<?php

class Pos extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->library('ControlCode');
		$this->load->model('Empresa_model');
		//Comprobacion de session
		if($this->session->sesion_activa ===  null){
			$this->session->sess_destroy();
			redirect('/');
		}
	}

	public function index()
	{
	    $datos_empresa = $this->Empresa_model->leerEmpresaMasDatosFacturacion($this->session->sucursal->idempresa);
	    $datos['datos_empresa'] = $datos_empresa;

		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('pos/vpos_index.php', $datos);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
}
