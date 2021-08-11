<?php

class Wizards_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Extraer estado de inicio y las banderas de Wizard
    public function leerEstadoInicial()
    {
        $qry = $this->db->get('t_wizards');
        return $qry->row();
    }

    //Actualizar el estado de las banderas
    public function actualizaBanderas($array_banderas)
    {
        $banderas = $array_banderas;
        $idwizard = $banderas['idwizard'];
        unset($banderas['idwizard']);
        $this->db->where('idwizard', $idwizard);
        $this->db->update('t_wizards', $banderas);
    }
}
