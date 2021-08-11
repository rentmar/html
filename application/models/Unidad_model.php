<?php

class Unidad_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertarUnidad($unidad)
    {
        $datos = array ('nombre'=>$unidad);
		$this->db->insert('ent_unidad',$datos);
    }
	public function leerTodoLikeUnidad($unidad)
	{
		$this->db->like('nombre',$unidad);
		$query = $this->db->get('ent_unidad');
		return $query->result();
	}
	public function leerTodoUnidad()
	{
		$query = $this->db->get('ent_unidad');
		return $query->result();
	}
	public function leerUnidadPorId($idu)
	{
		$this->db->where('idunidad',$idu);
		$query = $this->db->get('ent_unidad');
		return $query->result();
	}
	public function updateUnidad($idu,$nom)
	{
		$datos=array('nombre'=>$nom);
		$this->db->where('idunidad',$idu);
		$this->db->update('ent_unidad',$datos);
	}
	public function leerUnidades()
	{
		$this->db->select('nombre');
		$query = $this->db->get('ent_unidad');
		return $query->result();
	}
	public function leerIdPorUnidad($unidad)
	{
		$this->db->select('idunidad');
		$this->db->where('nombre',$unidad);
		$query = $this->db->get('ent_unidad');
		return $query->result();
	}
	
}