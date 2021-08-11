<?php
class Venta_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('ControlCode');
        $this->load->library('calendar');
        $this->load->model('Cliente_model');
    }


    //Registrar venta
    public function registrarVenta($venta, $carrito, $cliente)
    {
        $venta_actual = $venta;
        $cliente_actual = $cliente;
        $tipo_venta = $venta_actual['rel_idtipopago'];
        $empresa = $venta_actual['rel_idempresa'];
        $numero_factura = $venta_actual['numero_factura'];
        unset($venta_actual['numero_factura']);

        //Extraer el identificador del almacen
        $idalmacen = $venta_actual['idalmacen'];
        unset($venta_actual['idalmacen']);

        //Monto a cuenta
        $monto_cuenta = $venta_actual['monto_cuenta'];
        unset($venta_actual['monto_cuenta']);

        //Porcentaje cargo debito
        $cargo_debito = $venta_actual['cargo_transaccion'];
        unset($venta_actual['cargo_transaccion']);

        //Inicia la transaccion
        $this->db->trans_begin();

        //Insertar el cliente si es nuevo
        if( $cliente_actual[0]['idcliente'] == 0 )
        {
            //Cliente nuevo
            $this->db->insert('ent_cliente_proveedor',[
                'nit' => $cliente_actual[0]['nit'],
                'razon_social' => $cliente_actual[0]['razonSocial'],
                'es_cliente' => 1,
                'es_proveedor' => 0,
            ]);
            //Agrega el identificador del cliente nuevo al registro de venta
            $venta_actual['rel_idcliente'] = $this->db->insert_id();
        }
        //Tipo de venta al credito, registrar el saldo
        if($tipo_venta == 2)
        {
            $saldo = $venta_actual['total']-$monto_cuenta;
            $venta_actual['saldo'] = $saldo;
            $venta_actual['es_deuda'] = 1;
        }

        //Tipo de venta debito
        if($tipo_venta == 3)
        {
            $venta_actual['cargo_transaccion'] = $cargo_debito;
        }

        //Inserta el registro de venta
        $this->db->insert('ent_compra_venta', $venta_actual);
        //Captura el id de la venta insertada
        $idventa = $this->db->insert_id();

        //Inserta el detalle de la venta y modifica las cantidades del almacen
        foreach ($carrito as $indice => $producto){
            //Inserta el detalle
            $this->db->insert('t_detalle', [
                'rel_idcomven' => $idventa,
                'rel_idproducto' => $producto->idproducto,
                'cantidad_producto' => $producto->cantidad,
                'descuento_producto' => $producto->descuento_porcentaje,
                'total_producto' => $producto->total,
            ]);
            //Modifica las cantidades en el almacen correspondiente
            $prod = $this->leerProductoExistencias($idalmacen, $producto->idproducto);
            $existencia_actualizada = $prod->existencias - $producto->cantidad;

            //Actualizar la base de datos
            $condiciones = [
                'rel_almacen' => $idalmacen,
                'rel_producto' => $producto->idproducto,
            ];
            $nueva_cantidad = [
                'existencias' => $existencia_actualizada,
            ];
            //Modificar los datos en la Tabla
            $this->db->where($condiciones);
            $this->db->update('t_almacen_producto', $nueva_cantidad);
        }

        //Genera el registro de factura asociado al registro de venta
        if($venta_actual['es_facturado'] == 1)
        {
            //Datos de facturacion
            $datos_fac = $this->leerDatosFacturacion($empresa);
            $cliente = $this->Cliente_model->leerProveedorPorId($venta_actual['rel_idcliente']);
            $empresa_actual = $this->Empresa_model->leerEmpresaPorIdentificador($empresa);
            //Calculo del codigo de control
            $numAutorizacion = $datos_fac->numero_autorizacion;
            $numFactura = $numero_factura;
            $nitCliente = $cliente->nit;
            $fechaTransaccion = mdate('%Y%m%d', $venta_actual['fecha']);
            $llaveDosificacion = $datos_fac->llave_dosificacion;
            $montoTransaccion = $venta_actual['total'] - $venta_actual['descuento_total'];

            $codControl = $this->controlcode->generate($numAutorizacion, $numFactura, $nitCliente, $fechaTransaccion, $montoTransaccion, $llaveDosificacion);

            $cadenaQR = $empresa_actual->nit.'|'.$numFactura.'|'.$numAutorizacion.'|'.mdate('%d/%m/%Y', $venta_actual['fecha']).'|'.$montoTransaccion.'|'.$montoTransaccion.'|'.$codControl.'|'.$nitCliente.'|'.'0'.'|'.'0'.'|'.'0'.'|'.'0';


            //Crear el registro para la factura
            $factura_regventa = [
                'fecha_facturacion' => $venta_actual['fecha'],
                'numero_factura' => $numero_factura,
                'numero_autorizacion' => $datos_fac->numero_autorizacion,
                'estado' => 'V',
                'cod_control' => $codControl,
                'fecha_limite_emision'=>$datos_fac->fecha_limite_emision,
                'llave_dosificacion'=>$datos_fac->llave_dosificacion,
                'codigo_qr' => $cadenaQR,
                'rel_idcomven' => $idventa,
            ];
            //Inserta el registro
            $this->db->insert('ent_facturas', $factura_regventa);
            //Actualizar el contador de facturas
            //$datos_fac = $this->leerDatosFacturacion($empresa);
            $valores_contador = [
                'numero_actual_factura' => $numero_factura + 1,
                'numero_ultimo_factura' => $numero_factura,
            ];
            $this->db->where('iddfac', $datos_fac->iddfac);
            $this->db->update('t_datos_factura', $valores_contador);
        }


        //Comprobar el estado de la transaccion
        if($this->db->trans_status() === false )
        {
            //Error en alguna consulta
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            //Todas las consultas se  efectuaron correctamente
            $this->db->trans_commit();
            return $idventa;
        }

    }

    //Lee las existencias de un producto en un almacen
    private function leerProductoExistencias($idalmacen, $idproducto)
    {
        $identificador_almacen = $idalmacen;
        $identificador_producto = $idproducto;
        $sql = "SELECT * "
            ."FROM ent_almacen "
            ."LEFT JOIN t_almacen_producto ON t_almacen_producto.rel_almacen = ent_almacen.idalmacen "
            ."WHERE t_almacen_producto.rel_almacen = ? AND t_almacen_producto.rel_producto = ? ";
        $qry = $this->db->query($sql, [$identificador_almacen, $identificador_producto ]);
        return $qry->row();
    }

    //Lee los datos de facturacion de una empresa
    public function leerDatosFacturacion($identificador)
    {
        $identificador_empresa = $identificador;
        $sql = "SELECT * "
            ."FROM ent_empresa "
            ."LEFT JOIN t_datos_factura ON t_datos_factura.iddfac = ent_empresa.rel_datos_factura "
            ."WHERE ent_empresa.idempresa = ? ";
        $qry = $this->db->query($sql, [$identificador_empresa, ]);
        return $qry->row();
    }

    //Leer la informacion de un registro de ventas
    public function leerRegistroVenta($identificador)
    {
        $idventa = $identificador;
        $sql = "SELECT *  "
            ."FROM ent_compra_venta  "
            ."LEFT JOIN ent_cliente_proveedor ON ent_cliente_proveedor.idclipro = ent_compra_venta.rel_idcliente  "
            ."LEFT JOIN t_tipo_pago ON t_tipo_pago.idtipopago = ent_compra_venta.rel_idtipopago   "
            ."WHERE ent_compra_venta.idcomven = ?  ";
        $qry = $this->db->query($sql, [$idventa]);
        return $qry->row();
    }

    //Leer detalle de venta
    public function leerDetalleVenta($identificador)
    {
        $sql = "SELECT *  "
            ."FROM t_detalle "
            ."LEFT JOIN ent_producto ON ent_producto.idproducto = t_detalle.rel_idproducto "
			."LEFT JOIN ent_marca ON ent_producto.rel_idmarca = ent_marca.idmarca "
			."LEFT JOIN ent_linea ON ent_producto.rel_idlinea = ent_linea.idlinea "
            ."WHERE t_detalle.rel_idcomven = ? ";
        $qry = $this->db->query($sql, [$identificador]);
        return $qry->result();
    }





}
