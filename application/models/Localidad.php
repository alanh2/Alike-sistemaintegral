<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localidad extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('localidad_model','localidad');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='localidad_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->localidad->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $localidad) {
			$no++;
			$row = array();
			$row[] = $localidad->id;
			$row[] = $localidad->nombre;
			$row[] = $localidad->rubro;
			//add html for action
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_localidad('."'".$localidad->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_localidad('."'".$localidad->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->localidad->count_all(),
						"recordsFiltered" => $this->localidad->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		if(isset($_POST['categoria'])){

			$list = $this->localidad->get_por_provincia($_POST['provincia']);

		}
		//$list = $this->localidad->get_datatables();
		
		$data = array();
	
		foreach ($list as $localidad) {
	
			$row = array();
	//		print_r ($localidad);
			$row['id'] = $localidad->id;
			$row['nombre'] = $localidad->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"localidades" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	public function ajax_edit($id)
	{
		$data = $this->localidad->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'rubroid' => $this->input->post('rubro'),
				);
		$insert = $this->localidad->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'rubroid' => $this->input->post('rubro'),
			);
		$this->localidad->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->localidad->delete_by_id($id);
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
