<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Compra_renglones_model extends CI_Model {



	var $table = 'compra_renglones';

	var $column_order = array(null); //set column field database for datatable orderable

	var $column_search = array(); //set column field database for datatable searchable just firstname , lastname , address are searchable

	var $order = array('id' => 'desc'); // default order 

	var $joins=array();

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}



	private function _get_datatables_query($compraid=NULL)

	{



		$this->db->from($this->table);

		$this->db->join('stock', 'compras_renglones.stockid= stock.id');

		$this->db->join('productos_colores', 'stock.producto_colorid= productos_colores.id');

		$this->db->join('colores', 'productos_colores.colorid= colores.id');
		
		$this->db->join('productos', 'productos_colores.productoid= productos.id');

		$this->db->select('compras_renglones.*, productos.nombre as producto, colores.nombre as color');

		if ($compraid !=NULL){
			$this->db->where('compraid',$compraid);	
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



	function get_datatables($compraid=NULL)

	{

		$this->_get_datatables_query($compraid);
		if(isset($_POST['length'])){
			$length=$_POST['length'];	
		}else{
			$length=10;	
		}
		if(isset($_POST['start'])){
			$start=$_POST['start'];	
		}else{
			$start=0;	
		}
		if($length >0){
			$this->db->limit($length, $start);
		}		
		$query = $this->db->get();
		return $query->result();

	}


	function count_filtered($compraid=NULL)

	{

		$this->_get_datatables_query($compraid);

		$query = $this->db->get();

		return $query->num_rows();

	}



	public function count_all($compraid=NULL)

	{

		$this->db->from($this->table);

		if ($compraid !=NULL){
			$this->db->where('compraid',$compraid);	
		}
		
		return $this->db->count_all_results();

	}



	public function get_by_id($id)

	{

		$this->db->from($this->table);
		
		$this->db->join('stock', 'compras_renglones.stockid= stock.id');

		$this->db->join('productos_colores', 'stock.producto_colorid= productos_colores.id');

		$this->db->join('colores', 'productos_colores.colorid= colores.id');
		
		$this->db->join('productos', 'productos_colores.productoid= productos.id');

		$this->db->select('compras_renglones.*, productos.nombre as producto, colores.nombre as color');
		
		$this->db->where('compras_renglones.id', $id);

		$query = $this->db->get();

		//echo $this->db->last_query();

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





}

