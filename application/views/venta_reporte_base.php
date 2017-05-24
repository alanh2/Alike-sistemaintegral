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
    <table border="0" class="renglones">
    <thead>
        <tr>
    <td>id</td>
    <td>vendedorid</td>
    <td>clienteid</td>
    <td>fecha</td>
    <td>total</td>
    <td>envioid</td>
    <td>descuento</td>
    <td>metodo_pagoid</td>
    <td>estadoid</td>
    <td>saldada</td>
    <td>cuentacorriente</td>
    <td>vendedor</td>
    <td>estado_nombre</td>
    <td>cliente</td>
    <td>tel_codigo_area</td>
    <td>tel_numero</td>
    <td>cel_numero</td>
    <td>direccion</td>
    <td>cp</td>
    <td>email</td>
    <td>dni</td>
    <td>cuitcuil</td>
    <td>web</td>
    <td>ranking</td>
    <td>localidad</td>
        </tr>
    </thead>
    <?php
    foreach ($data['reporte'] as $r) {
        if( true){// $producto->l1!=0 || $producto->l2!=0 || $producto->l3!=0 || $producto->l4!=0 ){
    ?>
    <tr>
    <td><?php echo $r->id;?></td>
    <td><?php echo $r->vendedorid;?></td>
    <td><?php echo $r->clienteid;?></td>
    <td><?php echo $r->fecha;?></td>
    <td><?php echo $r->total;?></td>
    <td><?php echo $r->envioid;?></td>
    <td><?php echo $r->descuento;?></td>
    <td><?php echo $r->metodo_pagoid;?></td>
    <td><?php echo $r->estadoid;?></td>
    <td><?php echo $r->saldada;?></td>
    <td><?php echo $r->cuentacorriente;?></td>
    <td><?php echo $r->vendedor;?></td>
    <td><?php echo $r->estado_nombre;?></td>
    <td><?php echo $r->cliente;?></td>
    <td><?php echo $r->tel_codigo_area;?></td>
    <td><?php echo $r->tel_numero;?></td>
    <td><?php echo $r->cel_numero;?></td>
    <td><?php echo $r->direccion;?></td>
    <td><?php echo $r->cp;?></td>
    <td><?php echo $r->email;?></td>
    <td><?php echo $r->dni;?></td>
    <td><?php echo $r->cuitcuil;?></td>
    <td><?php echo $r->web;?></td>
    <td><?php echo $r->ranking;?></td>
    <td><?php echo $r->localidad;?></td>
    </tr>
     
    <?php 
        }
    }?>
    </table>            
</td>
</tr>
</table>

<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>