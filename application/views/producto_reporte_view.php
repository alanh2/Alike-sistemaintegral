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
<table width="620px" border="0">
<tr>
<td width="170px" height="50px" valign="top">
<img src="<?php echo 'http://systemix.com.ar/sistemaIntegral/assets/images/zocalo_factura.png'; //echo site_url('../assets/images/zocalo_factura.png'); ?>" width="200px">
</td>
<td valign="top" width="80%">
    <br>
            <h3>Reporte productos</h3>
            <br />
            <br />
    <table border="0" class="renglones">
    <thead>
        <tr>
            <th>ID(S/PC/P)</th>
            <th>Local</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Subcategoria</th>
            <th>Nombre</th>
            <th>Color</th>
            <?php if(isset($_GET['mostrar_cantidad'])){?><th>Cantidad</th><?php }?>
            <?php if(isset($_GET['mostrar_costo'])){?><th>Costo</th><?php }?>
            <?php if((isset($_GET['mostrar_cantidad']))&&(isset($_GET['mostrar_costo']))) { ?><th>Cantidad * Costo</th><?php }?>
            <?php if(isset($_GET['mostrar_l1'])){?><th>1</th><?php }?>
            <?php if(isset($_GET['mostrar_l2'])){?><th>2</th><?php }?>
            <?php if(isset($_GET['mostrar_l3'])){?><th>3</th><?php }?>
            <?php if(isset($_GET['mostrar_l4'])){?><th>4</th><?php }?>
        </tr>
    </thead>
    <?php
    $totalCantidad=0;
    $totalCostoCantidad=0;

    foreach ($data['reporte'] as $producto) {
        if( true){// $producto->l1!=0 || $producto->l2!=0 || $producto->l3!=0 || $producto->l4!=0 ){
            $costoCantidad= $producto->cantidad*$producto->costo;;
            $totalCantidad+=$producto->cantidad;
            $totalCostoCantidad+=$costoCantidad;
    ?>
        <tr>
        <td><?php echo $producto->S_PC_P;?></td>
        <td><?php echo $producto->local;?></td>
        <td><?php echo $producto->marca;?></td>
        <td><?php echo $producto->modelo;?></td>
        <td><?php echo $producto->subcategoria;?></td>
        <td><?php echo $producto->producto;?></td>
        <td><?php echo $producto->color;?></td>


            <?php if(isset($_GET['mostrar_cantidad'])){?><td><?php echo $producto->cantidad;?></td><?php }?>
            <?php if(isset($_GET['mostrar_costo'])){?><td><?php echo $producto->costo;?></td><?php }?>
            <?php if((isset($_GET['mostrar_cantidad']))&&(isset($_GET['mostrar_costo']))) { ?><td><?php echo $costoCantidad;?></td><?php }?>
            <?php if(isset($_GET['mostrar_l1'])){?><td>$<?php echo $producto->l1;?></td><?php }?>
            <?php if(isset($_GET['mostrar_l2'])){?><td>$<?php echo $producto->l2;?></td><?php }?>
            <?php if(isset($_GET['mostrar_l3'])){?><td>$<?php echo $producto->l3;?></td><?php }?>
            <?php if(isset($_GET['mostrar_l4'])){?><td>$<?php echo $producto->l4;?></td><?php }?>

        <!--<td><?php echo $producto->cantidad;?></td>
        <td><?php echo $producto->costo;?></td>
        <td><?php echo $costoCantidad;?></td>

        <td>$<?php echo $producto->l1;?></td>
        <td>$<?php echo $producto->l2;?></td>
        <td>$<?php echo $producto->l3;?></td>
        <td>$<?php echo $producto->l4;?></td>-->
        </tr>
         
    <?php 
        }
    }?>
    </table>            
</td>
</tr>
</table>

<?php if(isset($_GET['mostrar_cantidad'])){?>
    <h3>Cantidad total de articulos en stock:<?php echo $totalCantidad;?></h3>
    <?php if(isset($_GET['mostrar_costo'])){?>
    <h3>Cantidad total costo en articulos:<?php echo $totalCostoCantidad;?></h3>
    <?php }?>
<?php }?>
<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>