<?php

    $movimientos = array();
    foreach ($data['ventas'] as $k) {
        $movimientos[] = array('Venta', $k->id, $k->monto, $k->fecha);
    }
    foreach ($data['notas_credito'] as $k) {
        $movimientos[] = array('Nota de crédito', $k->id, $k->monto, $k->fecha);
    }
    foreach ($data['cobros'] as $k) {
        $movimientos[] = array('Cobro', $k->id, $k->monto, $k->fecha);
    }
echo json_encode($movimientos);
?>
        <div id="page-wrapper">
            <br>
            <h3>Clientes</h3>
            <br />
            <br />
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th style="width:225px;">Accion</th>
                    </tr>
                </thead>
                <tbody>
<?php 
    /*foreach ($movimientos as $k) {
       echo '<tr><td>'.$k['tipo'].'</td><td>'.$k['fecha'].'</td><td>'.$k['monto'].'</td><td></td></tr>';
    }*/
 ?>
                </tbody>
    
                <tfoot>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th style="width:225px;">Accion</th>
                    </tr>
                </tfoot>
            </table> 
        </div>

<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    
    //datatables
    table = $('#table').DataTable({ 
        "data": <?php echo json_encode($movimientos); ?>,
        "responsive": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
         // Load data for the table's content from an Ajax source
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

</script>
