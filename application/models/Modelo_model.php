<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_model extends CI_Model {

	var $table = 'modelos';
	var $column_order = array('id','nombre','marca',null); //set column field database for datatable orderable
	var $column_search = array('modelos.id','modelos.nombre','marcas.nombre'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		$this->db->join('marcas', 'marcas.id = modelos.marcaid');
		$this->db->select('modelos.*, marcas.nombre as marca');

		$i = 0;
		
		if(isset($_POST['search']['value'])) // if datatable send POST for search
		{
			
			foreach ($this->column_search as $item) // loop column 
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
				
				$i++;
			}
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
		//echo $this->db->last_query();
		return $query->result();
	}
	function get_por_marca($marca)
	{
		$this->db->from($this->table);
		$this->db->where('marcaid', $marca);
		$this->db->order_by('nombre','asc');
		$query = $this->db->get();
		//echo $this->db->last_query();
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
		$this->db->join('marcas', 'marcas.id = modelos.marcaid');
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
	public function cuantos_por($id){
		$this->db->from($this->table);
		$this->db->where('marcaid',$id);
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		//echo $this->db->last_query();
		return $rowcount;
	}

}
