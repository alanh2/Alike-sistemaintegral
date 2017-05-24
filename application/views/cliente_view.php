<style type="text/css">
    #mensajesAnteriores{
        width: 100%;
        float: left;
        border-top: 1px solid #000;
        max-height: 270px;
        overflow-y: auto;
    }
    #mensajesAnteriores .fa{
        color:#ffd119;
    }
    .mensaje, .comentario, .puntaje{
        float:left;
    }
    .mensaje{
        position: relative;
        margin-top: 10px;
    }
    .mensaje a{
        position: absolute;
        top: 0;
        right: -5px;
    }
    .modal-body {
        float: left;
        padding: 15px;
        position: relative;
        width: 100%;
    }
</style>
        <div id="page-wrapper">
            <br>
            <h3>Clientes</h3>
            <br />
            <button id="agregar" class="btn btn-success" onclick="add_cliente()"><i class="glyphicon glyphicon-plus"></i> Agregar Cliente</button>
            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
            <br />
            <br />
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:25px;">ID</th>
                        <th>Razon social</th>
                        <th>Tel</th>
                        <th>Whatsapp</th>
                        <th>Direccion</th>
                        <th>Localidad</th>
                        <th>Email</th>
                        <th>Web</th>

                        <th style="width:225px;">Accion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
    
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Razon social</th>
                        <th>Tel</th>
                        <th>Whatsapp</th>
                        <th>Direccion</th>
                        <th>Localidad</th>
                        <th>Email</th>
                        <th>Web</th>
                        <th style="width:225px;">Accion</th>
                    </tr>
                </tfoot>
            </table> 
        </div>

<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>




<?php $this->view('common/abm_simple'); ?>

<script type="text/javascript">

var save_method; //for save method string
var table;
var modal_abierto=false;

