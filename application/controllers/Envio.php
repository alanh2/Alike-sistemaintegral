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
		$this->load->model('Enviometodo_model','enviometodo');
		$this->load->model('Envioventa_model','envioVenta');
		$this->load->model('detalle_cuentacorriente_model','detalleCuentacorriente');
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
		$metodo = $this->enviometodo->get_datos_metodo_by_id($data->envtablaid, $data->metodoenvio);
		$data = array_merge((array) $data,(array) $metodo);
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
			//row[] = $envio->costo;
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
	public function pasar_costos(){
		$tiposenvios = array('0','env_retiros','env_ocas','env_ocaexpress','env_motos','env_otros');

		$this->db->from('envios');
		$query = $this->db->get()->result();

		foreach ($query as $envio) {
			$datametodo = $this->enviometodo->get_datos_metodo_by_id($envio->id, $envio->metodoenvio);
			if ($data->metodoenvio != 1 && isset($datametodo)){
				$this->envio->update(array('id' => $envio->id),array('costo'=> $datametodo->costo));
			}else{
				$this->envio->update(array('id' => $envio->id),array('costo'=> '0.00'));
			}
		}

	}
	public function ajax_add($ventaid=NULL)
	{
		$costo = $this->input->post('costo');
		$metodoEnvio = $this->input->post('metodoEnvio');
		if ($metodoEnvio == 1){
			$costo = 0;
		}
		$this->db->trans_begin(); 
        $datametodo = array(
        		"metodoenvio" => $metodoEnvio,
        		"motoid" => $this->input->post('motoid'),
        		"direccion" => $this->input->post('direccion'),
        		"nombre_empresa" => $this->input->post('nombre_empresa'),
        		"direccion_empresa" => $this->input->post('direccion_empresa'),
        		"tracking" => $this->input->post('tracking'),
        	);

		$metodoEnvioid = $this->enviometodo->add_envio($datametodo);
        $dataenvio = array(
        		"costo" => $costo,
        		"recibe" => $this->input->post('recibe'),
        		"dni" => $this->input->post('dni'),
        		"metodoenvio" => $metodoEnvio,
        		"fecha" => date('Y-m-d H:i:s'),
        		"fechaestimada" => $this->input->post('fecha_estimada'),
        		"envtablaid" => $metodoEnvioid,
        		"clienteid" => $this->input->post('clienteid'),
        		"operacion" => 1,
        );
		$envioid = $this->envio->save($dataenvio);

		if ($ventaid!=NULL){
			$this->envioVenta->save(array("envioid" => $envioid, "ventaid" => $ventaid));
		}

        $datadetallecc = array(
        		"monto" => $costo,
        		"clienteid" => $this->input->post('clienteid'),
        		"fecha" => date('Y-m-d H:i:s'),
        		"tipo_operacionid" => 2, //envio
        		"operacionid" => $envioid,
        		"vendedorid" => 1,
        );
		$detalleccid = $this->detalleCuentacorriente->registrar($datadetallecc);

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

	public function ajax_update($ventaid=NULL)
	{
		$costo = $this->input->post('costo');
		$envioid = $this->input->post('id');
		$metodoEnvio = $metodoEnvio;
		if ($metodoEnvio == 1){
			$costo = 0;
		}
		$this->db->trans_begin(); 
        $datametodo = array(
        		"metodoenvio" => $metodoEnvio,
        		"motoid" => $this->input->post('motoid'),
        		"direccion" => $this->input->post('direccion'),
        		"nombre_empresa" => $this->input->post('nombre_empresa'),
        		"direccion_empresa" => $this->input->post('direccion_empresa'),
        		"tracking" => $this->input->post('tracking'),
        );

		$metodoEnvioid = $this->enviometodo->actualizar($datametodo['metodo'],1,$datametodo);
        $dataenvio = array(
        		"costo" => $costo,
        		"recibe" => $this->input->post('recibe'),
        		"dni" => $this->input->post('dni'),
        		"metodoenvio" => $metodoEnvio,
        		"fecha_estimada" => $this->input->post('fecha_estimada'),
        		"envtablaid" => $metodoEnvioid,
        		"clienteid" => $this->input->post('cliente'),
        );
		$this->envio->update(array('id' => $envioid),$dataenvio);

/*		if ($ventaid!=NULL){
			$this->envioVenta->update(array("envioid" => $envioid, "ventaid" => $ventaid), array("costo" => $costo));
		}*/

        $datadetallecc = array(
        		"monto" => $monto,
        		"clienteid" => $this->input->post('cliente'),
        		"tipo_operacion" => 2, //envio
        		"operacionid" => $envioid,
        		"vendedorid" => 1,
        	);
		$detalleccid = $this->detalleCuentacorriente->actualizar_detalle_cc($datadetallecc);

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
	
	public function ajax_delete($id)
	{
		$this->db->trans_begin();
		$envio = $this->envio->get_by_id($id);
		$this->envio->delete_by_id($id);
		$this->enviometodo->delete_by_id($id, $envio->envtablaid);
		$this->envioVenta->delete_by_envioid($id);

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
			$row[] = '$'.$envio->costo;
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

