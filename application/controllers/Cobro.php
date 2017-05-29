<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model('cobro_model','cobro');
		$this->load->model('cobro_renglones_model','cobroRenglones');
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
		$no = $_POST['start'];
		foreach ($list as $cobro) {
			$no++;
			$row = array();
			$row[] = $cobro->id;
			$row[] = $cobro->razon_social;
			$row[] = $cobro->monto;
			$row[] = $cobro->fecha;
			$row[] = $cobro->metodo_pago;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a> '
				  .'<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
		
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
	
	public function ajax_add($ventaid=NULL)
	{
		$monto = $this->input->post('monto');
		if ($ventaid != NULL && $this->venta->total_debido_by_venta($ventaid, $monto) == 1 && $monto > 0)
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
	        		"monto" => $monto,
	        	);

			$metodoid = $this->transaccion->add_transaccion($datametodo['metodo'],1,$datametodo);
	        $datacobro = array(
	        		"monto" => $monto,
	        		"metododepagoid" => $this->input->post('metodo'),
	        		"clienteid" => $this->input->post('cliente'),
	        		"fecha" => date('Y-m-d H:i:s'),
	        		"metodoid" => $metodoid,
	        	);
			$cobroid = $this->cobro->save($datacobro);

			if ($ventaid!=NULL){
				$this->aplicacionCobroVenta->save(array("cobroid" => $cobroid, "ventaid" => $ventaid, "monto" => $monto));
			}

			///////////////////////////////////////////////////
			///Agregar registro en detalle cuenta corriente////
			///////////////////////////////////////////////////

/*			if ($datametodo['metodo'] != 5){ // si no es un cobro del metodo cuenta corriente/nota de credito, intenta saldar ventas adeudadas
				$monto = $this->pagar_deudas($this->input->post('cliente'), $monto);
				$this->pagar_ventas_pendientes($this->input->post('cliente'), $cobroid, $monto);
			}*/
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

		}else{
			$output['resultado'] = 'Error, supera monto total de venta';
		}
		echo json_encode($output);
	}

	public function ajax_update($ventaid=NULL)
	{
		$monto = $this->input->post('monto');
		$cobroid = $this->input->post('id');
		if ($ventaid != NULL && $this->venta->total_debido_by_venta($ventaid, $monto, $cobroid) == 1 && $monto > 0)
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
	        		"monto" => $monto,
	        	);

			$metodoid = $this->transaccion->actualizar($datametodo);

	        $datacobro = array(
	        		"monto" => $monto,
	        		"metododepagoid" => $this->input->post('metodo'),
	        		"clienteid" => $this->input->post('cliente'),
	        		"fecha" => date('Y-m-d H:i:s'),
	        		"metodoid" => $metodoid,
	        	);
			$this->cobro->update(array('id' => $cobroid),$datacobro);

			if ($ventaid!=NULL){
				$this->aplicacionCobroVenta->update(array("cobroid" => $cobroid, "ventaid" => $ventaid), array("monto" => $monto));
			}

			///////////////////////////////////////////////////
			///Modificar registro en detalle cuenta corriente//
			///////////////////////////////////////////////////

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
		}else{
			$output['resultado'] = 'Error, supera monto total de venta';
		}
		echo json_encode($output);
	}
	
	public function ajax_delete($id)
	{
		$cobro = $this->cobro->get_by_id($id);
		$this->db->trans_begin();
		$this->cobro->delete_by_id($id);
		$this->transaccion->eliminar($cobro->metododepagoid, $cobro->metodoid);
		$this->aplicacionCobroVenta->delete_by_cobroid($id);

		///////////////////////////////////////////////////
		///Modificar registro en detalle cuenta corriente//
		///////////////////////////////////////////////////

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
		if ($monto > 0){
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
					$this->aplicacionCobroVenta->save(array('cobroid'=> $cobroid, 'ventaid'=> $ventas[$i]->id, 'monto'>= $monto));
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

	private function pagar_deudas($clienteid, $monto){
		if ($monto > 0){
			$deudas = $this->cuentaCorriente->get_deudas($clienteid);
			$cantidadDeudas = count($deudas);
			$i = 0;
			while( $monto >  0 && $i < $cantidadDeudas){
				$saldoRestante = $this->cuentaCorriente->get_saldo_deuda($deudas[$i]->id);

				if(($monto - $saldoRestante) >= 0){ //Saldo de la deuda
					$this->transaccion->update('mov_cuentacorrientes', array('id' => $deudas[$i]->id),array('saldo' => 0));
					$monto = $monto - $saldoRestante;
				}else{
					$this->transaccion->update('mov_cuentacorrientes',array('id' => $deudas[$i]->id),array('saldo' => $saldoRestante - $monto));
					$monto = 0;
				}
				++$i;
			}
		}
		return $monto;
	}

	public function ajax_detalle($id)
	{
		$this->load->helper('url');

		$list = $this->cobroRenglones->get_datatables($id);

		$data = array();
		if(isset($_POST['start'])){
			$start=$_POST['start'];
		}else{
			$start=0;
		}
		$no = $start;
		foreach ($list as $cobro) {
			$no++;
			$row = array();
			$row[] = $cobro->id;
			$row[] = $cobro->fecha;
			$row[] = '$'+$cobro->monto;
			$row[] = $cobro->metodo_pago;
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Editar</a> '
				  .'<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_cobro('."'".$cobro->id."'".')"><i class="glyphicon glyphicon-trash"></i> Borrar</a>';
			$data[] = $row;
		}
		$output = array(
						"recordsTotal" => $this->cobroRenglones->count_all($id),
						"recordsFiltered" => $this->cobroRenglones->count_filtered($id),
						"data" => $data,
				);
		echo json_encode($output);
	}
}

