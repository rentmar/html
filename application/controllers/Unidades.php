<?php

class Unidades extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('Unidad_model');
		$this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->library('session');
    }

	public function crearUnidad()
	{
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('unidad/vunidad_crearunidad.php');

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function listaEditarUnidad()
	{
		$dtu['dts_unidad']=$this->Unidad_model->leerTodoUnidad();
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		$this->load->view('unidad/vunidad_listaeditarunidad.php',$dtu);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	
	public function registrarUnidad()
	{
		$this->Unidad_model->insertarUnidad($this->input->post('unidad'));
		redirect('unidades/crearUnidad');
	}
	public function editarUnidad($idu)
	{
		$dte['dt_edit']=$this->Unidad_model->leerUnidadPorId($idu);
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		
		$this->load->view('unidad/vunidad_editarunidad.php',$dte);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function modificarUnidad()
	{
		$this->Unidad_model->updateUnidad($this->input->post('editar_idunidad'),$this->input->post('editar_unidad'));
		redirect('MarcasLineasUnidades');
	}
}
