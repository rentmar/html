<?php

class Factura_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Extraer todos los registros
    public function leerTodasLasDosificaciones($idempresa) {
        $sql =    "SELECT * "
            . "FROM ent_registro_dosificacion "
            . "WHERE ent_registro_dosificacion.rel_idempresa = ? "
            . "ORDER BY ent_registro_dosificacion.fecha_dosificacion DESC "
            . "LIMIT 10  ";
        $qry = $this->db->query($sql, [$idempresa]);
        return $qry->result();
    }

    //Extraer la ultima dosificacion
    public function getUltimaDosificacion($idempresa) {
        $sql =    "SELECT * "
            . "FROM ent_registro_dosificacion "
            . "WHERE ent_registro_dosificacion.rel_idempresa = ? "
            . "ORDER BY ent_registro_dosificacion.fecha_dosificacion DESC "
            . "LIMIT 1  ";
        $qry = $this->db->query($sql, [$idempresa]);
        return $qry->row();
    }

    //Actualizar los datos de dosificacion
    public function updateDatosFacturacion($datos)
    {
        //Capturar el identificador
        $iddfac = $datos['iddfac'];
        $idempresa = $datos['idempresa'];
        //Generar el registro de dosificacion
        $registro_dosificacion = [
            'fecha_dosificacion' => now(),
            'rel_idempresa' => $idempresa,
            'numero_autorizacion_reg' => $datos['numero_autorizacion'],
            'fecha_limite_emision ' => $datos['fecha_limite_emision'],
            'llave_dosificacion_reg' => $datos['llave_dosificacion'],
            'pie_reg'=> $datos['pie'],
            'pie_ley453_reg ' =>$datos['pie_ley453'],
        ];
        unset($datos['idempresa']);
        unset($datos['iddfac']);
        //Transaccion
        $this->db->trans_start(); //Inciar la transaccion
        //Actualizar los datos de facturacion
        $this->db->where('iddfac', $iddfac);
        $this->db->update('t_datos_factura', $datos);
        //Insertar el registro
        $this->db->insert('ent_registro_dosificacion', $registro_dosificacion);
        $this->db->trans_complete();
        if($this->db->trans_status() === false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //Extraer las facturas emitidas en un periodo
    public function leerFacturasMesActual($idSucursal, $datos_facturacion)
    {
        $sql ="SELECT *  "
            . "FROM ent_compra_venta "
            . "LEFT JOIN ent_facturas ON ent_facturas.rel_idcomven = ent_compra_venta.idcomven "
            . "LEFT JOIN ent_cliente_proveedor ON ent_compra_venta.rel_idcliente = ent_cliente_proveedor.idclipro  "
            . "WHERE ent_compra_venta.es_facturado = ? "
            . "AND ent_compra_venta.rel_idempresa = ?  "
            . "AND ent_facturas.numero_autorizacion = ?  "
            . "AND ent_facturas.fecha_limite_emision = ? "
            . "ORDER BY ent_facturas.numero_factura ASC ";
        $qry = $this->db->query($sql, [true, $idSucursal, $datos_facturacion->numero_autorizacion, $datos_facturacion->fecha_limite_emision ]);
        return $qry->result();
    }
	public function leerFacturasMesCliente($idSucursal, $datos_facturacion,$nit)
    {
        $sql ="SELECT *  "
            . "FROM ent_compra_venta "
            . "LEFT JOIN ent_facturas ON ent_facturas.rel_idcomven = ent_compra_venta.idcomven "
            . "LEFT JOIN ent_cliente_proveedor ON ent_compra_venta.rel_idcliente = ent_cliente_proveedor.idclipro  "
            . "WHERE ent_compra_venta.es_facturado = ? "
            . "AND ent_compra_venta.rel_idempresa = ?  "
            . "AND ent_facturas.numero_autorizacion = ?  "
            . "AND ent_facturas.fecha_limite_emision = ? "
			. "AND ent_cliente_proveedor.nit = ".$nit." "
            . "ORDER BY ent_facturas.numero_factura ASC ";
        $qry = $this->db->query($sql, [true, $idSucursal, $datos_facturacion->numero_autorizacion, $datos_facturacion->fecha_limite_emision ]);
        return $qry->result();
    }

    //Extraer todas las facturas emitidas
    public function leerFacturasEmitidas($idEmpresa)
    {

    }

    //Leer la factura asociada con el registro de ventas
    public function leerFacturaPorRegistro($identificador)
    {
        $qry = $this->db->get_where('ent_facturas', ['rel_idcomven'=>$identificador]);
        return $qry->row()->idfactura;
    }

    //Leer factura por identificador
    public function leerFacturaPorID($identificador){
        $qry = $this->db->get_where('ent_facturas', ['idfactura'=>$identificador]);
        return $qry->row();
    }

    public function leerFacturas()
    {
        $sql ="SELECT *  "
            . "FROM ent_facturas "
            . "ORDER BY ent_facturas.numero_factura ASC "
            . "  "
            . " "
            . "  "
            . "  "
            . " "
            . " "
            . " ";
        $qry = $this->db->query($sql);
        return $qry->result();
    }


}