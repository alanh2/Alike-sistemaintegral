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
    $select_metodos = $('#metodos');
    $.ajax({
        url: "<?php echo site_url('metodopago/ajax_dropdown')?>"
        , "type": "GET"
        , data:{}
        , dataType: 'JSON'
        , success: function (data) {
            $select_metodos.html('');
            $.each(data.metodos, function (key, val) {
                $select_metodos.append('<option value="' + val.id + '">' + val.nombre + '</option>');
            })
        }
        , error: function () {
            $select_metodos.html('<option id="-1">ninguna disponible</option>');

        }

    });
    function mostrar_campos(metodo){
        $(".metodo").hide();
        switch ($("#metodos").val()){
            case "1":
                break;
            case "2":
                $(".metodo.cheque").show();
                break;
            case "3":
                $(".metodo.mercadopago").show();
                break;
            case "4":
                $(".metodo.transferencia").show();
                break;
            case "7":
                $(".metodo.tarjeta").show();
                break;
        }
    }
    $("#metodos").change(function(){
        mostrar_campos($("#metodos").val());
    });
});

function add_cobro()
{
    save_method = 'add';
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form_cobro').modal('show'); // show bootstrap modal
    $('.modal-title').text('Agregar Cobro'); // Set Title to Bootstrap modal title
    $('#nombre').focus();
}


function edit_cobro(id)
{
    save_method = 'update';
    $('#form_cobro')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('cobro/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(id);
            $("#cliente").val(data.clienteid);
            $("#metodos").val(data.metododepagoid);
            $('[name="metodo_anterior"]').val(data.metododepagoid);
            $('[name="mov_tabla_id_anterior"]').val(data.metodoid);
            $('[name="monto"]').val(data.monto);

            mostrar_campos(data.metododepagoid);
            $('[name="vencimiento"]').val(data.vencimiento);
            $('[name="banco"]').val(data.banco);
            $('[name="numeracion"]').val(data.numeracion);
            $('[name="titular"]').val(data.titular);
            $('[name="digitos"]').val(data.digitos);
            $('[name="fecha"]').val(data.fecha);
            $('[name="codigomp"]').val(data.codigomp);
            $('[name="codigo_operacion"]').val(data.codigo_operacion);
            if (data.pagado == 1){
               $('[name="pagado"]').prop("checked",true);
            }
            
            $('#modal_form_cobro').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Cobro'); // Set title to Bootstrap modal title
            $('[name="cliente"]').focus();

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save_cobro()
{
    $('#btnCobroSave').text('saving...'); //change button text
    $('#btnCobroSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('cobro/ajax_add'.'/'.$ventaidasociada)?>";
    } else {
        url = "<?php echo site_url('cobro/ajax_update'.'/'.$ventaidasociada)?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form_cobro').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.resultado == "Ok") //if success close modal and reload ajax table
            {
                $('#modal_form_cobro').modal('hide');
                reload_cobros();
                $('#form_cobro')[0].reset(); // reset form on modals
            }
            else
            {
                alert(data.resultado);
            }
            $('#btnCobroSave').text('guardar'); //change button text
            $('#btnCobroSave').attr('disabled',false); //set button enable 
            $('#nombre').attr('disabled',false); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnCobroSave').text('guardar'); //change button text
            $('#btnCobroSave').attr('disabled',false); //set button enable 
            $('#nombre').attr('disabled',false); 

        }
    });
}

function delete_cobro(id)
{
    if(confirm('Esta seguro que desea borrar este cobro?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('cobro/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form_cobro').modal('hide');
                reload_cobros();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
function reload_cobros()
{
    cobros.ajax.reload(null,false); //reload datatable ajax 
}
    //datepicker

</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_cobro" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Formulario de Cobro</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_cobro" class="form-horizontal">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="mov_tabla_id_anterior"/>
                    <input type="hidden" name="metodo_anterior"/>
                    <input type="hidden" id="cliente" name="cliente" value="<?php echo $clienteidasociado; ?>" />
                    <div class="form-group">
                        <label class="control-label col-md-5">Elija el método de pago</label>
                        <div class="col-md-6">
                            <select id="metodos" name="metodo" class="form-control" data-bind="value:metodo">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-5">Monto ($)</label>
                        <div class="col-md-6">
                            <input id="monto" name="monto" class="form-control" value=""/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group tarjeta transferencia metodo">
                        <label class="control-label col-md-5">Titular</label>
                        <div class="col-md-6">
                            <input id="tarjetas_titular" name="titular" class="form-control"/>
                            <span class="help-block"></span>
                        </div>                          
                    </div>
                    <div class="form-group tarjeta cheque metodo">
                        <label class="control-label col-md-5">Vencimiento</label>
                        <div class="col-md-6">
                            <input id="vencimiento" name="vencimiento" class="form-control datepickerCobro"/>
                            <span class="help-block"></span>
                        </div>                          
                    </div>
                    <div class="form-group tarjeta metodo">
                        <label class="control-label col-md-5">Últimos 4 dígitos</label>
                        <div class="col-md-6">
                            <input type="number" pattern="{0,9}[4]" id="digitos" name="digitos" class="form-control" maxlength="4"/>
                            <span class="help-block"></span>
                        </div>                          
                    </div>
                    <div class="form-group transferencia metodo">
                       <label class="control-label col-md-5">Fecha</label>
                        <div class="col-md-6">
                            <input id="fecha" name="fecha" class="form-control datepicker"/>
                            <span class="help-block"></span>
                        </div>                         
                    </div>
                    <div class="form-group cheque transferencia metodo">
                        <label class="control-label col-md-5">Banco</label>
                        <div class="col-md-6">
                            <input id="banco" name="banco" class="form-control"/>
                            <span class="help-block"></span>
                        </div>                          
                    </div>
                    <div class="form-group cheque metodo">
                        <label class="control-label col-md-5">Numeración</label>
                        <div class="col-md-6">
                            <input id="numeracion" name="numeracion" class="form-control"/>
                            <span class="help-block"></span>
                        </div>                          
                    </div>
                    <div class="form-group mercadopago metodo">
                       <label class="control-label col-md-5">Codigo MercadoPago</label>
                        <div class="col-md-6">
                            <input id="codigomp" name="codigomp" class="form-control"/>
                            <span class="help-block"></span>
                        </div>                         
                    </div>
                    <div class="form-group transferencia metodo">
                       <label class="control-label col-md-5">Codigo Operación</label>
                        <div class="col-md-6">
                            <input id="codigo_operacion" name="codigo_operacion" class="form-control"/>
                            <span class="help-block"></span>
                        </div>                         
                    </div>
                    <div class="form-group cheque tarjeta mercadopago metodo">
                       <label class="control-label col-md-5">Pagado</label>
                        <div class="col-md-6">
                            <input id="codigo_operacion" type="checkbox" name="pagado" class="form-control"/>
                            <span class="help-block"></span>
                        </div>                         
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCobroSave" onclick="save_cobro()" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<style>
.metodo{
    display: none;
}
</style>
<script type="text/javascript">
    //datepicker
    $('.datepickerCobro').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
</script>