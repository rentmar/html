<?php

class Compras extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('date');
		$this->load->model('Compra_model');
		$this->load->model('Producto_model');
		$this->load->model('Cliente_model');
		$this->load->model('Empresa_model');
        $this->load->library('session');
        $this->load->library('ion_auth');
    }
	public function index()
	{
		if (!$this->session->has_userdata('carrito_compra')) 
		{
            //Si no existe crear la variable de session
            $this->session->set_userdata('carrito_compra',[]);
        }
		if (!$this->session->has_userdata('proveedor')) 
		{
            $this->session->set_userdata('proveedor', []);
        }
		if (!$this->session->has_userdata('datos_compra')) 
		{
            $this->session->set_userdata('datos_compra', []);
        }
		$carrito_compra=$this->session->carrito_compra;
		$dts['carrito_compra'] = $carrito_compra;
		$dts['noconfirmada']=$this->Compra_model->comprasNoConfirmadas();
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('compras/vcompras_index.php',$dts);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function proveedorCompra()
	{
		$dts['almacen']=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$dts['lista_proveedores']=$this->Cliente_model->leerProveedores();
		$datestring = '%Y-%m-%d';
		$time = time();
		$dts['fecha']=mdate($datestring, $time);
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		$this->load->view('compras/vcompras_proveedorcompra.php',$dts);
		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function comprarProducto()
	{
		$almacen=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		if ($this->session->proveedor==[])
		{
			$this->session->proveedor=$this->Cliente_model->leerProveedorPorId($this->input->post('idproveedor'));	
		}
		if ($this->session->datos_compra==[])
		{
			$this->session->datos_compra=array(
										'fecha'=>$this->input->post('fecha'),
										'codigo_pedido'=>$this->input->post('codigo_pedido'),
										'numero_factura'=>$this->input->post('numero_factura'));
		}

		$dts['lista_productos']=$this->Producto_model->leerTodoProducto();
		$dts['almacen']=$almacen;
		
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		$this->load->view('compras/vcompras_elegirproducto.php',$dts);
		
		$this->load->view('html/pie.php');
	}
	public function carritoCompra($idprod)
	{
		$indice = $this->obtenerIndiceProductoCarrito($idprod);
		if($indice !== 0)
        {
            $this->incrementarProductoCarrito($indice);
        }
		else
		{
            $this->agregarAlCarrito($idprod);
        }
		redirect ("compras/comprarProducto");
	}
	private function obtenerIndiceProductoCarrito($identificador)
    {
		$indice=0;
        $carrito = $this->session->carrito_compra; //Obtener la variable carrito de la session
        $numero_elementos_carrito = count($carrito);
		if ($numero_elementos_carrito!==0)
		{
			for ($i=0;$i<$numero_elementos_carrito;$i++)
			{
				if($carrito[$i]['idp']===$identificador)
				{
					$indice=$identificador;
				}
			}
		}
		return $indice;
    }
    private function agregarAlCarrito($idprod)
    {
        //Agrega al carrito un producto con cantidad inicial 1
        $carrito = $this->session->carrito_compra;
		$p=$this->Producto_model->leerProductoPorId($idprod);
		$producto="{$p[0]->fabricante}-{$p[0]->linea}-{$p[0]->item}-{$p[0]->dimension}-{$p[0]->unidad}";
		$producto_compra=array('idp'=>$p[0]->idproducto,
						 	'producto'=>$producto,
							'codigo'=>$p[0]->codigo,
							'cantidad'=>1,
							'precio'=>0);
        array_push($carrito, $producto_compra);
        $this->session->set_userdata('carrito_compra', $carrito);
    }
    private function incrementarProductoCarrito($indice)
    {
        $carrito = $this->session->carrito_compra;
		$contador=count($carrito);
		for ($i=0;$i<$contador;$i++)
		{
			if ($carrito[$i]['idp']===$indice)
			{
				$carrito[$i]['cantidad']++;
			}
		}
        $this->session->set_userdata('carrito_compra', $carrito);
    }
	public function quitarProducto($idp)
	{
		$carrito = $this->session->carrito_compra;
		$contador=count($carrito);
		for ($i=0;$i<$contador;$i++)
		{
			if ($carrito[$i]['idp']===$idp)
			{
				unset($carrito[$i]);
			}
		}
		$this->session->set_userdata('carrito_compra', $carrito);
		redirect ("compras/comprarProducto");
	}
	public function cantidadProducto($idp)
	{
		$valor=$this->input->post('cantidad');
		$carrito = $this->session->carrito_compra;
		$contador=count($carrito);
		for ($i=0;$i<$contador;$i++)
		{
			if ($carrito[$i]['idp']===$idp)
			{
				$carrito[$i]['cantidad']=$valor;
			}
		}
        $this->session->set_userdata('carrito_compra', $carrito);
		redirect ("compras/comprarProducto");
	}
	public function precioProducto($idp)
	{
		$valor=$this->input->post('precio');
		$carrito = $this->session->carrito_compra;
		$contador=count($carrito);
		for ($i=0;$i<$contador;$i++)
		{
			if ($carrito[$i]['idp']===$idp)
			{
				$carrito[$i]['precio']=$valor;
			}
		}
        $this->session->set_userdata('carrito_compra', $carrito);
		redirect ("compras/comprarProducto");
	}
	public function cancelarCompra()
	{
		$this->vaciarCompra();
		redirect ("compras");
	}
	private function vaciarCompra()
	{
		$this->session->set_userdata('carrito_compra',[]);
		$this->session->set_userdata('proveedor', []);
		$this->session->set_userdata('datos_compra', []);
	}
	public function registrarCompra()
	{
		$total=0;
		$f=$this->session->datos_compra['fecha'];
		$fecha = $this->fecha_unix($f);
		foreach ($this->session->carrito_compra as $prod)
		{
			$total=$total+$prod['precio'];
		}			
		$dts=array('proveedor'=>$this->session->proveedor->idclipro,
					'sucursal'=>$this->session->sucursal->idempresa,
					'usuario'=>1,
					'fecha'=>$fecha,
					'codigo_pedido'=>$this->session->datos_compra['codigo_pedido'],
					'numero_factura'=>$this->session->datos_compra['numero_factura'],
					'total'=>$total
					);
		$this->Compra_model->insertarCompra($dts,$this->session->carrito_compra);
		$this->vaciarCompra();
		redirect ("compras");
	}
	public function confirmacionCompra()
	{
		$dts['almacen']=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		
		$dts['listaconfirmar']=$this->Compra_model->registroComprasConfirmar();
		
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		$this->load->view('compras/vcompras_listaconfirmacioncompra.php',$dts);
		
		$this->load->view('html/pie.php');
	}
	public function cantidadRecibida($idr)
	{	
		$cantidades=$this->Compra_model->getCantidades($idr);
		$idp=$cantidades[0]->rel_idproducto;
		$ida=$this->session->sucursal->idempresa;
		if (($this->input->post('cantrecibida')+$cantidades[0]->cantidad_recibida)>$cantidades[0]->cantidad_producto)
		{
			redirect ('compras/confirmacionCompra');
		}
		else
		{
			$datestring = '%Y-%m-%d';
			$cant=$cantidades[0]->cantidad_recibida+$this->input->post('cantrecibida');
			$nota=$cantidades[0]->nota_recepcion.'-'.mdate($datestring, time()).' recibido:'.$this->input->post('cantrecibida');
			$this->Compra_model->updateCantidadRecibida($idr,$cant,$nota);
			$cant=$this->Compra_model->leerCantidadProductoAlmacen($idp,$ida)+$cant;
			$this->Compra_model->setProductoAlmacen($idp,$ida,$cant);
			$cantidades=$this->Compra_model->getCantidades($idr);
			if ($cantidades[0]->cantidad_recibida==$cantidades[0]->cantidad_producto)
			{
				$this->Compra_model->updateConfirmacion($idr);
			}
			redirect ('compras/confirmacionCompra');
		}
	}
	private function fecha_unix($fecha) 
	{
        list($anio, $mes, $dia) = explode('-', $fecha);
        $fecha_unix = mktime(0, 0, 0, $mes, $dia, $anio);
        return $fecha_unix;
    }
}
