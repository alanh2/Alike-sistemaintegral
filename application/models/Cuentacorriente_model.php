<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentacorriente_model extends CI_Model {

	var $table = 'mov_cuentacorrientes';
	var $metodos_pago = array('0','mov_efectivos','mov_cheques','mov_mercadopagos','mov_transferencias','mov_cuentacorrientes','mov_panamas', 'mov_tarjetas');

	var $column_order = array('id','monto','fecha', 'metodos_pago.nombre',null); //set column field database for datatable orderable
	var $column_search = array('cobros.monto','cobros.fecha', 'metodos_pago.nombre'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
	var $numero_metodo_pago = 5;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$this->db->join('metodos_pago', 'metodos_pago.id = cobros.metododepagoid');
		$this->db->select('cobros.*, metodos_pago.nombre as metodo_pago');

		$i = 0;
		
		foreach ($this->column_search as $item) // loop column 
		{
			if(isset($_POST['search']['value'])) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
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

	public function get_deuda_by_cliente($clienteid)
	{
		$this->db->from($this->table);
		$this->db->join('cobros', 'cobros.metodoid = mov_cuentacorrientes.id');
		$this->db->where('metododepagoid',$this->numero_metodo_pago);
		$this->db->where('clienteid',$clienteid);
		$this->db->select_sum('mov_cuentacorrientes.saldo', 'deuda');

		$query = $this->db->get();
		return $query->row()->deuda;
	}

	public function cliente_es_deudor($clienteid)
	{
		$deuda = $this->get_deuda_by_cliente($clienteid);
		if ( $deuda > 0){
			return true;
		}else{
			return false;
		}
	}

	public function cliente_supero_limite_deuda($clienteid)
	{
		$deuda = $this->get_deuda_by_cliente($clienteid);
		if ( $deuda >= 5000){ // Definir limite
			return true;
		}else{
			return false;
		}
	}


	/*-----------*/

	public function ventas_adeudadas($clienteid){
		$this->db->from('aplicaciones_cobro_venta');
		$this->db->join('ventas', 'ventas.id = aplicaciones_cobro_venta.ventaid');
		$this->db->join('cobros', 'cobros.id = aplicaciones_cobro_venta.cobroid');
		$this->db->where('ventas.clienteid',$clienteid);
		$this->db->where('cobros.metododepagoid',5);// pagadas con cuenta corrienre
		$this->db->where('ventas.saldada',0); //Pagada con cuenta corriente sin terminar de pagar segun los cobros del cliente
		$this->db->select('ventas.id');

		$query = $this->db->get();
		return $query->result();
	}

	public function cobros_parciales_venta($ventaid){
		$this->db->from('aplicaciones_cobro_venta');
		$this->db->join('cobros', 'cobros.id = aplicaciones_cobro_venta.cobroid');
		$this->db->join('ventas', 'ventas.id = aplicaciones_cobro_venta.ventaid');
		$this->db->where('cobros.metododepagoid !=',5);// pagadas con cuenta corrienre
		$this->db->where('ventas.id',$ventaid);
		$this->db->select_sum('aplicaciones_cobro_venta.monto','cobrado');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->row();
	}

	public function get_deudas($clienteid){
		$this->db->from('cobros');
		$this->db->join('aplicaciones_cobro_venta', 'aplicaciones_cobro_venta.cobroid = cobros.id', 'left');
		$this->db->where('cobros.clienteid',$clienteid);
		$this->db->where('aplicaciones_cobro_venta.id',null); // trae los que no tienen ventas asociadas
		$this->db->where('cobros.metododepagoid',5); // pagadas con cuenta corrienre
		$this->db->select('cobros.metodoid as id'); // traigo los id que tienen saldos adeudados de cuenta corriente pero que no son cobros de una venta

		$query = $this->db->get();
		return $query->result();
	}

	public function get_saldo_deuda($cuentacorrienteid){
		$this->db->from($this->table);
		$this->db->where('id',$cuentacorrienteid);
		$this->db->select('saldo'); // lo que resta pagar de la deuda

		$query = $this->db->get();
		return $query->row()->saldo;
	}

}
