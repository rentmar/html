<?php

class Marcas extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('Marca_model');
		$this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->library('session');
    }

	public function crearMarca()
	{
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('marca/vmarca_crearmarca.php');

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function listaMarcas()
	{
		$dtm['dts_marca']=$this->Marca_model->leerTodoMarca();
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		$this->load->view('marca/vmarca_listaeditarmarca.php',$dtm);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	
	public function registrarMarca()
	{
		$this->Marca_model->insertarMarca($this->input->post('marca'));
		redirect('marcas/crearMarca');
	}
	public function editarMarca($idm)
	{
		$dte['dt_edit']=$this->Marca_model->leerMarcaPorId($idm);
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");
		
		$this->load->view('marca/vmarca_editarmarca.php',$dte);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function modificarMarca()
	{
		$this->Marca_model->updateMarca($this->input->post('editar_idmarca'),$this->input->post('editar_marca'));
		redirect('MarcasLineasUnidades');
	}
}