$(document).ready(function() {
    
    $("#modal_comentario").on('hidden.bs.modal', function () {
        $(this).data('bs.modal', null);
    });
    $('#modal_comentario').on('shown.bs.modal', function () {
    $('#comentario').focus();
        //$(this).find('[autofocus]').focus();
    });
	$('#form').submit(function(event) {
		save();
		$('#nombre').attr('disabled',true); 
		event.preventDefault();
	});

    //datatables
    table = $('#table').DataTable({ 
        "oSearch": {"sSearch": search},
		"responsive": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
		 // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('cliente/ajax_list')?>",
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
	
    //get a reference to the select element
    $select_provincias = $('#provincia');
    //request the JSON data and parse into the select element
    $.ajax({
        url: "<?php echo site_url('provincia/ajax_dropdown')?>"
        , "type": "POST"
        , data:{length:'',start:0}
        , dataType: 'JSON'
        , success: function (data) {
            //clear the current content of the select
            $select_provincias.html('');
            //iterate over the data and append a select option
            $.each(data.provincias, function (key, val) {
                $select_provincias.append('<option value="' + val.id + '">' + val.nombre + '</option>');
            });

        }
        , error: function () {
            //if there is an error append a 'none available' option
            $select_provincias.html('<option id="-1">ninguna disponible</option>');
        }

    });

    $('#provincia').change(function(event,localidadid) {
        //get a reference to the select element
    	$select_localidades = $('#localidad');
    	//request the JSON data and parse into the select element
    	$.ajax({
    		url: "<?php echo site_url('localidad/ajax_dropdown')?>"
    		, "type": "POST"
    		, data:{length:'',start:0,provincia:$('#provincia').val()}
    		, dataType: 'JSON'
    		, success: function (data) {
    			//clear the current content of the select
    			$select_localidades.html('');
    			//iterate over the data and append a select option
    			$.each(data.localidades, function (key, val) {
    				$select_localidades.append('<option value="' + val.id + '">' + val.nombre + '</option>');
    			})
                if(!isNaN(localidadid)){
                    $('[name="localidad"]').val(localidadid).trigger('change');
                }
    		}
    		, error: function () {
    			//if there is an error append a 'none available' option
    			$select_localidades.html('<option id="-1">ninguna disponible</option>');
    		}

    	});
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

});



function add_cliente()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('[name="provincia"]').val('3').trigger('change')
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Agregar Clientes'); // Set Title to Bootstrap modal title
}
function add_mensaje(clienteid)
{


    $('#formMensaje .form-group').removeClass('has-error'); // clear error class
    $('#formMensaje .help-block').empty(); // clear error string
    $('#modal_comentario .modal-title').text('Agregar mensaje'); // Set Title to Bootstrap modal title
    $('[name="clienteidmensaje"]').val(clienteid);
    _cargar_mensajes(clienteid);
}
function _reset_mensajes(clienteid){
    $('#formMensaje')[0].reset(); // reset form on modals
    $("input[name=puntaje]").val("");
    $('#star1 a').removeClass('fa-star');
    $('#star1 a').addClass('fa-star-o');
    _cargar_mensajes(clienteid);
}
function _cargar_mensajes(clienteid){
        $.ajax({
        url : "<?php echo site_url('comentariocliente/ajax_list/')?>/" + clienteid,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            var promedio = parseFloat(0);
            var cantidad = parseFloat(0);
            var resultado ="";
            $.each(data, function(i, item) {
                resultado= resultado+'<div class="row mensaje mensaje'+item[0]+' col-md-12"><label class="comentario col-md-12">'+item[1]+'</label><label class="puntaje col-md-12">';
                for(i=0;i<item[2];i++){
                    resultado = resultado+'<i class="fa fa-star"></i>';
                }
                resultado = resultado+'</label><a href="javascript: delete_mensaje('+item[0]+')">X</a></div>';
                promedio = parseFloat(promedio) + parseFloat(item[2]);
                cantidad++;
            });
            resultado = '</label></div>' + resultado;
            promedio = Math.round((parseFloat(promedio) / cantidad)*2); //multiplico para agarrar los medios
            estrellas ='';
            for(i=1;i<promedio;i=i+2){
                estrellas = estrellas + '<i class="fa fa-star"></i>';
            }
            if (promedio - i == 1 ){ 
                estrellas = estrellas + '<i class="fa fa-star-half-o"></i>';
            }
            resultado = estrellas + resultado;

            resultado = '<div class="row mensaje col-md-12"><label class="comentario col-md-12">Puntaje promedio: '+resultado;
            $('#mensajesAnteriores').html(resultado);
            $('#modal_comentario').modal('show'); // show bootstrap modal when complete loaded
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
function edit_cliente(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('cliente/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('[name="id"]').val(data.id);
            $('[name="razon_social"]').val(data.razon_social);
            //$('[name="tel_codigo_area"]').val(data.tel_codigo_area);
            $('[name="tel_numero"]').val(data.tel_numero);
            $('[name="cel_numero"]').val(data.cel_numero);
            $('[name="direccion"]').val(data.direccion);
            $('[name="provincia"]').val(data.provinciaid).trigger('change',data.localidadid);
            //$('[name="localidad"]').val(data.localidadid);
            $('[name="cp"]').val(data.cp);
            $('[name="email"]').val(data.email);
            $('[name="dni"]').val(data.dni);
            $('[name="web"]').val(data.web);
            //$('[name="cuil"]').val(data.cuil);
            //$('[name="cuit"]').val(data.cuit);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Cliente'); // Set title to Bootstrap modal title

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
        url = "<?php echo site_url('cliente/ajax_add')?>";
    } else {
        url = "<?php echo site_url('cliente/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
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
function saveMensaje()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url = "<?php echo site_url('comentariocliente/ajax_add/')?>";
    $.ajax({
        url : url,
        type: "POST",
        data: $('#formMensaje').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                //$('#modal_comentario').modal('hide');
               _reset_mensajes($('[name="clienteidmensaje"]').val());


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
function delete_cliente(id)
{
    if(confirm('Esta seguro que desea borrar este cliente?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('cliente/ajax_delete')?>/"+id,
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

function delete_mensaje(id)
{
    if(confirm('Esta seguro que desea borrar este mensaje?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('comentariocliente/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                _cargar_mensajes($('[name="clienteidmensaje"]').val());
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Formulario de Cliente</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Razon social</label>
                            <div class="col-md-9">
                                <input id="nombre" name="razon_social" placeholder="Razon social" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Telefono</label>
                            <div class="col-md-9">
                                <input id="tel_numero" name="tel_numero" placeholder="Telefono" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Whatsapp</label>
                            <div class="col-md-9">
                                <input id="tel_celular" name="tel_celular" placeholder="Whatsapp" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">Direccion</label>
                            <div class="col-md-9">
                                <input id="direccion" name="direccion" placeholder="Direccion" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Provincia</label>
                            <div class="col-md-9">
                                <select id="provincia" name="provincia" class="form-control">
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Localidad</label>
                            <div class="col-md-9">
                                <select id="localidad" name="localidad" class="form-control">
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input id="email" name="email" placeholder="Email" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">DNI</label>
                            <div class="col-md-9">
                                <input id="dni" name="dni" placeholder="DNI" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Cuil / Cuit</label>
                            <div class="col-md-9">
                                <input id="cuitcuil" name="cuitcuil" placeholder="Cuil / Cuit" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sitio Web</label>
                            <div class="col-md-9">
                                <input id="web" name="web" placeholder="Sitio Web" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
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
<div class="modal fade" id="modal_comentario" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Comentario de Cliente</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="formMensaje" class="form-horizontal">
                    <input type="hidden" value="" id="clienteidmensaje" name="clienteidmensaje"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Comentario</label>
                            <div class="col-md-9">
                                <input id="comentario" name="comentario" placeholder="Comentario" class="form-control" type="text" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Puntaje</label>
                            <div class="col-md-9">
                                <div class='starrr' id='star1'></div>
                                <input id="puntaje" name="puntaje" type="hidden">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="mensajesAnteriores"></div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="saveMensaje()" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/starrr.css')?>">
<script src="<?php echo base_url('assets/js/starrr.js')?>"></script>
<script type="text/javascript">
(window.jQuery, window);

    $('#star1').starrr({
      change: function(e, value){
        if (value) {
          $('#puntaje').val(value);
        }
      }
    });
</script>
<!-- End Bootstrap modal -->