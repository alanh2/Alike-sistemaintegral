<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/common.js')?>"></script>

<script src="<?php echo base_url('assets/dashboard/js/metisMenu.js')?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/raphael-min.js')?>"></script>
<!--<script src="<?php echo base_url('assets/dashboard/js/morris.min.js')?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/morris-data.js')?>"></script>-->
<script src="<?php echo base_url('assets/dashboard/js/sb-admin-2.js')?>"></script>

<div id="page-wrapper">
    <br/><br/>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="menu">
                    <div class=" titulo">Ventas</div><br><hr/>
                    <a class="link" href="<?php echo site_url('venta/alta_venta/')?>" target="_blank" title="Nueva Venta">Nueva Venta</a><br><hr/>
                    <a class="link " href="<?php echo site_url('venta/')?>" target="_blank" title="Listar Ventas">Listado</a><br><hr/>
                    <?php if(isset($_SESSION['admin'])&&($_SESSION['admin']['jerarquia']<4)){?>  
                    <span class="link">Ver</span>
                    <input onkeyup="javascript: if(event.keyCode == 13) window.open('<?php echo site_url('venta/alta_venta/')?>/'+$('#ventaid').val());" class="form-control" type="text" value="" id="ventaid" placeholder="Venta" />
                    <?php }?>

                </div>
            </div>
            <?php if(isset($_SESSION['admin'])&&($_SESSION['admin']['jerarquia']<4)){?>
            <div class="col-lg-3 col-md-6">
                <div class="menu">
                    <div class=" titulo">Cobros</div><br><hr/>
                    <a class="link" href="<?php echo site_url('cobro/')?>" target="_blank" title="Listar Cobros">Listar Cobros</a><br><hr/>
                    <!--<span class="link">Buscar Cobros</span>
                    <input onkeyup="javascript: if(event.keyCode == 13) window.open('<?php echo site_url('cobro/?search=')?>'+$('#cobroid').val());" class="form-control" type="text" value="" id="cobroid" placeholder="Cobro" />-->

                </div>
            </div>
            <?php }?>
            <div class="col-lg-3 col-md-6">
                <div class="menu">
                    <div class=" titulo">Clientes</div><br><hr/>
                    <a class="link" href="<?php echo site_url('cliente/')?>" target="_blank" title="Listar Clientes">Listado</a><br><hr/>
                    <span class="link">Buscar Cliente</span>
                    <input onkeyup="javascript: if(event.keyCode == 13) window.open('<?php echo site_url('cliente/?search=')?>'+$('#clienteid').val());" class="form-control" type="text" value="" id="clienteid" placeholder="Cliente" />

                </div>
            </div>  
            <div class="col-lg-3 col-md-6">
                <div class="menu">
                    <div class=" titulo">Productos</div><br><hr/>
                    <?php if(isset($_SESSION['admin'])&&($_SESSION['admin']['jerarquia']<4)){?><a class="link" href="<?php echo site_url('producto/')?>" target="_blank" title="Productos">Listado</a><br><hr><?php }?>
                    <a class="link" href="<?php echo site_url('producto/lista_precios/3')?>" target="_blank" title="Gastos">Precios</a><br>
                </div>
            </div>
        </div><br/>
        <div class="row">

                <?php if(isset($_SESSION['admin'])&&($_SESSION['admin']['jerarquia']<4)){?>
            <div class="col-lg-3 col-md-6">
                <div class="menu">
                    <div class=" titulo">Gastos</div><br><hr/>
                    <a class="link" href="<?php echo site_url('gasto/')?>" target="_blank" title="Listar Clientes">Listado</a><br><hr/>
                    <a class="link" href="<?php echo site_url('tipogasto/')?>" target="_blank" title="Listar Clientes">Tipo gastos</a><br><hr/>

                </div>
            </div>

                <?php }?>
            <?php if(isset($permisos['gastos'])){?>  
            <div class="col-lg-3 col-md-6">
                <div class="menu">
                    <div class=" titulo">Admin</div><br><hr/>
                    <a class="link" href="<?php echo site_url('sueldo/')?>" target="_blank" title="Sueldos">Sueldos</a><br><hr/>
                    <a class="link" href="<?php echo site_url('venta/reporte_fin_de_mes/2017-04-01/2017-04-31/')?>" target="_blank" title="Reporte ventas fin de mes">Reporte venta</a><br><hr/>

                </div>
            </div>
            <? } ?>
        </div>
    </div>
</div>
<style type="text/css">
 table.seccion{
    border-radius: 25px;
    padding: 20px;
}
hr{
    padding: 0;
    margin:0;
}
#page-wrapper{
    background-image: url("<?php echo base_url('assets/images/fondo_claro.jpg');?>");
}
.titulo{
    font-size: 20px;
    color: #F0AD4E;
    text-align: center;
}
a{
    text-decoration: none;
}
a:hover{
    text-decoration: none;
}

.panel-heading{
    height: 75px;
}
.link{
    font-size: 30px;    
    color: #FFF;
}
.menu{
    border-radius: 25px;
    padding: 20px;


    border: solid 2px #fff; 
  /*background: #6f6; // without a background or border applied you won't be able to see if its rounded*/
}

</style>