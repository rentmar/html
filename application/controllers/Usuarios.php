<?php

class Usuarios extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('ion_auth');
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Empresa_model');
    }

    public function index(){
        $usuario_actual = $this->ion_auth->user()->row();
        $usuarios = $this->ion_auth->users()->result();
        unset($usuarios[0]);

        //Datos para la interfaz grafica
        $datos['usuarios'] = $usuarios;
        $datos['usuario_actual'] = $usuario_actual;


        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('usuarios/vusuarios_index.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function addUsuario(){
        //Usuario actual
        $usuario_actual = $this->ion_auth->user()->row();
        //Empresas
        $empresas = $this->Empresa_model->leerEmpresas();


        //Datos para la interfaz grafica

        $datos['usuario_actual'] = $usuario_actual;
        $datos['empresas'] = $empresas;

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('usuarios/vusuarios_form.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');

    }

    //Validacion y captura del nuevo usuario
    public function procesarNuevoUsuario()
    {
        //Usuario actual
        $usuario_actual = $this->ion_auth->user()->row();
        //Empresas
        $empresas = $this->Empresa_model->leerEmpresas();


        //Datos para la interfaz grafica

        $datos['usuario_actual'] = $usuario_actual;
        $datos['empresas'] = $empresas;
        $this->load->library('form_validation');
        //Comprobar que el nit esta lleno
        $this->form_validation->set_rules('username', 'Nombre de usuario', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('passwd', 'Password', 'required');
        $this->form_validation->set_rules('passwdc', 'Confirmar Password', 'required|matches[passwd]');
        //$this->form_validation->set_rules('rsocial', 'Razon Social', 'required');
        if($this->form_validation->run()==false)
        {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('usuarios/vusuarios_form.php', $datos);

            /**** PIE ****/
            $this->load->view('html/pie.php');
        }
        else
        {
            $empresa = $this->Empresa_model->leerEmpresaPorIdentificador($this->input->post('empresa'));
            $tipo_usuario = $this->input->post('tipousuario');

            $username = $this->input->post('username');
            $password = $this->input->post('passwd');
            $email = $this->input->post('email');
            $additional_data = [
                'first_name'=> $this->input->post('nombre'),
                'last_name' => $this->input->post('apellido'),
                'company' => $empresa->nombre_empresa,
                'rel_empresa' => $empresa->idempresa,
                'phone' => $this->input->post('telefono'),
            ];

            //Seleccion de grupo de usuarios
            if($tipo_usuario == 1)
            {
                //echo "ADMIN";
                $group = array('1');
            }elseif ($tipo_usuario == 2)
            {
                //echo "Normal";
                $group = array('2');
            }

            $this->ion_auth->register($username, $password, $email, $additional_data, $group);
            redirect('usuarios');

        }

    }

    public function cambiarEstado($identificador)
    {
        $id = $identificador;
        $usuario = $this->ion_auth->user($id)->row();
        //var_dump($usuario);
        if($usuario->active == 1)
        {
            $estado = 0;
        }
        elseif ($usuario->active == 0)
        {
            $estado = 1;
        }

        $data = [
            'active' => $estado,
        ];

        $this->ion_auth->update($id, $data);
        redirect('usuarios');
    }

    public function editarInfoPersonal($identificador)
    {
        $id = $identificador;
        $usuario = $this->ion_auth->user($id)->row();

        $datos['usuario'] = $usuario;

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('usuarios/vusuarios_form_personal.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function procesarInfoPersonal()
    {
        $id = base64_decode($this->input->post('idusr'));
        //Usuario actual
        $usuario_actual = $this->ion_auth->user()->row();
        //Empresas
        $empresas = $this->Empresa_model->leerEmpresas();
        $usuario = $this->ion_auth->user($id)->row();
        $datos['usuario'] = $usuario;


        //Datos para la interfaz grafica

        $datos['usuario_actual'] = $usuario_actual;
        $datos['empresas'] = $empresas;
        $this->load->library('form_validation');
        //Comprobar que el nit esta lleno

        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');


        if($this->form_validation->run()==false)
        {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('usuarios/vusuarios_form_personal.php', $datos);

            /**** PIE ****/
            $this->load->view('html/pie.php');

        }else{
            $empresa = $this->Empresa_model->leerEmpresaPorIdentificador($this->input->post('empresa'));


            $additional_data = [
                'first_name'=> $this->input->post('nombre'),
                'last_name' => $this->input->post('apellido'),
            ];
            $this->ion_auth->update($id, $additional_data);
            redirect('usuarios');
        }
    }

    public function editarInfoContacto($identificador)
    {
        $id = $identificador;
        $usuario = $this->ion_auth->user($id)->row();

        $datos['usuario'] = $usuario;

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('usuarios/vusuarios_form_contacto.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function procesarInfoContacto()
    {
        $id = base64_decode($this->input->post('idusr'));
        //Usuario actual
        $usuario_actual = $this->ion_auth->user()->row();
        //Empresas
        $empresas = $this->Empresa_model->leerEmpresas();
        $usuario = $this->ion_auth->user($id)->row();
        $datos['usuario'] = $usuario;
        //Datos para la interfaz grafica

        $datos['usuario_actual'] = $usuario_actual;
        $datos['empresas'] = $empresas;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if($this->form_validation->run()==false)
        {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('usuarios/vusuarios_form_contacto.php', $datos);

            /**** PIE ****/
            $this->load->view('html/pie.php');

        }else{
            $empresa = $this->Empresa_model->leerEmpresaPorIdentificador($this->input->post('empresa'));
            $additional_data = [
                'phone'=> $this->input->post('telefono'),
                'email' => $this->input->post('email'),
            ];
            /*var_dump($id);
            echo "<br>";
            var_dump($additional_data);*/
            $this->ion_auth->update($id, $additional_data);
            redirect('usuarios');
        }
    }



    public function editarPermisos($identificador)
    {
        $id = $identificador;
        $usuario = $this->ion_auth->user($id)->row();
        $empresas = $this->Empresa_model->leerEmpresas();
        $usuario_actual = $this->ion_auth->user()->row();

        $datos['usuario'] = $usuario;
        $datos['empresas'] = $empresas;
        $datos['usuario_actual'] = $usuario_actual;

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('usuarios/vusuarios_form_permisos.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function procesarPermisos()
    {

        $id = base64_decode($this->input->post('idusr'));
        //Usuario actual
        $usuario_actual = $this->ion_auth->user()->row();
        //Empresas
        $empresas = $this->Empresa_model->leerEmpresas();
        $usuario = $this->ion_auth->user($id)->row();
        $datos['usuario'] = $usuario;
        //Datos para la interfaz grafica

        $datos['usuario_actual'] = $usuario_actual;
        $datos['empresas'] = $empresas;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('idusr', 'Identificador', 'required');

        if($this->form_validation->run()==false)
        {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('usuarios/vusuarios_form_permisos.php', $datos);

            /**** PIE ****/
            $this->load->view('html/pie.php');

        }else{
            $grupo = $this->input->post('tipousuario');

            echo $grupo;
            //Remover el usuario del grupo
            $this->ion_auth->remove_from_group([1,2], $id);
            //Agregar al nuevo grupo
            $this->ion_auth->add_to_group($grupo, $id);
            //$this->ion_auth->update($id, $additional_data);
            redirect('usuarios');
        }

    }

    public function editarPassword($identificador)
    {

        $id = $identificador;
        $usuario = $this->ion_auth->user($id)->row();

        $datos['usuario'] = $usuario;

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('usuarios/vusuarios_form_password.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function procesarPassword()
    {
        $id = base64_decode($this->input->post('idusr'));
        //Usuario actual
        $usuario_actual = $this->ion_auth->user()->row();
        //Empresas
        $empresas = $this->Empresa_model->leerEmpresas();
        $usuario = $this->ion_auth->user($id)->row();
        $datos['usuario'] = $usuario;
        //Datos para la interfaz grafica

        $datos['usuario_actual'] = $usuario_actual;
        $datos['empresas'] = $empresas;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('passwd', 'Password', 'required');
        $this->form_validation->set_rules('passwdc', 'Confirmar Password', 'required|matches[passwd]');

        if($this->form_validation->run()==false)
        {
            /**** ENCABEZADO ****/
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('usuarios/vusuarios_form_password.php', $datos);

            /**** PIE ****/
            $this->load->view('html/pie.php');

        }
        else
        {
            $empresa = $this->Empresa_model->leerEmpresaPorIdentificador($this->input->post('empresa'));
            $additional_data = [
                'password'=> $this->input->post('passwd'),
            ];
            /*var_dump($id);
            echo "<br>";
            var_dump($additional_data);*/
            $this->ion_auth->update($id, $additional_data);
            redirect('usuarios');
        }

    }


}
