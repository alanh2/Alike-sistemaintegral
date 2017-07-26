<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	var $table = 'clientes';
	var $column_order = array('id', 'razon_social', 'tel_codigo_area', 'tel_numero', 'cel_numero', 'direccion', 'localidad', 'cp', 'email', 'dni', null); //set column field database for datatable orderable
	var $column_search = array('clientes.razon_social', 'clientes.tel_codigo_area', 'clientes.tel_numero', 'clientes.cel_numero', 'clientes.direccion', 'localidades.nombre', 'clientes.cp', 'clientes.email', 'clientes.dni'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query($localid=null)
	{
		
		$this->db->from($this->table);
		$this->db->join('localidades', 'localidades.id = clientes.localidadid');
		$this->db->select('clientes.*, localidades.nombre as localidad');
		if($localid!=null){
			$this->db->where('localid',$localid);
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

	function get_datatables($localid=null)
	{
		$this->_get_datatables_query($localid);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function get_por_orden_alfabetico()
	{
		$this->db->from($this->table);
		$this->db->order_by('razon_social','asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_all()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_saldo($clienteid){
		$query= $this->db->query('SELECT SUM(monto) as monto FROM(
		SELECT "venta",id,total*(-1) as monto FROM `ventas` WHERE clienteid='.$clienteid.' 
		UNION SELECT "cobros",`cobros`.`id` as `id`, IF(metododepagoid=5,`cobros`.`monto`*(-1),`cobros`.`monto`) as monto FROM `cobros` JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid` 
		LEFT JOIN `aplicaciones_cobro_venta` ON `cobros`.`id` = `aplicaciones_cobro_venta`.`cobroid` WHERE `clienteid` = '.$clienteid.' AND (aplicaciones_cobro_venta.id IS NULL AND metododepagoid="5" OR metododepagoid!="5")
		UNION SELECT "nota_credito",id,monto FROM nota_credito WHERE clienteid='.$clienteid.'
		) as a');
		//echo $this->db->last_query();
		return $query->row();
		/*SELECT SUM(monto) FROM(
SELECT "venta",id,total*(-1) as monto FROM `ventas` WHERE clienteid=56 
UNION SELECT "cobros",`cobros`.`id` as `id`, IF(metododepagoid=5,`cobros`.`monto`*(-1),`cobros`.`monto`) as monto FROM `cobros` JOIN `metodos_pago` ON `metodos_pago`.`id` = `cobros`.`metododepagoid` 
LEFT JOIN `aplicaciones_cobro_venta` ON `cobros`.`id` = `aplicaciones_cobro_venta`.`cobroid` WHERE `clienteid` = '56' AND (aplicaciones_cobro_venta.id IS NULL AND metododepagoid="5" OR metododepagoid!="5")
UNION SELECT "nota_credito",id,monto FROM nota_credito WHERE clienteid=56
) as a*/

	}
	function get_por_categoria($categoria)
	{
		$this->db->from($this->table);
		$this->db->where('categoriaid', $categoria);
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
		$this->db->join('localidades', 'localidades.id = clientes.localidadid');
		$this->db->select('clientes.*, localidades.nombre as localidad,localidades.provinciaid');
		$this->db->where('clientes.id',$id);
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
