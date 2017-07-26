<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sueldo_model extends CI_Model {



	var $table = 'sueldo_pagos';

	var $column_order = array('sueldo_pagos.id','sueldo_pagos.fecha','vendedores.nombre',null); //set column field database for datatable orderable

	var $column_search = array('sueldo_pagos.id','vendedores.nombre'); //set column field database for datatable searchable just firstname , lastname , address are searchable

	var $order = array('id' => 'desc'); // default order 



	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}


	private function _get_datatables_query()

	{

		

		$this->db->from($this->table);

		$this->db->join('vendedores', 'vendedores.id = sueldo_pagos.vendedorid');

		$this->db->select('sueldo_pagos.*, vendedores.nombre as vendedor');

		$this->db->where('vendedorid !=','1');
		$this->db->where('vendedorid !=','3');
		$this->db->where('vendedorid !=','9');


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

	public function get_cuentas_anual(){//Aca hay qeu cambiar ese month(fecha) por mes_pagado, e indicar el año antes de hacer el reporte, o ponerle un default por el año actual.
		$query= $this->db->query("SELECT vendedores.nombre as vendedor,sueldo
	  ,SUM(IF(month(fecha) = 1, monto,0)) as enero
	  ,SUM(IF(month(fecha) = 2, monto,0)) as febrero
	  ,SUM(IF(month(fecha) = 3, monto,0)) as marzo
	  ,SUM(IF(month(fecha) = 4, monto,0)) as abril
	  ,SUM(IF(month(fecha) = 5, monto,0)) as mayo
	  ,SUM(IF(month(fecha) = 6, monto,0)) as junio
	  ,SUM(IF(month(fecha) = 7, monto,0)) as julio
	  ,SUM(IF(month(fecha) = 8, monto,0)) as agosto
	  ,SUM(IF(month(fecha) = 9, monto,0)) as septiembre
	  ,SUM(IF(month(fecha) = 10, monto,0)) as octubre
	  ,SUM(IF(month(fecha) = 11, monto,0)) as noviembre
	  ,SUM(IF(month(fecha) = 12, monto,0)) as diciembre
	   FROM `sueldo_pagos`
	   INNER JOIN vendedores on sueldo_pagos.vendedorid=vendedores.id
	   WHERE vendedorid!=1 and vendedorid!=3 and vendedorid!=9
		GROUP BY vendedorid
		ORDER BY vendedores.nombre
	   ");
		//echo $this->db->last_query();
	
		return $query->result();

		
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





}

