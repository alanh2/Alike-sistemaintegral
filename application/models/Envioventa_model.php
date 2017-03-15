<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Envioventa_model extends CI_Model {

	var $table = 'ventas_envios';

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

	public function get_by_venta($ventaid)
	{
		$this->db->from($this->table);
		$this->db->join('envios', 'ventas_envios.envioid = envios.id');
		$this->db->join('metodos_envio', 'metodos_envio.id = envios.metodoenvio');
		$this->db->select('ventas_envios.*, metodos_envio.nombre as nombre_envio, metodos_envio.id as metodoenvio, envios.recibe, envios.dni, envios.metodoenvioid as idregistrometodoenvio, envios.fechaestimada');
		$this->db->where('ventas_envios.ventaid',$ventaid);
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
