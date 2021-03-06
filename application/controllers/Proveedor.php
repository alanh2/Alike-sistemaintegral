<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('proveedor_model','proveedor');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='proveedor_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->proveedor->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $proveedor) {
			$no++;
			$row = array();
			$row[] = $proveedor->id;
			$row[] = $proveedor->nombre;
			$row[] = $proveedor->direccion;
			$row[] = $proveedor->telefono;
			$row[] = $proveedor->paisid;
			//add html for action
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_proveedor('."'".$proveedor->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_proveedor('."'".$proveedor->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->proveedor->count_all(),
						"recordsFiltered" => $this->proveedor->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_dropdown()
	{
		$list = $this->proveedor->get_datatables();
		
		$data = array();
	
		foreach ($list as $proveedor) {
	
			$row = array();
			$row['id'] = $proveedor->id;
			$row['nombre'] = $proveedor->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"proveedores" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}

	public function ajax_edit($id)
	{
		$data = $this->proveedor->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'direccion' => $this->input->post('direccion'),
				'telefono' => $this->input->post('telefono'),
				'paisid' => $this->input->post('pais'),
				);
		$insert = $this->proveedor->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nombre' => $this->input->post('nombre'),
				'direccion' => $this->input->post('direccion'),
				'telefono' => $this->input->post('telefono'),
				'paisid' => $this->input->post('pais'),
			);
		$this->proveedor->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->proveedor->delete_by_id($id);
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
