<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marca extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('marca_model','marca');
	}

	public function index()
	{
		$this->isAdmin();
		$this->load->helper('url');
		$data['view']='marca_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->marca->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $marca) {
			$no++;
			$row = array();
			$row[] = $marca->id;
			$row[] = $marca->nombre;
			//add html for action
			if($this->able_to_delete($marca->id)){

				$row[] = '
				      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_marca('."'".$marca->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_marca('."'".$marca->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			}else{
				$row[] = '
				      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_marca('."'".$marca->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
			}
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->marca->count_all(),
						"recordsFiltered" => $this->marca->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		$list = $this->marca->get_datatables();
		
		$data = array();
	
		foreach ($list as $marca) {
	
			$row = array();
			$row['id'] = $marca->id;
			$row['nombre'] = $marca->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"marcas" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	public function ajax_edit($id)
	{
		$data = $this->marca->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				);
		$insert = $this->marca->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
			);
		$this->marca->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->marca->delete_by_id($id);
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

		$this->load->model('modelo_model','modelo');
		return $this->modelo->cuantos_por($id)<1;

	}
}