<style>
@page{size:auto; margin-bottom:5mm;}
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
    padding: 5px;
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
<table width="100%" border="0">
<tr>
<td width="170px" height="50px" valign="top">
<img src="<?php echo 'http://systemix.com.ar/sistemaIntegral/assets/images/zocalo_factura.png'; //echo site_url('../assets/images/zocalo_factura.png'); ?>" width="200px">
</td>
<td valign="top" width="80%">
    <br>
            <h3>Reporte ventas</h3>
            <br />
            <br />
    <table border="0" class="renglones">
    <thead>
        <tr>
            <th style="width:25px;" >Num</th>
            <th style="width:25px;" >id</th>
            <th>fecha</th>
            <th>local</th>
            <th>total</th>
            <th>costo</th>
            <!--<th>cuentacorriente</th>-->
            <th>vendedor</th>
            <th>cliente</th>
            <th>Estado</th>
        </tr>
    </thead>
    <?php
    $totalTotales=0;
    //$totalCostoCantidad=0;
    $i=1;
    foreach ($data['reporte'] as $venta) {
        if( true){// $venta->l1!=0 || $venta->l2!=0 || $venta->l3!=0 || $venta->l4!=0 ){
            $totalTotales += $venta->total;
    ?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $venta->id?></td>
        <td><?php echo $venta->local;?></td>
        <td><?php echo $venta->fecha;?></td>
        <td><?php echo $venta->total;?></td>
        <td><?php echo $venta->costo_venta;?></td>
        <!--<td><?php echo $venta->cuentacorriente;?></td>-->
        <td><?php echo $venta->vendedor;?></td>
        <td><?php echo $venta->cliente;?></td>
        <td><?php echo $venta->estado_nombre;?></td>

        </tr>
         
    <?php 
        $i++;   
        }
    }?>
    </table>            
</td>
</tr>
</table>
<div align="center"><h3>Total vendido: $<?php echo $totalTotales;?></h3></div>
<div align="center"><h3><?php echo $i.'ventas';?></h3></div>
<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>