<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Devolucion_model extends CI_Model {



	var $table = 'devoluciones';

	var $column_order = array('devoluciones.id','cliente','devoluciones.fecha',null); //set column field database for datatable orderable

	var $column_search = array('clientes.razon_social','devoluciones.fecha','devoluciones.id'); //set column field database for datatable searchable just firstname , lastname , address are searchable

	var $order = array('id' => 'desc'); // default order 

	var $joins=array();

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}

	function actualizar_total($devolucionid){
		$total=$this->get_total($devolucionid);
		//echo $this->db->last_query();
		//echo $this->db->affected_rows();
		if($this->db->affected_rows()>0){
			$data = array(
					'total' => $total->total,
				);
			$where=array('id' => $devolucionid);
			$this->db->update($this->table, $data, $where);
		}
		return $this->db->affected_rows();
	}

	private function _get_datatables_query()

	{



		$this->db->from($this->table);

		$this->db->join('ventas', 'ventas.id = devoluciones.ventaid');

		$this->db->join('clientes', 'clientes.id = ventas.clienteid');

		$this->db->join('vendedores', 'vendedores.id = ventas.vendedorid');
		
		$this->db->join('devoluciones_renglones', 'devoluciones_renglones.devolucionid = devoluciones.id','left');

		$this->db->select('devoluciones.*, clientes.razon_social as cliente, vendedores.nombre as vendedor');
		
		$this->db->group_by('devoluciones.id'); 
		
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
	public function get_total($id){
		/*$this->db->from($this->table."_renglones");
		$this->db->select('SUM(total_renglon) as total');// COALESCE(sum(num), 0) AS val
		$this->db->group_by('ventaid'); 
		$this->db->where('ventaid',$id);

		$query = $this->db->get();*/
		$query= $this->db->query("SELECT SUM(total) as total FROM( (SELECT IFNULL(SUM(precio_unitario),0) as total FROM `devoluciones_renglones`
			INNER JOIN `ventas_renglones` ON `devoluciones_renglones`.`venta_renglonid`= `ventas_renglones`.`id`
		 WHERE `devolucionid` = '".$id."' GROUP BY `devolucionid`) UNION (SELECT 0 total)) as tabla");
		//echo $this->db->last_query();
		return $query->row();
	}
	
	/*public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->join('clientes', 'clientes.id = ventas.clienteid');
		$this->db->join('vendedores', 'vendedores.id = ventas.vendedorid');
		$this->db->join('localidades', 'localidades.id = clientes.localidadid');
		$this->db->join('ventas_estados', 'ventas_estados.id = ventas.estado');
		$this->db->join('ventas_renglones', 'ventas_renglones.ventaid = ventas.id','left');
		$this->db->select('ventas.*, 
			vendedores.nombre as vendedor,
			ventas_estados.nombre as estado_nombre,
			clientes.razon_social as cliente, clientes.tel_codigo_area, clientes.tel_numero, clientes.cel_numero, clientes.direccion, clientes.cp,
			clientes.email, clientes.dni, clientes.cuitcuil, clientes.web, clientes.ranking,IFNULL(SUM(  `total_renglon` ),0) AS total, localidades.nombre as localidad');
		$this->db->where('ventas.id',$id);
		$this->db->group_by('ventas.id'); 
		$query = $this->db->get();
		return $query->row();
	}
*/
	
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

