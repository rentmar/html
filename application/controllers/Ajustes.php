<?php

class Ajustes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Empresa_model');
		$this->load->model('Producto_model');
		$this->load->model('Almacen_model');

        //Comprobar inicio de session
        if ($this->session->sesion_activa === null) {
            $this->session->sess_destroy();
            redirect('/');
        }
    }

    public function index()
    {
        $empresas = $this->Empresa_model->leerEmpresas();


        $datos['empresas'] = $empresas;


        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('ajustes/vajustes_index.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function crearEmpresa()
    {

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('ajustes/vajustes_formempresa.php');

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function empresaProcesar()
    {
        $this->load->library('form_validation');

        //Reglas de Validacion
        $this->form_validation->set_rules('nit', 'NIT', 'required|is_unique[ent_empresa.nit]|numeric|integer');
        $this->form_validation->set_rules('nombreempresa', 'Nombre de la Empresa', 'required');
        $this->form_validation->set_rules('rsocial', 'Razon Social', 'required');
        $this->form_validation->set_rules('actividad', 'Actividad', 'required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'min_length[7]|max_length[8]|numeric|integer');
        $this->form_validation->set_rules('telefonomov', 'Telefono Movil', 'min_length[7]|max_length[8]|numeric|integer');


        if ($this->form_validation->run() == false) {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('ajustes/vajustes_formempresa.php');

            /**** PIE ****/
            $this->load->view('html/pie.php');
        } else {
            $empresa = $this->empresaDatos();
            $idempresa = $this->Empresa_model->insertarNuevaEmpresa($empresa);
			$dtalmacen=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($idempresa);
			$ida=$dtalmacen->idalmacen;
			$idsproducto=$this->Producto_model->leerIdsProducto();
			foreach ($idsproducto as $idp) 
			{
				$this->Almacen_model->insertarProductoAlmacen($ida,$idp->idproducto);
			}
            redirect('ajustes');
        }
    }

    private function empresaDatos()
    {
        $empresa_datos = [
            'nit' => $this->input->post('nit'),
            'nombre_empresa' => $this->input->post('nombreempresa'),
            'razon_social' => $this->input->post('rsocial'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('telefonomov'),
            'actividad' => $this->input->post('actividad'),
            'logo' => 'assets/img/logo/logo.jpg',
            'rel_datos_factura' => '',
        ];

        return $empresa_datos;
    }

    private function empresaDatosEdit()
    {
        $empresa_datos = [
            'nit' => $this->input->post('nit'),
            'nombre_empresa' => $this->input->post('nombreempresa'),
            'razon_social' => $this->input->post('rsocial'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono'),
            'celular' => $this->input->post('telefonomov'),
            'actividad' => $this->input->post('actividad'),
            'logo' => 'assets/img/logo/logo.jpg',
            'rel_datos_factura' => $this->input->post('datosfac'),
        ];

        return $empresa_datos;
    }

    public function editarEmpresa($idempresa)
    {
        $empresa = $this->Empresa_model->leerEmpresaPorIdentificador($idempresa);
        $datos['empresa'] = $empresa;

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('ajustes/vajustes_editformempresa.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');


    }

    public function procesarEditarEmpresa()
    {

        $idempresa = $this->input->post('idempresa');
        $empresa = $this->Empresa_model->leerEmpresaPorIdentificador($idempresa);
        $datos['empresa'] = $empresa;


        $this->load->library('form_validation');

        //Reglas de Validacion

        $this->form_validation->set_rules('nombreempresa', 'Nombre de la Empresa', 'required');
        $this->form_validation->set_rules('rsocial', 'Razon Social', 'required');
        $this->form_validation->set_rules('actividad', 'Actividad', 'required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'min_length[7]|max_length[8]|numeric|integer');
        $this->form_validation->set_rules('telefonomov', 'Telefono Movil', 'min_length[7]|max_length[8]|numeric|integer');


        if ($this->form_validation->run() == false) {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('ajustes/vajustes_editformempresa.php', $datos);

            /**** PIE ****/
            $this->load->view('html/pie.php');
        } else {
            $empresa = $this->empresaDatosEdit();
            $idempresa = $this->input->post('idempresa');
            $idempresa = $this->Empresa_model->updateEmpresa($empresa, $idempresa);
            redirect('ajustes');
        }
    }


}
