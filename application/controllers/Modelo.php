<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Modelo extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('modelo_model','modelo');

	}



	public function index($search=null)

	{
		$this->isAdmin();

		$this->load->helper('url');

		$data['view']='modelo_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$data['search']=$search;

		$this->load->view('master_view',$data);

	}



	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->modelo->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $modelo) {

			$no++;

			$row = array();

			$row[] = $modelo->id;

			$row[] = $modelo->marca;

			$row[] = $modelo->nombre;

			$row[] = $modelo->nombre_comercial;

			//
			//add html for action
			if($this->able_to_delete($modelo->id)){

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_modelo('."'".$modelo->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_modelo('."'".$modelo->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			}else{
				$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_modelo('."'".$modelo->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
			}
		

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->modelo->count_all(),

						"recordsFiltered" => $this->modelo->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	public function ajax_dropdown()

	{

		if(isset($_POST['marca'])){

			$list = $this->modelo->get_por_marca($_POST['marca']);

		}//else{

		//	$list = $this->modelo->get_datatables();

		//}

		$data = array();

	

		foreach ($list as $modelo) {

	

			$row = array();

	//		print_r ($categoria);

			$row['id'] = $modelo->id;

			$row['nombre'] = $modelo->nombre;

			

			$data[] = $row;

		}

	

		$output = array(

	

			"modelos" => $data,

				);

		//output to json format

	

	

	   echo json_encode($output);

	

	}

	public function ajax_edit($id)

	{

		$data = $this->modelo->get_by_id($id);

		echo json_encode($data);

	}
	
	public function get_by_id($id)

	{

		$data = $this->modelo->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'nombre_comercial ' => $this->input->post('nombre_comercial'),

				'marcaid' => $this->input->post('marca'),

				);

		$insert = $this->modelo->save($data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_update()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'nombre_comercial ' => $this->input->post('nombre_comercial'),

				'marcaid' => $this->input->post('marca'),

			);

		$this->modelo->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_delete($id)

	{

		$this->modelo->delete_by_id($id);

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
		
		if($this->input->post('nombre_comercial') == '')

		{

			$data['inputerror'][] = 'nombre_comercial';

			$data['error_string'][] = 'El nombre comercial no puede estar vacio';

			$data['status'] = FALSE;

		}



		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}
	private function able_to_delete($id){

		$this->load->model('producto_model','producto');

		return $this->producto->cuantos_por('productos','modeloid',$id)<1;

	}


}

