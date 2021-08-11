<?php


class Empresa_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Leer la empresa por su identificador
    public function leerEmpresaPorIdentificador($identificador){
        $qry = $this->db->get_where('ent_empresa', ['idempresa'=>$identificador]);
        return $qry->row();
    }

    //Datos del almacen por el identificador de la empresa
    public function leerAlmacenIdentificadorEmpresa($identificador){
        $qry = $this->db->get_where('ent_almacen', ['rel_empresa'=>$identificador]);
        return $qry->row();
    }

    //Leer todas las empresas creadas
    public function leerEmpresas()
    {
        $qry = $this->db->get('ent_empresa');
        return $qry->result();
    }

    //Leer la empresa mas sus datos de facturacion
    public function leerEmpresaMasDatosFacturacion($identificador)
    {
        $identificador_empresa = $identificador;
        $sql = "SELECT * "
            ."FROM ent_empresa "
            ."LEFT JOIN t_datos_factura ON t_datos_factura.iddfac = ent_empresa.rel_datos_factura "
            ."WHERE ent_empresa.idempresa = ? ";
        $qry = $this->db->query($sql, [$identificador_empresa, ]);
        return $qry->row();
    }

    //Leer la empresa mas almacen
    public function leerEmpresaAlmacen($identificador)
    {
        $identificador_empresa = $identificador;
        $sql = "SELECT * "
            ."FROM ent_almacen "
            ."LEFT JOIN ent_empresa ON ent_empresa.idempresa = ent_almacen.rel_empresa "
            ."WHERE ent_empresa.idempresa = ? ";
        $qry = $this->db->query($sql, [$identificador_empresa, ]);
        return $qry->row();
    }

    //Leer los cargos e impuestos
    public function leerCargosImpuestos($identificador)
    {
        $identificador_empresa = $identificador;
        $sql = "SELECT * "
            ."FROM ent_empresa "
            ."LEFT JOIN t_cargos_impuestos ON t_cargos_impuestos.rel_idempresa = ent_empresa.idempresa "
            ."WHERE ent_empresa.idempresa = ? ";
        $qry = $this->db->query($sql, [$identificador_empresa, ]);
        return $qry->row();
    }

    //Crear nueva empresa mas almacen
    public function insertarNuevaEmpresa($empresa_nueva)
    {
        //identificador de la empresa
        $idempresa = 0;

        //Datos de la empresa
        $empresa = $empresa_nueva;

        //Datos de facturacion
        $datos_facturacion = [
            'numero_autorizacion' => '',
            'numero_inicial_factura' => 1,
            'numero_actual_factura' => 1,
            'numero_ultimo_factura' => 0,
            'fecha_limite_emision ' => '',
            'llave_dosificacion' => '',
            'pie' => '',
            'pie_ley453' => '',
        ];

        //Matriz para el almacen
        $almacen = [
            'nombre_almacen' => '',
            'rel_empresa' => '',
        ];

        //Abrir la transaccion
        $this->db->trans_begin();

        //Insertar los datos de facturacion
        $this->db->insert('t_datos_factura', $datos_facturacion);
        //Recuperar el identificador de los datos de facturacion insertados
        $dat_facturacion = $this->db->insert_id();

        //Ajustar los datos de informacion de la empresa
        $empresa['rel_datos_factura'] = $dat_facturacion;
        //Insertar los datos de la empresa
        $this->db->insert('ent_empresa', $empresa);
        //Recuperar el identificador de la empresa
        $idempresa = $this->db->insert_id();

        //Ajustar los datos del almacen
        $almacen['nombre_almacen'] = 'Almacen - '.$empresa['nombre_empresa'];
        $almacen['rel_empresa'] = $idempresa;
        //Insertar el almacen
        $this->db->insert('ent_almacen', $almacen);
		
		
        if ($this->db->trans_status() === FALSE)
        {
            //Errores en la consulta
            $this->db->trans_rollback();
            return -1;
        }
        else
        {
            //Todas las consultas se hicieron correctamente
            $this->db->trans_commit();
            //Devuelve el identificador de la empresa
            return $idempresa;
        }


    }

    //Actualizar datos de la empresa
    public function updateEmpresa($empresa, $idempresa)
    {
        $this->db->where('idempresa', $idempresa);
        $this->db->update('ent_empresa', $empresa);
    }





}
