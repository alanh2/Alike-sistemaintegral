<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Venta extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('venta_model','venta');

		$this->load->model('venta_renglones_model','venta_renglones');

		$this->load->model('producto_model','producto');
		
		$this->load->model('cobro_model','cobro');
		
		$this->load->model('aplicacioncobroventa_model','aplicacionCobroVenta');

		$this->load->model('transaccion_model','transaccion');

		$this->load->model('Comentariocliente_model','Comentariocliente');

		$this->load->model('envioventa_model','envioventa');
	}

	public function index()

	{

		$this->load->helper('url');

		$data['view']='venta_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}

	public function add_venta_post(){

		$data = $this->input->post('data');

    	$data = json_decode($data);

		$data=$data->venta;

		//print_r($data);

		//$this->_validate();

		$venta = array(

				   'clienteid'=>$data->cliente->ID,

				   'fecha'=>$data->fecha,

				   'subtotal'=>$data->subtotal,

				   'descuento'=>$data->descuento,

				   'total'=>$data->total,

				   

				);

		$insert = $this->venta->save($venta);

		$venta_id=$this->db->insert_id();

		foreach($data->renglones as $key=>$value){

			$renglon = array(

					   'ventaid'=>$venta_id,

					   'productoid'=>$value->ID,

					   'cantidad'=>$value->cantidad,

					   'preciounidad'=>$value->precio

					);		

			$insert = $this->venta->save_renglon($renglon);

			$this->producto->salida_stock($value->ID, $value->cantidad);

		}

		echo $this->db->last_query();

		echo json_encode(array("status" => TRUE));

	}

	public function metodo_pago_venta($id=NULL){
		if($id==NULL){
			$this->alta_venta();
		}else{
			$this->load->helper('url');
			$this->cargar_venta($id);
			$data['view']='metodo_pago_venta_view';
			$this->load->view('master_view',$data);
		}
	}	

	public function envios_venta($id=NULL){
		if($id==NULL){
			$this->alta_venta();
		}else{
			$this->load->helper('url');
			$this->cargar_venta($id);
			$data['view']='venta_envios_view';
			$this->load->view('master_view',$data);
		}
	}	

	public function ver_detalles($id=NULL){
		if ($id != null){
			$data['view']='venta_detalle_view';
			$data['venta'] = $this->venta->get_by_id($id);
			//$data['venta']->total = $this->venta->get_total($id)->total;
			$this->load->view('master_view',$data);

		}else{
			$this->index();
		}
	}

	public function cargar_venta($id){
		$data['venta']=$this->venta->get_by_id($id);
		$data['promedio'] = $this->Comentariocliente->get_promedio_by_cliente($data['venta']->clienteid);
		if($data['promedio']->puntaje<3){
			$data['menuClienteColor']='yellow';
			$data['menuClienteEstado']='
                    <div class="huge"><i class="fa fa-thumbs-down"></i></div>
                    <div class="leyenda">No confiable</div>';

		}else{
			$data['menuClienteColor']='green';
			$data['menuClienteEstado']='
                    <div class="huge"><i class="fa fa-thumbs-up"></i></div>
                    <div class="leyenda">Confiable</div>';
		}
		$stars='';
		for($i=1;$i<=round($data['promedio']->puntaje);$i++){
			$stars.='<i class="fa fa-star"></i>';
		}
		$data['stars']=$stars;
		//------------------------------------------------------------------------------------------------------------------------------//
		$data['aplicacionesCobroVenta']=$this->aplicacionCobroVenta->get_by_venta_id($id);
		if(count($data['aplicacionesCobroVenta'])>0){
			$data['menuVentaColor']='green';
			$data['menuVentaEstado']='
                    <div class="huge"><i class="fa fa-check"></i></div>
                    <div class="leyenda">Listo!</div>';	
		}else{
			$data['menuVentaColor']='red';
			$data['menuVentaEstado']='
                    <div class="huge"><i class="fa fa-times"></i></div>
                    <div class="leyenda">Completar</div>';				
		}

		//------------------------------------------------------------------------------------------------------------------------------//
		$data['cantidadproductos'] = $this->venta_renglones->count_all($id);//cantidad de renglones
		$total = 0;
		if ($data['cantidadproductos'] > 0) {
			$total = $this->venta->get_total($id)->total;
			$data['menuRenglonesColor']='green';
			$data['menuRenglonesEstado']='
                    <div class="huge"><i class="fa fa-check"></i></div>
                    <div class="leyenda">Listo!</div>';
		}else{
			$data['menuRenglonesColor']='red';
			$data['menuRenglonesEstado']='
                    <div class="huge"><i class="fa fa-times"></i></div>
                    <div class="leyenda">Completar</div>';				
		}
		$data['total'] = $total;

		//------------------------------------------------------------------------------------------------------------------------------//
		$data['envio']=$this->envioventa->get_by_venta($id);
		if(isset($data['envio']->nombre_envio) && count($data['envio']->nombre_envio)>0){
			$data['menuEnviosColor']='green';
			$data['menuEnviosEstado']='
                    <div class="huge"><i class="fa fa-check"></i></div>
                    <div class="leyenda">Listo!</div>';
		}else{
			$data['menuEnviosColor']='red';
			$data['menuEnviosEstado']='
                    <div class="huge"><i class="fa fa-check"></i></div>
                    <div class="leyenda">Listo!</div>';
		}
		//------------------------------------------------------------------------------------------------------------------------------//
		$data['menu']=$this->load->view("venta_menu_view",$data,TRUE);
		return $data;
	}

	public function alta_venta($id=NULL){

		$this->load->helper('url');
		if($id!=NULL){
			
			$venta=$this->venta->get_by_id($id);
			
			$data['save_method']='mod';//aqui va la data que se le quiera pasar a la vista a travez de la master
		
			$data['venta']=$venta;//aqui va la data que se le quiera pasar a la vista a travez de la master
			$data['promedio']=$this->Comentariocliente->get_promedio_by_cliente($venta->clienteid);

		}else{
			$data['save_method']='add';//aqui va la data que se le quiera pasar a la vista a travez de la master
		
		}
 
		$data['view']='venta_alta_view';
		$this->load->view('master_view',$data);

	}

	//En esta parte se agregan productos a la venta
	public function renglones_venta($id=NULL){
		if($id==NULL){
			$this->alta_venta();
		}else{
			$this->load->helper('url');
			$this->cargar_venta($id);
			$data['view']='venta_renglones_view';
			$this->load->view('master_view',$data);
		}

	}
	
	public function ajax_venta($id=NULL){
		if($id!=NULL){
			$data=$this->venta->get_by_id($id);
			echo json_encode($data);
		}
	}

	public function ajax_venta2($id=NULL){
		if($id!=NULL){
			$data=$this->venta->get_by_id($id);
			//Mientras tanto, hasta que se haga el campo autovaluado de total en ventas
			$data->total=$this->venta->get_total($id)->total;
			echo json_encode($data);
		}
	}

	public function ajax_datos_envio_por_venta($ventaid)
	{
		$data = $this->envioventa->get_by_venta($ventaid);
		echo json_encode($data);
	}

	public function completar_envio(){
		$data = $this->input->post();
		if ($data['ventasenviosid'] != ''){
			$this->envioventa->update(array('id' => $data['ventasenviosid']),array('metodoenvioid'=> $data['metodo']));
		}else{
			$this->envioventa->save(array('metodoenvioid'=> $data['metodo'], 'ventaid'=> $data['ventaid']));
		}
		echo json_encode(array("resultado" => 'Ok'));
	}

	public function completar_venta(){
		$data = $this->input->post();
		$this->db->trans_begin(); 
		$transaccion_result = $this->transaccion->add_transaccion($data['metodo'],1,$data);
		$cobro_result = $this->cobro->save(array('clienteid'=> $data['clienteid'], 'monto'=> $data['monto'],'fecha'=> date('Y-m-d H:i:s'), 'metodoid' => $transaccion_result, 'metododepagoid' => $data['metodo']));
		$aplicacion_result = $this->aplicacionCobroVenta->save(array('cobroid'=> $cobro_result, 'ventaid'=> $data['ventaid'], 'monto'=> null));

		$output = array(
						"transaccion" => $transaccion_result,
						"cobro" => $cobro_result,
						"aplicacion" => $aplicacion_result,
						"data" => $data
				);

		if ($this->db->trans_status() === FALSE || !isset($transaccion_result) || !isset($cobro_result) || !isset($aplicacion_result))
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

	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->venta->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $venta) {

			$no++;

			$row = array();

			$row[] = $venta->id;

			$row[] = $venta->cliente;

			$row[] = $venta->fecha;

			$row[] = $venta->total;

			$row[] = $venta->vendedor;



			//add html for action

			$row[] = '<a class="btn btn-sm btn-info" href="'.site_url('venta/ver_detalles/'.$venta->id).'" title="Ver Detalles"><i class="glyphicon glyphicon-list"></i> Ver detalles</a>
			<a class="btn btn-sm btn-success" href="'.site_url('venta/alta_venta/'.$venta->id).'" title="Ver Detalles"><i class="fa fa-edit"></i> Modificar</a>';
		

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->venta->count_all(),

						"recordsFiltered" => $this->venta->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	public function ajax_edit($id)

	{

		$data = $this->venta->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		$this->_validate();

		$data = array(

				'clienteid' => $this->input->post('cliente'),

				'vendedorid' => $this->input->post('vendedor'),

				'fecha' => date("Y-m-d H:i:s"),

				'estado' => 'iniciada',

			);

		$insert = $this->venta->save($data);

		echo json_encode(array("status" => TRUE, 'id' => $insert));

	}



	public function ajax_update()

	{

		$this->_validate();

		$data = array(

				'clienteid' => $this->input->post('cliente'),

				'vendedorid' => $this->input->post('vendedor'),

			);

		$this->venta->update(array('id' => $this->input->post('id')), $data);
		
		echo json_encode(array("status" => TRUE, 'id' => $this->input->post('id')));

	}



	public function ajax_delete($id)

	{

		$this->venta->delete_by_id($id);

		echo json_encode(array("status" => TRUE));

	}

	public function ajax_detalle($id)
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
			$data[] = $row;
		}
		$output = array(
						"recordsTotal" => $this->venta_renglones->count_all($id),
						"recordsFiltered" => $this->venta_renglones->count_filtered($id),
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



	public function ajax_add_renglon()

	{

		//$this->_validate();

		$data = array(

				'ventaid' => $this->input->post('venta'),

				'stockid' => $this->input->post('stock'),

				'cantidad' => $this->input->post('cantidad'),

				'precio_unitario' => $this->input->post('precio'),

				'total_renglon' => $this->input->post('precio')*$this->input->post('cantidad'),


			);

		$insert = $this->venta_renglones->save($data);

		echo json_encode(array("status" => TRUE));

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

		if($this->input->post('cliente') == '')

		{

			$data['inputerror'][] = 'cliente';

			$data['error_string'][] = 'Debe seleccionar un cliente';

			$data['status'] = FALSE;

		}



		if($this->input->post('vendedor') == '')

		{

			$data['inputerror'][] = 'vendedor';

			$data['error_string'][] = 'Debe seleccionar un vendedor';

			$data['status'] = FALSE;

		}

		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}
	private function _validate_renglon()

	{

		$data = array();

		$data['error_string'] = array();

		$data['inputerror'] = array();

		$data['status'] = TRUE;



		if($this->input->post('cliente') == '')

		{

			$data['inputerror'][] = 'cliente';

			$data['error_string'][] = 'Debe seleccionar un cliente';

			$data['status'] = FALSE;

		}



		if($this->input->post('vendedor') == '')

		{

			$data['inputerror'][] = 'vendedor';

			$data['error_string'][] = 'Debe seleccionar un vendedor';

			$data['status'] = FALSE;

		}

		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}



}

