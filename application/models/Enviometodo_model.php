<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enviometodo_model extends CI_Model {

	var $tiposenvios = array('0','env_retiros','env_ocas','env_ocaexpress','env_motos','env_otros');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function actualizar($data)
	{
		if($data['metodo'] != $data['metodo_envio_id_anterior']){
			$this->db->where('id', $data['metodo_registro_id_anterior']);
			$this->db->delete($this->tiposenvios[$data['metodo_envio_id_anterior']]);

			return $this->add_envio($data);
		}else{
			$datosEnvio = $this->_armarEnvio($data);
			$this->update($this->tiposenvios[$data['metodo']], array('id' => $data['metodo_registro_id_anterior']), $datosEnvio);
			return $data['metodo_registro_id_anterior'];
		}
	}
	public function add_envio($data)
	{
		$datosEnvio = $this->_armarEnvio($data);
/*		$this->db->insert($this->tiposenvios[$data['metodo']], $datosEnvio);
		return $this->db->insert_id();
		*/
		return $this->save($this->tiposenvios[$data['metodo']], $datosEnvio);
		 
	}

	public function get_datos_metodo_by_id($id, $metodo){
		$this->db->from($this->tiposenvios[$metodo]);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	private function _armarEnvio($data)
	{
		$retiro = 1;
		$oca = 2;
		$oca_express =3;
		$moto = 4;
		$otros = 5;

		$datos_preparados = array();
		
		switch ($data['metodo']) {
			case $retiro:
				$datos_preparados['id'] = null;
				break;
			case $oca:
				$datos_preparados['costo'] = $data['costo'];
				$datos_preparados['direccion'] = $data['direccion'];
				$datos_preparados['tracking'] = $data['tracking'];
				break;
			case $oca_express:
				$datos_preparados['costo'] = $data['costo'];
				$datos_preparados['direccion'] = $data['direccion'];
				$datos_preparados['tracking'] = $data['tracking'];
				break;
			case $moto:
				$datos_preparados['costo'] = $data['costo'];
				$datos_preparados['direccion'] = $data['direccion'];
				$datos_preparados['tracking'] = $data['tracking'];
				$datos_preparados['motoid'] = $data['motoid'];
				break;
			case $otros:
				$datos_preparados['costo'] = $data['costo'];
				$datos_preparados['direccion'] = $data['direccion'];
				$datos_preparados['tracking'] = $data['tracking'];
				$datos_preparados['direccionempresa'] = $data['direccion_empresa'];
				$datos_preparados['nombreempresa'] = $data['nombre_empresa'];
				break;
			default:
				//rechazar envio
				break;
		}
		return $datos_preparados;
	}
	public function save($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function update($table, $where, $data)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}


}
