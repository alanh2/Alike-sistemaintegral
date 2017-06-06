<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Envio_renglones_model extends CI_Model {

	var $table = 'envios';

	//var $column_order = array('id','monto','fecha', 'metodos_envio.nombre',null);
	var $column_order = array('id','fechaestimada', 'metodos_envio.nombre',null); //set column field database for datatable orderable
	//var $column_search = array('envios.monto','envios.fechaestimada', 'metodos_envio.nombre');
	var $column_search = array('envios.fechaestimada', 'metodos_envio.nombre'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query($ventaid=NULL)
	{
		
		$this->db->from($this->table);
		$this->db->join('metodos_envio', 'metodos_envio.id = envios.metodoenvio');
		$this->db->join('ventas_envios', 'envios.id = ventas_envios.envioid', 'left');
		$this->db->join('ventas', 'ventas_envios.ventaid = ventas.id');
		$this->db->select('envios.*, metodos_envio.nombre as metodo_envio');
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
		$this->db->join('ventas_envios', 'envios.id = ventas_envios.envioid');
		$this->db->join('ventas', 'ventas_envios.ventaid = ventas.id');
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
}
