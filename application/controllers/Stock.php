<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Stock extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('stock_model','stock');

	}

	public function transferencia_entre_locales(){
		$this->load->helper('url');
		$data['view']='stock_transferencia_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);

	}
	public function ajax_transferencia(){

		$this->_validate();
		$stockid=$this->input->post('id');
		$cantidad=$this->input->post('cantidad');

		$stock_origen=$this->stock->get_by_id($stockid);//stock origen
		$stock_destino=$this->stock->get_by_producto_color_local($stock_origen->producto_colorid,$this->input->post('destino'));//stock destino
		$stock_origen_cantidad_final=$stock->cantidad-$cantidad;
		print_r($stock_destino);
		/*if(($stock_origen_cantidad_final>0)&&($stock_destino!=null)){

		}
		
		$stock_destino_cantidad_final=$stock->cantidad+$cantidad;

		$data_stock_origen= array('cantidad'=>$stock_origen_cantidad_final);
		$data_stock_destino= array('cantidad'=>$stock_destino_cantidad_final);
		
		//$this->stock->update(array('id' => $stockid), $data);
		//print_r($this->input->post());
		echo json_encode(array("status" => TRUE));
*/
	}

	public function index()

	{

		$this->load->helper('url');

		$data['view']='stock_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}



	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->stock->get_datatables();

		$data = array();

		if(isset($_POST['start'])){
			$start=$_POST['start'];
		}else{
			$start=0;
		}
		$no = $start;

		foreach ($list as $producto) {
			$producto->id=$producto->stock_id;//Aca se pone distinto para poder traer todos los campos de productos y no haya conflicto con el campo ID
			$no++;

			$row = array();

			$row[] = $producto->id;

			$row[] = $producto->codigo;

			$row[] = $producto->marca;

			$row[] = $producto->modelo;

			$row[] = $producto->subcategoria;

			$row[] = $producto->nombre." - ".$producto->color;

			$row[] = $producto->cantidad;

			$transferencia='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Transfer" onclick="transferir_stock('."'".$producto->id."'".')"><i class="glyphicon glyphicon-transfer"></i> Transferir stock</a>';
			$editar='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_stock('."'".$producto->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Ajustar stock</a>';
			$action=$editar;
			if ($producto->cantidad>0){
				$action.=$transferencia;
			}
			$row[] = $action;
	

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->stock->count_all(),

						"recordsFiltered" => $this->stock->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);

	}

	
