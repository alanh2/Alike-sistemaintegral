<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaccion_model extends CI_Model {


	var $tabla = array('0','mov_efectivos','mov_cheques','mov_mercadopagos','mov_transferencias','mov_cuentacorrientes','mov_panamas', 'mov_tarjetas');


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function add_transaccion($metododepago, $operacion, $data){
		$data = $this->_preparar_transaccion($metododepago, $operacion, $data);
		$this->db->insert($this->tabla[$metododepago], $data);
		return $this->db->insert_id();
	}

	function _preparar_transaccion($metododepago, $operacion, $data){
		$efectivos = 1;
		$cheques = 2;
		$mps =3;
		$transferencias = 4;
		$cuentacorrientes = 5;
		$panamas = 6;
		$tarjetas = 7;
		$datos_preparados = array();
		$datos_preparados['operacion'] = $operacion;			
		switch ($metododepago) {
			case $efectivos:
				break;
			case $cheques:
				$datos_preparados['vencimiento'] = $data['vencimiento'];
				$datos_preparados['banco'] = $data['banco'];
				$datos_preparados['numeracion'] = $data['numeracion'];
				break;
			case $mps:
				$datos_preparados['codigomp'] = $data['codigomp'];
				break;
			case $transferencias:
				$datos_preparados['banco'] = $data['banco'];
				$datos_preparados['titular'] = $data['titular'];
				$datos_preparados['codigo_operacion'] = $data['codigo_operacion'];
				$datos_preparados['fecha'] = $data['fecha'];
				break;
			case $cuentacorrientes:
				break;
			case $panamas:
				break;
			case $tarjetas:
				$datos_preparados['titular'] = $data['titular'];
				$datos_preparados['vencimiento'] = $data['vencimiento'];
				$datos_preparados['digitos'] = $data['digitos'];
				break;
			default:
				//rechazar pago
				break;
		}
		return $datos_preparados;
	}
/*	
	private function _add_efectivo($data)
	{
		$this->db->insert($this->tabla_efectivos, $data);
		return $this->db->insert_id();
	}
	private function _add_cheque($data)
	{
		$this->db->insert($this->tabla_cheques, $data);
		return $this->db->insert_id();
	}
	private function _add_mp($data)
	{
		$this->db->insert($this->tabla_mps, $data);
		return $this->db->insert_id();
	}
	private function _add_cuentacorriente($data)
	{
		$this->db->insert($this->tabla_cuentacorrientes, $data);
		return $this->db->insert_id();
	}
	private function _add_panama($data)
	{
		$this->db->insert($this->tabla_panamas, $data);
		return $this->db->insert_id();
	}
	private function _add_tarjeta($data)
	{
		$this->db->insert($this->tabla_tarjetas, $data);
		return $this->db->insert_id();
	}
*/
}
