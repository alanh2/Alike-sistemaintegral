<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaccion extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('transaccion_model','transaccion');
	}

	public function index()//terminar
	{
		$this->load->helper('url');
		$data['view']='transaccion_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->transaccion->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $transaccion) {
			$no++;
			$row = array();
			$row[] = $transaccion->id;
			$row[] = $transaccion->monto;
			$row[] = $transaccion->fecha;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->transaccion->count_all(),
						"recordsFiltered" => $this->transaccion->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_add_efectivo()
	{
		//$this->_validate();
		$data = array(
				'monto' => $this->input->post('monto'),
				'fecha' => $this->input->post('fecha'),
				'tipo_transaccion' => $this->input->post('tipo_transaccion'),//entrada/salida
		);
		$insert = $this->transaccion->add_transaccion('1', $data);// 1 = efectivo
		echo json_encode(array("status" => TRUE, "efectivoid" => $insert));
	}

	public function ajax_add_cheque()
	{
		//$this->_validate();
		$data = array(
				'monto' => $this->input->post('monto'),
				'fecha' => $this->input->post('fecha'),
				'tipo_transaccion' => $this->input->post('tipo_transaccion'),//entrada/salida
		);
		$insert = $this->transaccion->add_transaccion('2', $data);// 1 = efectivo
		echo json_encode(array("status" => TRUE, "chequeid" => $insert));
	}

	public function ajax_delete($metodo_pago, $id)
	{
		$this->transaccion->delete_by_id($metodo_pago, $id);
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
