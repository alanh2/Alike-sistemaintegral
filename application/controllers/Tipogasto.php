<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipogasto extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('tipogasto_model','tipogasto');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='tipogasto_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->tipogasto->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $tipogasto) {
			$no++;
			$row = array();
			$row[] = $tipogasto->id;
			$row[] = $tipogasto->nombre;
			//add html for action
			if($this->able_to_delete($tipogasto->id)){

				$row[] = '
				      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_tipogasto('."'".$tipogasto->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_tipogasto('."'".$tipogasto->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			}else{
				$row[] = '
				      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_tipogasto('."'".$tipogasto->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
			}
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->tipogasto->count_all(),
						"recordsFiltered" => $this->tipogasto->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		$list = $this->tipogasto->get_datatables();
		
		$data = array();
	
		foreach ($list as $tipogasto) {
	
			$row = array();
			$row['id'] = $tipogasto->id;
			$row['nombre'] = $tipogasto->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"tiposgastos" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	public function ajax_edit($id)
	{
		$data = $this->tipogasto->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				);
		$insert = $this->tipogasto->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
			);
		$this->tipogasto->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->tipogasto->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nombre') == '')
		{
			$data['inputerror'][] = 'nombre';
			$data['error_string'][] = 'El nombre no puede estar vacio';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function able_to_delete($id){

		$this->load->model('gasto_model','gasto');
		return $this->gasto->cuantos_por($id)<1;

	}
}