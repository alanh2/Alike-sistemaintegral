<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashback_model extends CI_Model {

	var $table = 'cash_backs';

	var $column_order = array('id','monto','saldo'); //set column field database for datatable orderable
	var $column_search = array('cash_backs.monto','cash_backs.saldo'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
	var $numero_metodo_pago = 8;

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
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

}
