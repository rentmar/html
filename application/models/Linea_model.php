<?php

class Linea_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insertarLinea($linea)
    {
        $datos = array ('nombre'=>$linea);
		$this->db->insert('ent_linea',$datos);
    }
	public function leerTodoLikeLinea($linea)
	{
		$this->db->like('nombre',$linea);
		$query = $this->db->get('ent_linea');
		return $query->result();
	}
	public function leerTodoLinea()
	{
		$query = $this->db->get('ent_linea');
		return $query->result();
	}
	public function updateLinea($idl,$nom)
	{
		$datos=array('nombre'=>$nom);
		$this->db->where('idlinea',$idl);
		$this->db->update('ent_linea',$datos);
	}
	public function leerLineas()
	{
		$this->db->select('nombre');
		$query = $this->db->get('ent_linea');
		return $query->result();
	}
	public function leerIdPorLinea($nom)
	{
		$this->db->select('idlinea');
		$this->db->where('nombre',$nom);
		$query = $this->db->get('ent_linea');
		return $query->result();
	}
	public function leerLineaPorId($idlinea)
	{
		$this->db->where('idlinea',$idlinea);
		$query = $this->db->get('ent_linea');
		return $query->result();
	}
	
}