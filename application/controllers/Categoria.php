<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('categoria_model','categoria');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='categoria_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->categoria->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $categoria) {
			$no++;
			$row = array();
			$row[] = $categoria->id;
			$row[] = $categoria->nombre;
			$row[] = $categoria->rubro;
			//add html for action
			if($this->able_to_delete($categoria->id)){
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_categoria('."'".$categoria->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_categoria('."'".$categoria->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			}else{
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_categoria('."'".$categoria->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
			
			}
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->categoria->count_all(),
						"recordsFiltered" => $this->categoria->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		$list = $this->categoria->get_datatables();
		
		$data = array();
	
		foreach ($list as $categoria) {
	
			$row = array();
	//		print_r ($categoria);
			$row['id'] = $categoria->id;
			$row['nombre'] = $categoria->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"categorias" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	public function ajax_edit($id)
	{
		$data = $this->categoria->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'rubroid' => $this->input->post('rubro'),
				);
		$insert = $this->categoria->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'rubroid' => $this->input->post('rubro'),
			);
		$this->categoria->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//$this->load->model('subcategoria_model','subcategoria');
		//$this->subcategoria->get_count($id);
		$this->categoria->delete_by_id($id);
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
		$this->load->model('subcategoria_model','subcategoria');
		return $this->subcategoria->cuantos_por($id)<1;
	}

}
