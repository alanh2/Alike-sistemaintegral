<?php switch ($venta->localid){
    case '2':
      $zocalo='http://systemix.com.ar/sistemaIntegral/assets/images/zocalo_factura_salvacell.jpg';
    break;
    case '3':
      $zocalo='http://systemix.com.ar/sistemaIntegral/assets/images/zocalo_factura_seicell.jpg';
    break;
    default:
      $zocalo='http://systemix.com.ar/sistemaIntegral/assets/images/zocalo_factura.png';
}?>
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
}
.renglones td{
  border: #aaa solid 1px;
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
<img src="<?php echo $zocalo; //echo site_url('../assets/images/zocalo_factura.png'); ?>" width="200px">
</td>
<td valign="top" width="80%">
  <table width="100%" border="0">
    <tr>
    <td width="30%"> </td>
      <td width="40%" style="text-align: right;" valign="top"><div style="text-align: center;"><span style="font-size: 50px">X</span><br/>No valido como factura</div></td>
      <td width="30%" align="left" valign="top">
        <div><span>Remito Nro: <span style="font-weight: bold;"><?php echo $venta->id;?></span></span><br/>
        <span><?php echo $venta->fecha?></span><br/>
        <span>Fecha de impresión</span><br/><span><?php echo date("Y-m-d H:i:s");?></span><br/>
        </div>
      </td>
    </tr>
  </table>
  <hr>
  <div class=""><span>Sres: </span><span><?php echo $venta->cliente;?></span><br/><br/>
    <span>Domicilio: </span><span><?php echo $venta->direccion;?></span><br/><br/>
    <span><?php echo $venta->localidad;?></span><br/><br/>
    <span>IVA:</span><span>Consumidor Final</span><br/><br/>
    <span>Telefono:</span><span><?php echo $venta->tel_numero;?></span><br/><br/>
    <span>Mail:</span><span><?php echo $venta->email;?></span><br/><br/>  
  </div>
  <hr>

  <div>
    <table width="100%" class="renglones">
      <thead>
      <tr>
        <th width="12%">Código</th>
        <th width="50%">Descripción</th>
        <th width="10%">CANT</th>
        <th width="13%">P.UNIT.</th>
        <th width="15%">P.TOTAL</th>
      </tr>
      </thead>
      <?php
      foreach ($venta_renglones as $key=>$renglon){
        //print_r($renglon);
        echo "<tr><td>".$renglon->stockid."</td><td>".$renglon->producto." ".$renglon->color."</td><td>".$renglon->cantidad."</td><td>".$renglon->precio_unitario."</td><td>".$renglon->total_renglon."</td></tr>";
      }
      /*for($i=0;$i<=40;$i++){
        echo"<tr><td>".$i."</td></tr>";
      }*/
      ?>
      <!--<tr><td>S4</td><td>Modelo s4 samsung con doble chapa y led</td><td>5</td><td>$30</td><td>$150</td></tr>
      <tr><td>S4</td><td>Desc....</td><td>5</td><td>$30</td><td>$150</td></tr>
      <tr><td>S4</td><td>Desc....</td><td>5</td><td>$30</td><td>$150</td></tr>
      <tr><td>S4</td><td>Desc....</td><td>5</td><td>$30</td><td>$150</td></tr>
      <tr><td colspan="99" class="noborder" style="height: 20px"></td></tr>-->
      <tr><td width="12%">Total</td><td width="68%"></td><td width="20%"><?php echo $venta->total;?></td></tr>
    </table><br/><br/>
    <br/>Cobros<br/>

    <table width="100%" class="renglones">
    <?php //=print_r($venta_cobros)
    foreach ($venta_cobros as $key=>$renglon){
    //print_r($renglon);
    echo "<tr><td>".$renglon->fecha."</td><td>".$renglon->metodo_cobro_nombre."</td><td>".$renglon->monto."</td></tr>";
    }
    ?>
    </table>
    <br/><br/>

Fuiste atendido por: <?php echo $venta->vendedor;?>
  </div>
    
</td>
</tr>
</table>
