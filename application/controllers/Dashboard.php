<?php
class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Cliente_model');

        //Comprobar inicio de session
        if($this->session->sesion_activa ===  null){
            $this->session->sess_destroy();
            redirect('/');
        }
    }

    public function index(){

        $dato['cliente'] = $this->Cliente_model->buscarNit('85');

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('dashboard/vdash_index.php', $dato);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }
}