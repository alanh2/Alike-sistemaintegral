<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('cobro_model','cobro');
		$this->load->model('transaccion_model','transaccion');
		$this->load->model('cuentacorriente_model','cuentaCorriente');
		$this->load->model('notacredito_model','notaCredito');
		$this->load->model('venta_model','venta');
		$this->load->model('aplicacioncobroventa_model','aplicacionCobroVenta');

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

	public function ajax_edit($id)
	{
		$cobro =$this->cobro->get_by_id($id);
		unset($cobro->fecha);
		$metodo = $this->transaccion->get_transaccion($cobro->metododepagoid, $cobro->metodoid);
		$data = array_merge((array) $cobro,(array) $metodo);
		echo json_encode($data);
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
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a> '
				  .'<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';;
		
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
	
	public function ajax_add()
	{
		$this->db->trans_begin(); 
        $datametodo = array(
        		"metodo" => $this->input->post('metodo'),
        		"vencimiento" => $this->input->post('vencimiento'),
        		"banco" => $this->input->post('banco'),
        		"numeracion" => $this->input->post('numeracion'),
        		"titular" => $this->input->post('titular'),
        		"digitos" => $this->input->post('digitos'),
        		"fecha" => $this->input->post('fecha'),
        		"codigomp" => $this->input->post('codigomp'),
        		"codigo_operacion" => $this->input->post('codigo_operacion'),
        		"operacion" => 1,
        	);

		$metodoid = $this->transaccion->add_transaccion($datametodo['metodo'],1,$datametodo);
        $datacobro = array(
        		"monto" => $this->input->post('monto'),
        		"metododepagoid" => $this->input->post('metodo'),
        		"clienteid" => $this->input->post('cliente'),
        		"fecha" => date('Y-m-d H:i:s'),
        		"metodoid" => $metodoid,
        	);
		$cobroid = $this->cobro->save($datacobro);

		if ($datametodo['metodo'] != 5){ // si no es un cobro del metodo cuenta corriente, intenta saldar ventas adeudadas
			$this->pagar_ventas_pendientes($this->input->post('cliente'), $cobroid, $this->input->post('monto'));
		}
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

	public function ajax_update()
	{
		$this->db->trans_begin(); 
        $datametodo = array(
        		"metodo_anterior" => $this->input->post('metodo_anterior'),
        		"metodo" => $this->input->post('metodo'),
        		"mov_tabla_id_anterior" => $this->input->post('mov_tabla_id_anterior'),
        		"vencimiento" => $this->input->post('vencimiento'),
        		"banco" => $this->input->post('banco'),
        		"numeracion" => $this->input->post('numeracion'),
        		"titular" => $this->input->post('titular'),
        		"digitos" => $this->input->post('digitos'),
        		"fecha" => $this->input->post('fecha'),
        		"codigomp" => $this->input->post('codigomp'),
        		"codigo_operacion" => $this->input->post('codigo_operacion'),
        		"operacion" => 1,
        	);

		$metodoid = $this->transaccion->actualizar($datametodo);

        $datacobro = array(
        		"monto" => $this->input->post('monto'),
        		"metododepagoid" => $this->input->post('metodo'),
        		"clienteid" => $this->input->post('cliente'),
        		"fecha" => date('Y-m-d H:i:s'),
        		"metodoid" => $metodoid,
        	);
		$this->cobro->update(array('id' => $this->input->post('id')),$datacobro);
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
		$cobro = $this->cobro->get_by_id($id);
		$this->db->trans_begin();
		$this->cobro->delete_by_id($id);
		$this->transaccion->eliminar($cobro->metododepagoid, $cobro->metodoid);

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

	private function pagar_ventas_pendientes($clienteid, $cobroid, $monto){
		$ventas = $this->cuentaCorriente->ventas_adeudadas($clienteid);
		$cantidadVentas = count($ventas);
		$i = 0;
		while( $monto >  0 && $i < $cantidadVentas){
			$total = $this->venta->get_total($ventas[$i]->id)->total;
			$montoSaldado = $this->cuentaCorriente->cobros_parciales_venta($ventas[$i]->id)->cobrado;
			//echo 'total = '. $total. '<br>' . 'montoSaldado = '. $montoSaldado. '<br>' . 'monto = '. $monto. '<br>';
			//echo $total;
			if(($monto - $total + $montoSaldado) >= 0){ //Saldo la venta si el monto alcanza
				$this->venta->update(array('id' => $ventas[$i]->id),array('saldada' => 1));
			}
			if ($monto - $total + $montoSaldado > 0){ // Queda plata para saldar otra venta
				//Aplico cobro a la ventaid con el monto que falta saldar
				$this->aplicacionCobroVenta->save(array('cobroid'=> $cobroid, 'ventaid'=> $ventas[$i]->id, 'monto'=> ($total - $montoSaldado)));
				$this->venta->update(array('id' => $ventas[$i]->id),array('saldada' => 1));
				$monto = $monto - $total + $montoSaldado;
			}else if($monto - $total + $montoSaldado <= 0){ // Me quedo sin monto restante
				//Aplico cobro a la ventaid con monto (Si queda saldada, lo modifico en la venta)
				$this->aplicacionCobroVenta->save(array('cobroid'=> $cobro_result, 'ventaid'=> $ventas[$i]->id, 'monto'>= $monto));
				$monto = 0;
			}
			++$i;
			//echo 'total = '. $total. '<br>' . 'montoSaldado = '. $montoSaldado. '<br>' . 'monto = '. $monto. '<br>';
		}
		if ($monto > 0){
			//echo 'total = '. $total. '<br>' . 'montoSaldado = '. $montoSaldado. '<br>' . 'monto = '. $monto. '<br>';
			$this->notaCredito->save(array('cobroid'=> $cobroid, 'monto'=> $monto, 'saldo'=> $monto));
			// Genero la nota de credito con el monto del cobro restante
		}
	}
}

