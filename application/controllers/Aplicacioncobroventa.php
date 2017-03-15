<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Aplicacioncobroventa extends MY_Controller {



	public function __construct()
	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('aplicacioncobroventa_model','aplicacion');
		$this->load->model('venta_model','venta');
		$this->load->model('venta_renglones_model','venta_renglones');
		$this->load->model('cobro_model','cobro');
	}
	
	public function ajax_aplicacion_por_venta($id=NULL){
		if($id!=NULL){
			$data=$this->aplicacion->get_by_venta_id($id);
			echo json_encode($data);
		}
	}

	public function ajax_delete($id)

	{

		$this->aplicacion->delete_by_id($id);

		echo json_encode(array("status" => TRUE));

	}
}

