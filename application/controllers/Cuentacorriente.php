<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentacorriente extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('cuentacorriente_model','cuentacorriente');
		$this->load->model('cobro_model','cobro');
		$this->load->model('venta_model','venta');
		$this->load->model('transaccion_model','transaccion');
		$this->load->model('aplicacioncobroventa_model','aplicacionCobroVenta');
		$this->load->model('notacredito_model','notaCredito');

	}

	private function ventas_adeudadas($clienteid){
		$this->db->from('aplicaciones_cobro_venta');
		$this->db->join('ventas', 'ventas.id = aplicaciones_cobro_venta.ventaid');
		$this->db->join('cobros', 'cobros.id = aplicaciones_cobro_venta.cobroid');
		$this->db->where('ventas.clienteid',$clienteid);
		$this->db->where('cobros.metodopagoid',5);// pagadas con cuenta corrienre
		$this->db->where('ventas.saldado',0); //Pagada con cuenta corriente sin terminar de pagar segun los cobros del cliente
		$this->db->select('ventas.id');

		$query = $this->db->get();
		return $query->result();
	}

	private function cobros_parciales_venta($ventaid){
		$this->db->from('aplicaciones_cobro_venta');
		$this->db->join('cobros', 'cobros.id = aplicaciones_cobro_venta.cobroid');
		$this->db->join('ventas', 'ventas.id = aplicaciones_cobro_venta.ventaid');
		$this->db->where('cobros.metodopagoid !=',5);// pagadas con cuenta corrienre
		$this->db->where('ventas.id',$ventaid);
		$this->db->select_sum('aplicaciones_cobro_venta.monto','cobrado');

		$query = $this->db->get();
		return $query->row();
	}

	public function ajax_saldo_by_cliente($clienteid)
	{
		$deuda = $this->cuentacorriente->calcular_saldo_by_cliente($clienteid);
		echo json_encode($deuda);
	}

	public function ajax_cliente_es_deudor($clienteid)
	{
		$afavor = $this->cuentacorriente->cliente_es_deudor($clienteid);
		echo json_encode($afavor);
	}

	public function cliente_supero_limite_deuda($clienteid)
	{
		$afavor = $this->cuentacorriente->cliente_es_deudor($clienteid);
		echo json_encode($afavor);
	}

}

