<?php

class Facturacion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->library('Pdf');
		$this->load->library('NumeroLiteral');
		$this->load->helper('date');
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Empresa_model');
		$this->load->model('Producto_model');
		$this->load->model('Almacen_model');
		$this->load->model('Venta_model');
		$this->load->model('Factura_model');

        //Comprobar inicio de session
        if ($this->session->sesion_activa === null) {
            $this->session->sess_destroy();
            redirect('/');
        }
    }

    public function index()
    {
		$alm=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
        $emp=$this->Empresa_model->leerEmpresaPorIdentificador($alm->rel_empresa);
		$dts['almacen']=$alm->nombre_almacen;
		$dts['empresa']=$emp;
		$this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");
		$this->load->view('facturacion/vfacturacion_factura.php',$dts);
        /**** PIE ****/
        $this->load->view('html/pie.php');
    }
	public function imprimirFactura($idventa_reg)
	{
	    $idventa = $idventa_reg;



		$alm=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
        $emp=$this->Empresa_model->leerEmpresaPorIdentificador($alm->rel_empresa);

        //Informacion del registro de venta
        $registro_venta = $this->Venta_model->leerRegistroVenta($idventa);

        //Detalle de venta
        $detalle_venta = $this->Venta_model->leerDetalleVenta($idventa);

        //La factura que corresponde al registro de venta
        $id_factura = $this->Factura_model->leerFacturaPorRegistro($idventa);
        $factura = $this->Factura_model->leerFacturaPorID($id_factura);

        //Datos de facturacion
        $datos_facturacion = $this->Venta_model->leerDatosFacturacion($this->session->sucursal->idempresa);


        $dts['almacen']=$alm->nombre_almacen;
		$dts['empresa']=$emp;
		$dts['registro_venta'] = $registro_venta;
		$dts['detalle_venta'] = $detalle_venta;
		$dts['contador']=count($detalle_venta);
		$dts['factura'] = $factura;
		$dts['datos_facturacion'] = $datos_facturacion;
		
        $descuento_calculado = round(($registro_venta->descuento_total / 100) * $registro_venta->total, 0, PHP_ROUND_HALF_DOWN);
        $dts['total']=$total=$registro_venta->total - $descuento_calculado;

		$numero=floor($total);
		$dts['literal']=strtoupper($this->numeroliteral->literal($numero));
		$dts['centavos']=round(($total-$numero)*100);
		$this->load->view('facturacion/vfacturacion_imprimir.php',$dts);
		
	}
	public function imprimirFacturaGrande($idventa_reg)
	{
	    $idventa = $idventa_reg;



		$alm=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
        $emp=$this->Empresa_model->leerEmpresaPorIdentificador($alm->rel_empresa);

        //Informacion del registro de venta
        $registro_venta = $this->Venta_model->leerRegistroVenta($idventa);

        //Detalle de venta
        $detalle_venta = $this->Venta_model->leerDetalleVenta($idventa);

        //La factura que corresponde al registro de venta
        $id_factura = $this->Factura_model->leerFacturaPorRegistro($idventa);
        $factura = $this->Factura_model->leerFacturaPorID($id_factura);

        //Datos de facturacion
        $datos_facturacion = $this->Venta_model->leerDatosFacturacion($this->session->sucursal->idempresa);


        $dts['almacen']=$alm->nombre_almacen;
		$dts['empresa']=$emp;
		$dts['registro_venta'] = $registro_venta;
		$dts['detalle_venta'] = $detalle_venta;
		$dts['contador']=count($detalle_venta);
		$dts['factura'] = $factura;
		$dts['datos_facturacion'] = $datos_facturacion;

        $descuento_calculado = round(($registro_venta->descuento_total / 100) * $registro_venta->total, 0, PHP_ROUND_HALF_DOWN);
        $total=$registro_venta->total - $descuento_calculado;

		$numero=floor($total);
		$dts['literal']=strtoupper($this->numeroliteral->literal($numero));
		$dts['centavos']=round(($total-$numero)*100);
		$this->load->view('facturacion/vfacturacion_imprimirgrande.php',$dts);
		
	}
	public function facturacionContado($idventa_reg)
    {
        $idventa = $idventa_reg;

        //Datos de la empresa
        $empresa = $this->session->sucursal;

        //Informacion del registro de venta
        $registro_venta = $this->Venta_model->leerRegistroVenta($idventa);

        //Detalle de venta
        $detalle_venta = $this->Venta_model->leerDetalleVenta($idventa);



        //La factura que corresponde al registro de venta
        $id_factura = $this->Factura_model->leerFacturaPorRegistro($idventa);
        $factura = $this->Factura_model->leerFacturaPorID($id_factura);

        $datos['idventa'] = $idventa;
        $datos['empresa'] = $empresa;
        $datos['registro_venta'] = $registro_venta;
        $datos['factura'] = $factura;
        $datos['detalle_venta'] = $detalle_venta;

        /**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('facturacion/vfacturacion_factura.php', $datos);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }

    private function mensaje($mensaje, $clase) {
        $this->session->set_flashdata([
            'mensaje' => $mensaje,
            'clase' => $clase,
        ]);
    }
}
