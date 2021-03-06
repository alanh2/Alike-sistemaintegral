<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro_renglones_model extends CI_Model {

	var $table = 'cobros';
	var $metodos_pago = array('0','mov_efectivos','mov_cheques','mov_mercadopagos','mov_transferencias','mov_cuentacorrientes','mov_panamas', 'mov_tarjetas');

	var $column_order = array('id','monto','fecha', 'metodos_pago.nombre',null); //set column field database for datatable orderable
	var $column_search = array('cobros.monto','cobros.fecha', 'metodos_pago.nombre'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query($ventaid=NULL)
	{
		
		$this->db->from($this->table);
		$this->db->join('metodos_pago', 'metodos_pago.id = cobros.metododepagoid');
		$this->db->join('aplicaciones_cobro_venta', 'cobros.id = aplicaciones_cobro_venta.cobroid', 'left');
		$this->db->join('ventas', 'aplicaciones_cobro_venta.ventaid = ventas.id');
		$this->db->select('cobros.*, metodos_pago.nombre as metodo_pago');
		if ($ventaid !=NULL){
			$this->db->where('ventas.id',$ventaid);	
		}
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
	function get_datatables($ventaid=NULL)
	{
		$this->_get_datatables_query($ventaid);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($ventaid=NULL)
	{
		$this->_get_datatables_query($ventaid);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($ventaid=NULL)
	{
		$this->db->from($this->table);
		$this->db->join('aplicaciones_cobro_venta', 'cobros.id = aplicaciones_cobro_venta.cobroid');
		$this->db->join('ventas', 'aplicaciones_cobro_venta.ventaid = ventas.id');
		if ($ventaid !=NULL){
			$this->db->where('ventas.id',$ventaid);	
		}
		return $this->db->count_all_results();
	}

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
		$this->db->join('metodos_pago', 'metodos_pago.id = cobros.metododepagoid');
		$this->db->join('aplicaciones_cobro_venta', 'cobros.id = aplicaciones_cobro_venta.cobroid','left');
		$this->db->where('clienteid',$clienteid);
		$this->db->where('(aplicaciones_cobro_venta.id IS NULL AND metododepagoid="5" OR metododepagoid!="5")',null,false);
		$this->db->select('cobros.id as id, cobros.monto, cobros.fecha, "Cobro" as tipo, metodos_pago.nombre as metodo_pago');
		$query = $this->db->get();
		//echo $this->db->last_query();

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


}
