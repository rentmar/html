<?php

class Clientes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->model('Empresa_model');
        $this->load->model('Producto_model');
        $this->load->model('Cliente_model');

        //Comprobacion de session
        if ($this->session->sesion_activa === null) {
            $this->session->sess_destroy();
            redirect('/');
        }
    }

    public function index()
    {
        $datos['lista_clientes'] = $this->Cliente_model->leerTodoClientes();

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('clientes/vclientes_index.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function addCliente()
    {
        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('clientes/vclientes_form.php');

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function procesar()
    {

        $this->load->library('form_validation');
        //Comprobar que el nit esta lleno
        $this->form_validation->set_rules('nit', 'NIT', 'required|is_unique[ent_cliente_proveedor.nit]');
        //$this->form_validation->set_rules('rsocial', 'Razon Social', 'required');
        if($this->form_validation->run()==false)
        {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('clientes/vclientes_form.php');

            /**** PIE ****/
            $this->load->view('html/pie.php');
        }else{

            $cliente = $this->capturarDatosCliente();
            $this->Cliente_model->crearCliente($cliente);
            redirect('clientes/');
        }
    }

    public function capturarDatosCliente()
    {
        $cliente = [
            'nit'=>trim($this->input->post('nit')),
            'razon_social' => trim($this->input->post('rsocial')),
            'telefono' => trim(trim($this->input->post('telefono'))),
            'es_cliente' => '',
            'es_proveedor'=> '',
        ];

        $tipo = $this->input->post('tipo');
        if($tipo == 1)
        {
            //echo "cliente";
            $cliente['es_cliente'] = 1;
            $cliente['es_proveedor'] = 0;

        }elseif ($tipo == 2)
        {
            //echo "proveedor";
            $cliente['es_cliente'] = 0;
            $cliente['es_proveedor'] = 1;
        }elseif ($tipo == 3)
        {
            //echo "ambos";
            $cliente['es_cliente'] = 1;
            $cliente['es_proveedor'] = 1;
        }
        return $cliente;
    }

    public function editarCliente($identificador)
    {
        $datos['cliente'] = $this->Cliente_model->leerCliente($identificador);
        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('clientes/vclientes_form_edit.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function procesarEdicion()
    {
        $identificador = base64_decode($this->input->post('identificador')) ;
        $datos['cliente'] = $this->Cliente_model->leerCliente($identificador);
        $this->load->library('form_validation');
        //Comprobar que el nit esta lleno
        //$this->form_validation->set_rules('nit', 'NIT', 'required|is_unique[ent_cliente_proveedor.nit]');
        $this->form_validation->set_rules('rsocial', 'Razon Social', 'required');
        if($this->form_validation->run()==false)
        {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('clientes/vclientes_form.php', $datos);

            /**** PIE ****/
            $this->load->view('html/pie.php');
        }else{

            $cliente = $this->capturarDatosEdicionCliente();
            $this->Cliente_model->updateCliente($cliente);
            redirect('clientes/');
        }
    }

    public function capturarDatosEdicionCliente()
    {
        $cliente = [
            'idclipro'=>trim(base64_decode($this->input->post('identificador'))),
            'nit'=>trim($this->input->post('nit')),
            'razon_social' => trim($this->input->post('rsocial')),
            'telefono' => trim(trim($this->input->post('telefono'))),
            'es_cliente' => '',
            'es_proveedor'=> '',
        ];

        $tipo = $this->input->post('tipo');
        if($tipo == 1)
        {
            //echo "cliente";
            $cliente['es_cliente'] = 1;
            $cliente['es_proveedor'] = 0;

        }elseif ($tipo == 2)
        {
            //echo "proveedor";
            $cliente['es_cliente'] = 0;
            $cliente['es_proveedor'] = 1;
        }elseif ($tipo == 3)
        {
            //echo "ambos";
            $cliente['es_cliente'] = 1;
            $cliente['es_proveedor'] = 1;
        }
        return $cliente;
    }


}
