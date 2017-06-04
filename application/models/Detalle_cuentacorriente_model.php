<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalle_cuentacorriente_model extends CI_Model {

	var $table = 'detalle_cuenta_corriente';
	var $metodos_pago = array('0','mov_efectivos','mov_cheques','mov_mercadopagos','
		mov_transferencias','mov_cuentacorrientes','mov_panamas', 'mov_tarjetas');
	var $tipo_operacion = array('0','cobro','envio','venta','gasto');

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

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

	public function get_by_operacion_id($tipo_operacion, $operacionid)
	{
		$this->db->from($this->table);
		$this->db->where('tipo_operacion', $tipo_operacion);
		$this->db->where('operacionid', $operacionid);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_last_detalle_by_cliente($clienteid)
	{
		$this->db->from($this->table);
		$this->db->where('clienteid',$clienteid);
		$this->db->select_max('id');
		$query = $this->db->get();
		$id = $query->row()->id;

		return $this->get_by_id($id);
	}

	public function get_all_by_cliente($clienteid, $id=NULL){
		$this->db->from($this->table);
		$this->db->where('clienteid',$clienteid);
		if ($id != NULL){
			$this->db->where('id >',$id);
		}
		$query = $this->db->get();

		return $query->result();
	}

	public function calcular_saldo_actual($data, $saldo_anterior){
//	var $tipo_operacion = array('0','cobro','envio','venta','gasto');
		$saldo_actual = $saldo_anterior;
		if ($data["tipo_operacion"] == 1 || $data["tipo_operacion"] == 2){
			$saldo_actual += $data["monto"];
		}
		if ($data["tipo_operacion"] == 3 || $data["tipo_operacion"] == 4){
			$saldo_actual -= $data["monto"];
		}
		return $saldo_actual;
	}

	public function armar_datos($data, $detalle=NULL){
		$saldo_anterior = 0;
		
		if ($detalle != NULL){
			$saldo_anterior = $detalle->saldo_anterior;
		}else{
			$ultimo_detalle= $this->get_last_detalle_by_cliente($data["clienteid"]);
			if ($ultimo_detalle == NULL){
				$saldo_anterior = 0;
			}else{
				$saldo_anterior = $ultimo_detalle->saldo_actual;
			}
		}

		$saldo_actual = $this->calcular_saldo_actual($data, $saldo_anterior);
		$dataDetallecc = array(
    		"saldo_anterior" => $saldo_anterior,
    		"saldo_actual" => $saldo_actual,
    		"tipo_operacion" => $data["tipo_operacion"], 
    		"operacionid" => $data["operacionid"],
    		"vendedorid" => $data["vendedorid"],
    		"clienteid" => $data["clienteid"],
			);
		if (isset($data["fecha"])){
    		$dataDetallecc["fecha"] = $data["fecha"];
		}
		return $dataDetallecc;
	}

	public function registrar($data)
	{
		$dataDetallecc = $this->armar_datos($data);
		return $this->save($dataDetallecc);
	}

	public function actualizar_detalle_cc($data)
	{
		$detalle = $this->get_by_operacion_id($data["tipo_operacion"], $data["operacionid"]);
		$dataDetallecc = $this->armar_datos($data, $detalle);

		$diferencia = $dataDetallecc["saldo_actual"] - $detalle->saldo_actual;

		$detallescc = $this->get_all_by_cliente($detalle->clienteid, $detalle->id);
		foreach ($detallescc as $d) {
			$this->actualizar($d, $diferencia);
		}

		return $this->update(array('id' => $detalle->id), $dataDetallecc);
	}

	public function eliminar_detalle_cc($tipo_operacion, $operacionid)
	{
		$detalle = $this->get_by_operacion_id($tipo_operacion, $operacionid);
		if ($detalle != NULL){
			$diferencia = $detalle->saldo_anterior - $detalle->saldo_actual;

			$detallescc = $this->get_all_by_cliente($detalle->clienteid, $detalle->id);
			foreach ($detallescc as $d) {
				$this->actualizar($d, $diferencia);
			}

			return $this->delete_by_id($detalle->id);
		}else{
			return 0;
		}
	}

	public function actualizar($detalle, $diferencia)
	{
		$dataDetallecc = array(
    		"saldo_anterior" => $detalle->saldo_anterior + $diferencia,
    		"saldo_actual" => $detalle->saldo_actual + $diferencia,
			);

		return $this->update(array('id' => $detalle->id), $dataDetallecc);
	}

}