<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aplicacioncobroventa_model extends CI_Model {

	var $table = 'aplicaciones_cobro_venta';
	var	$tablas_movimientos = array('0','mov_efectivos','mov_cheques','mov_mercadopagos','mov_transferencias','mov_cuentacorrientes','mov_panamas', 'mov_tarjetas');
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function get_by_venta_id($id)
	{
		$this->db->from($this->table);
		$this->db->join('cobros', 'cobros.id = aplicaciones_cobro_venta.cobroid');
		$this->db->join('metodos_pago', 'metodos_pago.id = cobros.metododepagoid');
		$this->db->select('cobros.id as cobros_id, cobros.fecha as fecha, aplicaciones_cobro_venta.monto as monto, 
			metodos_pago.nombre as metodo_cobro_nombre');
		$this->db->order_by('fecha', 'desc');
		$this->db->where('ventaid',$id);
		$query = $this->db->get();

		return $query->result();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}
	public function delete_by_cobroid($cobroid)
	{
		$this->db->where('cobroid', $cobroid);
		$this->db->delete($this->table);
	}


}
