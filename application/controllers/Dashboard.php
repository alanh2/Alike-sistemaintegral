<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();
		
		//$this->load->model('dashboard_model','dashboard');

	}



	public function index()

	{
		$this->isAdmin();

		$this->load->helper('url');

		$data['view']='dashboard_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}



}

