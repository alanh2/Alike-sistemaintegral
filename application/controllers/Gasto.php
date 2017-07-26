<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Gasto extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('gasto_model','gasto');

	}



	public function index($search=null)

	{

		$this->isAdmin();
		if (($_SESSION['admin']['vendedorid']==5)||($_SESSION['admin']['vendedorid']==9)||($_SESSION['admin']['vendedorid']==16)){
			$this->load->helper('url');

			$data['view']='gasto_view';

			$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

			$data['search']=$search;

			$this->load->view('master_view',$data);
		}else{
			echo "<H1>ACCESO DENEGADO</H1>";
		}
	}



	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->gasto->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $gasto) {

			$no++;

			$row = array();

			$row[] = $gasto->id;

			$row[] = $gasto->tipogasto;

			$row[] = $gasto->nombre;
	
			$row[] = $gasto->monto;
	
			$row[] = $gasto->fecha;

			$row[] = $gasto->vendedor;

			//add html for action
			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_gasto('."'".$gasto->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_gasto('."'".$gasto->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->gasto->count_all(),

						"recordsFiltered" => $this->gasto->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	public function ajax_dropdown()

	{

		/*if(isset($_POST['marca'])){

			$list = $this->gasto->get_por_marca($_POST['marca']);

		}*///else{

		//	$list = $this->gasto->get_datatables();

		//}

		$data = array();

	

		foreach ($list as $gasto) {

	

			$row = array();

	//		print_r ($categoria);

			$row['id'] = $gasto->id;

			$row['nombre'] = $gasto->nombre;

			

			$data[] = $row;

		}

	

		$output = array(

	

			"gastos" => $data,

				);

		//output to json format

	

	

	   echo json_encode($output);

	

	}

	public function ajax_edit($id)

	{

		$data = $this->gasto->get_by_id($id);

		echo json_encode($data);

	}
	
	public function get_by_id($id)

	{

		$data = $this->gasto->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),

				'tipos_gastoid' => $this->input->post('tipogasto'),

				'monto' => $this->input->post('monto'),

				'fecha' => date("Y-m-d H:i:s"),

				'vendedorid' => $this->input->post('vendedorid'),

				'localid' => $this->input->post('localid'),

				);

		$insert = $this->gasto->save($data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_update()

	{

		$this->_validate();

		$data = array(

				'nombre' => $this->input->post('nombre'),
				
				'tipos_gastoid' => $this->input->post('tipogasto'),

				'monto' => $this->input->post('monto'),
			);

		$this->gasto->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_delete($id)

	{

		$this->gasto->delete_by_id($id);

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
	/*private function able_to_delete($id){

		$this->load->model('producto_model','producto');

		return $this->producto->cuantos_por('productos','gastoid',$id)<1;

	}*/


}

