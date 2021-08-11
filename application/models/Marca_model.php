<?php

class Marca_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Extraer todos los productos
    public function insertarMarca($dato_marca)
    {
        $datos = array ('fabricante'=>$dato_marca);
		$this->db->insert('ent_marca',$datos);
    }
	public function leerTodoLikeMarca($marca)
	{
		$this->db->like('fabricante',$marca);
		$query = $this->db->get('ent_marca');
		return $query->result();
	}
	public function leerMarcaPorId($idmarca)
	{
		$this->db->where('idmarca',$idmarca);
		$query = $this->db->get('ent_marca');
		return $query->result();
	}
	public function updateMarca($idm,$fab)
	{
		$datos=array('fabricante'=>$fab);
		$this->db->where('idmarca',$idm);
		$this->db->update('ent_marca',$datos);
	}
	public function leerMarcas()
	{
		$this->db->select('fabricante');
		$query = $this->db->get('ent_marca');
		return $query->result();
	}
	public function leerTodoMarca()
	{
		$query = $this->db->get('ent_marca');
		return $query->result();
	}
	public function leerIdPorMarca($marca)
	{
		$this->db->select('idmarca');
		$this->db->where('fabricante',$marca);
		$query = $this->db->get('ent_marca');
		return $query->result();
	}
}