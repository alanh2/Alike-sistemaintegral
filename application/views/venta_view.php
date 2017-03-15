        <div id="page-wrapper">

            <br>

            <h3>Ventas</h3>

            <br />

            <button id="agregar" class="btn btn-success" onclick="window.open('http://systemix.com.ar/sistemaIntegral/index.php/venta/alta_venta/')"><i class="glyphicon glyphicon-plus"></i> Agregar Venta</button>

            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>

            <br />

            <br />

            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th style="width:25px;">ID</th>

                        <th>Cliente</th>

                        <th>Fecha</th>

                        <th>Total</th>

                        <th>Vendedor</th>

                        <th style="width:225px;">Accion</th>

                    </tr>

                </thead>

                <tbody>

                </tbody>

    

                <tfoot>

                    <tr>

                        <th>ID</th>

                        <th>Cliente</th>

                        <th>Fecha</th>

                        <th>Total</th>

                        <th>Vendedor</th>

                        <th>Accion</th>

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

            "url": "<?php echo site_url('venta/ajax_list')?>",

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



function edit_venta(id)

{

    save_method = 'update';

    $('#form')[0].reset(); // reset form on modals

    $('.form-group').removeClass('has-error'); // clear error class

    $('.help-block').empty(); // clear error string



    //Ajax Load data from ajax

    $.ajax({

        url : "<?php echo site_url('venta/ajax_edit/')?>/" + id,

        type: "GET",

        dataType: "JSON",

        success: function(data)

        {

            

            $('[name="id"]').val(data.id);

            $('[name="nombre"]').val(data.nombre);

            $('[name="categoria"]').val(data.categoriaid);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded

            $('.modal-title').text('Editar Venta'); // Set title to Bootstrap modal title



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

        url = "<?php echo site_url('venta/ajax_add')?>";

    } else {

        url = "<?php echo site_url('venta/ajax_update')?>";

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



function delete_venta(id)

{

    if(confirm('Esta seguro que desea borrar esta venta?'))

    {

        // ajax delete data to database

        $.ajax({

            url : "<?php echo site_url('venta/ajax_delete')?>/"+id,

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



</script>

