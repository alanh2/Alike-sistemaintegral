<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Envio extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('envio_model','envio');
		$this->load->model('envio_renglones_model','envioRenglones');
		$this->load->model('venta_model','venta');
	}

	public function index()
	{
		$this->load->helper('url');
		$data['view']='envio_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function edit_envio()
	{
		$this->load->helper('url');
		$data['view']='envio_edit_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}

	public function ajax_edit($id)
	{
		$data =$this->envio->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');
		$list = $this->envio->get_datatables();
		$no = $_POST['start'];
		foreach ($list as $envio) {
			$no++;
			$row = array();
			$row[] = $envio->id;
			//row[] = $envio->monto;
			$row[] = $envio->fechaestimada;
			$row[] = $envio->metodo_envio;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_envio('."'".$envio->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a> '
				  .'<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_envio('."'".$envio->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->envio->count_all(),
						"recordsFiltered" => $this->envio->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function ajax_add($ventaid=NULL)
	{
		echo json_encode($output);
	}

	public function ajax_update($ventaid=NULL)
	{

	}
	
	public function ajax_delete($id)
	{
		$this->db->trans_begin();
		$this->envio->delete_by_id($id);

		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	    	$output['resultado'] = 'Error';
		}
		else
		{
	        $this->db->trans_commit();
	    	$output['resultado'] = 'Ok';
		}
		echo json_encode($output);
	}

	public function ajax_detalle($id)
	{
		$this->load->helper('url');

		$list = $this->envioRenglones->get_datatables($id);

		$data = array();
		if(isset($_POST['start'])){
			$start=$_POST['start'];
		}else{
			$start=0;
		}
		$no = $start;
		foreach ($list as $envio) {
			$no++;
			$row = array();
			$row[] = $envio->id;
			$row[] = $envio->fechaestimada;
			//$row[] = '$'.$envio->monto;
			$row[] = $envio->metodo_envio;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_envio('."'".$envio->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a> '
				  .'<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_envio('."'".$envio->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			$data[] = $row;
		}
		$output = array(
						"recordsTotal" => $this->envioRenglones->count_all($id),
						"recordsFiltered" => $this->envioRenglones->count_filtered($id),
						"data" => $data,
				);
		echo json_encode($output);
	}
}

