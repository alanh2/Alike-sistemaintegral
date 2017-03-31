        <div id="page-wrapper">

            <br>

            <h3>Stock</h3>

            <br />

            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>

            <br />

            <br />
<style>
    tr td:nth-child(2) {
    display:none;
}
</style>
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th style="width:25px;">ID</th>

                        <th style="display:none;">Codigo</th>

                        <th>Marca</th>

                        <th>Modelo</th>

                        <th>Categoria</th>

                        <th><strong>Nombre</strong></th>

                        <th>Cantidad</th>

                        <th style="width:225px;">Accion</th>

                    </tr>

                </thead>

                <tbody>

                </tbody>

    

                <tfoot>

                    <tr>

                        <th>ID</th>

                        <th style="display:none;">Codigo</th>

                        <th>Marca</th>

                        <th>Modelo</th>

                        <th>Categoria</th>

                        <th><strong>Nombre</strong></th>

                        <th>Cantidad</th>

                        <th>Action</th>

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



    //datatables

    table = $('#table').DataTable({ 



		"responsive": true,

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.

		 // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('stock/ajax_list')?>",

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

	$select_categorias = $('#categoria');

	//request the JSON data and parse into the select element

	$.ajax({

		url: "<?php echo site_url('categoria/ajax_dropdown')?>"

		, "type": "POST"

		, data:{length:'',start:0}

		, dataType: 'JSON'

		, success: function (data) {

			//clear the current content of the select

			$select_categorias.html('');

			//iterate over the data and append a select option

			$.each(data.categorias, function (key, val) {

				$select_categorias.append('<option value="' + val.id + '">' + val.nombre + '</option>');

			})

		}

		, error: function () {

			//if there is an error append a 'none available' option

			$select_categorias.html('<option id="-1">ninguna disponible</option>');

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



});



function edit_stock(id)

{

    save_method = 'update';

    $('#form')[0].reset(); // reset form on modals

    $('.form-group').removeClass('has-error'); // clear error class

    $('.help-block').empty(); // clear error string



    //Ajax Load data from ajax

    $.ajax({

        url : "<?php echo site_url('stock/ajax_edit/')?>/" + id,

        type: "GET",

        dataType: "JSON",

        success: function(data)

        {

			

			$('[name="id"]').val(data.stock_id);

            $('[name="nombre"]').val(data.nombre+" - "+data.color);

            $('[name="cantidad"]').val(data.cantidad);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded

            $('.modal-title').text('Ajustar Stock'); // Set title to Bootstrap modal title



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

        url = "<?php echo site_url('stock/ajax_add')?>";

    } else {

        url = "<?php echo site_url('stock/ajax_update')?>";

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





        },

        error: function (jqXHR, textStatus, errorThrown)

        {

            alert('Error adding / update data');

            $('#btnSave').text('guardar'); //change button text

            $('#btnSave').attr('disabled',false); //set button enable 



        }

    });

}





</script>



<!-- Bootstrap modal -->

<div class="modal fade" id="modal_form" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h3 class="modal-title">Formulario de Productos</h3>

            </div>

            <div class="modal-body form">

                <form action="#" id="form" class="form-horizontal">

                    <input type="hidden" value="" name="id"/> 

                    <div class="form-body">

                        <div class="form-group">

                            <label class="control-label col-md-3">Nombre</label>

                            <div class="col-md-9">

                                <input name="nombre" placeholder="Nombre" class="form-control" type="text" disabled="disabled">

                                <span class="help-block"></span>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-md-3">Cantidad</label>

                            <div class="col-md-9">

                                <input name="cantidad" placeholder="Cantidad" class="form-control" type="text">

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

<!-- End Bootstrap modal -->