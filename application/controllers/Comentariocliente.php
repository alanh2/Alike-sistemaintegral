<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comentariocliente extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('comentariocliente_model','comentariocliente');
	}

	public function ajax_list($clienteid)
	{
		$this->load->helper('url');
		$list = $this->comentariocliente->get_by_cliente($clienteid);
		$data = array();
		if ($list != null){
			foreach ($list as $comcli) {
				$row = array();
				$row[] = $comcli->id;
				$row[] = $comcli->comentario;
				$row[] = $comcli->puntaje;
				$data[] = $row;
			}
		}
		echo json_encode($data);
	}	
	
	public function ajax_edit($id)
	{
		$data = $this->comentariocliente->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'comentario' => $this->input->post('comentario'),
				'puntaje' => $this->input->post('puntaje'),
				'clienteid' => $this->input->post('clienteidmensaje'),
		);
		$insert = $this->comentariocliente->save($data);
		
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
		$this->comentariocliente->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->comentariocliente->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_promedio($id)
	{
		echo json_encode($this->comentariocliente->get_promedio_by_cliente($id));
		//echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('comentario') == '')
		{
			$data['inputerror'][] = 'comentario';
			$data['error_string'][] = 'El comentario no puede estar vacio';
			$data['status'] = FALSE;
		}
		if($this->input->post('puntaje') == '')
		{
			$data['inputerror'][] = 'puntaje';
			$data['error_string'][] = 'El puntaje no puede estar vacio';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}