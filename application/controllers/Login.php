<?php

class Login extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->model('Empresa_model');
		$this->load->model('Wizards_model');
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');

	}
	public function index(){
	    $estado_inicial = $this->Wizards_model->leerEstadoInicial();
	    if($estado_inicial->es_primer_inicio)
	    {
	        redirect('Wizards');
        }

		if(!$this->ion_auth->logged_in()) //No se ha iniciado session
		{
			//Redireccionar a la pagina Login
			$this->load->view('login/login.php');
		}
		else
		{
			redirect('dashboard', 'refresh');
		}
	}

	public function validar(){
		if($this->ion_auth->login($this->input->post('usuario'), $this->input->post('password'), false ))
		{
			$log_user = $this->ion_auth->user()->row();
			$empresa = $this->Empresa_model->leerEmpresaPorIdentificador($log_user->rel_empresa);
			$this->session->set_userdata('sucursal', [ ]);
			$this->session->set_userdata('sucursal', $empresa);
			$this->session->set_userdata('sesion_activa', true);
			redirect('dashboard/', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('log_mensaje', $this->ion_auth->errors());
			redirect('login/', 'refresh');
		}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		//Terminar sesion
		$this->load->library('session');
		$this->session->sess_destroy();
		//Redirigir al login
		redirect('login/', 'refresh');
	}
}
