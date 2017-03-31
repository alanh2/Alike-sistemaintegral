<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Producto_model extends CI_Model {



	var $table = 'productos';

	var $column_order = array('marca','categoria','modelo',null); //set column field database for datatable orderable

	var $column_search = array('marcas.nombre','subcategorias.nombre','modelos.nombre','proveedores.nombre'); //set column field database for datatable searchable just firstname , lastname , address are searchable

	var $order = array('id' => 'desc'); // default order 

	var $joins=array();

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}

	public function cuantos_por($tabla,$fk,$id){

		//tabla por si es M a M, clave foranea y id

		$this->db->from($tabla);

		$this->db->where($fk,$id);

		$query = $this->db->get();

		$rowcount = $query->num_rows();

		return $rowcount;

	}

	



	private function _get_datatables_query()

	{



		$this->db->from($this->table);

		$this->db->join('subcategorias', 'subcategorias.id = productos.subcategoriaid');

		$this->db->join('proveedores', 'proveedores.id = productos.proveedorid');

		$this->db->join('modelos', 'modelos.id = productos.modeloid');

		$this->db->join('marcas', 'marcas.id = modelos.marcaid');

		$this->db->select('productos.*, marcas.nombre as marca, subcategorias.nombre as subcategoria, proveedores.nombre as proveedor, modelos.nombre as modelo, modelos.marcaid');

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
	
	public function get_producto_colores($id)

	{

		$this->db->from($this->table."_colores");

		$this->db->join('colores', 'colores.id = productos_colores.colorid');

		$this->db->where('productoid',$id);
		
		$this->db->select('productos_colores.*, colores.nombre as nombre, colores.name as name ');

		$query = $this->db->get();

		return $query->result();

	}



	public function save($data)

	{

		$this->db->insert($this->table, $data);

		return $this->db->insert_id();

	}

	public function save_color($data)

	{

		$table=$this->table."_colores";
		$where= array('productoid'=>$data["productoid"],'colorid'=>$data["colorid"]);
		$query = $this->db->get_where($table,$where);

		if($this->db->affected_rows()==1){
			$this->db->update($table, $data, $where);
		}
		else{
			$this->db->insert($table, $data);
			$colorid=$this->db->insert_id();
			$stockData['producto_colorid']=$colorid;
			$stockData['cantidad']=0;
			$stockData['localid']=1;
			$this->db->insert('stock',$stockData);
		}
		//echo $this->db->last_query();

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
	public function delete_colores($productoid,$colores_no_eliminados=null)

	{

		$this->db->where('productoid', $productoid);

		$this->db->where_not_in('colorid', $colores_no_eliminados);

		$this->db->delete($this->table."_colores");
	}


	
	//agregado

	//STOCK

	public function salida_stock($id, $cantidad){

		$this->db->set('stock', 'stock-'.$cantidad, FALSE);

		$this->db->where('id', $id);

		$this->db->update($this->table);

	}

	public function ajuste_stock($id, $cantidad){

		$this->db->set('stock', 'stock+'.$cantidad, FALSE);

		$this->db->where('id', '$id');

		$this->db->update($this->table);

	}



}