public function ajax_color_por_producto_para_venta($producto=NULL, $venta=NULL)

	{	
		if($producto!=NULL){
			if($venta!=NULL){
				$list = $this->stock->get_por_producto_para_venta($producto,$venta);
			}else{
				$list = $this->stock->get_por_producto($producto);
			}
		}else{

			$list = $this->stock->get_datatables();
		}
		
		$data = array();


		foreach ($list as $stock) {
	
			$row = array();

			$row['id'] = $stock->stockid;

			$row['nombre'] = $stock->nombre;

			$row['l1'] = $stock->costo+$stock->costo*$stock->porcentaje1/100;
			
			$row['l2'] = $stock->costo+$stock->costo*$stock->porcentaje2/100;

			$row['l3'] = $stock->costo+$stock->costo*$stock->porcentaje3/100;

			$row['l4'] = $stock->costo+$stock->costo*$stock->porcentaje4/100;
			
			$row['cantidad'] = $stock->cantidad;

			$data[] = $row;

		}

	
		$output = array(

	
			"colores" => $data,

				);

	   echo json_encode($output);

	}
	public function ajax_dropdown()

	{

		$list = $this->stock->get_datatables();

		

		$data = array();

	

		foreach ($list as $producto) {

	

			$row = array();

	//		print_r ($categoria);

			$row['id'] = $producto->id;

			$row['nombre'] = $producto->nombre;

			

			$data[] = $row;

		}

	

		$output = array(

	

			"productos" => $data,

				);

		//output to json format

	

	

	   echo json_encode($output);

	

	}
	public function ajax_autocomplete(){
		
		$list = $this->stock->get_datatables();

		$data = array();


		foreach ($list as $producto) {

	

			$row = array();

	//		print_r ($categoria);

			$row['id'] = $producto->id;

			$row['nombre'] = $producto->nombre;

			$row['marca'] = $producto->marca;

			$row['modelo'] = $producto->modelo;

			$row['subcategoria'] = $producto->subcategoria;

			$row['codigo'] = $producto->codigo;

			

			$data[] = $row;

		}

	

		$output = array(

	

			"productos" => $data,

				);

		//output to json format

	

	

	   echo json_encode($output);
	}


	public function ajax_edit($id)

	{

		$data = $this->stock->get_by_id($id);

		echo json_encode($data);

	}



	public function ajax_add()

	{

		//print_r($this->input->post());

		//print_r($_FILES);

		$this->_validate();

		$data = array(

				'codigo' => $this->input->post('codigo'),

				'nombre' => $this->input->post('nombre'),

				//'marcaid' => $this->input->post('marca'),

				'subcategoriaid' => $this->input->post('subcategoria'),

				'proveedorid' => $this->input->post('proveedor'),

				'modeloid' => $this->input->post('modelo'),

		);

		$productoid = $this->stock->save($data);

		if(($this->input->post('colores'))){
			$colores=$this->input->post('colores');
			if(is_array($colores)){

				foreach ($colores as $key=>$value){

					$data = array(

							'colorid' => $key,

							'productoid' => $productoid,

							'costo' => $value['costo'],

							'porcentaje1' => $value['porcentaje1'],

							'porcentaje2' => $value['porcentaje2'],

							'porcentaje3' => $value['porcentaje3'],

							'porcentaje4' => $value['porcentaje4'],

							

					);

					$this->stock->save_color($data);

					//echo $this->db->last_query();

				

				}

			}
		}
		/*$target_path = "assets/uploads/"; //Declaring Path for uploaded images

		$j=0;

		for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

	

			$validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed

			$ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 

			$file_extension = end($ext); //store extensions in the variable

			

			$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image

			$j = $j + 1;//increment the number of uploaded images according to the files in array       

		  

		if (($_FILES["file"]["size"][$i] < 100000) //Approx. 100kb files can be uploaded.

					&& in_array($file_extension, $validextensions)) {

				if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder

					echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';

				} else {//if file was not moved.

					echo $j. ').<span id="error">please try again!.</span><br/><br/>';

				}

			} else {//if file size and file type was incorrect.

				echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';

			}

		}*/

		echo json_encode(array("status" => TRUE));

	}



	public function ajax_update()

	{

		$this->_validate();
		$stockid=$this->input->post('id');
		$data = array(

				'cantidad' => $this->input->post('cantidad'),
		);

		$this->stock->update(array('id' => $stockid), $data);
		//print_r($this->input->post());
		echo json_encode(array("status" => TRUE));

	}



	public function ajax_delete($id)

	{

		$this->stock->delete_colores($id);
		$this->stock->delete_by_id($id);

		echo json_encode(array("status" => TRUE));

	}

	private function able_to_delete($id){

		$this->load->model('stock_model','stock');

		return $this->stock->cuantos_por_color_producto($id)<1;

	}



	private function _validate()

	{

		$data = array();

		$data['error_string'] = array();

		$data['inputerror'] = array();

		$data['status'] = TRUE;



		/*if($this->input->post('marca') == '')

		{

			$data['inputerror'][] = 'marca';

			$data['error_string'][] = 'Debe seleccionar una marca';

			$data['status'] = FALSE;

		}*/

		/*if($this->input->post('codigo') == '')

		{

			$data['inputerror'][] = 'codigo';

			$data['error_string'][] = 'Codigo es un campo requerido';

			$data['status'] = FALSE;

		}*/

		if($this->input->post('cantidad') == '')

		{

			$data['inputerror'][] = 'cantidad';

			$data['error_string'][] = 'Cantidad es un campo requerido';

			$data['status'] = FALSE;

		}

		
		/*if($this->input->post('categoria') == '')

		{

			$data['inputerror'][] = 'categoria';

			$data['error_string'][] = 'Debe seleccionar una categoria';

			$data['status'] = FALSE;

		}*/

		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}

		

	public function alta_producto($id=NULL){

		if($id==NULL){
			$data['data']['save_method']='add';
		}else{
			$data['data']['save_method']='edit';
			$data['data']['producto']=$this->stock->get_by_id($id);
			$data['data']['colores']=$this->stock->get_producto_colores($id);
		}
		$this->load->helper('url');

		$data['view']='producto_alta_view';

		//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}

	/*public function alta_producto_post(){

		$data = $this->input->post('data');

    	$data = json_decode($data);

		$data=$data->producto;

		//print_r($data);

		//$this->_validate();

		$venta = array(

				   'codigo'=>$data->codigo,

				   'nombre'=>$data->nombre,

				   'modelo'=>$data->modelo,

				   'subcategoria'=>$data->subcategoria,

				   'proveedor'=>$data->proveedor,

				   

				);

		$insert = $this->stock->save($producto);

		$producto_id=$this->db->insert_id();

		foreach($data->renglones as $key=>$value){

			$color = array(

					   'productoid'=>$producto_id,

					   'colorid'=>$value->id,

					   'porcentaje1'=>$value->porcentaje1,

					   'porcentaje2'=>$value->porcentaje2,

					   'porcentaje3'=>$value->porcentaje3,

					   'porcentaje4'=>$value->porcentaje4

					);		

			$insert = $this->stock->save_color($color);

			//$this->stock->salida_stock($value->ID, $value->cantidad);

		//echo $this->db->last_query();

		mail("mikehambra@gmail.com","alike",$this->db->last_query());

		}

		

		echo json_encode(array("status" => TRUE));

		



	}*/
}

