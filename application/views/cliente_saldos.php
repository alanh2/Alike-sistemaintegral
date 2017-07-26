
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
            <h3>Resumen Saldos</h3>
            <br />
            <br />
<br />
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" border="1">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="45%">Razon social</th>
                        <th width="45%">Saldo</th>
                    </tr>
                </thead>
                <tbody>
<?php
$total=0;
    foreach ($data['saldos'] as $k) {
       echo '<tr><td>'.$k->id.'</td><td>'.$k->razon_social.'</td><td>'.$k->saldo.'</td></tr>';
    $total+=$k->monto;
    }
 ?>
    <tr><td colspan="4"></td></tr>
                </tbody>
            </table>     
</td>
</tr>
</table>

<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>