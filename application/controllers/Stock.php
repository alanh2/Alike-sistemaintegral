<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Stock extends CI_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->model('stock_model','stock');

	}



	public function index($id=NULL)

	{

		$this->load->helper('url');

		$data['id']=$id;

		$this->load->view('stock_view',$data);

	}



	public function ajax_list()

	{

		$list = $this->stock->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $stock) {

			$no++;

			$row = array();

			$row[] = $stock->marca;

			$row[] = $stock->categoria;

			$row[] = $stock->modelo;

			$row[] = $stock->stock;



			//add html for action

			//$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_stock('."'".$stock->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

			//	  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_stock('."'".$stock->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';

		

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->stock->count_all(),

						"recordsFiltered" => $this->stock->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	public function ajax_dropdown($producto=NULL, $venta=NULL)

	{	
		if($producto!=NULL){
			if($venta!=NULL){
				$list = $this->stock->get_por_producto_para_venta($producto,$venta);
			}else{
				$list = $this->stock->get_por_producto($producto);
			}
		}else{

			$list = $this->stock->get_datatables();
		}
		
		$data = array();


		foreach ($list as $stock) {
	
			$row = array();

			$row['id'] = $stock->stockid;

			$row['nombre'] = $stock->nombre;

			$row['l1'] = $stock->costo*$stock->porcentaje1;
			
			$row['l2'] = $stock->costo*$stock->porcentaje2;

			$row['l3'] = $stock->costo*$stock->porcentaje3;

			$row['l4'] = $stock->costo*$stock->porcentaje4;
			
			$row['cantidad'] = $stock->cantidad;

			$data[] = $row;

		}

	
		$output = array(

	
			"colores" => $data,

				);

	   echo json_encode($output);

	}




	public function ajax_edit($id)

	{

		$data = $this->stock->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		$this->_validate();

		$data = array(

				'marcaid' => $this->input->post('marca'),

				'categoriaid' => $this->input->post('categoria'),

				'modelo' => $this->input->post('modelo'),

				'stock' => $this->input->post('stock'),

			);

		$insert = $this->stock->save($data);

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_update()

	{

		$this->_validate();

		$data = array(

				'marcaid' => $this->input->post('marca'),

				'categoriaid' => $this->input->post('categoria'),

				'modelo' => $this->input->post('modelo'),

				'stock' => $this->input->post('stock'),

			);

		$this->stock->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));

	}

	public function ajax_delete($id)

	{

		$this->stock->delete_by_id($id);

		echo json_encode(array("status" => TRUE));

	}





	private function _validate()

	{

		$data = array();

		$data['error_string'] = array();

		$data['inputerror'] = array();

		$data['status'] = TRUE;



		if($this->input->post('marca') == '')

		{

			$data['inputerror'][] = 'marca';

			$data['error_string'][] = 'Debe seleccionar una marca';

			$data['status'] = FALSE;

		}



		if($this->input->post('categoria') == '')

		{

			$data['inputerror'][] = 'categoria';

			$data['error_string'][] = 'Debe seleccionar una categoria';

			$data['status'] = FALSE;

		}



		if($this->input->post('modelo') == '')

		{

			$data['inputerror'][] = 'modelo';

			$data['error_string'][] = 'Modelo es un campo requerido';

			$data['status'] = FALSE;

		}

		





		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}



}

