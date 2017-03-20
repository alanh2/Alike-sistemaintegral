<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('cobro_model','cobro');
		$this->load->model('transaccion_model','transaccion');

	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='cobro_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function edit_cobro()
	{
		$this->load->helper('url');
		$data['view']='cobro_edit_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_edit($id)
	{
		$cobro =$this->cobro->get_by_id($id);
		unset($cobro->fecha);
		$metodo = $this->transaccion->get_transaccion($cobro->metododepagoid, $cobro->metodoid);
		$data = array_merge((array) $cobro,(array) $metodo);
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->cobro->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cobro) {
			$no++;
			$row = array();
			$row[] = $cobro->id;
			$row[] = $cobro->monto;
			$row[] = $cobro->fecha;
			$row[] = $cobro->metodo_pago;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a> '
				  .'<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';;
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cobro->count_all(),
						"recordsFiltered" => $this->cobro->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function ajax_add()
	{
		$this->db->trans_begin(); 
        $datametodo = array(
        		"metodo" => $this->input->post('metodo'),
        		"vencimiento" => $this->input->post('vencimiento'),
        		"banco" => $this->input->post('banco'),
        		"numeracion" => $this->input->post('numeracion'),
        		"titular" => $this->input->post('titular'),
        		"digitos" => $this->input->post('digitos'),
        		"fecha" => $this->input->post('fecha'),
        		"codigomp" => $this->input->post('codigomp'),
        		"codigo_operacion" => $this->input->post('codigo_operacion'),
        		"operacion" => 1,
        	);

		$metodoid = $this->transaccion->add_transaccion($datametodo['metodo'],1,$datametodo);
        $datacobro = array(
        		"monto" => $this->input->post('monto'),
        		"metododepagoid" => $this->input->post('metodo'),
        		"clienteid" => $this->input->post('cliente'),
        		"fecha" => date('Y-m-d H:i:s'),
        		"metodoid" => $metodoid,
        	);
		$this->cobro->save($datacobro);
		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	    	$output['resultado'] = 'Error';
		}
		else
		{
	        $this->db->trans_commit();
	    	$output['resultado'] = 'Ok';
		}

		echo json_encode($output);
	}

	public function ajax_update()
	{
		$this->db->trans_begin(); 
        $datametodo = array(
        		"metodo_anterior" => $this->input->post('metodo_anterior'),
        		"metodo" => $this->input->post('metodo'),
        		"mov_tabla_id_anterior" => $this->input->post('mov_tabla_id_anterior'),
        		"vencimiento" => $this->input->post('vencimiento'),
        		"banco" => $this->input->post('banco'),
        		"numeracion" => $this->input->post('numeracion'),
        		"titular" => $this->input->post('titular'),
        		"digitos" => $this->input->post('digitos'),
        		"fecha" => $this->input->post('fecha'),
        		"codigomp" => $this->input->post('codigomp'),
        		"codigo_operacion" => $this->input->post('codigo_operacion'),
        		"operacion" => 1,
        	);

		$metodoid = $this->transaccion->actualizar($datametodo);

        $datacobro = array(
        		"monto" => $this->input->post('monto'),
        		"metododepagoid" => $this->input->post('metodo'),
        		"clienteid" => $this->input->post('cliente'),
        		"fecha" => date('Y-m-d H:i:s'),
        		"metodoid" => $metodoid,
        	);
		$this->cobro->update(array('id' => $this->input->post('id')),$datacobro);
		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	    	$output['resultado'] = 'Error';
		}
		else
		{
	        $this->db->trans_commit();
	    	$output['resultado'] = 'Ok';
		}
		echo json_encode($output);
	}
	
	public function ajax_delete($id)
	{
		$cobro = $this->cobro->get_by_id($id);
		$this->db->trans_begin();
		$this->cobro->delete_by_id($id);
		$this->transaccion->eliminar($cobro->metododepagoid, $cobro->metodoid);

		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	    	$output['resultado'] = 'Error';
		}
		else
		{
	        $this->db->trans_commit();
	    	$output['resultado'] = 'Ok';
		}
		echo json_encode($output);
	}
}

