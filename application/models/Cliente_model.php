<?php
class Cliente_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function leerClientes()
    {
        $sql = "SELECT * "
            ."FROM ent_cliente_proveedor "
            ."WHERE ent_cliente_proveedor.es_cliente = ?";
        $qry = $this->db->query($sql, [1]);
        return $qry->result_array();
    }

    public function leerCliente($identificador)
    {
        $idcliente = $identificador;
        $sql = "SELECT * "
            ."FROM ent_cliente_proveedor "
            ."WHERE ent_cliente_proveedor.idclipro = ?";
        $qry = $this->db->query($sql, $idcliente);
        return $qry->row();

    }

    public function leerTodoClientes()
    {
        $sql = "SELECT * "
            ."FROM ent_cliente_proveedor ";
        $qry = $this->db->query($sql);
        return $qry->result();
    }

    public function crearCliente($datos)
    {
        $this->db->insert('ent_cliente_proveedor', $datos);
    }

    public function updateCliente($datos)
    {
        $idcliente = $datos['idclipro'];
        unset($datos['idclipro']);
        $this->db->where('idclipro', $idcliente);
        $this->db->update('ent_cliente_proveedor', $datos);
    }

    //Buscar Clientes por nit
    public function buscarNit($patron)
    {
        $this->db->from('ent_cliente_proveedor');
        $this->db->where('es_proveedor', 1);
        $this->db->like('nit', $patron);
        $qry = $this->db->get();
        return $qry->result();
    }
	
	public function leerProveedores()
    {
        $sql = "SELECT idclipro,nit,razon_social "
            ."FROM ent_cliente_proveedor WHERE es_proveedor=1";
        $qry = $this->db->query($sql);
        return $qry->result();
    }
	public function leerProveedorPorId($idp)
    {
        $sql = "SELECT idclipro,nit,razon_social "
            ."FROM ent_cliente_proveedor WHERE idclipro=".$idp;
        $qry = $this->db->query($sql);
        //return $qry->result();
        return $qry->row();
    }

    public function leerClientesPorNit($patron)
    {
        $patron_nit = '%'.$patron.'%';
        $sql = "SELECT * "
            ."FROM ent_cliente_proveedor "
            ."WHERE ent_cliente_proveedor.es_cliente = 1 "
            ."AND ent_cliente_proveedor.nit LIKE ? ";
        $qry = $this->db->query($sql, [$patron_nit]);
        return $qry->result();
    }

    public function leerClientePorNit($nit)
    {
        $this->db->select('*');
        $this->db->from('ent_cliente_proveedor');
        $this->db->where('nit', $nit);
        $this->db->where('es_cliente', true);
        $qry = $this->db->get();
        return $qry->row();
    }



}