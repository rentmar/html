<?php

class Almacen_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	public function leerAlmacenes()
    {
        $qry = $this->db->get('ent_almacen');
        return $qry->result();
    }
	public function leerProductosAlmacenCero($ida)
	{
		$sql = "SELECT ent_producto.idproducto, 
				ent_marca.fabricante, 
				ent_linea.nombre AS linea, 
				ent_producto.item, 
				ent_producto.dimension, 
				ent_unidad.nombre AS unidad, 
				t_almacen_producto.existencias "
				."FROM t_almacen_producto "
				."LEFT JOIN ent_producto ON t_almacen_producto.rel_producto=ent_producto.idproducto "
				."LEFT JOIN ent_marca ON ent_producto.rel_idmarca=ent_marca.idmarca "
				."LEFT JOIN ent_linea ON ent_producto.rel_idlinea=ent_linea.idlinea "
				."LEFT JOIN ent_unidad ON ent_producto.rel_unidad=ent_unidad.idunidad "
				."WHERE t_almacen_producto.existencias=0 AND t_almacen_producto.rel_almacen = ?";
        $qry = $this->db->query($sql, [$ida]);
        return $qry->result();
	}
	public function leerProductosExistentesAlmacen($ida)
	{
		$sql = "SELECT ent_producto.idproducto, 
				ent_marca.fabricante, 
				ent_linea.nombre AS linea, 
				ent_producto.item, 
				ent_producto.dimension, 
				ent_producto.codigo,
				ent_unidad.nombre AS unidad, 
				t_almacen_producto.existencias "
				."FROM t_almacen_producto "
				."LEFT JOIN ent_producto ON t_almacen_producto.rel_producto=ent_producto.idproducto "
				."LEFT JOIN ent_marca ON ent_producto.rel_idmarca=ent_marca.idmarca "
				."LEFT JOIN ent_linea ON ent_producto.rel_idlinea=ent_linea.idlinea "
				."LEFT JOIN ent_unidad ON ent_producto.rel_unidad=ent_unidad.idunidad "
				."WHERE t_almacen_producto.existencias!=0 AND t_almacen_producto.rel_almacen = ?";
        $qry = $this->db->query($sql, [$ida]);
        return $qry->result();
	}
	public function updateCantidadAlmacen($ida,$idp,$cant)
	{
		$this->db->set('existencias',$cant);
		$this->db->where('rel_almacen',$ida);
		$this->db->where('rel_producto',$idp);
		$this->db->update('t_almacen_producto');
	}
	public function leerCantidadAlmacenProducto($ida,$idp)
	{
		$this->db->select('existencias');
		$this->db->where('rel_almacen',$ida);
		$this->db->where('rel_producto',$idp);
		$query = $this->db->get('t_almacen_producto');
		return $query->result();
	}
	public function insertarProductoAlmacen($ida,$idp)
	{
		$this->db->trans_start();
		$dts_almProd=array('rel_almacen'=>$ida,
						'rel_producto'=>$idp,
						'existencias'=>0
						);
		$this->db->insert('t_almacen_producto',$dts_almProd);
		$this->db->trans_complete();
	}
}