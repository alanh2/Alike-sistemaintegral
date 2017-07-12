<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notacredito_model extends CI_Model {

	var $table = 'nota_credito';

	var $column_order = array('id','monto','saldo'); //set column field database for datatable orderable
	var $column_search = array('nota_credito.monto','nota_credito.saldo'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
	var $numero_metodo_pago = 8;

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_resumen_by_clienteid($clienteid)
	{
		$this->db->from($this->table);
		//$this->db->join('cobros', 'cobros.id = nota_credito.cobroid','left');
		//$this->db->where('cobros.clienteid',$clienteid);
		$this->db->where('nota_credito.clienteid',$clienteid);
		$this->db->select('id, monto, fecha, "Nota de credito" as tipo');
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

	public function get_saldo_by_cliente($clienteid)
	{
		$this->db->from($this->table);
		$this->db->join('cobros', 'cobros.metodoid = nota_credito.id');
		$this->db->where('metododepagoid',$this->numero_metodo_pago);
		$this->db->where('clienteid',$clienteid);
		$this->db->select_sum('nota_credito.saldo', 'saldo');

		$query = $this->db->get();
		return $query->row()->saldo;
	}

}
