<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Color extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('color_model','color');

	}



	public function index()

	{

		$this->load->helper('url');

		$data['view']='color_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}



	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->color->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $color) {

			$no++;

			$row = array();

			$row[] = $color->id;

			$row[] = $color->nombre;

			$row[] = $color->name;

			//add html for action

			if($this->able_to_delete($color->id)){

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_color('."'".$color->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_color('."'".$color->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';

			}else{

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_color('."'".$color->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';

			

			}

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->color->count_all(),

						"recordsFiltered" => $this->color->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	

	public function ajax_dropdown()

	{	
		if(isset($_POST['producto'])){

			$list = $this->color->get_por_producto($_POST['producto']);
		}else{

			$list = $this->color->get_datatables();
		}
		
		$data = array();


		foreach ($list as $color) {
	
			$row = array();

			$row['id'] = $color->id;

			$row['nombre'] = $color->nombre;

			$row['name'] = $color->name;

			if(isset($_POST['producto'])){
				$row['l1'] = $color->costo*$color->porcentaje1;
				
				$row['l2'] = $color->costo*$color->porcentaje2;

				$row['l3'] = $color->costo*$color->porcentaje3;

				$row['l4'] = $color->costo*$color->porcentaje4;
			}

			$data[] = $row;

		}

	
		$output = array(

	
			"colores" => $data,

				);

	   echo json_encode($output);

	}

	

	public function ajax_edit($id)

	{

		$data = $this->color->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'name' => $this->input->post('name'),

				);

		$insert = $this->color->save($data);

		

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_update()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'name' => $this->input->post('name'),

			);

		$this->color->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_delete($id)

	{

		$this->color->delete_by_id($id);

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

		if($this->input->post('name') == '')

		{

			$data['inputerror'][] = 'name';

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

		return $this->producto->cuantos_por('productos_colores','colorid',$id)<1;

	}



}

