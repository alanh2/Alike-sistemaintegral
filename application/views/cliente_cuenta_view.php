<?php
/*    foreach ($data['ventas'] as $k) {
        $movimientos[] = array('id' => $k->id, 'tipo' => $k->tipo, 'monto' => $k->monto, 'fecha' => $k->fecha);
    }
    foreach ($data['notas_credito'] as $k) {
        $movimientos[] = array('id' => $k->id, 'tipo' => $k->tipo, 'monto' => $k->monto, 'fecha' => $k->fecha);
    }
    foreach ($data['cobros'] as $k) {
        $movimientos[] = array('id' => $k->id, 'tipo' => $k->tipo, 'monto' => $k->monto, 'fecha' => $k->fecha);
    }
*/
?>
        <div id="page-wrapper">
            <br>
            <h3>Cliente</h3>
            <br />
            <br />
<div class="col-md-5 alpha">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info"></i> Información general</h3>
      </div>
      <div class="panel-body">
    <div class="row">
        <label for="Cliente" class="col-xs-6">Razón social:</label> <div class="col-xs-6"><?php echo $data['cliente']->razon_social;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Dirección :</label> <div class="col-xs-6"><?php echo $data['cliente']->localidad . ', ' . $data['cliente']->direccion;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Código postal:</label> <div class="col-xs-6"><?php echo $data['cliente']->cp;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Teléfono:</label> <div class="col-xs-6"><?php echo $data['cliente']->tel_numero;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Whatsapp:</label> <div class="col-xs-6"><?php echo $data['cliente']->tel_codigo_area;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Email:</label> <div class="col-xs-6"><?php echo $data['cliente']->email;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Web:</label> <div class="col-xs-6"><?php echo $data['cliente']->web;?></div>
    </div>
      </div>
    </div>
</div>
<br />
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
<?php
$total=0;
    foreach ($data['movimientos'] as $k) {
        if($k->tipo=="Cobro"){
            $k->tipo=$k->tipo." (".$k->metodo_pago.")";
            if($k->metodo_pago=="Cuenta Corriente"){
                $k->monto=$k->monto*(-1);
            }
        }
        if($k->tipo=="Venta"){
            //$k->tipo=$k->tipo." (".$k->metodo_pago.")";
                $k->monto=$k->monto*(-1);
        }
       echo '<tr><td>'.$k->tipo.'</td><td>'.$k->fecha.'</td><td>'.$k->monto.'</td></tr>';
       $total+=$k->monto;
    }
 ?>
 <tr><td><b>Total</b></td><td>Fecha de impresion:<?php echo date('Y-m-d H:i:s')?></td><td><?php echo $total;?></td></tr>
                </tbody>
    
                <tfoot>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Total</th>
                    </tr>
                </tfoot>
            </table> 
        </div>
<?php $this->view('common/abm_simple'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script type="text/javascript">
</script>
