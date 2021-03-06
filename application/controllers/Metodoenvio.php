<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Metodoenvio extends MY_Controller {

	public function __construct()
	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('metodoenvio_model','metodoenvio');

	}

	public function index()
	{

		$this->load->helper('url');

		$data['view']='metodo_envio_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}

	public function ajax_dropdown()
	{
		$list = $this->metodoenvio->get_metodos();
		$data = array();

		foreach ($list as $metodo) {
			$row = array();
	//		print_r ($categoria);
			$row['id'] = $metodo->id;
			$row['nombre'] = $metodo->nombre;
			$data[] = $row;
		}
		$output = array(
			"metodos" => $data,
				);
		//output to json format
	   echo json_encode($output);
	}


}