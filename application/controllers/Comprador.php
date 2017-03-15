<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comprador extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('comprador_model','cliente');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='comprador_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->cliente->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cliente) {
			$no++;
			$row = array();
			$row[] = $cliente->id;
			$row[] = $cliente->razon_social;
			$row[] = $cliente->tel_codigo_area;
			$row[] = $cliente->tel_numero;
			$row[] = $cliente->cel_numero;
			$row[] = $cliente->direccion;
			$row[] = $cliente->localidad;
			$row[] = $cliente->cp;
			$row[] = $cliente->email;
			$row[] = $cliente->dni;
			$row[] = $cliente->cuil;
			$row[] = $cliente->cuit;
			//add html for action
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_cliente('."'".$cliente->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_cliente('."'".$cliente->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>
				  <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Mensajes" onclick="add_mensaje('."'".$cliente->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cliente->count_all(),
						"recordsFiltered" => $this->cliente->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function ajax_dropdown()
	{
		if(isset($_POST['categoria'])){
			$list = $this->cliente->get_por_categoria($_POST['categoria']);
		}//else{
		//	$list = $this->modelo->get_datatables();
		//}
		$data = array();
	
		foreach ($list as $cliente) {
	
			$row = array();
	//		print_r ($categoria);
			$row['id'] = $cliente->id;
			$row['nombre'] = $cliente->nombre;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"clientes" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	
	public function ajax_edit($id)
	{
		$data = $this->cliente->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'razon_social' => $this->input->post('razon_social'),
				'tel_codigo_area' => $this->input->post('tel_codigo_area'),
				'tel_numero' => $this->input->post('tel_numero'),
				'cel_numero' => $this->input->post('cel_numero'),
				'direccion' => $this->input->post('direccion'),
				'localidad' => $this->input->post('localidad'),
				'cp' => $this->input->post('cp'),
				'email' => $this->input->post('email'),
				'dni' => $this->input->post('dni'),
				'cuil' => $this->input->post('cuil'),
				'cuit' => $this->input->post('cuit'),
		);
		$insert = $this->cliente->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_addMensaje()
	{
		$this->_validate();
		$data = array(
				'comentario' => $this->input->post('comentario'),
				'puntaje' => $this->input->post('puntaje'),
		);
		$insert = $this->mensaje->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'razon_social' => $this->input->post('razon_social'),
				'tel_codigo_area' => $this->input->post('tel_codigo_area'),
				'tel_numero' => $this->input->post('tel_numero'),
				'cel_numero' => $this->input->post('cel_numero'),
				'direccion' => $this->input->post('direccion'),
				'localidad' => $this->input->post('localidad'),
				'cp' => $this->input->post('cp'),
				'email' => $this->input->post('email'),
				'dni' => $this->input->post('dni'),
				'cuil' => $this->input->post('cuil'),
				'cuit' => $this->input->post('cuit'),
			);
		$this->cliente->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->cliente->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('razon_social') == '')
		{
			$data['inputerror'][] = 'razon_social';
			$data['error_string'][] = 'La razon social no puede estar vacia';
			$data['status'] = FALSE;
		}
		if($this->input->post('tel_numero') == '')
		{
			$data['inputerror'][] = 'telefono';
			$data['error_string'][] = 'El telefono no puede estar vacio';
			$data['status'] = FALSE;
		}
		if($this->input->post('direccion') == '')
		{
			$data['inputerror'][] = 'direccion';
			$data['error_string'][] = 'La direccion no puede estar vacia';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
