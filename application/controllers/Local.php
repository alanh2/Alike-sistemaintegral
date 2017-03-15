<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Local extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('local_model','local');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='local_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->local->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $local) {
			$no++;
			$row = array();
			$row[] = $local->id;
			$row[] = $local->nombre;
			$row[] = $local->direccion;
			$row[] = $local->telefono;
			//add html for action
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_local('."'".$local->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_local('."'".$local->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->local->count_all(),
						"recordsFiltered" => $this->local->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		$list = $this->local->get_datatables();
		
		$data = array();
	
		foreach ($list as $local) {
	
			$row = array();
			$row['id'] = $local->id;
			$row['nombre'] = $local->nombre;
			$row['direccion'] = $local->direccion;
			$row['telefono'] = $local->telefono;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"locales" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	public function ajax_edit($id)
	{
		$data = $this->local->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'direccion' => $this->input->post('direccion'),
				'telefono' => $this->input->post('telefono'),
				);
		$insert = $this->local->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'direccion' => $this->input->post('direccion'),
				'telefono' => $this->input->post('telefono'),
			);
		$this->local->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->local->delete_by_id($id);
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
		if($this->input->post('direccion') == '')
		{
			$data['inputerror'][] = 'direccion';
			$data['error_string'][] = 'La dirección no puede estar vacia';
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