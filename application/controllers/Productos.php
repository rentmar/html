<?php

class Productos extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("html");
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->library('session');
		$this->load->model('Producto_model');
		$this->load->model('Marca_model');
		$this->load->model('Linea_model');
		$this->load->model('Unidad_model');
		$this->load->model('Almacen_model');
	}

	public function index()
	{
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('productos/vproducto_index.php');

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function elegirImagen()
	{
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('productos/vproducto_imagen.php');

		$this->load->view('html/pie.php');
	}
	public function subirImagen()
	{	
		$config['upload_path'] = './assets/img/producto';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']     = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('imagproducto')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('avisos/vavisos', $error);
        } else {
			$this->Producto_model->ingresarImagen($this->upload->data('file_name'));
			redirect('productos');
        }
	}
	public function crearProducto()
	{
		$dts['marcas']=$this->Marca_model->leerMarcas();
		$dts['lineas']=$this->Linea_model->leerLineas();
		$dts['unidades']=$this->Unidad_model->leerUnidades();
		$dts['imagenes']=$this->Producto_model->leerImagenes();
		
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('productos/vproducto_crearproducto.php',$dts);

		
		$this->load->view('html/pie.php');

	}
	public function registrarProducto()
	{
		$idm=$this->Marca_model->leerIdPorMarca($this->input->post('marca_producto'));
		$idl=$this->Linea_model->leerIdPorLinea($this->input->post('linea_producto'));
		$idu=$this->Unidad_model->leerIdPorUnidad($this->input->post('unidad_producto'));
		$imagen=$this->Producto_model->leerImagenId($this->input->post('imagenes'));
		$almacen=$this->Almacen_model->leerAlmacenes();
		var_dump($imagen);
			$dts_prod= array(
						'rel_idmarca'=>$idm[0]->idmarca,
						'rel_idlinea'=>$idl[0]->idlinea,
						'imagen'=>"assets/img/producto/".$imagen->nombre_imagen,
						'item'=>$this->input->post('item_producto'),
						'codigo'=>$this->input->post('codigo_producto'),
						'dimension'=>$this->input->post('dimension_producto'),
						'rel_unidad'=>$idu[0]->idunidad,
						//'embalaje'=>$this->input->post('embalaje_producto'),
						'precio'=>$this->input->post('precio_producto'),
						'incremento'=>$this->input->post('incremento'),
						'descuento'=>$this->input->post('descuento_maximo')
						);
		$this->Producto_model->insertarProducto($dts_prod,$almacen);
		redirect('productos/crearProducto');
	}
	public function registrarProductoSalir()
	{
		$idm=$this->Marca_model->leerIdPorMarca($this->input->post('marca_producto'));
		$idl=$this->Linea_model->leerIdPorLinea($this->input->post('linea_producto'));
		$idu=$this->Unidad_model->leerIdPorUnidad($this->input->post('unidad_producto'));
		$almacen=$this->Almacen_model->leerAlmacenes();
		$dts_prod= array(
						'rel_idmarca'=>$idm[0]->idmarca,
						'rel_idlinea'=>$idl[0]->idlinea,
						'imagen'=>"assets/img/producto/tubo.jpg",
						'item'=>$this->input->post('item_producto'),
						'codigo'=>$this->input->post('codigo_producto'),
						'dimension'=>$this->input->post('dimension_producto'),
						'rel_unidad'=>$idu[0]->idunidad,
						//'embalaje'=>$this->input->post('embalaje_producto'),
						'precio'=>$this->input->post('precio_producto'),
						'incremento'=>$this->input->post('incremento'),
						'descuento'=>$this->input->post('descuento_maximo')
						);
		$this->Producto_model->insertarProducto($dts_prod,$almacen);
		redirect('productos');
	}
	public function listaEditarProducto()
	{
		$prod=$this->input->post('busca_producto_editar');
		$dts['lista_prods']=$this->Producto_model->buscarProductoNombre();
		/**** ENCABEZADO ****/
		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('productos/vproducto_listaeditarproducto.php',$dts);

		/**** PIE ****/
		$this->load->view('html/pie.php');
	}
	public function editarProducto($idp)
	{
		$producto=$this->Producto_model->leerProductoPorId($idp);
		$dte['dts_editar']=$producto;
		$dte['marcas']=$this->Marca_model->leerMarcas();
		$dte['lineas']=$this->Linea_model->leerLineas();
		$dte['unidades']=$this->Unidad_model->leerUnidades();
		$dte['imagenes']=$this->Producto_model->leerImagenes();
		$campos=explode("/",$producto[0]->imagen);
		$dte['imagene']=$campos[3];

		$this->load->view("html/encabezado.php");
		$this->load->view("html/navbar.php");
		$this->load->view("html/aside.php");

		$this->load->view('productos/vproducto_editarproducto.php',$dte);

		$this->load->view('html/pie.php');
	}
	public function modificarProducto()
	{
		$idp=$this->input->post('eidproducto');
		$idm=$this->Marca_model->leerIdPorMarca($this->input->post('emarca_producto'));
		$idl=$this->Linea_model->leerIdPorLinea($this->input->post('elinea_producto'));
		$idu=$this->Unidad_model->leerIdPorUnidad($this->input->post('eunidad_producto'));
		$imagen=$this->Producto_model->leerImagenId($this->input->post('imagenes'));
		$datos_edit=array (
						'rel_idmarca'=>$idm[0]->idmarca,
						'rel_idlinea'=>$idl[0]->idlinea,
						'item'=>$this->input->post('eitem_producto'),
						'dimension'=>$this->input->post('edimension_producto'),
						'codigo'=>$this->input->post('ecodigo_producto'),
						'rel_unidad'=>$idu[0]->idunidad,
						//'embalaje'=>$this->input->post('edit_embalaje_producto'),
						'precio'=>$this->input->post('eprecio_producto'),
						'incremento'=>$this->input->post('eincremento_producto'),
						'descuento'=>$this->input->post('edescuento_maximo'),
						'imagen'=>"assets/img/producto/".$imagen->nombre_imagen
						);
		$this->Producto_model->updateProducto($idp,$datos_edit);
		redirect('productos');
	}
}
