<div id="page-wrapper">

    <br>

    <h3></h3>
    <br />
    <div class="col-12">
      <a href="<?php echo site_url('Pdfs/imprimir_venta/'.$venta->id)?>" target="_blank"><i class="fa fa-print"></i>Imprimir</div></a>
<div class="col-md-6 alpha">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info"></i> Información general <a href="<?php echo site_url('venta/alta_venta/'.$venta->id); ?>" class="fa fa-edit pull-right"></a></h3>
      </div>
      <div class="panel-body">
    <div class="row">
        <label for="Vendedor" class="col-xs-6">Vendedor:</label> <div class="col-xs-6"><?php echo $venta->vendedor;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Cliente:</label> <div class="col-xs-6"><?php echo $venta->cliente;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Fecha:</label> <div class="col-xs-6"><?php echo $venta->fecha;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Descuento aplicado:</label> <div class="col-xs-6"><?php echo $venta->descuento;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Monto total:</label> <div class="col-xs-6">$<?php echo $venta->total;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Estado:</label> <div class="col-xs-6"><?php echo $venta->estado_nombre;?></div>
    </div>
    <div class="row">
        <label for="Cliente" class="col-xs-6">Cuenta corriente:</label> <div class="col-xs-6">No</div>
    </div>
      </div>
    </div>
</div>
<div class="col-md-12 alpha omega">
    <div class="panel panel-primary">
        <div class="panel-heading col-md-12">
            <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Productos</h3>
        </div>
        <div class="panel-body alpha omega">
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th style="width:25px;">ID</th>

                        <th>Producto</th>

                        <th>Precio</th>

                        <th>Cantidad</th>

                        <th>Subtotal</th>

                    </tr>

                </thead>

                <tbody>

                </tbody>



                <tfoot>

                    <tr>

                        <th>ID</th>

                        <th>Producto</th>

                        <th>Precio</th>

                        <th>Cantidad</th>

                        <th>Subtotal</th>

                    </tr>

                </tfoot>

            </table>
        </div>
    </div>
</div>
<button id="agregar" class="btn btn-success" onclick="add_envio()"><i class="glyphicon glyphicon-plus"></i> Agregar Envio</button>
<div class="col-md-12 alpha omega">
    <div class="panel panel-warning">
        <div class="panel-heading col-md-12">
        <h3 class="panel-title"><i class="fa fa-truck"></i> Envios</h3>
        </div>
        <div class="panel-body alpha omega">

            <table id="enviosdt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:25px;">ID</th>
                        <th>Fecha estimada</th>
                        <!--th>Monto</th-->
                        <th>Metodo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Fecha estimada></th>
                        <!--th>Monto</th-->
                        <th>Metodo</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<button id="agregar" class="btn btn-success" onclick="add_cobro()"><i class="glyphicon glyphicon-plus"></i> Agregar Cobro</button>
<div class="col-md-12 alpha omega">
    <div class="panel panel-success">
        <div class="panel-heading col-md-12">
        <h3 class="panel-title"><i class="fa fa-money"></i> Cobros</h3>
        </div>
        <div class="panel-body alpha omega">

            <table id="cobrosdt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th style="width:25px;">ID</th>
                        <th>Fecha</th>
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
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Metodo</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="col-md-12 alpha omega">
    <div class="panel panel-danger">
        <div class="panel-heading col-md-12">
    <h3 class="panel-title"><i class="fa fa-undo"></i> Devolucion</h3>

        </div>
        <div class="panel-body alpha omega">
            <table id="devolucion" class="table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th style="width:25px;">ID</th>

                        <th>Producto</th>

                        <th>Cantidad</th>

                    </tr>

                </thead>

                <tbody>

                </tbody>



                <tfoot>

                    <tr>

                        <th>ID</th>

                        <th>Producto</th>

                        <th>Cantidad</th>

                    </tr>

                </tfoot>

            </table> 
        </div>
    </div>
</div>

</div>



<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>

<script src="<?php echo base_url('assets/jquery/jquery-ui.js')?>"></script>

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
$(document).ready(function() {
    //datatables
    table = $('#table').DataTable({ 
        "sDom": 'rt<"top"i><"clear">', //Sacar el cuadro de busqueda
        "paging": false,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                //'$'+pageTotal +' ( $'+ total +' total)'//Esto es para cuando hay paginacion
                '$'+ total +' total'
            );
        },

        "responsive": true,

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.

         // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('venta/ajax_detalle/'.$venta->id)?>",

            "type": "POST"

        },

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

            "sInfo":           "En total son _TOTAL_ productos distintos",

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
    });//end datatable
    devolucion = $('#devolucion').DataTable({ 
        "sDom": 'rt<"top"i><"clear">', //Sacar el cuadro de busqueda
        "paging": false,

        "responsive": true,

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.

         // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('devolucion/ajax_detalle/'.$venta->id)?>",

            "type": "POST"

        },

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

            "sInfo":           "En total son _TOTAL_ productos distintos",

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

envios = $('#enviosdt').DataTable({ 
        "sDom": 'rt<"top"i><"clear">', //Sacar el cuadro de busqueda
        "paging": false,
/*        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                //'$'+pageTotal +' ( $'+ total +' total)'//Esto es para cuando hay paginacion
                '$'+ total +' total'
            );
        },*/
        "responsive": true,

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.

         // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('envio/ajax_detalle/'.$venta->id)?>",

            "type": "POST"

        },

        "columnDefs": [

        { 

            "targets": [ -1], //last column

            "orderable": false, //set not orderable

        },

        ],

        "language":{

            "sProcessing":     "Procesando...",

            "sLengthMenu":     "Mostrar _MENU_ envios",

            "sZeroRecords":    "No se encontraron resultados",

            "sEmptyTable":     "Ningún dato disponible en esta tabla",

            "sInfo":           "En total son _TOTAL_ envios distintos",

            "sInfoEmpty":      "Mostrando envios del 0 al 0 de un total de 0 envios",

            "sInfoFiltered":   "(filtrado de un total de _MAX_ envios)",

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

cobros = $('#cobrosdt').DataTable({ 
        "sDom": 'rt<"top"i><"clear">', //Sacar el cuadro de busqueda
        "paging": false,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                //'$'+pageTotal +' ( $'+ total +' total)'//Esto es para cuando hay paginacion
                '$'+ total +' total'
            );
        },
        "responsive": true,

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.

         // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('cobro/ajax_detalle/'.$venta->id)?>",

            "type": "POST"

        },

        "columnDefs": [

        { 

            "targets": [ -1], //last column

            "orderable": false, //set not orderable

        },

        ],

        "language":{

            "sProcessing":     "Procesando...",

            "sLengthMenu":     "Mostrar _MENU_ cobros",

            "sZeroRecords":    "No se encontraron resultados",

            "sEmptyTable":     "Ningún dato disponible en esta tabla",

            "sInfo":           "En total son _TOTAL_ cobros distintos",

            "sInfoEmpty":      "Mostrando cobros del 0 al 0 de un total de 0 cobros",

            "sInfoFiltered":   "(filtrado de un total de _MAX_ cobros)",

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

</script>
<style>
.ui-front{
    z-index: 99999;
}

.btn.btn-success {
    float: left;
    margin-bottom: 20px;
}
#cobros.panel-body {
    height: 95px;
    overflow: auto;
}
@media all and (max-width: 992px) {
    .alpha, .omega {
        padding-left: 0;
        padding-right: 0;
    }
}
</style>
<!-- End Bootstrap modal -->
<?php
    $this->view('_cobro_modal_view.php');
    $this->view('_envio_modal_view.php');
?>