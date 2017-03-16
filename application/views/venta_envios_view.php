<link href="<?php echo base_url('assets/css/multiple_image_upload.css')?>" rel="stylesheet">

<div id="page-wrapper" data-bind="with:venta">

<style>

.stacked{
    float:left;
}
</style>
    <br />
<?php
    $ventaid ='';
    if (isset($venta)){
        $ventaid = $venta->id;
    }

    $metodo_envioid = 1;
    if (isset($envio)){
        $metodo_envioid = $envio->metodoenvio;
    }
?>
        <div class="header"></div><br />
        
        <?php
            $this->view('venta_menu_view');
        ?>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vendedor: <?php echo $venta->vendedor;?></span>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cliente: <?php echo $venta->cliente;?></span>
            <br />
            <br />
        <div class="form">

            <form action="#" id="form" class="form-horizontal">
                <input id="id" name="id" type="hidden" value="<? if (isset($envio->envioid)){echo $envio->envioid; } ?>"/>

                <input id="ventaid" name="ventaid" type="hidden" value="<?php echo $venta->id ?> " /> 
                
                <input id="clienteid" name="clienteid" type="hidden" value="<?php echo $venta->clienteid ?>"/>
                
                <input id="metodo_envio_anterior" name="metodo_envio_anterior" type="hidden" value="<? if (isset($envio->metodoenvio)){echo $envio->metodoenvio; } ?>" />

                <input id="env_tabla_id_anterior" name="env_tabla_id_anterior" type="hidden" value="<? if (isset($envio->idregistrometodoenvio)){echo $envio->idregistrometodoenvio; } ?>"/>

                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Elija el método de envio</label>
                        <div class="col-md-5">
                            <select id="metodos" name="metodo" class="form-control" data-bind="value:metodo">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Fecha estimada de entrega</label>
                        <div class="col-md-5">
                            <input id="fecha_estimada" name="fecha_estimada" class="form-control datepicker" value="<? if (isset($envio->fechaestimada)){echo $envio->fechaestimada; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Nombre de quién recibe</label>
                        <div class="col-md-5">
                            <input id="recibe" name="recibe" class="form-control" value="<? if (isset($envio->recibe)){echo $envio->recibe; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">DNI de quién recibe</label>
                        <div class="col-md-5">
                            <input id="dni" name="dni" class="form-control" value="<? if (isset($envio->dni)){echo $envio->dni; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodo moto">
                        <label class="control-label col-md-3">Elija la moto deseada</label>
                        <div class="col-md-5">
                            <select id="motoid" name="motoid" class="form-control" data-bind="value:motoid">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodo oca ocaexpress moto otros">
                        <label class="control-label col-md-3">Costo ($)</label>
                        <div class="col-md-5">
                            <input id="costo" name="costo" class="form-control" value="<? if (isset($metodo_envio->costo)){echo $metodo_envio->costo; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodo oca ocaexpress moto otros">
                        <label class="control-label col-md-3">Dirección</label>
                        <div class="col-md-5">
                            <input id="direccion" name="direccion" class="form-control" value="<? if (isset($metodo_envio->direccion)){echo $metodo_envio->direccion; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodo otros">
                        <label class="control-label col-md-3">Nombre de la empresa</label>
                        <div class="col-md-5">
                            <input id="nombre_empresa" name="nombre_empresa" class="form-control" value="<? if (isset($metodo_envio->nombreempresa)){echo $metodo_envio->nombreempresa; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodo otros">
                        <label class="control-label col-md-3">Dirección de la empresa</label>
                        <div class="col-md-5">
                            <input id="direccion_empresa" name="direccion_empresa" class="form-control" value="<? if (isset($metodo_envio->direccionempresa)){echo $metodo_envio->direccionempresa; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodo oca ocaexpress moto otros">
                        <label class="control-label col-md-3">Código de seguimiento</label>
                        <div class="col-md-5">
                            <input id="tracking" name="tracking" class="form-control" value="<? if (isset($metodo_envio->tracking)){echo $metodo_envio->tracking; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>

            </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
        </form>
        </div>
    </div>
</form>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/jquery/jquery-ui.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/common.js')?>"></script>
<script src="<?php echo base_url('assets/knockout/knockout-3.3.0.js')?>"></script>
<script src="<?php echo base_url('assets/knockout/knockoutMapping.js')?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/metisMenu.js')?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/raphael-min.js')?>"></script>
<!--<script src="<?php echo base_url('assets/dashboard/js/morris.min.js')?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/morris-data.js')?>"></script>-->
<script src="<?php echo base_url('assets/dashboard/js/sb-admin-2.js')?>"></script>
<script src="<?php echo base_url('assets/js/multiple_image_upload.js')?>"></script>
<script type="text/javascript">
var table;


