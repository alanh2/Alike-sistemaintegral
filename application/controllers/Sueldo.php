<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sueldo extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('sueldo_model','sueldo');

	}



	public function index()

	{
		$this->isAdmin();

		$this->load->helper('url');

		$data['view']='sueldo_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}

	public function estados()

	{
		$this->isAdmin();

		$this->load->helper('url');

		$data['view']='sueldo_estados_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}

	public function ajax_cuentas_anual($year=null){
		
		$this->load->helper('url');

		$list = $this->sueldo->get_cuentas_anual($year);

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $cuenta) {

			$no++;

			$row = array();

			$row[] = $cuenta->vendedor." ( ".$cuenta->sueldo." ) ";

			$row[] = $cuenta->enero;

			$row[] = $cuenta->febrero;

			$row[] = $cuenta->marzo;

			$row[] = $cuenta->abril;

			$row[] = $cuenta->mayo;

			$row[] = $cuenta->junio;

			$row[] = $cuenta->julio;

			$row[] = $cuenta->agosto;

			$row[] = $cuenta->septiembre;

			$row[] = $cuenta->octubre;

			$row[] = $cuenta->noviembre;
		
			$row[] = $cuenta->diciembre;

			//add html for action
/*
			if($this->able_to_delete($sueldo->id)){

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pago_sueldo('."'".$sueldo->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_pago_sueldo('."'".$sueldo->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';

			}else{

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_sueldo('."'".$sueldo->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';

			

			}
*/
			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->sueldo->count_all(),

						"recordsFiltered" => $this->sueldo->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);


	}

	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->sueldo->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $sueldo) {

			$no++;

			$row = array();

			$row[] = $sueldo->id;

			$row[] = $sueldo->vendedor;

			$row[] = $sueldo->monto;

			$row[] = $sueldo->fecha;

			//add html for action

			if($this->able_to_delete($sueldo->id)){

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pago_sueldo('."'".$sueldo->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_pago_sueldo('."'".$sueldo->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';

			}else{

			$row[] = '

			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_sueldo('."'".$sueldo->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';

			

			}

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->sueldo->count_all(),

						"recordsFiltered" => $this->sueldo->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	public function ajax_dropdown()

	{

		$list = $this->sueldo->get_datatables();

		

		$data = array();

	

		foreach ($list as $sueldo) {

	

			$row = array();

	//		print_r ($sueldo);

			$row['id'] = $sueldo->id;

			$row['vendedor'] = $sueldo->vendedor;

			$row['monto'] = $sueldo->monto;

			

			$data[] = $row;

		}

	

		$output = array(

	

			"sueldos" => $data,

				);

		//output to json format

	

	

	   echo json_encode($output);

	

	}

	public function ajax_edit($id)

	{

		$data = $this->sueldo->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		$this->_validate();

		$data = array(

				'monto' => $this->input->post('monto'),

				'vendedorid' => $this->input->post('vendedor'),

				'fecha' => $this->input->post('fecha'),

				);

		$insert = $this->sueldo->save($data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_update()

	{

		$this->_validate();

		$data = array(

				'monto' => $this->input->post('monto'),

				'vendedorid' => $this->input->post('vendedor'),

				'fecha' => $this->input->post('fecha'),

			);

		$this->sueldo->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_delete($id)

	{

		//$this->load->model('subcategoria_model','subcategoria');

		//$this->subcategoria->get_count($id);

		$this->sueldo->delete_by_id($id);

		echo json_encode(array("status" => TRUE));

	}





	private function _validate()

	{

		$data = array();

		$data['error_string'] = array();

		$data['inputerror'] = array();

		$data['status'] = TRUE;



		
		if($this->input->post('monto') == '')

		{

			$data['inputerror'][] = 'monto';

			$data['error_string'][] = 'El monto no puede estar vacio';

			$data['status'] = FALSE;

		}

		if($this->input->post('fecha') == '')

		{

			$data['inputerror'][] = 'fecha';

			$data['error_string'][] = 'La fecha no puede estar vacio';

			$data['status'] = FALSE;

		}



		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}

	private function able_to_delete($id){

		//$this->load->model('subcategoria_model','subcategoria');

		//return $this->subcategoria->cuantos_por($id)<1;
		return true;
	}



}

