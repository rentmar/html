<?php

class Inventario_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	public function cantidadVendidaEmpresaProducto($ide,$idp)
	{
		$sql = "SELECT t_detalle.cantidad_producto "
                ."FROM t_detalle   "
                ."LEFT JOIN ent_compra_venta ON ent_compra_venta.idcomven = t_detalle.rel_idcomven "
				."WHERE ent_compra_venta.es_compra = 0 "
                ."AND ent_compra_venta.rel_idempresa = ? "
                ."AND "
                ."t_detalle.rel_idproducto=?";
		$qry = $this->db->query($sql, [$ide, $idp]);
        return $qry->result();
	}
	public function cantidadCompradaEmpresaProducto($ide,$idp)
	{
		$sql = "SELECT t_detalle.cantidad_producto "
                ."FROM t_detalle   "
                ."LEFT JOIN ent_compra_venta ON ent_compra_venta.idcomven = t_detalle.rel_idcomven "
				."WHERE ent_compra_venta.es_compra = 1 "
                ."AND ent_compra_venta.rel_idempresa =".$ide." "
                ."AND t_detalle.rel_idproducto=".$idp;
		$qry = $this->db->query($sql);
        return $qry->result();
	}
}