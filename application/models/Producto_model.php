<?php

class Producto_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Extraer todos los productos
    public function leerProductosAlmacen($identificador)
    {
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre AS linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre, ent_producto.precio, ent_producto.incremento, ent_producto.descuento, ent_producto.imagen   "
            ."FROM ent_almacen "
            ."LEFT JOIN t_almacen_producto ON t_almacen_producto.rel_almacen = ent_almacen.idalmacen "
            ."LEFT JOIN ent_producto ON ent_producto.idproducto = t_almacen_producto.rel_producto  "
            ."LEFT JOIN ent_registro ON ent_registro.idregistro = t_almacen_producto.rel_registro "
            ."LEFT JOIN ent_marca ON ent_marca.idmarca = ent_producto.rel_idmarca "
            ."LEFT JOIN ent_linea ON ent_linea.idlinea = ent_producto.rel_idlinea "
            ."LEFT JOIN ent_unidad ON ent_unidad.idunidad = ent_producto.rel_unidad "
            ."WHERE ent_almacen.idalmacen = ?";
        $qry = $this->db->query($sql, [$identificador]);
        return $qry->result();
    }

    //Busqueda de productos por nombre
    public function buscarProductosPorNombre($identificador_almacen, $patron_busqueda_producto)
    {
        $patron_producto = '%'.$patron_busqueda_producto.'%';
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, ent_producto.precio, ent_producto.incremento, ent_producto.descuento, ent_producto.imagen, t_almacen_producto.existencias "
                ."FROM ent_almacen "
                ."LEFT JOIN t_almacen_producto ON t_almacen_producto.rel_almacen = ent_almacen.idalmacen "
                ."LEFT JOIN ent_producto ON ent_producto.idproducto = t_almacen_producto.rel_producto  "
                ."LEFT JOIN ent_marca ON ent_marca.idmarca = ent_producto.rel_idmarca "
                ."LEFT JOIN ent_linea ON ent_linea.idlinea = ent_producto.rel_idlinea "
                ."LEFT JOIN ent_unidad ON ent_unidad.idunidad = ent_producto.rel_unidad "
                ."WHERE ent_almacen.idalmacen = ? "
                ."AND ent_producto.item LIKE ? ";
        $qry = $this->db->query($sql, [$identificador_almacen, $patron_producto]);
        return $qry->result();
    }
	public function ingresarImagen($img)
	{
		$dts=array('nombre_imagen'=>$img);
		$this->db->insert('imagenproducto',$dts);
	}
	public function leerImagenes()
	{
		$q=$this->db->get('imagenproducto');
		return $q->result();
	}
	public function leerImagenId($idimg)
	{
		$this->db->where('idimag',$idimg);
		$q=$this->db->get('imagenproducto');
		return $q->row();
	}
    //Busqueda de producto por un patron en varios campos
    public function buscarProductoPorPatron($identificador_almacen, $patron_busqueda_producto)
    {
        $patron_producto = '%'.$patron_busqueda_producto.'%';
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, ent_producto.precio, ent_producto.incremento, ent_producto.descuento, ent_producto.imagen, t_almacen_producto.existencias  "
                ."FROM ent_almacen   "
                ."LEFT JOIN t_almacen_producto ON t_almacen_producto.rel_almacen = ent_almacen.idalmacen "
                ."LEFT JOIN ent_producto ON ent_producto.idproducto = t_almacen_producto.rel_producto "
                ."LEFT JOIN ent_marca ON ent_marca.idmarca = ent_producto.rel_idmarca "
                ."LEFT JOIN ent_linea ON ent_linea.idlinea = ent_producto.rel_idlinea "
                ."LEFT JOIN ent_unidad ON ent_unidad.idunidad = ent_producto.rel_unidad "
                ."WHERE ent_almacen.idalmacen = ? "
                ."AND "
                ."( "
                ."  ent_marca.fabricante LIKE ?  "
                ."  OR ent_linea.nombre LIKE ?  "
                ."  OR ent_producto.item LIKE ?  "
                ."  OR ent_producto.dimension LIKE ?  "
                .") ";
        $qry = $this->db->query($sql, [$identificador_almacen, $patron_producto, $patron_producto, $patron_producto, $patron_producto]);
        return $qry->result();
    }

    //Leer producto de un almacen por el identificador
    public function leerProductoPorIdentificador($identificador, $almacen)
    {
        $identificador_producto = $identificador;
        $identificador_almacen = $almacen;
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, ent_producto.precio, ent_producto.incremento, ent_producto.descuento, ent_producto.imagen, t_almacen_producto.existencias "
            ."FROM ent_almacen "
            ."LEFT JOIN t_almacen_producto ON t_almacen_producto.rel_almacen = ent_almacen.idalmacen "
            ."LEFT JOIN ent_producto ON ent_producto.idproducto = t_almacen_producto.rel_producto  "
            ."LEFT JOIN ent_marca ON ent_marca.idmarca = ent_producto.rel_idmarca "
            ."LEFT JOIN ent_linea ON ent_linea.idlinea = ent_producto.rel_idlinea "
            ."LEFT JOIN ent_unidad ON ent_unidad.idunidad = ent_producto.rel_unidad "
            ."WHERE ent_almacen.idalmacen = ? "
            ."AND ent_producto.idproducto = ? ";
        $qry = $this->db->query($sql, [$identificador_almacen, $identificador_producto]);
        return $qry->row();
    }
	public function insertarProducto($dts,$almacen)
	{
		$this->db->trans_start();
		$this->db->insert('ent_producto',$dts);
		$idp=$this->db->insert_id();
		foreach ($almacen as $ida)
		{
			$dts_almProd=array('rel_almacen'=>$ida->idalmacen,
						'rel_producto'=>$idp,
						'existencias'=>0
						);
		$this->db->insert('t_almacen_producto',$dts_almProd);
		}
		$this->db->trans_complete();
	}
	public function buscarProductoLikeNombre($patron_busqueda_producto)
    {
		$patron_producto = '%'.$patron_busqueda_producto.'%';
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, ent_producto.precio, ent_producto.incremento, ent_producto.descuento, ent_producto.imagen"
                ." FROM ent_producto "
                ." INNER JOIN ent_marca ON ent_producto.rel_idmarca=ent_marca.idmarca"
                ." INNER JOIN ent_linea ON ent_producto.rel_idlinea = ent_linea.idlinea"
                ." INNER JOIN ent_unidad ON ent_producto.rel_unidad=ent_unidad.idunidad"
                ." WHERE ent_producto.item LIKE ? ";
        $qry = $this->db->query($sql,[$patron_producto]);
        return $qry->result();
    }
	public function buscarProductoNombre()
    {
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, ent_producto.precio, ent_producto.incremento, ent_producto.descuento, ent_producto.imagen"
                ." FROM ent_producto "
                ." INNER JOIN ent_marca ON ent_producto.rel_idmarca=ent_marca.idmarca"
                ." INNER JOIN ent_linea ON ent_producto.rel_idlinea = ent_linea.idlinea"
                ." INNER JOIN ent_unidad ON ent_producto.rel_unidad=ent_unidad.idunidad";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
	public function leerProductoPorId($idp)
	{
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, ent_producto.precio, ent_producto.incremento, ent_producto.descuento, ent_producto.imagen"
                ." FROM ent_producto "
                ." INNER JOIN ent_marca ON ent_producto.rel_idmarca=ent_marca.idmarca"
                ." INNER JOIN ent_linea ON ent_producto.rel_idlinea = ent_linea.idlinea"
                ." INNER JOIN ent_unidad ON ent_producto.rel_unidad=ent_unidad.idunidad"
                ." WHERE ent_producto.idproducto =".$idp;
        $qry = $this->db->query($sql);
        return $qry->result();
	}
	public function updateProducto($idp,$dts)
	{	
		$this->db->where('idproducto', $idp);
		$this->db->update('ent_producto', $dts);
	}
	public function leerTodoProducto()
	{
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, ent_producto.precio, ent_producto.incremento, ent_producto.descuento, ent_producto.imagen"
                ." FROM ent_producto "
                ." INNER JOIN ent_marca ON ent_producto.rel_idmarca=ent_marca.idmarca"
                ." INNER JOIN ent_linea ON ent_producto.rel_idlinea = ent_linea.idlinea"
                ." INNER JOIN ent_unidad ON ent_producto.rel_unidad=ent_unidad.idunidad";
        $qry = $this->db->query($sql);
        return $qry->result();
	}
	public function leerIdsProducto()
	{
        $sql = "SELECT idproducto"
                ." FROM ent_producto ";
        $qry = $this->db->query($sql);
        return $qry->result();
	}
	public function buscarProductoValoracion($identificador_almacen, $patron_busqueda_producto)
    {
        $patron_producto = '%'.$patron_busqueda_producto.'%';
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, t_almacen_producto.existencias  "
                ."FROM ent_almacen   "
                ."LEFT JOIN t_almacen_producto ON t_almacen_producto.rel_almacen = ent_almacen.idalmacen "
                ."LEFT JOIN ent_producto ON ent_producto.idproducto = t_almacen_producto.rel_producto "
                ."LEFT JOIN ent_marca ON ent_marca.idmarca = ent_producto.rel_idmarca "
                ."LEFT JOIN ent_linea ON ent_linea.idlinea = ent_producto.rel_idlinea "
                ."LEFT JOIN ent_unidad ON ent_unidad.idunidad = ent_producto.rel_unidad "
                ."WHERE ent_almacen.idalmacen = ? "
                ."AND "
                ."( "
                ."  ent_marca.fabricante LIKE ?  "
                ."  OR ent_linea.nombre LIKE ?  "
                ."  OR ent_producto.item LIKE ?  "
                ."  OR ent_producto.dimension LIKE ?  "
                .") ";
        $qry = $this->db->query($sql, [$identificador_almacen, $patron_producto, $patron_producto, $patron_producto, $patron_producto]);
        return $qry->result();
    }
	public function leerProdcutoAlmacenId($ida, $idp)
    {
        $sql = "SELECT ent_producto.idproducto, ent_marca.fabricante, ent_linea.nombre as linea, ent_producto.item, ent_producto.dimension, ent_producto.codigo, ent_unidad.nombre as unidad, t_almacen_producto.existencias  "
                ."FROM ent_almacen   "
                ."LEFT JOIN t_almacen_producto ON t_almacen_producto.rel_almacen = ent_almacen.idalmacen "
                ."LEFT JOIN ent_producto ON ent_producto.idproducto = t_almacen_producto.rel_producto "
                ."LEFT JOIN ent_marca ON ent_marca.idmarca = ent_producto.rel_idmarca "
                ."LEFT JOIN ent_linea ON ent_linea.idlinea = ent_producto.rel_idlinea "
                ."LEFT JOIN ent_unidad ON ent_unidad.idunidad = ent_producto.rel_unidad "
                ."WHERE ent_almacen.idalmacen = ? "
                ."AND "
                ."t_almacen_producto.rel_producto=?";
        $qry = $this->db->query($sql, [$ida, $idp]);
        return $qry->result();
    }
}