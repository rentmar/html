<?php

class Classabc_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //EL total de los productos
    public function leerProductos()
    {
        $qry = $this->db->get('ent_productos');
        return $qry->result();
    }

    //Calcular el numero de productos
    public function cantidadProductos()
    {
        $qry = $this->count_all('ent_productos');
        return $qry;
    }

    //Calcular la participacion de los articulos
    public function participacionProductos()
    {
        $qry = (1/$this->db->count_all('articulos'))*100;
        return $qry;
    }

    //Comprobar si existe un periodo contable activo
    public function existePeriodoContableActivo()
    {
        $sql = "SELECT * "
            ."FROM ent_inventario "
            ."WHERE ent_inventario.esta_activo = 1";
        $qry = $this->db->query($sql);
        if(empty($qry))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
