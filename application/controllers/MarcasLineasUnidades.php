<?php

class MarcasLineasUnidades extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');

        $this->load->library('session');
        $this->load->library('ion_auth');
    }

    public function index()
    {
        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('mlu/vmlu_index.php');

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }
}
