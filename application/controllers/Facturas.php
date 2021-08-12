<?php

class Facturas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->model('Empresa_model');
        $this->load->model('Factura_model');
        $this->load->model('Venta_model');
        $this->load->library('ControlCode');

        //Comprobar inicio de session
        if ($this->session->sesion_activa === null) {
            $this->session->sess_destroy();
            redirect('/');
        }
    }

    public function index()
    {
        $empresa_actual = $this->session->sucursal;

        $empresa_factura = $this->Empresa_model->leerEmpresaMasDatosFacturacion($empresa_actual->idempresa);


        $datos['empresa_factura'] = $empresa_factura;
        $datos['usuario'] = $this->ion_auth->user()->row();
        $datos['historial_dosificacion'] = $this->Factura_model->leerTodasLasDosificaciones($empresa_actual->idempresa);

        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('facturas/vfacturas_index.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    public function actualizarDosificacion()
    {
        $empresa_actual = $this->session->sucursal;
        $datos['empresa_factura'] = $this->Empresa_model->leerEmpresaMasDatosFacturacion($empresa_actual->idempresa);


        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('facturas/vfacturas_form_dosificacion.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');

    }

    public function procesarDosificacion()
    {

        $empresa_actual = $this->session->sucursal;
        $datos['empresa_factura'] = $this->Empresa_model->leerEmpresaMasDatosFacturacion($empresa_actual->idempresa);

        //Capturar el identificador de los datos de la facturacion
        $identificador = base64_decode($this->input->post('iddosificacion'));

        //Validacion
        $this->load->library('form_validation');

        $this->form_validation->set_rules('numautorizacion', 'Numero de Autorizacion', 'required');
        $this->form_validation->set_rules('numautorizacionc', 'Confirmar Numero de Autorizacion', 'required|matches[numautorizacion]');

        $this->form_validation->set_rules('numerofactura', 'Numero de Factura', 'required');
        $this->form_validation->set_rules('numerofacturac', 'Confirmar Numero de Factura', 'required|matches[numerofactura]');

        $this->form_validation->set_rules('fechaemision', 'Fecha de Emision', 'required');
        $this->form_validation->set_rules('fechaemisionc', 'Confirmar Fecha de Emision', 'required|matches[fechaemision]');

        $this->form_validation->set_rules('llavedosificacion', 'Llave de Dosificacion', 'required');
        $this->form_validation->set_rules('llavedosificacionc', 'Confirmar Llave de Dosificacicon', 'required|matches[llavedosificacion]');

        $this->form_validation->set_rules('leyendaPiePagina', 'Leyenda', 'required');
        $this->form_validation->set_rules('leyendaPiePaginaL453', 'Leyenda Ley 453', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view("html/encabezado.php");
            $this->load->view("html/navbar.php");
            $this->load->view("html/aside.php");

            $this->load->view('facturas/vfacturas_form_dosificacion.php', $datos);

            /**** PIE ****/
            $this->load->view('html/pie.php');
        } else {
            //Capturar los datos de la dosificacion
            $dosificacion = $this->datosDosificacionFormulario();
            $this->Factura_model->updateDatosFacturacion($dosificacion);
            redirect('Facturas/');
        }

    }

    private function datosDosificacionFormulario()
    {
        $empresa_actual = $this->session->sucursal;
        $fecha = strtotime(trim($this->input->post('fechaemision')));

        $dosificacion = [
            'idempresa' => $empresa_actual->idempresa,
            'iddfac' => trim(base64_decode($this->input->post('iddosificacion'))),
            'numero_autorizacion' => trim($this->input->post('numautorizacion')),
            'numero_inicial_factura' => trim($this->input->post('numerofactura')),
            'numero_actual_factura' => trim($this->input->post('numerofactura')),
            'numero_ultimo_factura' => 0,
            'fecha_limite_emision' => $fecha,
            'llave_dosificacion' => trim($this->input->post('llavedosificacion')),
            'pie' => trim($this->input->post('leyendaPiePagina')),
            'pie_ley453' => trim($this->input->post('leyendaPiePaginaL453')),
        ];

        return $dosificacion;
    }

    public function emitirFactura($identificador)
    {
        echo "Emitir Factura";
        redirect('puntoVenta/');
    }


    //Conversor de datetime picker a Unix TST
    private function fechaToUnixTimeStamp($fechaDMY)
    {
        list($fecha, $hora, $ap) = explode(' ', $fechaDMY);
        //Fragmentar la fecha
        list($mm, $dd, $yyyy) = explode('/', $fecha);
        //Fragmentat la hora
        list($h, $m) = explode(':', $hora);
        if ($ap == 'PM') {
            $h = $h + 12;
        }
        $unixtime = mktime($h, $m, 0, $mm, $dd, $yyyy);
        return $unixtime;
    }

    //Cambiar el formato MM/DD/YY a unix timestamp
    private function mmddyyToUnix($fecha)
    {
        list($mes, $dia, $anio) = explode('/', $fecha);
        $fecha_unix = mktime(0, 0, 0, $mes, $dia, $anio);
        return $fecha_unix;
    }

    public function facturasEmitidas()
    {
        //Leer empresa mas datos de facturacion

        $empresa = $this->Empresa_model->leerEmpresaPorIdentificador($this->session->sucursal->idempresa);
        $datos_facturacion = $this->Venta_model->leerDatosFacturacion($empresa->idempresa);
        $facturas_emitidas = $this->Factura_model->leerFacturasMesActual($empresa->idempresa, $datos_facturacion);
        $datos['facturas_emitidas'] = $facturas_emitidas;

        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('facturas/vfacturas_emitidas.php', $datos);

      
        $this->load->view('html/pie.php');


    }
	public function listaFacturasBlanco()
	{
		echo "lista blanco";
	}
	public function facturasRevisar()
	{
		 $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('facturas/vfacturas_revisar.php');

        $this->load->view('html/pie.php');
	}
	public function listaFacturasCliente()
	{
		$nit=$this->input->post("nit");
		$empresa = $this->Empresa_model->leerEmpresaPorIdentificador($this->session->sucursal->idempresa);
        $datos_facturacion = $this->Venta_model->leerDatosFacturacion($empresa->idempresa);
        $facturas_emitidas = $this->Factura_model->leerFacturasMesCliente($empresa->idempresa, $datos_facturacion,$nit);
        $datos['facturas_emitidas'] = $facturas_emitidas;
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('facturas/vfacturas_emitidascliente.php', $datos);

      
        $this->load->view('html/pie.php');
	}
    //TEst de facturas
    public function testFacturas()
    {
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('facturas/vfacturas_test.php');

        /**** PIE ****/
        $this->load->view('html/pie.php');

    }

    public function procesarTest()
    {
        //Capturar la informacion
        $info = $this->capturarInformacionPrueba();

        //Calcular el codigo de control
        $numAutorizacion = $info['numero_autorizacion'];
        $numFactura = $info['numero_factura'];
        $nitCliente = $info['nit_cliente'];
        $fechaTransaccion = $info['fecha_transaccion']; //AAAAMMDD
        $montoTransaccion = $info['monto_transaccion'];
        $llaveDosificacion = $info['llave_dosificacion'];

        //Argumentos
        //Numero de autorizacion
        //Numero de factura
        //NIT
        //Fecha  AAAAMMDD
        //Monto de la transaccion
        //Dosificacion
        $cod_control = $this->controlcode->generate($numAutorizacion, $numFactura, $nitCliente, $fechaTransaccion, $montoTransaccion, $llaveDosificacion);


        $datos['info'] = $info;
        $datos['cod_control'] = $cod_control;

        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('facturas/vfacturas_testresultado.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');




    }
    private function capturarInformacionPrueba()
    {
        $infoTest = [
            'numero_autorizacion' => $this->input->post('numautorizacion'),
            'numero_factura' => $this->input->post('numfactura'),
            'nit_cliente' => $this->input->post('nitcliente'),
            'fecha_transaccion' => $this->input->post('fechatransaccion'),
            'monto_transaccion' => $this->input->post('montotransaccion'),
            'llave_dosificacion' => $this->input->post('llavedosificacion'),
        ];
        return $infoTest;
    }




}
