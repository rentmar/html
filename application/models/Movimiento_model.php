<?php

class Movimiento_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	public function ingresarMovimiento($dt)
	{
		$this->db->insert('ent_movimiento',$dt);
	}
	public function movimientoNoConfirmado($ida)
	{
		$this->db->where('confirmacion', 0);
		$this->db->where('rel_idalmacen_destino',$ida);
		$this->db->from('ent_movimiento');
		return $this->db->count_all_results();
	}
	public function leerNoConfirmados($id)
	{
		$sql = "SELECT ent_movimiento.idmovimiento,
					   users.username, 
					   ent_producto.item, 
					   ent_movimiento.fecha_movimiento, 
					   ent_movimiento.cantidad_producto, 
					   ent_almacen.nombre_almacen AS origen "
            ."FROM ent_movimiento "
            ."LEFT JOIN users ON ent_movimiento.rel_idusuario=users.id "
            ."LEFT JOIN ent_producto ON ent_movimiento.rel_idproducto=ent_producto.idproducto "
            ."LEFT JOIN ent_almacen ON ent_movimiento.rel_idalmacen_origen=ent_almacen.idalmacen "
            ."WHERE ent_movimiento.confirmacion=0 AND ent_movimiento.rel_idalmacen_destino = ?";
        $qry = $this->db->query($sql, [$id]);
        return $qry->result();
	}
	public function datosMovimiento($idmov)
	{
		$this->db->select('rel_idproducto,cantidad_producto,rel_idalmacen_origen');
		$this->db->where('idmovimiento',$idmov);
		$qry = $this->db->get('ent_movimiento');
		return $qry->result();
	}
	public function confirmarMovimiento($idmov)
	{
		$this->db->set('confirmacion',1);
		$this->db->where('idmovimiento',$idmov);
		$this->db->update('ent_movimiento');
	}
}