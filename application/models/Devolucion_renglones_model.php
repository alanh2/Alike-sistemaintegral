<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Devolucion_renglones_model extends CI_Model {



	var $table = 'devoluciones_renglones';

	var $column_order = array(null); //set column field database for datatable orderable

	var $column_search = array(); //set column field database for datatable searchable just firstname , lastname , address are searchable

	var $order = array('id' => 'desc'); // default order 

	var $joins=array();

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}



	private function _get_datatables_query($ventaid=NULL)

	{



		$this->db->from($this->table);

		$this->db->join('ventas_renglones', 'ventas_renglones.id=devoluciones_renglones.venta_renglonid');

		$this->db->join('ventas', 'ventas.id=ventas_renglones.ventaid');		
		
		$this->db->join('stock', 'ventas_renglones.stockid= stock.id');

		$this->db->join('productos_colores', 'stock.producto_colorid= productos_colores.id');

		$this->db->join('colores', 'productos_colores.colorid= colores.id');
		
		$this->db->join('productos', 'productos_colores.productoid= productos.id');

		$this->db->select('devoluciones_renglones.*, productos.nombre as producto, colores.nombre as color');

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


	function count_filtered($ventaid=NULL)

	{

		$this->_get_datatables_query($ventaid);

		$query = $this->db->get();

		return $query->num_rows();

	}



	public function count_all($devolucionid=NULL)

	{

		$this->db->from($this->table);

		if ($devolucionid !=NULL){
			$this->db->where('id',$devolucionid);	
		}
		
		return $this->db->count_all_results();

	}


	public function get_by_renglon_id($id){
		$this->db->from($this->table);
		$this->db->select('sum(cantidad) as cantidad');
		$this->db->where('venta_renglonid', $id);
 		$this->db->group_by('venta_renglonid'); 
		$query = $this->db->get();
		return $query->row();
//		echo $this->db->last_query();
	}
	public function get_by_id($id)

	{

		$this->db->from($this->table);
		
		$this->db->join('stock', 'ventas_renglones.stockid= stock.id');

		$this->db->join('productos_colores', 'stock.producto_colorid= productos_colores.id');

		$this->db->join('colores', 'productos_colores.colorid= colores.id');
		
		$this->db->join('productos', 'productos_colores.productoid= productos.id');

		$this->db->select('ventas_renglones.*, productos.nombre as producto, colores.nombre as color');
		
		$this->db->where('ventas_renglones.id', $id);

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

