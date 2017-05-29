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
            <h3>Lista Precios</h3>
            <br />
            <br />
    <table border="0" class="renglones">
    <thead>
        <tr>
            <th>ID:</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Subcategoria</th>
            <th>Nombre</th>
            <th>Color</th>
            <?php if($data['lista']==null){?>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <?php }else{
                echo "<th>$</th>";
            }?>
        </tr>
    </thead>
    <?php
    foreach ($data['stock'] as $producto) {
        if( true){// $producto->l1!=0 || $producto->l2!=0 || $producto->l3!=0 || $producto->l4!=0 ){
    ?>
    <tr>
    <td><?php echo $producto->id;?></td>
    <td><?php echo $producto->marca;?></td>
    <td><?php echo $producto->modelo;?></td>
    <td><?php echo $producto->subcategoria;?></td>
    <td><?php echo $producto->producto;?></td>
    <td><?php echo $producto->color;?></td>

    <?php if($data['lista']==null){?>
    <td>$<?php echo $producto->l1;?></td>
    <td>$<?php echo $producto->l2;?></td>
    <td>$<?php echo $producto->l3;?></td>
    <td>$<?php echo $producto->l4;?></td>
    <?php }else{
        switch ($data['lista']) {
            case '1':
            echo "<td>".$producto->l1."</td>";
                break;
            case '2':
            echo "<td>".$producto->l2."</td>";
                break;
            case '3':
            echo "<td>".$producto->l3."</td>";
                break;
            case '4':
            echo "<td>".$producto->l4."</td>";
                break;
            default:
            case '4':
            echo "<td><td>";
                break;
                break;
        }
    }?>
    </tr>
     
    <?php 
        }
    }?>
    </table>            
</td>
</tr>
</table>

<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>