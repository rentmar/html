<?php

class Movimientos extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->helper('date');
		$this->load->model('Producto_model');
		$this->load->model('Cliente_model');
		$this->load->model('Empresa_model');
		$this->load->model('Almacen_model');
		$this->load->model('Movimiento_model');
        $this->load->library('session');
        $this->load->library('ion_auth');
    }
	public function index()
	{
		$almacen=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$dt['movs']=$this->Movimiento_model->movimientoNoConfirmado($almacen->idalmacen);
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('movimientos/vmovimientos_index.php',$dt);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function movimientoProducto()
	{
		$almacen=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$dts['lista_productos']=$this->Almacen_model->leerProductosExistentesAlmacen($almacen->idalmacen);
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('movimientos/vmovimientos_producto.php',$dts);

		$this->load->view('html/pie.php');
	}
	public function solicitarMovimiento($idp)
	{
		$usuario = $this->ion_auth->user()->row();
		$datestring = '%Y-%m-%d';
		$time = time();
		$dts['fecha']=mdate($datestring, $time);
		$dts['usuario']=$usuario->id;
		$almacen_origen=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$dts['almacen_origen']=$almacen_origen;
		$dts['almacenes']=$this->Almacen_model->leerAlmacenes();
		$p=$this->Producto_model->leerProductoPorIdentificador($idp,$almacen_origen->idalmacen);
		$producto="{$p->fabricante}-{$p->linea}-{$p->item}-{$p->dimension}-{$p->unidad}";
		$dts['producto']=$producto;
		$dts['idprod']=$p->idproducto;
		$dts['existencias']=$p->existencias;
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('movimientos/vmovimientos_solicitud.php',$dts);

		$this->load->view('html/pie.php');
	}
	public function registrarSolicitud()
	{
		$f=$this->input->post('fecha');
		$u=$this->input->post('usuario');
		$ido=$this->input->post('idorigen');
		$idp=$this->input->post('idproducto');
		$e=$this->input->post('existencias');
		$m=$this->input->post('movimiento');
		$idd=$this->input->post('iddestino');
		if($m>$e)
		{
			redirect ('Movimientos/solicitarMovimiento/'.$idp);
		}
		else 
		{
			$fecha=$this->fecha_unix($f);
			$datos=array(
						'rel_idusuario'=>$u,
						'rel_idproducto'=>$idp,
						'fecha_movimiento'=>$fecha,
						'cantidad_producto'=>$m,
						'rel_idalmacen_origen'=>$ido,
						'rel_idalmacen_destino'=>$idd,
						'rel_idusuario_destino'=>1,//alog 
						'confirmacion'=>0);
			$this->Movimiento_model->ingresarMovimiento($datos);
			redirect ('Movimientos');
		}
	}
	public function confirmacionMovimiento()
	{
		$almacen=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$lista=$this->Movimiento_model->leerNoConfirmados($almacen->idalmacen);
		$dts['lista']=$lista;
		$dts['destino']=$almacen;
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('movimientos/vmovimientos_confirmacion.php',$dts);

		$this->load->view('html/pie.php');
	}
	public function confirmarMovimiento($idmov)
	{
		$almacen=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$dtsmov=$this->Movimiento_model->datosMovimiento($idmov);
		$c=$this->Almacen_model->leerCantidadAlmacenProducto($almacen->idalmacen,$dtsmov[0]->rel_idproducto);
		$cant=$c[0]->existencias-$dtsmov[0]->cantidad_producto;
		$this->Almacen_model->updateCantidadAlmacen($almacen->idalmacen,$dtsmov[0]->rel_idproducto,$cant);
		$c=$this->Almacen_model->leerCantidadAlmacenProducto($dtsmov[0]->rel_idalmacen_origen,$dtsmov[0]->rel_idproducto);
		$cant=$c[0]->existencias+$dtsmov[0]->cantidad_producto;
		$this->Almacen_model->updateCantidadAlmacen($dtsmov[0]->rel_idalmacen_origen,$dtsmov[0]->rel_idproducto,$cant);
		$this->Movimiento_model->confirmarMovimiento($idmov);
		redirect ("Movimientos/confirmacionMovimiento");
	}
	private function fecha_unix($fecha) 
	{
        list($anio, $mes, $dia) = explode('/', $fecha);
        $fecha_unix = mktime(0, 0, 0, $mes, $dia, $anio);
        return $fecha_unix;
    }
}
