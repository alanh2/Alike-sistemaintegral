<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('cliente_model','cliente');
		$this->load->model('venta_model','venta');
		$this->load->model('cobro_model','cobro');
		$this->load->model('notacredito_model','notacredito');
		$this->load->model('cuentacorriente_model','cuentacorriente');
		$this->load->model('detalle_cuentacorriente_model','detalleCuentacorriente');
	}

	public function index()
	{
		$this->isAdmin();
		$this->load->helper('url');
		$data['view']='cliente_view';
		$data['data']='';//aqui va la data que se le quiera pasar a la vista a travez de la master
		$this->load->view('master_view',$data);
	}
	private function build_sorter($clave) {
	    return function ($a, $b) use ($clave) {
	        return strnatcmp($a[$clave], $b[$clave]);
	    };
	}
	public function cuenta($clienteid)
	{
		$this->isAdmin();
		$this->load->helper('url');
		$notasCredito = $this->notacredito->get_resumen_by_clienteid($clienteid);
		$ventas = $this->venta->get_resumen_by_clienteid($clienteid);
		$cobros = $this->cobro->get_resumen_by_clienteid($clienteid);
		$cliente = $this->cliente->get_by_id($clienteid);

		$data['view']='cliente_cuenta_view';
		$data['data']['movimientos'] = array_merge($ventas,$notasCredito, $cobros);
		function cmp($a, $b)
		{
		    return strcmp($a->fecha, $b->fecha);
		}

		usort($data['data']['movimientos'],  "cmp");
		
		//print_r($data['data']['movimient	os']);
		$data['data']['cliente'] = $cliente;
		$this->load->view('master_view',$data);
	}

	public function detalle_cuenta_cliente($clienteid)
	{
		$this->isAdmin();
		$this->load->helper('url');
/*		$notasCredito = $this->notacredito->get_resumen_by_clienteid($clienteid);
		$ventas = $this->venta->get_resumen_by_clienteid($clienteid);
		$cobros = $this->cobro->get_resumen_by_clienteid($clienteid);
*/
		$cliente = $this->cliente->get_by_id($clienteid);
		$movimientos = $this->detalleCuentacorriente->get_all_by_cliente($clienteid);

		$data['view']='detalle_cc_view';
		$data['data']['movimientos'] = $movimientos;
		//$data['data']['movimientos'] = array_merge($ventas,$notasCredito, $cobros);
		/*function cmp($a, $b)
		{
		    return strcmp($a->fecha, $b->fecha);
		}

		usort($data['data']['movimientos'],  "cmp");
		*/
		$data['data']['cliente'] = $cliente;
		$this->load->view('master_view',$data);
	}

	public function ajax_list($localid=null)
	{
		$this->load->helper('url');
		$list = $this->cliente->get_datatables($localid);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cliente) {
			$no++;
			$row = array();
			$row[] = $cliente->id;
			$row[] = $cliente->razon_social;
			//$row[] = $cliente->tel_codigo_area;
			$row[] = $cliente->tel_numero;
			$row[] = $cliente->cel_numero;
			$row[] = $cliente->direccion;
			$row[] = $cliente->localidad;
			//$row[] = $cliente->cp;
			$row[] = $cliente->email;
			//$row[] = $cliente->dni;
			//$row[] = $cliente->cuitcuil;
			$row[] = $cliente->web;
			//add html for action
			$row[] = '
			      <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_cliente('."'".$cliente->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>
				<a class="btn btn-sm btn-warning" href="'.site_url('Pdfs/imprimir_cuenta_corriente/'.$cliente->id).'" title="Imprimir" target="_blank"><i class="fa fa-print"></i></a>
				  <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Mensajes" onclick="add_mensaje('."'".$cliente->id."'".')"><i class="fa fa-star"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_cliente('."'".$cliente->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cliente->count_all(),
						"recordsFiltered" => $this->cliente->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function ajax_dropdown()
	{
		$list = $this->cliente->get_por_orden_alfabetico();
		
		$data = array();
	
		foreach ($list as $cliente) {
	
			$row = array();
	//		print_r ($categoria);
			$row['id'] = $cliente->id;
			$row['nombre'] = $cliente->razon_social;
			
			$data[] = $row;
		}
	
		$output = array(
	
			"clientes" => $data,
				);
		//output to json format
	
	
	   echo json_encode($output);
	
	}
	
	public function ajax_edit($id)
	{
		$data = $this->cliente->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'razon_social' => $this->input->post('razon_social'),
				//'tel_codigo_area' => $this->input->post('tel_codigo_area'),
				'tel_numero' => $this->input->post('tel_numero'),
				'cel_numero' => $this->input->post('cel_numero'),
				'direccion' => $this->input->post('direccion'),
				'localidadid' => $this->input->post('localidad'),
				'cp' => $this->input->post('cp'),
				'email' => $this->input->post('email'),
				'dni' => $this->input->post('dni'),
				'cuitcuil' => $this->input->post('cuitcuil'),
				'web' => $this->input->post('web'),
				'localid'=>$_SESSION['admin']['localid'],
		);
		$insert = $this->cliente->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_addMensaje()
	{
		$this->_validate();
		$data = array(
				'comentario' => $this->input->post('comentario'),
				'puntaje' => $this->input->post('puntaje'),
		);
		$insert = $this->comentariocliente->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'razon_social' => $this->input->post('razon_social'),
				//'tel_codigo_area' => $this->input->post('tel_codigo_area'),
				'tel_numero' => $this->input->post('tel_numero'),
				'cel_numero' => $this->input->post('cel_numero'),
				'direccion' => $this->input->post('direccion'),
				'localidadid' => $this->input->post('localidad'),
				'cp' => $this->input->post('cp'),
				'email' => $this->input->post('email'),
				'dni' => $this->input->post('dni'),
				'cuitcuil' => $this->input->post('cuitcuil'),
				'web' => $this->input->post('web'),
			);
		$this->cliente->update(array('id' => $this->input->post('id')), $data);
		//echo $this->db->last_query();
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->cliente->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_estado_de_cuenta($clienteid)
	{
		$data = array(
				'saldo' => $this->notacredito->get_saldo_by_cliente($clienteid),
				'deuda' => $this->cuentacorriente->get_deuda_by_cliente($clienteid),
		);
		print_r($data);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('razon_social') == '')
		{
			$data['inputerror'][] = 'razon_social';
			$data['error_string'][] = 'La razon social no puede estar vacia';
			$data['status'] = FALSE;
		}
		if($this->input->post('tel_numero') == '')
		{
			$data['inputerror'][] = 'tel_numero';
			$data['error_string'][] = 'El telefono no puede estar vacio';
			$data['status'] = FALSE;
		}
		if($this->input->post('direccion') == '')
		{
			$data['inputerror'][] = 'direccion';
			$data['error_string'][] = 'La direccion no puede estar vacia';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
