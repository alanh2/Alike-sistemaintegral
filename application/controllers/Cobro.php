<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('cobro_model','cobro');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='cobro_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function edit_cobro()
	{
		$this->load->helper('url');
		$data['view']='cobro_edit_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->cobro->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cobro) {
			$no++;
			$row = array();
			$row[] = $cobro->id;
			$row[] = $cobro->monto;
			$row[] = $cobro->fecha;
			$row[] = $cobro->metodo_pago;
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="'.site_url('cobro/edit_cobro/'.$cobro->id).'" title="Edit")"><i class="glyphicon glyphicon-pencil"></i> Editar</a>'
				  /*.'<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';*/;
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cobro->count_all(),
						"recordsFiltered" => $this->cobro->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_delete($id)
	{
		$this->mensaje->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}

