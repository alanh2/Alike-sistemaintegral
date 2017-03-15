<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rubro extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('rubro_model','rubro');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='rubro_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->rubro->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rubro) {
			$no++;
			$row = array();
			$row[] = $rubro->id;
			$row[] = $rubro->nombre;
			//add html for action
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_rubro('."'".$rubro->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>'
				  /*.'<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_rubro('."'".$rubro->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';*/;
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->rubro->count_all(),
						"recordsFiltered" => $this->rubro->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		$list = $this->rubro->get_datatables();
		
		$data = array();
	
		foreach ($list as $rubro) {
	
			$row = array();
	//		print_r ($rubro);
			$row['id'] = $rubro->id;
			$row['nombre'] = $rubro->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"rubros" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	public function ajax_edit($id)
	{
		$data = $this->rubro->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				);
		$insert = $this->rubro->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
			);
		$this->rubro->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->load->model('categoria_model','categoria');
		$this->subcategoria->get_count($id);
		//$this->categoria->delete_by_id($id);
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
