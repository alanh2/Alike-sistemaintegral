        <div id="page-wrapper">
            <br>
            <h3>Envios</h3>
            <br />
            <button id="agregar" class="btn btn-success" onclick="add_envio()"><i class="glyphicon glyphicon-plus"></i> Agregar Envio</button>
            <button class="btn btn-default" onclick="reload_envios()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
            <br />
            <br />
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:25px;">ID</th>
                        <th>Fecha estimada</th>
                        <th>Monto</th>
                        <th>Metodo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Fecha estimada</th>
                        <th>Monto</th>
                        <th>Metodo</th>
                        <th>Acciones</th>
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
<script src="<?php echo base_url('assets/dashboard/js/sb-admin-2.js')?>"></script>

<script type="text/javascript">
var envios;

$(document).ready(function() {
	$(document).keypress(function(event) {
		if(event.charCode==43){//+
			$("#agregar").trigger("click");
		}
		//alert('Handler for .keypress() called. - ' + event.charCode);
	});
    //datatables
    envios = $('#table').DataTable({ 

		"responsive": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
		 // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('envio/ajax_list')?>",
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

});


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
<?php
    $this->view('_envio_modal_view.php');
?>