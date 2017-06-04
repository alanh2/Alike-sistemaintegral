        <div id="page-wrapper">
            <br>
            <h3>Cobros</h3>
            <br />
            <button id="agregar" class="btn btn-success" onclick="add_cobro()"><i class="glyphicon glyphicon-plus"></i> Agregar Cobro</button>
            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
            <br />
            <br />
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:25px;">ID</th>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Método de pago</th>
                        <th style="width:150px;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
    
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Método de pago</th>
                        <th>Acción</th>
                    </tr>
                </tfoot>
            </table> 
        </div>

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

<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
	$(document).keypress(function(event) {
		if(event.charCode==43){//+
			$("#agregar").trigger("click");
		}
		//alert('Handler for .keypress() called. - ' + event.charCode);
	});
	$('#modal_form').on('shown.bs.modal', function () {
		$('#nombre').focus();
		//$(this).find('[autofocus]').focus();
	});
	
	$("#modal_form").on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null);
	});
	
	$('#form').submit(function(event) {
		save();
		$('#nombre').attr('disabled',true); 
		event.preventDefault();
	});
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


    $select_clientes = $('#clientes');
    $.ajax({
        url: "<?php echo site_url('cliente/ajax_dropdown')?>"
        , "type": "POST"
        , data:{length:'',start:0}
        , dataType: 'JSON'
        , success: function (data) {
            $select_clientes.html('');
            $.each(data.clientes, function (key, val) {
                $select_clientes.append('<option value="' + val.id + '">' + val.nombre + '</option>');
            })
        }
        , error: function () {
            $select_clientes.html('<option id="-1">ninguna disponible</option>');
        }
    });

    //datatables
    table = $('#table').DataTable({ 

		"responsive": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
		 // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('cobro/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1], //last column
            "orderable": false, //set not orderable
        },
        ],
		"language":{
		    "sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			}
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
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Agregar Cobro'); // Set Title to Bootstrap modal title
    $('#nombre').focus();
}

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

function edit_cobro(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
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
            $("#clientes").val(data.clienteid);
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

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Cobro'); // Set title to Bootstrap modal title
            $('[name="clientes"]').focus();

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('cobro/ajax_add')?>";
    } else {
        url = "<?php echo site_url('cobro/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.resultado == "Ok") //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('guardar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            $('#nombre').attr('disabled',false); 
    		$('#form')[0].reset(); // reset form on modals

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('guardar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
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
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}



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
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Formulario de Cobro</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="mov_tabla_id_anterior"/>
                    <input type="hidden" name="metodo_anterior"/>
                    <div class="form-group">
                        <label class="control-label col-md-5">Cliente</label>
                        <div class="col-md-6">
                            <select id="clientes" name="cliente" class="form-control" data-bind="value:metodo">
                            </select>                            <span class="help-block"></span>
                        </div>
                    </div>
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
                            <input id="vencimiento" name="vencimiento" class="form-control datepicker"/>
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
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script type="text/javascript">
    $('.datepicker').datepicker({

    autoclose: true,

    format: "yyyy-mm-dd",

    todayHighlight: true,

    orientation: "top auto",

    todayBtn: true,

    todayHighlight: true,  

});
</script>
<style>
.metodo{
    display: none;
}
</style>