<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metodoenvio_model extends CI_Model {

	var $table = 'metodos_envio';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_metodos()
	{
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}
}
