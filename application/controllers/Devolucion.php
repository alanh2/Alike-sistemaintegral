<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Devolucion extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('venta_model','venta');

		$this->load->model('venta_renglones_model','venta_renglones');

		$this->load->model('stock_model','stock');

		$this->load->model('devolucion_renglones_model','devolucion_renglones');

		$this->load->model('producto_model','producto');
		
		$this->load->model('transaccion_model','transaccion');

		$this->load->model('devolucion_model','devolucion');

		$this->load->model('gasto_model','gasto');

		$this->load->model('notacredito_model','notacredito');

		$this->load->model('cashback_model','cashback');


	}

	public function index()

	{

		$this->load->helper('url');

		$data['view']='devolucion_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}

	
	public function alta_devolucion($id=NULL){
		$this->isAdmin();
		
		$this->load->helper('url');
		if($id!=NULL){
			
			$venta=$this->venta->get_by_id($id);
			$data['venta']=$venta;//aqui va la data que se le quiera pasar a la vista a travez de la master
		}else{
			//redireccionar a index..? quizas poner esto en todos lados donde aplique
		}
 
		$data['view']='devolucion_alta_view';
		$this->load->view('master_view',$data);

	}

	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->devolucion->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $devolucion) {

			$no++;

			$row = array();

			$row[] = $devolucion->id;

			$row[] = $devolucion->cliente;

			$row[] = $devolucion->fecha;

			$row[] = $devolucion->total;

			$row[] = $devolucion->vendedor;

			$row[] = '<a class="btn btn-sm btn-info" href="'.site_url('venta/ver_detalles/'.$devolucion->ventaid).'" target="_blank">Venta <i class="fa fa-shopping-cart"></i></a>';



			//add html for action
			/*
			if(strtotime($devolucion->fecha) < strtotime('-30 days')){
				$row[] = '<a class="btn btn-sm btn-info" href="'.site_url('venta/ver_detalles/'.$devolucion->id).'" title="Ver Detalles"><i class="glyphicon glyphicon-list"></i> ver </a>
				<a class="btn btn-sm btn-success" href="'.site_url('venta/alta_venta/'.$devolucion->id).'" title="Modificar"><i class="fa fa-edit"></i> Mod </a>';
			}
			else{
				$row[] = '<a class="btn btn-sm btn-info" href="'.site_url('venta/ver_detalles/'.$devolucion->id).'" title="Ver Detalles"><i class="glyphicon glyphicon-list"></i> ver </a>
			<a class="btn btn-sm btn-success" href="'.site_url('venta/alta_venta/'.$devolucion->id).'" title="Modificar"><i class="fa fa-edit"></i> Mod </a>
			<a class="btn btn-sm btn-danger" href="'.site_url('devolucion/alta_devolucion/'.$devolucion->id).'" title="Devolución"><i class="fa fa-undo"></i> Dev </a>';	
			}
			*/
			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->devolucion->count_all(),

						"recordsFiltered" => $this->devolucion->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	public function ajax_add($ventaid=null)

	{

		$this->_validate();
		$venta=$this->venta->get_by_id($ventaid);
		$data = array(

				
				//'vendedorid' => $this->input->post('vendedor'),

				'fecha' => date("Y-m-d H:i:s"),

				'ventaid' => $ventaid,

			);

		//echo json_encode(array("status" => TRUE, 'id' => $insert));
		//$this->db->trans_begin(); 
		
		$devolucionid = $this->devolucion->save($data);

		$data = $this->input->post('devoluciones');
		//print_r($_POST);
		$devolucion="";
		foreach ($data as $venta_renglon => $unidades) {
			if(!isset($devolucion[$venta_renglon])){
				$devolucion[$venta_renglon]["stock"]=0;
				$devolucion[$venta_renglon]["RMA"]=0;
			}
			foreach($unidades as $key=> $value){
				if($value==1){
					$devolucion[$venta_renglon]["stock"]+=1;
				}else{
					$devolucion[$venta_renglon]["RMA"]+=1;
				}
			}

		}
		//print_r($devolucion);
		foreach ($devolucion as $venta_renglonid=>$devoluciones){
			$devolucion_renglon=$this->add_renglon($devolucionid,$venta_renglonid,$devoluciones['stock'],$devoluciones['RMA']);
			$venta_renglon=$this->venta_renglones->get_by_id($venta_renglonid);
			$stock=$this->stock->get_by_id($venta_renglon->stockid);
			$stock_cantidad_final=$stock->cantidad+$devoluciones['stock'];
			$stock_rma_final=$stock->rma+$devoluciones['RMA'];
			$dataStock= array('cantidad'=>$stock_cantidad_final,'rma'=>$stock_rma_final);
			$this->stock->update(array('id' => $venta_renglon->stockid), $dataStock);
		}

			$this->devolucion->actualizar_total($devolucionid);
			//echo $this->db->last_query();
			$monto_devolucion=$this->devolucion->get_total($devolucionid);
			//echo $monto_devolucion;
			if (isset($_POST['cashonota'])){
				if($this->input->post('cashonota')==2){
					$dataNotaCredito = array('monto'=>$monto_devolucion->total,'saldo'=>$monto_devolucion->total,'fecha' => date("Y-m-d H:i:s"),'devolucionid'=>$devolucionid, 'clienteid'=>$venta->clienteid);
					$nota_creditoid = $this->notacredito->save($dataNotaCredito);
					echo json_encode(array("status" => TRUE));
				}else{
					$dataCashBack= array('monto'=>$monto_devolucion->total,'fecha' => date("Y-m-d H:i:s"),'devolucionid'=>$devolucionid, 'clienteid'=>$venta->clienteid);
					$cash_backid = $this->cashback->save($dataCashBack);
					echo json_encode(array("status" => TRUE));
				}
			}
	}

	public function ajax_detalle($id)
	{
		$this->load->helper('url');

		$list = $this->devolucion_renglones->get_datatables($id);

		$data = array();
		if(isset($_POST['start'])){
			$start=$_POST['start'];
		}else{
			$start=0;
		}
		$no = $start;
		foreach ($list as $renglon) {
			$no++;
			$row = array();
			$row[] = $renglon->id;
			$row[] = $renglon->producto." - ".$renglon->color;
			$row[] = $renglon->cantidad;
			$data[] = $row;
		}
		$output = array(
						"recordsTotal" => $this->devolucion_renglones->count_all($id),
						"recordsFiltered" => $this->devolucion_renglones->count_filtered($id),
						"data" => $data,
				);
		echo json_encode($output);
	}

//////////////////////////////////////////////////////////////////////////////////////Renglones/////////////////////////////////////////////////////////////////////////////
public function ajax_renglones($id)

	{

		$this->load->helper('url');

		$list = $this->venta_renglones->get_datatables($id);

		$data = array();
		if(isset($_POST['start'])){
			$start=$_POST['start'];
		}else{
			$start=0;
		}
		$no = $start;

		foreach ($list as $renglon) {
			$no++;

			$row = array();

			$row[] = $renglon->id;

			$row[] = $renglon->producto." - ".$renglon->color;

			$row[] = '$'.$renglon->precio_unitario;

			$row[] = $renglon->cantidad;

			$row[] = '$'.$renglon->precio_unitario*$renglon->cantidad;

			//add html for action

			$row[] = '
						<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_renglon('."'".$renglon->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>

						<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_renglon('."'".$renglon->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';

		

			$data[] = $row;

		}



		$output = array(

						//"draw" => $_POST['draw'],

						"recordsTotal" => $this->venta_renglones->count_all($id),

						"recordsFiltered" => $this->venta_renglones->count_filtered($id),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	public function ajax_edit_renglon($id)

	{

		$data = $this->venta_renglones->get_by_id($id);

		echo json_encode($data);

	}



	public function add_renglon($devolucionid,$venta_renglonid,$stock,$rma)

	{

		//$this->_validate();

		$data = array(

				'devolucionid' => $devolucionid,

				'venta_renglonid' => $venta_renglonid,

				//'stockid' => $this->input->post('stock'),

				'cantidad' => $stock+$rma,

				'stock' => $stock,

				'rma' => $rma,

				//'precio_unitario' => $this->input->post('precio'),

				//'total_renglon' => $this->input->post('precio')*$this->input->post('cantidad'),


			);

		$insert = $this->devolucion_renglones->save($data);

		//echo json_encode(array("status" => TRUE));

	}

	public function ajax_update_renglon()
	{

		$data = array(

				'cantidad' => $this->input->post('cantidad'),

				'precio_unitario' => $this->input->post('precio'),

				'total_renglon' => $this->input->post('precio')*$this->input->post('cantidad'),

			);

		$this->venta_renglones->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));

	}

	public function ajax_delete_renglon($id)
	{

		$this->venta_renglones->delete_by_id($id);

		echo json_encode(array("status" => TRUE));

	}

	private function _validate()

	{

		$data = array();

		$data['error_string'] = array();

		$data['inputerror'] = array();

		$data['status'] = TRUE;

		if($this->input->post('cashonota') == '')

		{

			$data['inputerror'][] = 'cashonota';

			$data['error_string'][] = 'Debe seleccionar si es cash o nota de credito';

			$data['status'] = FALSE;

		}



		/*if($this->input->post('vendedor') == '')

		{

			$data['inputerror'][] = 'vendedor';

			$data['error_string'][] = 'Debe seleccionar un vendedor';

			$data['status'] = FALSE;

		}
*/
		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}


}

