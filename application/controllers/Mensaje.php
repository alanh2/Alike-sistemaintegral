<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensaje extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('mensaje_model','mensaje');
	}

	public function ajax_list($clienteid)
	{
		$this->load->helper('url');
		$list = $this->mensaje->get_by_cliente($clienteid);
		$data = array();
		if ($list != null){
			foreach ($list as $mensajecliente) {
				$row = array();
				$row[] = $mensajecliente->id;
				$row[] = $mensajecliente->comentario;
				$row[] = $mensajecliente->puntaje;
				$data[] = $row;
			}
		}
		echo json_encode($data);
	}	
	
	public function ajax_edit($id)
	{
		$data = $this->mensaje->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		//$this->_validate();
		$data = array(
				'comentario' => $this->input->post('comentario'),
				'puntaje' => $this->input->post('puntaje'),
				'clienteid' => $this->input->post('clienteidmensaje'),
		);
		$insert = $this->mensaje->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'comentario' => $this->input->post('comentario'),
				'puntaje' => $this->input->post('puntaje'),
				'clienteid' => $clienteid,
			);
		$this->mensaje->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->mensaje->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}

