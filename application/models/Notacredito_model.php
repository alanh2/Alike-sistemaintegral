<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notacredito_model extends CI_Model {

	var $table = 'nota_credito';

	var $column_order = array('id','monto','saldo'); //set column field database for datatable orderable
	var $column_search = array('nota_credito.monto','nota_credito.saldo'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

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