$(document).ready(function() {
    $.ajax({
        url: "<?php echo site_url('venta/ajax_venta2/'.$venta->id)?>"
        , "type": "GET"
        , data:{}
        , dataType: 'JSON'
        , success: function (data) {
            $("#ventaid").val(data.id);
            $("#clienteid").val(data.clienteid);
        }
        , error: function () {
        }

    });
    $select_metodos = $('#metodos');
    $.ajax({
        url: "<?php echo site_url('metodoenvio/ajax_dropdown')?>"
        , "type": "GET"
        , data:{}
        , dataType: 'JSON'
        , success: function (data) {
            $select_metodos.html('');
            $.each(data.metodos, function (key, val) {
                $select_metodos.append('<option value="' + val.id + '">' + val.nombre + '</option>');
            })
            $("#metodos").val('<?php echo $metodo_envioid; ?>');
        }
        , error: function () {
            $select_metodos.html('<option id="-1">ninguno disponible</option>');

        }

    });

    $select_motos = $('#motoid');
    $.ajax({
        url: "<?php echo site_url('moto/ajax_dropdown')?>"
        , "type": "GET"
        , data:{}
        , dataType: 'JSON'
        , success: function (data) {
            $select_motos.html('');
            $.each(data.motos, function (key, val) {
                $select_motos.append('<option value="' + val.id + '">' + val.nombre + '</option>');
            })
            <?php if (isset($metodo_envio->motoid)){ ?>
            $("#motoid").val('<?php echo $metodo_envio->motoid; ?>');
            <?php } ?>
        }
        , error: function () {
            $select_motos.html('<option id="-1">ninguno disponible</option>');

        }

    });




    mostrar_campos('<?php echo $metodo_envioid; ?>');

    $("#metodos").change(function(){
        mostrar_campos($("#metodos").val());
    });

    function mostrar_campos(metodo){
        $(".metodo").hide();
        switch (metodo){
            case "1": //Retira el cliente
                break;
            case "2": //OCA
                $(".metodo.oca").show();
                break;
            case "3": //OCA Express
                $(".metodo.ocaexpress").show();
                break;
            case "4": //Moto
                $(".metodo.moto").show();
                break;
            case "5": //Otros
                $(".metodo.otros").show();
                break;
        }
    }
    
});
    //datepicker

    $('.datepicker').datepicker({

        autoclose: true,

        format: "yyyy-mm-dd",

        todayHighlight: true,

        orientation: "top auto",

        todayBtn: true,

        todayHighlight: true,  

    });



    //set input/textarea/select event when change value, remove class error and remove text help block 

    $("input").change(function(){

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();

    });

    $("textarea").change(function(){

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();

    });

    $("select").change(function(){

        $(this).parent().parent().removeClass('has-error');

        $(this).next().empty();

    });





function save()
{

    $('#btnSave').text('saving...'); //change button text

    $('#btnSave').attr('disabled',true); //set button disable 

    var url;

    url = "<?php echo site_url('venta/completar_envio')?>";

    $.ajax({

        url : url,

        type: "POST",

        data: $('#form').serialize(),

        //Options to tell jQuery not to process data or worry about content-type.

        dataType: "JSON",

        success: function(data)

        {

            if(data.resultado == 'Ok') //if success close modal and reload ajax table
            {
                alert("Envio completado");
                window.location.href = '<?php echo site_url("venta/metodo_pago_venta/").'/'.$venta->id ?>';
            }else{
                alert("Complete todos los campos")
            }

            $('#btnSave').text('guardar'); //change button text

            $('#btnSave').attr('disabled',false); //set button enable 

        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error, no pudo ser completado el envio');
            $('#btnSave').text('guardar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
}

window.reset = function (e) {

    e.wrap('<form>').closest('form').get(0).reset();

    e.unwrap();

}

//$('#files').on("change", function(){ reset($('#files'));});

</script>


<style>

.form-group{
    margin-bottom: 5px;
}
.thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
}
.modal-body {
    float: left;
    padding: 15px;
    position: relative;
    width: 100%;
}
.ui-front{
    z-index: 99999;
}
.panel .nombre{
    margin-top:12px;
    text-align: center;
    font-size: 20px;
}
.panel .nombre > span {
    font-family: arial;
}
.panel .puntaje {
    font-size: 20px;
    line-height: 70px;
    text-align: center;
}
.panel .huge{
    font-size: 30px;
}
.panel .leyenda{
    font-size: 10px;
}
.panel .col-xs-3.alfa{
    padding-left: 0px;
}
.menuVentas .col-xs-3{
    padding-left: 10px;
    padding-right: 10px;
}
.metodo, .envios{
    display: none;
}
@media all and (max-width: 560px) {
    .panel .fa-5x{
        font-size: 9vw;
    }
    .menuVentas .col-xs-3{
        padding-left: 5px;
        padding-right: 5px;
        text-align: center;
    }
}
</style>