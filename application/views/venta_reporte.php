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
<table width="620px" border="0">
<tr>
<td width="170px" height="50px" valign="top">
<img src="<?php echo 'http://systemix.com.ar/sistemaIntegral/assets/images/zocalo_factura.png'; //echo site_url('../assets/images/zocalo_factura.png'); ?>" width="200px">
</td>
<td valign="top" width="80%">
    <br>
            <h3>Lista Ventas</h3>
            <br />
            <br />
    <table border="0" class="renglones" width="100%">
    <thead>
        <tr>
    <td>id</td>
    <td>fecha</td>
    <td>total</td>
    <td>cuentacorriente</td>
    <td>vendedor</td>
    <td>estado_nombre</td>
    <td>cliente</td>
        </tr>
    </thead>
    <?php
    foreach ($data['reporte'] as $r) {
        if( true){// $producto->l1!=0 || $producto->l2!=0 || $producto->l3!=0 || $producto->l4!=0 ){
    ?>
    <tr>
    <td><?php echo $r->id;?></td>
    <td><?php echo $r->fecha;?></td>
    <td><?php echo $r->total;?></td>
    <td><?php echo $r->cuentacorriente;?></td>
    <td><?php echo $r->vendedor;?></td>
    <td><?php echo $r->estado_nombre;?></td>
    <td><?php echo $r->cliente;?></td>
    </tr>
     
    <?php 
        }
    }?>
    </table>            
</td>
</tr>
</table>
<?php echo json_encode($data['reporte']);?>
<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>