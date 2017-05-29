
<style>

.seccion{
    border-radius: 25px 25px 25px 25px;
    border: 2px solid #73AD21;
    padding: 20px; 
    width: 200px;
    height: 150px;
    width: 680px;
}
body{

}
.renglones{
   border-collapse: collapse;
}
.renglones th{
  border: #aaa solid 2px;
    text-align: center;
}
.renglones td{
  border: #aaa solid 1px;
    text-align: center;
}
.noborder td{
  border:none;
}
*{
  font-family: Helvetica;
  font-size: 14px;
}
</style>
<br/><br/>
<table width="620px" border="0">
<tr>
<td width="170px" height="50px" valign="top">
<img src="<?php echo 'http://systemix.com.ar/sistemaIntegral/assets/images/zocalo_factura.png'; //echo site_url('../assets/images/zocalo_factura.png'); ?>" width="200px">
</td>
<td valign="top" width="80%">
<br>
            <h3>Resumen movimientos cuenta Corriente</h3>
            <br />
            <br />
<table>
<tr><td width="20%">Razón social:</td><td width="40%"><?php echo $data['cliente']->razon_social;?></td></tr>
<tr><td> </td></tr>
<tr><td>Dirección:</td><td><?php echo $data['cliente']->localidad . ', ' . $data['cliente']->direccion;?></td></tr>
<tr><td> </td></tr>
<tr><td>Código postal:</td><td><?php echo $data['cliente']->cp;?>b</td></tr>
<tr><td> </td></tr>
<tr><td>Teléfono:</td><td><?php echo $data['cliente']->tel_numero;?></td></tr>
<tr><td> </td></tr>
<tr><td>Whatsapp:</td><td><?php echo $data['cliente']->tel_codigo_area;?></td></tr>
<tr><td> </td></tr>
<tr><td>Email:</td><td><?php echo $data['cliente']->email;?></td></tr>
<tr><td> </td></tr>
<tr><td>Web:</td><td><?php echo $data['cliente']->web;?></td></tr>
</table>
<br />
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" border="1">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="30%">Tipo</th>
                        <th width="30%">Fecha</th>
                        <th width="30%">Total</th>
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
       echo '<tr><td>'.$k->id.'</td><td>'.$k->tipo.'</td><td>'.$k->fecha.'</td><td>'.$k->monto.'</td></tr>';
    $total+=$k->monto;
    }
 ?>
    <tr><td colspan="4"></td></tr>
    <tr><td colspan="3"><b>Saldo hasta el día (<?php echo date('Y-m-d H:i:s')?>)</b></td><td><b><?php echo $total;?></b></td></tr>
                </tbody>
            </table>     
</td>
</tr>
</table>

<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>