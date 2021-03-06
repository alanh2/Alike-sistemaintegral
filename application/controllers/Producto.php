<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Producto extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->is_logged_in();

		$this->load->model('producto_model','producto');

	}

	public function ajustar_colores($id){
		$this->isAdmin();
		$this->load->helper('url');

		$data['view']='producto_ajustar_colores_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}

	public function index()

	{

		$this->isAdmin();
		
		$this->load->helper('url');

		$data['view']='producto_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}

	public function reportes(){
		
		$this->isAdmin();
		
		$this->load->helper('url');
		$data['view']='producto_reportes_view';
		//$data['data'][''] = $lista;
		$this->load->view('master_view',$data);
		
	}
	public function generar_reporte(){
		
		$this->isAdmin();
		
		$this->load->helper('url');
		$data['view']='producto_reporte_view';
		$data['data']['reporte']=$this->producto->get_reporte($this->input->get('local'),$this->input->get('marca'),$this->input->get('modelo'),$this->input->get('categoria'),$this->input->get('subcategoria'),$this->input->get('proveedor'));
		//$data['data'][''] = $lista;
		$this->load->view('master_view',$data);
		//echo $this->db->last_query();
		
		//print_r($_GET);	
	}	
	public function busqueda()

	{
		$this->isAdmin();

		$this->load->helper('url');

		$data['view']='producto_busqueda_view';

		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master

		$this->load->view('master_view',$data);

	}



	public function ajax_list()

	{

		$this->load->helper('url');

		$list = $this->producto->get_datatables();

		$data = array();

		if(isset($_POST['start'])){
			$start=$_POST['start'];
		}else{
			$start=0;
		}
		$no = $start;

		foreach ($list as $producto) {

			$no++;

			$row = array();

			$row[] = $producto->id;

			$row[] = $producto->codigo;

			$row[] = $producto->marca;

			$row[] = $producto->modelo;

			$row[] = $producto->nombre;

			$row[] = $producto->categoria;

			$row[] = $producto->subcategoria;

			//add html for action
			$editar='<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit"
					   onclick="window.open(\''.site_url('/producto/alta_producto/'.$producto->id).'\')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
				$clonar='<a class="btn btn-sm btn-info" href="javascript:void(0)" title="Clonar"
					   onclick="window.open(\''.site_url('/producto/clonar_producto/'.$producto->id).'\')"><i class="glyphicon glyphicon-copy"></i> Clonar</a>';
			if($this->able_to_delete($producto->id)>0){
				
				$row[] = $editar." ".$clonar.'

					  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_producto('."'".$producto->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			}else{

				$row[] = $editar." ".$clonar;
	
			}
		$row[]="";

			$data[] = $row;

		}



		$output = array(

						"draw" => $_POST['draw'],

						"recordsTotal" => $this->producto->count_all(),

						"recordsFiltered" => $this->producto->count_filtered(),

						"data" => $data,

				);

		//output to json format

		echo json_encode($output);
		//print_r($_POST); 
	}

	public function lista_precios($lista=null){
		$this->isAdmin();
		$this->load->helper('url');
		$data['view']='producto_lista_precios_view';
		$data['data']['stock'] = $this->producto->get_lista_precios($lista);
		$data['data']['lista'] = $lista;
		$this->load->view('master_view',$data);
		//echo $this->db->last_query();

	}

	public function producto_lista_precios_view_con_busqueda($lista=null){
		$this->isAdmin();
		$this->load->helper('url');
		$data['view']='producto_lista_precios_view';
		$data['data']['stock'] = $this->producto->get_lista_precios($lista);
		$data['data']['lista'] = $lista;
		$this->load->view('master_view',$data);
		//echo $this->db->last_query();

	}

	public function ajax_dropdown()

	{

		$list = $this->producto->get_datatables();

		

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
		
		$list = $this->producto->get_datatables();

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

		$data = $this->producto->get_by_id($id);

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

		$productoid = $this->producto->save($data);

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
					$this->producto->save_color($data,$value['cantidad']);

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
		$productoid=$this->input->post('id');
		$data = array(

				'codigo' => $this->input->post('codigo'),

				'nombre' => $this->input->post('nombre'),

				'subcategoriaid' => $this->input->post('subcategoria'),

				'proveedorid' => $this->input->post('proveedor'),

				'modeloid' => $this->input->post('modelo'),

		);

		$this->producto->update(array('id' => $productoid), $data);
		if(($this->input->post('colores'))){
			$colores=$this->input->post('colores');
			$colores_no_eliminados=array();
			if(is_array($colores)){

				foreach ($colores as $key=>$value){
					array_push($colores_no_eliminados,$key);
					$data = array(

							'colorid' => $key,

							'productoid' => $productoid,

							'costo' => $value['costo'],

							'porcentaje1' => $value['porcentaje1'],

							'porcentaje2' => $value['porcentaje2'],

							'porcentaje3' => $value['porcentaje3'],

							'porcentaje4' => $value['porcentaje4'],

							

					);
					$this->producto->save_color($data,$value['cantidad']);

					//echo $this->db->last_query();

				

				}

			}

			//$colores_no_eliminados=implode(",", $colores_no_eliminados);
			//echo $colores_no_eliminados;
			$this->producto->delete_colores($productoid,$colores_no_eliminados);
			//echo $this->db->last_query();
		}
		//print_r($this->input->post());
		echo json_encode(array("status" => TRUE));

	}



	public function ajax_delete($id)

	{
		$this->db->trans_begin(); 
		$this->producto->delete_colores($id);
		$this->producto->delete_by_id($id);
		if ($this->db->trans_status() === FALSE)
		{
	        $this->db->trans_rollback();
	        echo json_encode(array("status" => FALSE));

		}
		else
		{
	        $this->db->trans_commit();
	        echo json_encode(array("status" => TRUE));

		}
		
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

		if($this->input->post('nombre') == '')

		{

			$data['inputerror'][] = 'nombre';

			$data['error_string'][] = 'Nombre es un campo requerido';

			$data['status'] = FALSE;

		}

		

		if($this->input->post('modelo') == '')

		{

			$data['inputerror'][] = 'modelo';

			$data['error_string'][] = 'Modelo es un campo requerido';

			$data['status'] = FALSE;

		}

		/*if($this->input->post('categoria') == '')

		{

			$data['inputerror'][] = 'categoria';

			$data['error_string'][] = 'Debe seleccionar una categoria';

			$data['status'] = FALSE;

		}*/

		if($this->input->post('subcategoria') == '')

		{

			$data['inputerror'][] = 'subcategoria';

			$data['error_string'][] = 'Debe seleccionar una sub categoria';

			$data['status'] = FALSE;

		}



		if($data['status'] === FALSE)

		{

			echo json_encode($data);

			exit();

		}

	}

		

	public function alta_producto($id=NULL){
		$this->isAdmin();

		if($id==NULL){
			$data['data']['save_method']='add';
			$data['titulo']='Alta Producto';
		}else{
			$data['data']['save_method']='edit';
			$data['data']['producto']=$this->producto->get_by_id($id);
			$data['data']['colores']=$this->producto->get_producto_colores_para_producto($id);
			$data['titulo']='Editar Producto';
		}
		$this->load->helper('url');

		$data['view']='producto_alta_view';

		//aqui va la data que se le quiera pasar a la vista a travez de la master
		//print_r($data['data']['colores']);
		$this->load->view('master_view',$data);

	}
	public function clonar_producto($id=NULL){
		$this->isAdmin();

		if($id==NULL){
			//$data['data']['save_method']='add';
		}else{
			$data['data']['save_method']='add';
			$data['data']['producto']=$this->producto->get_by_id($id);
			$data['data']['colores']=array();
			$data['titulo']='Clonar Producto';
		}
		$this->load->helper('url');

		$data['view']='producto_alta_view';

		//aqui va la data que se le quiera pasar a la vista a travez de la master
		//print_r($data['data']['colores']);
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

		$insert = $this->producto->save($producto);

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

			$insert = $this->producto->save_color($color);

			//$this->producto->salida_stock($value->ID, $value->cantidad);

		//echo $this->db->last_query();

		mail("mikehambra@gmail.com","alike",$this->db->last_query());

		}

		

		echo json_encode(array("status" => TRUE));

		



	}*/



	//lista stock de un producto

	public function stock($id)

	{
		$this->isAdmin();

		$this->load->helper('url');

		$data['id']=$id;

		$this->load->view('stock_view',$data);

	}



}

