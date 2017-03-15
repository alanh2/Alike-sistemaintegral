<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moto extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('moto_model','moto');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='moto_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->moto->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $moto) {
			$no++;
			$row = array();
			$row[] = $moto->id;
			$row[] = $moto->nombre;
			$row[] = $moto->telefono;
			//add html for action
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_moto('."'".$moto->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Borrar" onclick="delete_moto('."'".$moto->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->moto->count_all(),
						"recordsFiltered" => $this->moto->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		$list = $this->moto->get_motos();
		
		$data = array();
	
		foreach ($list as $moto) {
	
			$row = array();
			$row['id'] = $moto->id;
			$row['nombre'] = $moto->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"motos" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	public function ajax_edit($id)
	{
		$data = $this->moto->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'telefono' => $this->input->post('telefono'),
				);
		$insert = $this->moto->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'telefono' => $this->input->post('telefono'),
			);
		$this->moto->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->moto->delete_by_id($id);
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
		if($this->input->post('telefono') == '')
		{
			$data['inputerror'][] = 'telefono';
			$data['error_string'][] = 'El teléfono no puede estar vacio';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}