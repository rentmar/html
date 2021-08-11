<?php

class Lineas extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('Linea_model');

        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->library('session');
    }

	public function crearLinea()
	{
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('linea/vlinea_crearlinea.php');

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function registrarLinea()
	{
		$this->Linea_model->insertarLinea($this->input->post('nombre_linea'));
		redirect('Lineas/crearLinea');
	}
	public function listaEditarLinea()
	{
		$dtl['dts_linea']=$this->Linea_model->leerTodoLinea();
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		$this->load->view('linea/vlinea_listaeditarlinea.php',$dtl);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function editarLinea($idl)
	{
		$dte['dt_edit']=$this->Linea_model->leerLineaPorId($idl);
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		
		$this->load->view('linea/vlinea_editarlinea.php',$dte);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function modificarLinea()
	{
		$this->Linea_model->updateLinea($this->input->post("edit_idlinea"),$this->input->post("edit_nombre_linea"));
		redirect('MarcasLineasUnidades');
	}
}
