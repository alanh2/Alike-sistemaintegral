<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Vendedor extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('vendedor_model','vendedor');

	}



	public function index()

	{

		$this->load->helper('url');

		$data['view']='vendedor_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}



	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->vendedor->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $vendedor) {

			$no++;

			$row = array();

			$row[] = $vendedor->id;

			$row[] = $vendedor->nombre;

			$row[] = $vendedor->apellido;

			$row[] = $vendedor->direccion;

			$row[] = $vendedor->usuario;

			$row[] = $vendedor->clave;

			$row[] = $vendedor->sueldo;

			$row[] = $vendedor->fecha_pago_sueldo;

			$row[] = $vendedor->comision;

			$row[] = $vendedor->email;

			$row[] = $vendedor->dni;

			//add html for action

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_vendedor('."'".$vendedor->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_vendedor('."'".$vendedor->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';

		

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->vendedor->count_all(),

						"recordsFiltered" => $this->vendedor->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	

	public function ajax_dropdown()

	{

		$list = $this->vendedor->get_datatables();


		$data = array();

	

		foreach ($list as $vendedor) {

	

			$row = array();

	//		print_r ($categoria);

			$row['id'] = $vendedor->id;

			$row['nombre'] = $vendedor->nombre;

			

			$data[] = $row;

		}

	

		$output = array(

	

			"vendedores" => $data,

				);

		//output to json format

	

	

	   echo json_encode($output);

	

	}

	

	public function ajax_edit($id)

	{

		$data = $this->vendedor->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'apellido' => $this->input->post('apellido'),

				'direccion' => $this->input->post('direccion'),

				'usuario' => $this->input->post('usuario'),

				'clave' => $this->input->post('clave'),

				'sueldo' => $this->input->post('sueldo'),

				'fecha_pago_sueldo' => $this->input->post('fecha_pago_sueldo'),

				'comision' => $this->input->post('comision'),

				'email' => $this->input->post('email'),

				'dni' => $this->input->post('dni'),

		);

		$insert = $this->vendedor->save($data);

		

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_update()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'apellido' => $this->input->post('apellido'),

				'direccion' => $this->input->post('direccion'),

				'usuario' => $this->input->post('usuario'),

				'clave' => $this->input->post('clave'),

				'sueldo' => $this->input->post('sueldo'),

				'fecha_pago_sueldo' => $this->input->post('fecha_pago_sueldo'),

				'comision' => $this->input->post('comision'),

				'email' => $this->input->post('email'),

				'dni' => $this->input->post('dni'),

			);

		$this->vendedor->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_delete($id)

	{

		$this->vendedor->delete_by_id($id);

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

			$data['error_string'][] = 'El nombresocial no puede estar vacia';

			$data['status'] = FALSE;

		}

		if($this->input->post('apellido') == '')

		{

			$data['inputerror'][] = 'apellido';

			$data['error_string'][] = 'El apellido no puede estar vacio';

			$data['status'] = FALSE;

		}

		

		if($this->input->post('usuario') == '')

		{

			$data['inputerror'][] = 'usuario';

			$data['error_string'][] = 'El usuario no puede estar vacia';

			$data['status'] = FALSE;

		}

		if($this->input->post('email') == '')

		{

			$data['inputerror'][] = 'email';

			$data['error_string'][] = 'El email no puede estar vacia';

			$data['status'] = FALSE;

		}



		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}



}

