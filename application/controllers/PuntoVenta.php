<?php

class PuntoVenta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->library('ControlCode');
        $this->load->model('Empresa_model');
        $this->load->model('Producto_model');
        $this->load->model('Cliente_model');
        $this->load->model('Venta_model');

        //Comprobacion de session
        if ($this->session->sesion_activa === null) {
            $this->session->sess_destroy();
            redirect('/');
        }
    }

    public function index()
    {

        //Comprobar si existe un carrito  de compras
        if (!$this->session->has_userdata('carrito')) {
            //Si no existe crear la variable de session
            $this->session->set_userdata('carrito', []);
            $this->session->set_userdata('descuento_total', 0);
        }

        //Comprobar si existe un cliente asignado a la compra
        if (!$this->session->has_userdata('cliente')) {
            $this->session->set_userdata('cliente', []);
        }


        //Recupera la variable carrito de la session
        $carrito = $this->session->carrito;
        //Recupera la variable cliente de la session
        $cliente = $this->session->cliente;


        //Fijar las variables de paso a la vista
        $datos['carrito'] = $carrito;
        $datos['cliente'] = $cliente;

        $almacen_actual = $this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);


        //Restriccion campo de busqueda vacio
        if ($this->session->producto == "") {
            $lista_productos = null;
        } else {
            //$lista_productos = $this->Producto_model->buscarProductosPorNombre($almacen_actual->idalmacen, $this->session->producto);
            $lista_productos = $this->Producto_model->buscarProductoPorPatron($almacen_actual->idalmacen, $this->session->producto);
        }


        $datos['lista_productos'] = $lista_productos;


        //Encabezado
        $this->load->view('pos/pos_ui/vpos_header');
        $this->load->view('pos/pos_ui/vpos_navbar.php');

        //Cuerpo
        $this->load->view('pos/pos_ui/vpos_venta', $datos);

        //Pie
        $this->load->view('pos/pos_ui/vpos_footer');

    }

    //Para la busqueda por Nombre del producto
    public function buscarProducto()
    {
        //Capturar el patron de busqueda nombre de producto
        $nombre_producto = $this->input->post('producto');
        //Limpiar las variables de session
        $this->session->set_userdata('producto', ' ');
        //Colocar la nueva variable
        $this->session->set_userdata('producto', $nombre_producto);
        redirect('puntoVenta');
    }

    public function agregarProducto($identificador){

        //Capturar el identificador de producto
        $identificador_producto = $identificador;

        //Determinar el identificador de almacen
        $almacen = $this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);

        //Comprobar si el producto se encuentra en el carrito
        //Regresa -1 si es nuevo, Regresa el indice si ya se encuentra en el carrito,
        $indice = $this->obtenerIndiceProductoCarrito($identificador_producto);
        if($indice !== -1)
        {
            //El producto  ya esta en el carrito, aumentar la cantidad
            $this->aumentarProductoCarrito($indice);
        }else{
            //El producto es nuevo
            $producto = $this->Producto_model->leerProductoPorIdentificador($identificador_producto, $almacen->idalmacen);

            //Validacion del producto
            if($producto === null)
            {
                //El producto no existe
                $this->mensaje('No existe el producto con el identificador proporcionado', 'warning');
            }else{
                //El producto existe y hay stock
                $this->agregarAlCarrito($producto);
            }

        }
        redirect('puntoVenta/');

    }

    //Obtiene la posicion del producto en el carrito en base al identificador de producto
    //Retorna un identificador si el producto existe en el carrito
    //Retorna -1 si el producto no esta almacenado en la session
    private function obtenerIndiceProductoCarrito($identificador)
    {
        $carrito = $this->session->carrito; //Obtener la variable carrito de la session
        $numero_elementos_carrito = count($carrito);
        //Recorrer el arreglo
        for($i=0; $i < $numero_elementos_carrito; $i++)
        {
            if($carrito[$i]->idproducto === $identificador){
                return $i; //Retorna la posicion del producto en el carrito
            }
        }
        return -1; //Retorna negativo si el producto no existe en el carrito
    }

    //Agregar un nuevo producto al carrito
    //Argumento: Objeto Producto
    private function agregarAlCarrito($producto)
    {
        //Agrega al carrito un producto con cantidad inicial 1
        $carrito = $this->session->carrito;
        //Bandera de modificacion manual
        $producto->bandera_precio_manual = false;
        //Calculo del precio de venta
        $producto->precio_venta = $this->calcularPrecioDeVenta($producto->precio, $producto->incremento);
        $producto->cantidad = 1; //Agregar un producto al carrito
        $producto->descuento_porcentaje = 0; //Sin descuento inicial
        $descuento_calculado = $this->calcularDescuento($producto->precio, $producto->descuento_porcentaje);
        //Calculo del subtotal ((PU + incremento)-Descuento)*Cantidad
        $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
        array_push($carrito, $producto);
        $this->session->set_userdata('carrito', $carrito);
    }

    //Aumenta la cantidad existente en uno
    //Toma como argumento el indice del producto en el carrito de ventas, no el identificador
    private function aumentarProductoCarrito($indice)
    {
        $carrito = $this->session->carrito;
        //Extrae el producto especifico
        $producto = $carrito[$indice];
        if(!$producto->bandera_precio_manual)
        {
            $producto->precio_venta = $this->calcularPrecioDeVenta($producto->precio, $producto->incremento);
            $producto->cantidad++;
            $descuento_calculado = $this->calcularDescuento($producto->precio, $producto->descuento_porcentaje);
            $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
            $carrito[$indice] = $producto;
            $this->session->set_userdata('carrito', $carrito);
        }
        else
        {
            //$this->mensaje('Bandera precio manual', 'warning');
            //Incrementa la cantidad
            $producto->cantidad++;
            $descuento_calculado = $this->calcularDescuento($producto->precio_venta, $producto->descuento_porcentaje);
            $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
            $carrito[$indice] = $producto;
            $this->session->set_userdata('carrito', $carrito);
        }
    }



    //Reduce la cantidad existenten en uno
    private function reducirProductoCarrito($indice)
    {
        $carrito = $this->session->carrito;
        $producto = $carrito[$indice];
        if(!$producto->bandera_precio_manual)
        {
            if($producto->cantidad > 1)
            {
                $producto->cantidad--;
                $producto->precio_venta = $this->calcularPrecioDeVenta($producto->precio, $producto->incremento);
                $descuento_calculado = $this->calcularDescuento($producto->precio, $producto->descuento_porcentaje);
                $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
                $carrito[$indice] = $producto;
                $this->session->set_userdata('carrito', $carrito);
            }
        }
        else
        {
            if($producto->cantidad > 1)
            {
                $producto->cantidad--;
                $descuento_calculado = $this->calcularDescuento($producto->precio_venta, $producto->descuento_porcentaje);
                $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
                $carrito[$indice] = $producto;
                $this->session->set_userdata('carrito', $carrito);
            }
            //$this->mensaje('Bandera precio manual', 'warning');
        }


    }

    public function aumentarPorcentajeCarrito($indice)
    {
        $carrito = $this->session->carrito;
        $producto = $carrito[$indice];
        if(!$producto->bandera_precio_manual)
        {
            if($producto->descuento_porcentaje < $producto->descuento)
            {
                $producto->descuento_porcentaje++;
                $producto->precio_venta = $this->calcularPrecioDeVenta($producto->precio, $producto->incremento);
                $descuento_calculado = $this->calcularDescuento($producto->precio, $producto->descuento_porcentaje);
                $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
                $carrito[$indice] = $producto;
                $this->session->set_userdata('carrito', $carrito);
            }
            else{
                $this->mensaje('Limite del descuento', 'warning');
            }

        }
        else
        {
            //$this->mensaje('Bandera precio manual', 'warning');
            if($producto->descuento_porcentaje < $producto->descuento)
            {
                $producto->descuento_porcentaje++;
                $descuento_calculado = $this->calcularDescuento($producto->precio_venta, $producto->descuento_porcentaje);
                $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
                $carrito[$indice] = $producto;
                $this->session->set_userdata('carrito', $carrito);
            }
            else{
                $this->mensaje('Limite del descuento', 'warning');
            }

        }
        redirect('puntoVenta/');
    }

    public function reducirPorcentajeCarrito($indice)
    {
        $carrito = $this->session->carrito;
        $producto = $carrito[$indice];
        if(!$producto->bandera_precio_manual)
        {
            if($producto->descuento_porcentaje > 0 )
            {
                $producto->descuento_porcentaje--;
                $producto->precio_venta = $this->calcularPrecioDeVenta($producto->precio, $producto->incremento);
                $descuento_calculado = $this->calcularDescuento($producto->precio, $producto->descuento_porcentaje);
                $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
                $carrito[$indice] = $producto;
                $this->session->set_userdata('carrito', $carrito);
            }
        }
        else
        {
            //$this->mensaje('Bandera precio manual', 'warning');
            if($producto->descuento_porcentaje > 0 )
            {
                $producto->descuento_porcentaje--;
                $descuento_calculado = $this->calcularDescuento($producto->precio_venta, $producto->descuento_porcentaje);
                $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
                $carrito[$indice] = $producto;
                $this->session->set_userdata('carrito', $carrito);
            }

        }

        redirect('puntoVenta/');
    }

    public function aumentarCantidad($indice)
    {
        $this->aumentarProductoCarrito($indice);
        redirect('puntoVenta/');
    }
    public function reducirCantidad($indice)
    {
        $this->reducirProductoCarrito($indice);
        redirect('puntoVenta/');
    }

    public function editarCantidad($indice)
    {
        $cantidad_nueva = $this->input->post('cantidadman');
        $carrito = $this->session->carrito;
        $producto = $carrito[$indice];


        if(!$producto->bandera_precio_manual)
        {
            $producto->cantidad = $cantidad_nueva;
            $producto->precio_venta = $this->calcularPrecioDeVenta($producto->precio, $producto->incremento);
            $descuento_calculado = $this->calcularDescuento($producto->precio, $producto->descuento_porcentaje);
            $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
            $carrito[$indice] = $producto;
            $this->session->set_userdata('carrito', $carrito);
        }
        else
        {
            //$this->mensaje('Bandera precio manual', 'warning');
            $producto->cantidad = $cantidad_nueva;
            $descuento_calculado = $this->calcularDescuento($producto->precio_venta, $producto->descuento_porcentaje);
            $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
            $carrito[$indice] = $producto;
            $this->session->set_userdata('carrito', $carrito);
        }

        redirect('puntoVenta/');
    }

    public function editarPorcentaje($indice)
    {
        $porcentaje_editado = $this->input->post('porcentajeman');
        $carrito = $this->session->carrito;
        $producto = $carrito[$indice];
        if(!$producto->bandera_precio_manual)
        {
            if( $porcentaje_editado <= $producto->descuento)
            {
                $producto->descuento_porcentaje = $porcentaje_editado;
                $producto->precio_venta = $this->calcularPrecioDeVenta($producto->precio, $producto->incremento);
                $descuento_calculado = $this->calcularDescuento($producto->precio, $producto->descuento_porcentaje);
                $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
                $carrito[$indice] = $producto;
                $this->session->set_userdata('carrito', $carrito);
            }
            else
            {
                $this->mensaje('El descuento ha excedido el limite', 'warning');
            }

        }
        else
        {
            //$this->mensaje('Bandera precio manual', 'warning');
            if( $porcentaje_editado <= $producto->descuento)
            {
                $producto->descuento_porcentaje = $porcentaje_editado;
                $descuento_calculado = $this->calcularDescuento($producto->precio_venta, $producto->descuento_porcentaje);
                $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
                $carrito[$indice] = $producto;
                $this->session->set_userdata('carrito', $carrito);
            }
            else
            {
                $this->mensaje('El descuento ha excedido el limite', 'warning');
            }
        }
        redirect('puntoVenta/');
    }


    public function editarPrecio($indice)
    {
        //Captura el precio ajustado manualmente
        $precio_editado = $this->input->post('precioman');

        //Recupera la variable de session carrito
        $carrito = $this->session->carrito;
        //Recupera el producto a editarse
        $producto = $carrito[$indice];

        //Ajustar el nuevo precio de venta
        $producto->precio_venta = $precio_editado;
        //Cambiar la bandera
        $producto->bandera_precio_manual = true;

        //Calculo del descuento y los totales
        $descuento_calculado = $this->calcularDescuento($producto->precio_venta, $producto->descuento_porcentaje);
        $producto->total = ($producto->precio_venta - $descuento_calculado)*($producto->cantidad);
        //Reemplazar las nuevos valores
        $carrito[$indice] = $producto;
        $this->session->set_userdata('carrito', $carrito);

        redirect('puntoVenta/');
    }



    private function calcularPrecioDeVenta($precio, $incremento)
    {
        $precio_lista = $precio;
        $margen = $incremento;
        $precio_venta = (($margen/100)*$precio_lista) + $precio_lista;
        $precio_venta = $this->redondeoCargos($precio_venta, 1);
        return $precio_venta;
    }

    public function quitarProducto($indice)
    {
        $carrito = $this->session->carrito;
        array_splice($carrito, $indice, 1);
        $this->session->set_userdata('carrito', $carrito);
        redirect('puntoVenta');
    }


    private function calcularDescuento($precio, $descuento_porcentaje)
    {
        //Calculo del descuento
        $descuento = ($descuento_porcentaje/100)*$precio;
        $descuento_ajustado = $this->redondeoDescuentos($descuento, 1);
        return $descuento_ajustado;
    }
    //Procedimiento para el redondeo de cifras
    protected function redondeoDescuentos($cantidad, $precision) {
        //Redondea los descuentos al inmediato inferior
        return round($cantidad, $precision, PHP_ROUND_HALF_DOWN);
    }
    //Procedimiento para el redondeo de cifras
    protected function redondeoCargos($cantidad, $precision) {
        //Redondea los cargos al inmediato superior
        return round($cantidad, $precision, PHP_ROUND_HALF_UP);
    }

    //Despliegue de mensaje
    public function mensaje($mensaje, $clase){
        $this->session->set_flashdata([
            'mensaje' => $mensaje,
            'clase' => $clase,
        ]);
    }

    //Vaciar el carrito
    private function vaciarCarrito() {
        $this->session->set_userdata('carrito', []); //Limpiar el carrito
        $this->session->set_userdata('cliente', []); //Limpiar el cliente
        $this->session->set_userdata('descuento_total', 0);
    }

    public function limpiarVariable()
    {
        $this->vaciarCarrito();
    }

    //Ajustar la variable de session descuento_total
    private function setDescuentoTotal($valor)
    {
        $this->session->set_userdata('descuento_total', $valor);
    }

    //Rutinas para los descuentos totales
    public function masDescuentoTotal() {
        $descuento = $this->session->descuento_total;
        if($descuento == 100)
        {
            $this->mensaje("Limite del descuento total", "warning");
            redirect('puntoVenta/');
        }
        else
        {
            $descuento = $descuento + 1;
            $this->setDescuentoTotal($descuento);
            redirect('puntoVenta/');
        }
    }

    public function menosDescuentoTotal() {
        $descuento = $this->session->descuento_total;
        if($descuento == 0)
        {
            $this->mensaje("Limite del descuento total", "warning");
            redirect('puntoVenta/');
        }
        else
        {
            $descuento = $descuento - 1;
            $this->setDescuentoTotal($descuento);
            redirect('puntoVenta/');
        }
    }

    public function manualDescuentoTotal() {
        $descuento = $this->input->post('descuento');
        $this->setDescuentoTotal($descuento);
        redirect('puntoVenta/');
    }

    //Conversor de datetime picker a Unix TST
    private function fechaToUnixTimeStamp($fechaDMY) {
        list($fecha, $hora, $ap) = explode(' ', $fechaDMY);
        //Fragmentar la fecha
        list($mm, $dd, $yyyy) = explode('/', $fecha);
        //Fragmentat la hora
        list($h, $m) = explode(':', $hora);
        if($ap == 'PM')
        {
            $h = $h + 12;
        }

        $unixtime = mktime($h, $m, 0, $mm, $dd, $yyyy);

        return $unixtime;
    }

    public function cancelarVenta() {
        $this->vaciarCarrito();
        $this->mensaje("Venta cancelada correctamente", "success");
        redirect('puntoVenta/');
    }

    public function agregarCliente()
    {
        $nit = trim($this->input->post('nit'));
        $rsocial = trim($this->input->post('rsocial'));


        //Definir el array de sesion del cliente
        $datos_cliente = [];

        //Obtener la variable de sesion cliente
        $cliente = $this->session->cliente;

        //Extraer el cliente de la base de datos
        $persona = $this->Cliente_model->leerClientePorNit($nit);

        var_dump($persona);

        if($persona === null) //El cliente es nuevo
        {
            if($rsocial != null)
            {
                //Definir los datos de la session
                $datos_cliente =[
                    'idcliente' => 0,
                    'nit' => $nit,
                    'razonSocial' => $rsocial,
                ];
                $this->session->set_userdata('cliente', []);
                $cliente = [];
                array_push($cliente, $datos_cliente);
                $this->session->set_userdata('cliente', $cliente);
            }
            else
            {
                //La razon social del cliente no ha sido
                $this->mensaje('Es un cliente nuevo. No se proporciono la razon social del cliente', 'danger');
                $this->valorNit($nit);
            }
        }
        else //El cliente esta registrado
        {
            //Definir los datos de la session
            $datos_cliente =[
                'idcliente' => $persona->idclipro,
                'nit' => $persona->nit ,
                'razonSocial' => $persona->razon_social,
            ];
            $this->session->set_userdata('cliente', []);
            $cliente = [];
            array_push($cliente, $datos_cliente);
            $this->session->set_userdata('cliente', $cliente);
        }

        redirect('puntoVenta/');
    }

    private function valorNit($param) {
        $this->session->set_flashdata([
            'valorNit'=>$param,
        ]);
    }

    //Procesar la venta
    public function procesarVenta()
    {
        $carrito = $this->session->carrito;

        $venta_actual = [
            'fecha' =>'',
            'tipo_venta' => $this->input->post('tipo_venta'),
            'venta_parcial' => $this->input->post('montototal'),
            'descuento_total' => $this->input->post('descuentototal'),
            'descuento_total_porcentaje' => $this->session->descuento_total,
            'venta_total' => $this->input->post('ventatotal'),
        ];

        if(count($carrito)>=1 && $this->session->cliente!=[])
        {
            //Informacion del cliente
            $cliente = $this->session->cliente;
            //Informacion del usuario activo
            $usuario_actual = $this->ion_auth->user()->row();
            $empresa_almacen = $this->Empresa_model->leerEmpresaAlmacen($this->session->sucursal->idempresa);
            $datos_facturacion = $this->Empresa_model->leerEmpresaMasDatosFacturacion($this->session->sucursal->idempresa);

            $datos['carrito'] = $carrito;
            $datos['cliente_actual'] = $cliente;
            $datos['usuario_actual'] = $usuario_actual;
            $datos['empresa_almacen'] = $empresa_almacen;
            $datos['venta_actual'] = $venta_actual;
            $datos['datos_facturacion'] = $datos_facturacion;



            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            if($venta_actual['tipo_venta'] == 1)
            {
                $this->load->view('ventas/vventas_contado.php', $datos);
            }
            elseif ($venta_actual['tipo_venta'] == 2)
            {
                //echo "Credito";
                $this->load->view('ventas/vventas_credito.php', $datos);
            }
            elseif ($venta_actual['tipo_venta'] == 3)
            {
                //echo "Debito";
                $this->load->view('ventas/vventas_debito.php', $datos);
            }
            elseif ($venta_actual['tipo_venta'] == 4 )
            {
                //echo "Cheque";
                $this->load->view('ventas/vventas_cheque.php', $datos);
            }
            elseif ($venta_actual['tipo_venta'] == 5)
            {
                //echo "Sin Factura";
                $this->load->view('ventas/vventas_nofactura.php', $datos);
            }
            elseif ($venta_actual['tipo_venta'] == 6)
            {
                echo "Cotizacion";
            }



            /**** PIE ****/
            $this->load->view('html/pie.php');










        }
        else
        {
            //Venta fallida
            $this->mensaje('No existe venta para procesar', 'danger');
            redirect('puntoVenta/');
        }


    }

    public function registrarVenta()
    {
        $carrito = $this->session->carrito;
        $venta = $this->capturarVenta();
        $cliente = $this->session->cliente;
        if(count($carrito)>=1 && $this->session->cliente!=[])
        {
            //Registrar la venta
            $idventa = $this->Venta_model->registrarVenta($venta, $carrito, $cliente);
            //var_dump($venta);

           if($idventa != false)
            {
                //Registro insertado
                //Redirigir a la vista de facturas
                $this->vaciarCarrito();
                redirect('facturacion/facturacionContado/'.$idventa);
            }
            else
            {
                //Registro no insertado, redirigir punto de venta
                $this->mensaje('No existe datos de la venta', 'danger');
                redirect('puntoVenta/');
            }
        }
        else
        {
            //Venta fallida
            $this->mensaje('No existe venta para procesar', 'danger');
            redirect('puntoVenta/');
        }
    }

    private function capturarVenta()
    {
        $empresa_almacen = $this->Empresa_model->leerEmpresaAlmacen($this->session->sucursal->idempresa);
        $usuario_actual = $this->ion_auth->user()->row();
        $venta = [
            'fecha' => strtotime(trim($this->input->post('fecha'))),
            'rel_idcliente' => base64_decode(trim($this->input->post('idcliente'))),
            'total' => $this->input->post('ventatotal'),
            'saldo' => 0,
            'descuento_total' => $this->input->post('de-total'),
            'cargo_transaccion' => 0,
            'es_compra' => 0,
            'es_deuda' => 0,
            'es_facturado' => $this->input->post('factura'),
            'rel_idtipopago' => $this->input->post('tipoventa') ,
            'rel_idempresa' => $empresa_almacen->idempresa,
            'rel_idusuario' => $usuario_actual->id,
            'idalmacen' => $empresa_almacen->idalmacen,
            'numero_factura' =>$this->input->post('numerofactura'),
            'monto_cuenta' => $this->input->post('montoacuenta'),
            'cargo_transaccion' => $this->input->post('cargo'),
        ];
        return $venta;
    }






}