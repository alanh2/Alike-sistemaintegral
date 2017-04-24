<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaccion_model extends CI_Model {


	var $tabla = array('0','mov_efectivos','mov_cheques','mov_mercadopagos','mov_transferencias','mov_cuentacorrientes','mov_panamas', 'mov_tarjetas');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function actualizar($data)
	{
		if($data['metodo'] != $data['metodo_anterior']){
			$this->db->where('id', $data['mov_tabla_id_anterior']);
			$this->db->delete($this->tabla[$data['metodo_anterior']]);

			return $this->add_transaccion($data['metodo'],$data['operacion'],$data);
		}else{
			$datosCobro = $this->_preparar_transaccion($data['metodo'], $data['operacion'], $data);
			$this->update($this->tabla[$data['metodo']], array('id' => $data['mov_tabla_id_anterior']), $datosCobro);
			return $data['mov_tabla_id_anterior'];
		}
	}

	function add_transaccion($metododepago, $operacion, $data){
		$data = $this->_preparar_transaccion($metododepago, $operacion, $data);
		$this->db->insert($this->tabla[$metododepago], $data);
		return $this->db->insert_id();
	}

	function get_transaccion($metododepago, $mov_tabla_id){
		$this->db->from($this->tabla[$metododepago]);
		$this->db->where($this->tabla[$metododepago].'.id',$mov_tabla_id);
		$query = $this->db->get();

		return $query->row();
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
		switch ($metododepago) {
			case $efectivos:
			$datos_preparados['operacion'] = $operacion;			
				break;
			case $cheques:
				$datos_preparados['vencimiento'] = $data['vencimiento'];
				$datos_preparados['banco'] = $data['banco'];
				$datos_preparados['numeracion'] = $data['numeracion'];
				$datos_preparados['operacion'] = $operacion;			
				break;
			case $mps:
				$datos_preparados['codigomp'] = $data['codigomp'];
				$datos_preparados['operacion'] = $operacion;			
				break;
			case $transferencias:
				$datos_preparados['banco'] = $data['banco'];
				$datos_preparados['titular'] = $data['titular'];
				$datos_preparados['codigo_operacion'] = $data['codigo_operacion'];
				$datos_preparados['fecha'] = $data['fecha'];
				$datos_preparados['operacion'] = $operacion;			
				break;
			case $cuentacorrientes:
				$datos_preparados['saldo'] = $data['monto'];
				break;
			case $panamas:
				$datos_preparados['operacion'] = $operacion;			
				break;
			case $tarjetas:
				$datos_preparados['titular'] = $data['titular'];
				$datos_preparados['vencimiento'] = $data['vencimiento'];
				$datos_preparados['digitos'] = $data['digitos'];
				$datos_preparados['operacion'] = $operacion;			
				break;
			default:
				//rechazar pago
				break;
		}
		return $datos_preparados;
	}
	public function update($table, $where, $data)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}
	public function eliminar($metodo, $id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->tabla[$metodo]);
	}
}
