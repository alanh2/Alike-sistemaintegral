<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provincia extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('provincia_model','provincia');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='provincia_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->provincia->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $provincia) {
			$no++;
			$row = array();
			$row[] = $provincia->id;
			$row[] = $provincia->nombre;
			$row[] = $provincia->rubro;
			//add html for action
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_provincia('."'".$provincia->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_provincia('."'".$provincia->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->provincia->count_all(),
						"recordsFiltered" => $this->provincia->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		$list = $this->provincia->get_datatables();
		
		$data = array();
	
		foreach ($list as $provincia) {
	
			$row = array();
	//		print_r ($provincia);
			$row['id'] = $provincia->id;
			$row['nombre'] = $provincia->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"provincias" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	public function ajax_edit($id)
	{
		$data = $this->provincia->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'rubroid' => $this->input->post('rubro'),
				);
		$insert = $this->provincia->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'rubroid' => $this->input->post('rubro'),
			);
		$this->provincia->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->provincia->delete_by_id($id);
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

}
