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
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
<?php
$tipo_operacion = array('0','Cobro','Envio','Venta','Nota de Crédito');
$total=0;
    foreach ($data['movimientos'] as $k) {
        $monto = $k->saldo_actual-$k->saldo_anterior;
        echo '<tr><td>'.$k->operacionid.'</td><td>'.$tipo_operacion[$k->tipo_operacionid].'</td><td>'.$k->fecha.'</td><td>$'.$monto.'</td></tr>';
        $total+=$monto;
    }
 ?>
 <tr><td></td><td><b>Total</b></td><td><b>Fecha de impresion:<?php echo date('Y-m-d H:i:s')?></b></td><td><b><?php echo '$'. $total;?></b></td></tr>
                </tbody>
    
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                </tfoot>
            </table> 
<?php $this->view('common/abm_simple'); ?>
<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>