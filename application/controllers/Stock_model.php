<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Stock_model extends CI_Model {



	var $table = 'stock';

	var $column_order = array(null); //set column field database for datatable orderable

	var $column_search = array('stock.id','marcas.nombre','modelos.nombre','subcategorias.nombre','productos.nombre','colores.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable

	var $order = array('id' => 'desc'); // default order 

	var $joins=array();

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}

	public function cuantos_por_color_producto($id){

		$this->db->from($this->table);
		
		$this->db->join('productos_colores', 'productos_colores.id = stock.producto_colorid');
				
		$this->db->where('productos_colores.productoid',$id);

		$query = $this->db->get();

		$rowcount = $query->num_rows();

		//echo $this->db->last_query();

		return $rowcount;

	}

	private function _get_datatables_query()

	{



		$this->db->from($this->table);

		$this->db->join('productos_colores', 'productos_colores.id = stock.producto_colorid');

		$this->db->join('colores', 'colores.id = productos_colores.colorid');

		$this->db->join('productos', 'productos.id = productos_colores.productoid');

		$this->db->join('locales', 'locales.id = stock.localid');

		$this->db->join('modelos', 'modelos.id = productos.modeloid');

		$this->db->join('marcas', 'marcas.id = modelos.marcaid');

		$this->db->join('subcategorias', 'subcategorias.id = productos.subcategoriaid');
//		$this->db->join('categorias', 'categorias.id = productos.categoriaid');

		$this->db->select('stock.cantidad, stock.id as stock_id, colores.name as color, subcategorias.nombre as subcategoria, productos.*, modelos.nombre as modelo, marcas.nombre as marca');

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
	
	function get_por_producto($producto)

	{

		$this->db->from($this->table);

		$this->db->join('colores', 'colores.id = stock.color_productoid');

		$this->db->where('productoid', $producto);

		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();

	}

	function get_por_producto_para_venta($producto,$venta)

	{

		$this->db->from($this->table);

		$this->db->join('productos_colores', 'productos_colores.id = stock.producto_colorid');

		$this->db->join('colores', 'productos_colores.colorid = colores.id');

		$this->db->where('productos_colores.productoid', $producto);

		$this->db->select('stock.id as stockid, productos_colores.*, colores.nombre, stock.cantidad,');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result();

	}


	function get_by_producto_color_local($producto_colorid,$localid){
		$this->db->from($this->table);		

		$this->db->join('productos_colores', 'productos_colores.id = stock.producto_colorid');

		$this->db->join('colores', 'colores.id = productos_colores.colorid');

		$this->db->join('productos', 'productos.id = productos_colores.productoid');

		$this->db->join('locales', 'locales.id = stock.localid');

		$this->db->join('modelos', 'modelos.id = productos.modeloid');

		$this->db->join('marcas', 'marcas.id = modelos.marcaid');

		$this->db->join('subcategorias', 'subcategorias.id = productos.subcategoriaid');
//		$this->db->join('categorias', 'categorias.id = productos.categoriaid');

		$this->db->select('stock.cantidad, stock.reservado, stock.id as stock_id, stock.localid, stock.producto_colorid, colores.name as color, subcategorias.nombre as subcategoria, productos.*, modelos.nombre as modelo, marcas.nombre as marca,');


		$this->db->where('stock.producto_colorid',$producto_colorid;
		$this->db->where('stock.localid',$localid;

		$query = $this->db->get();



		return $query->row();
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

		$this->db->join('productos_colores', 'productos_colores.id = stock.producto_colorid');

		$this->db->join('colores', 'colores.id = productos_colores.colorid');

		$this->db->join('productos', 'productos.id = productos_colores.productoid');

		$this->db->join('locales', 'locales.id = stock.localid');

		$this->db->join('modelos', 'modelos.id = productos.modeloid');

		$this->db->join('marcas', 'marcas.id = modelos.marcaid');

		$this->db->join('subcategorias', 'subcategorias.id = productos.subcategoriaid');
//		$this->db->join('categorias', 'categorias.id = productos.categoriaid');

		$this->db->select('stock.cantidad, stock.reservado, stock.id as stock_id, stock.localid, stock.producto_colorid, colores.name as color, subcategorias.nombre as subcategoria, productos.*, modelos.nombre as modelo, marcas.nombre as marca,');


		$this->db->where('stock.id',$id);

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





}

