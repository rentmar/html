<?php

class Wizards extends CI_Controller{



    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Wizards_model');
        $this->load->model('Empresa_model');
        $this->load->library('ion_auth');
    }

    public function index()
    {
        $estado_inicial = $this->Wizards_model->leerEstadoInicial();

        if(!$estado_inicial->wizard_empresa)
        {
            redirect('Wizards/empresa');
        }
        elseif (!$estado_inicial->wizard_usuario)
        {
            redirect('Wizards/usuario');
        }
        elseif (!$estado_inicial->wizard_inventario)
        {
            redirect('Wizards/inventario');
        }
        elseif($estado_inicial->es_primer_inicio)
        {
            redirect('Wizards/finInicio');
        }

    }

    public function usuario($empresa)
    {
        $idempresa = $empresa;
        $datos['idempresa'] = $idempresa;
        /********* Encabezado ************/
        $this->load->view("wizards/encabezado.php");
        /********* Contenido ************/
        $this->load->view('wizards/vwizard_usuario.php', $datos);
        /**** PIE ****/
        $this->load->view('wizards/pie.php');
    }

    public function inventario()
    {
        /********* Encabezado ************/
        $this->load->view("wizards/encabezado.php");
        /********* Contenido ************/
        $this->load->view('wizards/vwizard_pcontable.php');
        /**** PIE ****/
        $this->load->view('wizards/pie.php');
    }

    public function usuarioProcesar($empresa)
    {
        $idempresa = $empresa;
        $datos['idempresa'] = $idempresa;

        $this->load->library('form_validation');

        //Reglas de Validacion
        $this->form_validation->set_rules('usuario', 'Nombre de Usuario', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('passwd', 'Password', 'required');
        $this->form_validation->set_rules('passwdc', 'Confirmar Password', 'required|matches[passwd]');
        $this->form_validation->set_rules('telefono', 'Telefono', 'min_length[7]|max_length[8]|required|numeric|integer');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[3]');

        if($this->form_validation->run()==false)
        {
            /********* Encabezado ************/
            $this->load->view("wizards/encabezado.php");
            /********* Contenido ************/
            $this->load->view('wizards/vwizard_usuario.php', $datos);
            /**** PIE ****/
            $this->load->view('wizards/pie.php');
        }
        else
        {
            $empresa = $this->Empresa_model->leerEmpresaPorIdentificador($this->input->post('idempresa'));
            $group = array('1');

            $username = $this->input->post('usuario');
            $password = $this->input->post('passwd');
            $email = $this->input->post('email');
            $additional_data = [
                'first_name'=> $this->input->post('nombre'),
                'last_name' => $this->input->post('apellido'),
                'company' => $empresa->nombre_empresa,
                'rel_empresa' => $empresa->idempresa,
                'phone' => $this->input->post('telefono'),
            ];

            $this->ion_auth->register($username, $password, $email, $additional_data, $group);
            //Cambio de banderas
            $banderas = [
                'idwizard' => 1,
                'es_primer_inicio' => 0,
                'wizard_usuario' => 1,
                'wizard_empresa' => 1,
            ];
            $this->Wizards_model->actualizaBanderas($banderas);

            redirect('login');

        }
    }



    public function empresa()
    {
        /********* Encabezado ************/
        $this->load->view("wizards/encabezado.php");
        /********* Contenido ************/
        $this->load->view('wizards/vwizard_empresa.php');
        /**** PIE ****/
        $this->load->view('wizards/pie.php');
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


        if($this->form_validation->run()==false)
        {
            /********* Encabezado ************/
            $this->load->view("wizards/encabezado.php");
            /********* Contenido ************/
            $this->load->view('wizards/vwizard_empresa.php');
            /**** PIE ****/
            $this->load->view('wizards/pie.php');
        }
        else
        {
            $empresa = $this->empresaDatos();
            var_dump($empresa);
            $idempresa = $this->Empresa_model->insertarNuevaEmpresa($empresa);
            if($idempresa !== -1)
            {
                //La creacion de la empresa se ha hecho correctamente
                //Ajustar las banderas de deteccion
                $banderas = [
                    'idwizard' => 1,
                    'es_primer_inicio' => 1,
                    'wizard_usuario' => 0,
                    'wizard_empresa' => 1,
                ];
                $this->Wizards_model->actualizaBanderas($banderas);

                //Redireccionar al wizard de usuario, incluyendo el argumento de identificador de empresa
                redirect('wizards/usuario/'.$idempresa);

            }
            else
            {
                //La creacion de la empresa nueva ha fallado
                redirect('login/');

            }

        }
    }


    public function finInicio()
    {
        echo "Cambiar la bandera de primer inicio";
    }

    private function empresaDatos()
    {
        $empresa_datos =[
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


}