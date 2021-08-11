<?php

class Inventarios extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("html");
        $this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('Almacen_model');
		$this->load->model('Empresa_model');
		$this->load->model('Producto_model');
		$this->load->model('Inventario_model');
		$this->load->model('Classabc_model');
        $this->load->library('session');
        $this->load->library('ion_auth');
    }

    public function index()
    {
		$dts['almacen']=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);

		/**** ENCABEZADO ****/
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('inventarios/inventario_index.php',$dts);

        /**** PIE ****/
        $this->load->view('html/pie.php');
    }
	public function iniciarProductos()
	{
		$dts['almacen']=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$dts['productos_almacen']=$this->Almacen_model->leerProductosAlmacenCero($dts['almacen']->idalmacen);
		

		$this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('inventarios/vproducto_iniciar.php',$dts);

        $this->load->view('html/pie.php');
	}
	public function cantidadInicio($idp)
	{
		$ida=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$this->Almacen_model->updateCantidadAlmacen($ida->idalmacen,$idp,$this->input->post('cantinicial'));
		redirect('Inventarios/iniciarProductos');
	}

	public function iniciarInventario()
    {
        $dts['almacen']=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
        $this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('inventarios/vinventario_proceso.php', $dts);

        $this->load->view('html/pie.php');
    }
	
	public function productoValorado()
    {
        $dts['almacen']=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$patron_busqueda_producto=$this->input->post('producto_val');
		$dts['productos']=$this->Producto_model->buscarProductoValoracion($dts['almacen']->idalmacen, $patron_busqueda_producto);
		$this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('inventarios/vproducto_valorado.php', $dts);

        $this->load->view('html/pie.php');
    }
    public function valorizacionProducto($idp)
    {
		$cvt=0;
		$cct=0;
		$almacen=$this->Empresa_model->leerAlmacenIdentificadorEmpresa($this->session->sucursal->idempresa);
		$dts['producto']=$this->Producto_model->leerProdcutoAlmacenId($almacen->idalmacen, $idp);
        $dts['IMI']=100;
		$VN=$this->Inventario_model->cantidadVendidaEmpresaProducto($this->session->sucursal->idempresa,$idp);
		foreach ($VN as $v)
		{
			$cvt=$cvt+$v->cantidad_producto;
		}
		$dts['VN']=$cvt;
		$CN=$this->Inventario_model->cantidadCompradaEmpresaProducto($this->session->sucursal->idempresa,$idp);
		foreach ($CN as $c)
		{
			$cct=$cct+$c->cantidad_producto;
		}
		$dts['CN']=$cct;
		$this->load->view("html/encabezado.php");
        $this->load->view("html/navbar.php");
        $this->load->view("html/aside.php");

        $this->load->view('inventarios/vinventario_valorizacion.php',$dts);

        $this->load->view('html/pie.php');
    }
	private function iniciarPeriodoContable()
    {

    }
}
