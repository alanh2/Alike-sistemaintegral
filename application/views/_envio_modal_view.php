<?php 
    $ventaidasociada = '';
    if (isset($venta->id)){
        $ventaidasociada = $venta->id;
    }
    $clienteidasociado = '';
    if (isset($venta->clienteid)){
        $clienteidasociado = $venta->clienteid;
    }
 ?>
<script type="text/javascript">
$(document).ready(function() {
    $select_metodos_envio = $('#metodosEnvio');
    $.ajax({
        url: "<?php echo site_url('metodoenvio/ajax_dropdown')?>"
        , "type": "GET"
        , data:{}
        , dataType: 'JSON'
        , success: function (data) {
            $select_metodos_envio.html('');
            $.each(data.metodos, function (key, val) {
                $select_metodos_envio.append('<option value="' + val.id + '">' + val.nombre + '</option>');
            })
        }
        , error: function () {
            $select_metodos_envio.html('<option id="-1">ninguno disponible</option>');

        }

    });
    $("#metodosEnvio").change(function(){
        mostrar_campos_envio($("#metodosEnvio").val());
    });
    $("#clientesEnvio").change(function(){
        $('[name="clienteid"]').val($("#clientesEnvio").val());
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
<?php 
if ($ventaidasociada == ''){ ?> 
    $select_clientes_envio = $('#clientesEnvio');
    $.ajax({
        url: "<?php echo site_url('cliente/ajax_dropdown')?>"
        , "type": "POST"
        , data:{length:'',start:0}
        , dataType: 'JSON'
        , success: function (data) {
            $select_clientes_envio.html('');
            $.each(data.clientes, function (key, val) {
                $select_clientes_envio.append('<option value="' + val.id + '">' + val.nombre + '</option>');
            })
        }
        , error: function () {
            $select_clientes_envio.html('<option id="-1">ninguno disponible</option>');
        }
    });
<?php } ?>
});
    function mostrar_campos_envio(metodo){
        $(".metodoEnvio").hide();
        switch (metodo){
            case "1": //Retira el cliente
                break;
            case "2": //OCA
                $(".metodoEnvio.oca").show();
                break;
            case "3": //OCA Express
                $(".metodoEnvio.ocaexpress").show();
                break;
            case "4": //Moto
                $(".metodoEnvio.moto").show();
                break;
            case "5": //Otros
                $(".metodoEnvio.otros").show();
                break;
        }
        alert
    }
function add_envio()
{
    save_method = 'add';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_envio').modal('show'); // show bootstrap modal
    $('.modal-title').text('Agregar Envio'); // Set Title to Bootstrap modal title
    $('#nombre').focus();
}

function edit_envio(id)
{
    save_method = 'update';
    $('#form_envio')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('envio/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
<?php 
    if ($ventaidasociada == ''){ ?> 
            $("#clientesEnvio").val(data.clienteid);
<?php } ?>
            $('[name="id"]').val(id);
            $("#clienteid").val(data.clienteid);
            $("#metodosEnvio").val(data.metodoenvio);
            $('[name="metodo_anterior"]').val(data.metodoenvio);
            $('[name="mov_tabla_id_anterior"]').val(data.envtablaid);
            $('[name="costo"]').val(data.costo);

            mostrar_campos_envio(data.metodoenvio);

            $('[name="ventaid"]').val(<?php echo $ventaidasociada; ?>);
            $('[name="metodo_envio_anterior"]').val(data.metodoenvio);
            $('[name="env_tabla_id_anterior"]').val(data.envtablaid);
            $('[name="direccion"]').val(data.direccion);
            $('[name="nombre_empresa"]').val(data.nombreempresa);
            $('[name="direccion_empresa"]').val(data.direccionempresa);
            $('[name="tracking"]').val(data.tracking);
            $('[name="recibe"]').val(data.recibe);
            $('[name="dni"]').val(data.dni);
            $('[name="fecha_estimada"]').val(data.fechaestimada);
            
            $('#modal_form_envio').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Envio'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save_envio()
{
    $('#btnEnvioSave').text('saving...'); //change button text
    $('#btnEnvioSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('envio/ajax_add'.'/'.$ventaidasociada)?>";
    } else {
        url = "<?php echo site_url('envio/ajax_update'.'/'.$ventaidasociada)?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_envio').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.resultado == "Ok") //if success close modal and reload ajax table
            {
                $('#modal_form_envio').modal('hide');
                reload_envios();
                $('#form_envio')[0].reset(); // reset form on modals
            }
            else
            {
                alert(data.resultado);
            }
            $('#btnEnvioSave').text('guardar'); //change button text
            $('#btnEnvioSave').attr('disabled',false); //set button enable 
            $('#nombre').attr('disabled',false); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnEnvioSave').text('guardar'); //change button text
            $('#btnEnvioSave').attr('disabled',false); //set button enable 
            $('#nombre').attr('disabled',false); 

        }
    });
}

function delete_envio(id)
{
    if(confirm('Esta seguro que desea borrar este envio?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('envio/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form_envio').modal('hide');
                reload_envios();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
function reload_envios()
{
    envios.ajax.reload(null,false); //reload datatable ajax 
}


</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_envio" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Formulario de Envio</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_envio" class="form-horizontal">
                    <input id="id" name="id" type="hidden"/>
                    <input id="ventaid" name="ventaid" type="hidden"/> 
                    <input id="clienteid" name="clienteid" type="hidden" value="<?php echo $clienteidasociado; ?>"/>
                    <input id="metodo_envio_anterior" name="metodo_envio_anterior" type="hidden"/>
                    <input id="env_tabla_id_anterior" name="env_tabla_id_anterior" type="hidden"/>
<?php               if ($ventaidasociada == ''){ ?>
                    <div class="form-group">
                        <label class="control-label col-md-5">Cliente</label>
                        <div class="col-md-6">
                            <select id="clientesEnvio" name="clienteEnvio" class="form-control"></select>
                            <span class="help-block"></span>
                        </div>
                    </div>
<?php               }   ?>
                    <div class="form-group">
                        <label class="control-label col-md-5">Elija el método de envio</label>
                        <div class="col-md-6">
                            <select id="metodosEnvio" name="metodoEnvio" class="form-control">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-5">Fecha estimada de entrega</label>
                        <div class="col-md-6">
                            <input id="fecha_estimada" name="fecha_estimada" class="form-control datepickerEnvio" value="<? if (isset($envio->fechaestimada)){echo $envio->fechaestimada; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-5">Nombre de quién recibe</label>
                        <div class="col-md-6">
                            <input id="recibe" name="recibe" class="form-control" value="<? if (isset($envio->recibe)){echo $envio->recibe; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-5">DNI de quién recibe</label>
                        <div class="col-md-6">
                            <input id="dni" name="dni" class="form-control" value="<? if (isset($envio->dni)){echo $envio->dni; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodoEnvio moto">
                        <label class="control-label col-md-5">Elija la moto deseada</label>
                        <div class="col-md-6">
                            <select id="motoid" name="motoid" class="form-control" data-bind="value:motoid">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodoEnvio oca ocaexpress moto otros">
                        <label class="control-label col-md-5">Costo ($)</label>
                        <div class="col-md-6">
                            <input id="costo" name="costo" class="form-control" value="<? if (isset($metodo_envio->costo)){echo $metodo_envio->costo; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodoEnvio oca ocaexpress moto otros">
                        <label class="control-label col-md-5">Dirección</label>
                        <div class="col-md-6">
                            <input id="direccion" name="direccion" class="form-control" value="<? if (isset($metodo_envio->direccion)){echo $metodo_envio->direccion; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodoEnvio otros">
                        <label class="control-label col-md-5">Nombre de la empresa</label>
                        <div class="col-md-6">
                            <input id="nombre_empresa" name="nombre_empresa" class="form-control" value="<? if (isset($metodo_envio->nombreempresa)){echo $metodo_envio->nombreempresa; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodoEnvio otros">
                        <label class="control-label col-md-5">Dirección de la empresa</label>
                        <div class="col-md-6">
                            <input id="direccion_empresa" name="direccion_empresa" class="form-control" value="<? if (isset($metodo_envio->direccionempresa)){echo $metodo_envio->direccionempresa; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group metodoEnvio oca ocaexpress moto otros">
                        <label class="control-label col-md-5">Código de seguimiento</label>
                        <div class="col-md-6">
                            <input id="tracking" name="tracking" class="form-control" value="<? if (isset($metodo_envio->tracking)){echo $metodo_envio->tracking; } ?>"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnEnvioSave" onclick="save_envio()" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<style>
.metodoEnvio{
    display: none;
}
</style>
<script type="text/javascript">
    //datepicker
    $('.datepickerEnvio').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
</script>