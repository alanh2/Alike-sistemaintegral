<style>

.seccion{
    border-radius: 25px 25px 25px 25px;
    border: 2px solid #73AD21;
    padding: 20px; 
    width: 200px;
    height: 150px;
    width: 680px;
}
body{

}
.renglones{
    border-collapse: collapse;

}
.renglones th{
    border: #aaa solid 2px;
    text-align: center;
}
.renglones td{
    padding: 5px;
    border: #aaa solid 1px;
    text-align: center;
}
.noborder td{
    border:none;
}
*{
    font-family: Helvetica;
    font-size: 14px;
}
</style>
<br/><br/>
<table width="620px" border="0" >
<tr>
<td width="170px" height="50px" valign="top">
<img src="<?php echo 'http://systemix.com.ar/sistemaIntegral/assets/images/zocalo_factura.png'; //echo site_url('../assets/images/zocalo_factura.png'); ?>" width="200px">
</td>
<td valign="top" width="80%">
    <br>
            <h3>Lista Ventas</h3>
            <br />
            <br />
    <table border="0" class="renglones" width="100%" id="table">
    <thead>
        <tr>
            <th style="width:25px;" >id</th>
            <th>fecha</th>
            <th>total</th>
            <th>cuentacorriente</th>
            <th>vendedor</th>
            <th>Estado</th>
            <th>cliente</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>id</th>
            <th>fecha</th>
            <th>total</th>
            <th>cuentacorriente</th>
            <th>vendedor</th>
            <th>Estado</th>
            <th>cliente</th>
        </tr>
    </tfoot>
    <?php 
    foreach ($data['reporte'] as $r) {
        if( true){// $producto->l1!=0 || $producto->l2!=0 || $producto->l3!=0 || $producto->l4!=0 ){
    ?>
    <tr>
        <td><?php echo $r->id;?></td>
        <td><?php echo $r->fecha;?></td>
        <td><?php echo $r->total;?></td>
        <td><?php echo $r->cuentacorriente;?></td>
        <td><?php echo $r->vendedor;?></td>
        <td><?php echo $r->estado_nombre;?></td>
        <td><?php echo $r->cliente;?></td>
    </tr>
     
    <?php 
        }
    }
    ?>
    </table>            
</td>
</tr>
</table>
<?php //echo json_encode($data['reporte']);?>
<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>

<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>

<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>

<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script>
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar  '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#table').DataTable({

    "aLengthMenu": [
        [10,25, 50, 100, 200, -1],
        [10,25, 50, 100, 200, "All"]
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

        },
       /* "responsive": true,

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.

         // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('venta/ajax_reporte_simple/2007-01-01/2020-01-01')?>",

            "type": "POST"

        },*/
    });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>   