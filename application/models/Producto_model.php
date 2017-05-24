<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Producto_model extends CI_Model {



	var $table = 'productos';

	var $column_order = array('id','marca','modelo','nombre','categoria','subcategoria',null); //set column field database for datatable orderable

	var $column_search = array('marcas.nombre','subcategorias.nombre','categorias.nombre','modelos.nombre','proveedores.nombre','productos.nombre'); //set column field database for datatable searchable just firstname , lastname , address are searchable

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

	public function get_lista_precios(){
		//mientras va la query de una
		$query=$this->db->query("SELECT stock.id,marcas.nombre as marca, modelos.nombre as modelo, subcategorias.nombre as subcategoria, productos.nombre as producto, colores.nombre as color, stock.cantidad,
ROUND(productos_colores.costo + productos_colores.costo*productos_colores.porcentaje1/'100') as 'l1',
ROUND(productos_colores.costo + productos_colores.costo*productos_colores.porcentaje2/'100') as 'l2',
ROUND(productos_colores.costo + productos_colores.costo*productos_colores.porcentaje3/'100') as 'l3',
ROUND(productos_colores.costo + productos_colores.costo*productos_colores.porcentaje4/'100') as 'l4'
FROM `stock` 
INNER JOIN productos_colores on stock.producto_colorid = productos_colores.id 
INNER JOIN productos on productos_colores.productoid= productos.id 
INNER JOIN subcategorias on productos.subcategoriaid= subcategorias.id 
INNER JOIN modelos on productos.modeloid= modelos.id 
INNER JOIN marcas on marcas.id=modelos.marcaid 
INNER JOIN colores on productos_colores.colorid= colores.id 
INNER JOIN locales on stock.localid= locales.id
ORDER BY marcas.nombre,modelos.nombre
");
		return $query->result();
	}	



	private function _get_datatables_query()

	{



		$this->db->from($this->table);

		$this->db->join('subcategorias', 'subcategorias.id = productos.subcategoriaid');

		$this->db->join('categorias', 'categorias.id = subcategorias.categoriaid');

		$this->db->join('proveedores', 'proveedores.id = productos.proveedorid');

		$this->db->join('modelos', 'modelos.id = productos.modeloid');

		$this->db->join('marcas', 'marcas.id = modelos.marcaid');

		$this->db->select('productos.*, marcas.nombre as marca, subcategorias.nombre as subcategoria, categorias.nombre as categoria, proveedores.nombre as proveedor, modelos.nombre as modelo, modelos.marcaid');

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

		return $this->db->count_all_results();

	}



	public function get_by_id($id)

	{

		$this->db->from($this->table);

		$this->db->where('id',$id);

		$query = $this->db->get();

		return $query->row();

	}
	
	public function get_producto_colores_para_producto($id)

	{

		$this->db->from($this->table."_colores");

		$this->db->join('colores', 'colores.id = productos_colores.colorid');
		$this->db->join('stock', 'productos_colores.id = stock.producto_colorid');

		$this->db->where('productoid',$id);
		
		$this->db->select('productos_colores.*, colores.nombre as nombre, colores.name as name, stock.cantidad,count(stock.id) as tieneStock');
	 	$this->db->group_by('productos_colores.id'); 
		$query = $this->db->get();
		//echo $this->db->last_query();

		return $query->result();

	}



	public function save($data)

	{

		$this->db->insert($this->table, $data);

		return $this->db->insert_id();

	}

	public function save_color($data,$stock=0)

	{

		$table=$this->table."_colores";
		$where= array('productoid'=>$data["productoid"],'colorid'=>$data["colorid"]);
		$query = $this->db->get_where($table,$where);

		if($this->db->affected_rows()==1){
			$this->db->update($table, $data, $where);
			$result = $query->result_array();
			$producto_colorid= $result[0]['id'];
		}
		else{
			$this->db->insert($table, $data);
		$producto_colorid=$this->db->insert_id();
		}

		$table="stock";
		$where= array('producto_colorid'=>$producto_colorid);
		$query = $this->db->get_where($table,$where);
		$data=array('cantidad'=>$stock,'localid'=>1,'producto_colorid'=>$producto_colorid);
		if($this->db->affected_rows()==1){
			$this->db->update($table, $data, $where);
		}
		else{
			$this->db->insert($table, $data);
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

	private function able_to_delete($id){

		$this->load->model('modelo_model','modelo');

		return $this->modelo->cuantos_por($id)<1;

	}


}

