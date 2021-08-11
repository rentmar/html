<?php

class Compra_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	public function comprasNoConfirmadas()
	{
		$this->db->where('confirmacion', 0);
		$this->db->from('ent_registro_compra');
		$qry=$this->db->count_all_results();
		return $qry;
	}
	public function insertarCompra($dts,$prod)
	{
		$idcompra=0;
		$iddtcompra=0;
		$iddet=0;
		$this->db->trans_start();
		$dtcv=array('fecha'=>$dts['fecha'],
					'rel_idcliente'=>$dts['proveedor'],
					'total'=>$dts['total'],
					'saldo'=>0,
					'descuento_total'=>0,
					'cargo_transaccion'=>0,
					'es_compra'=>1,
					'es_deuda'=>0,
					'es_facturado'=>0,
					'rel_idtipopago'=>1,
					'rel_idempresa'=>$dts['sucursal'],
					'rel_idusuario'=>$dts['usuario']
					);
		$this->db->insert('ent_compra_venta',$dtcv);
		$idcompra = $this->db->insert_id();
		$dtcompra=array(
							'codigo_pedido'=>$dts['codigo_pedido'],
							'numero_factura'=>$dts['numero_factura']
							);
		$this->db->insert('t_datos_compra',$dtcompra);
		$iddtcompra = $this->db->insert_id();
		foreach ($prod as $p)
		{
			$dtp=array(
						'rel_idcomven'=>$idcompra,
						'rel_idproducto'=>$p['idp'],
						'cantidad_producto'=>$p['cantidad'],
						'descuento_producto'=>0,
						'total_producto'=>$p['precio']
						);
			$this->db->insert('t_detalle',$dtp);
			$iddet= $this->db->insert_id();
			$dtregcom=array(
							'rel_iddetalle'=>$iddet,
							'cantidad_recibida'=>0,
							'confirmacion'=>0,
							'rel_iddtcompra'=>$iddtcompra
							);
			$this->db->insert('ent_registro_compra',$dtregcom);
		}
		$this->db->trans_complete();
	}
	public function registroComprasConfirmar()
	{
		$sql = "SELECT ent_registro_compra.idregcompra,
				ent_marca.fabricante,
				ent_linea.nombre,
				ent_producto.item,
				ent_producto.codigo,
				ent_producto.dimension,
				ent_registro_compra.cantidad_recibida,
				ent_registro_compra.nota_recepcion,
				ent_compra_venta.fecha, 						
				t_detalle.cantidad_producto,
				t_detalle.total_producto 
				FROM ent_registro_compra 
				LEFT JOIN t_detalle ON ent_registro_compra.rel_iddetalle=t_detalle.iddetalle 
				LEFT JOIN ent_compra_venta ON t_detalle.rel_idcomven=ent_compra_venta.idcomven 
				LEFT JOIN ent_producto ON t_detalle.rel_idproducto=ent_producto.idproducto 
				LEFT JOIN ent_linea ON ent_producto.rel_idlinea = ent_linea.idlinea
				LEFT JOIN ent_marca on ent_producto.rel_idmarca = ent_marca.idmarca 
				WHERE ent_registro_compra.confirmacion=0";
        $qry = $this->db->query($sql);
        return $qry->result();
	}
	public function setProductoAlmacen($idp,$ida,$cant)
	{
		$this->db->set('existencias', $cant);
		$this->db->where('rel_almacen', $ida);
		$this->db->where('rel_producto', $idp);
		$this->db->update('t_almacen_producto');
	}
	public function leerCantidadProductoAlmacen($idp,$ida)
	{
		$this->db->select('existencias');
		$this->db->where('rel_almacen', $ida);
		$this->db->where('rel_producto', $idp);
		$qry=$this->db->get('t_almacen_producto');
		return $qry->result();
	}
	public function getIdDetalleRegCompra($idr)
	{
		$this->db->select('rel_iddetalle');
		$this->db->where('idregcompra', $idr);
		$qry=$this->db->get('ent_registro_compra');
		return $qry->result();
	}
	public function getCantidades($idr)
	{
		$sql = "SELECT 
				ent_registro_compra.cantidad_recibida,	
				ent_registro_compra.nota_recepcion,
				t_detalle.cantidad_producto,
				t_detalle.rel_idproducto
				FROM ent_registro_compra 
				LEFT JOIN t_detalle ON ent_registro_compra.rel_iddetalle=t_detalle.iddetalle 
				WHERE ent_registro_compra.idregcompra=".$idr;
		$qry = $this->db->query($sql);
		return $qry->result();
	}
	public function updateCantidadRecibida($idr,$cant,$nota)
	{
		$this->db->set('nota_recepcion', $nota);
		$this->db->set('cantidad_recibida', $cant);
		$this->db->where('idregcompra', $idr);
		$this->db->update('ent_registro_compra');
	}
	public function updateConfirmacion($idr)
	{
		$this->db->set('confirmacion', 1);
		$this->db->where('idregcompra', $idr);
		$this->db->update('ent_registro_compra');
	}
}