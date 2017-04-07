<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Subcategoria extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('subcategoria_model','subcategoria');

	}



	public function index()

	{

		$this->load->helper('url');

		$data['view']='subcategoria_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}



	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->subcategoria->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $subcategoria) {

			$no++;

			$row = array();

			$row[] = $subcategoria->id;

			$row[] = $subcategoria->nombre;

			$row[] = $subcategoria->categoria;

			//add html for action
			if($this->able_to_delete($subcategoria->id)){

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_subcategoria('."'".$subcategoria->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_subcategoria('."'".$subcategoria->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			}else{
				$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_subcategoria('."'".$subcategoria->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
			}
		

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->subcategoria->count_all(),

						"recordsFiltered" => $this->subcategoria->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	

	public function ajax_dropdown()

	{

		if(isset($_POST['categoria'])){

			$list = $this->subcategoria->get_por_categoria($_POST['categoria']);

		}//else{

		//	$list = $this->modelo->get_datatables();

		//}

		$data = array();

	

		foreach ($list as $subcategoria) {

	

			$row = array();

	//		print_r ($categoria);

			$row['id'] = $subcategoria->id;

			$row['nombre'] = $subcategoria->nombre;

			

			$data[] = $row;

		}

	

		$output = array(

	

			"subcategorias" => $data,

				);

		//output to json format

	

	

	   echo json_encode($output);

	

	}

	

	public function ajax_edit($id)

	{

		$data = $this->subcategoria->get_by_id($id);

		echo json_encode($data);

	}
	
	public function get_by_id($id)

	{

		$data = $this->subcategoria->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'categoriaid' => $this->input->post('categoria'),

				);

		$insert = $this->subcategoria->save($data);

		

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_update()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'categoriaid' => $this->input->post('categoria'),

			);

		$this->subcategoria->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_delete($id)

	{

		$this->subcategoria->delete_by_id($id);

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

		$this->load->model('producto_model','producto');

		return $this->producto->cuantos_por('productos','subcategoriaid',$id)<1;

	}


}

