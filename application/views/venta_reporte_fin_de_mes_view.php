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
<table  border="0" >
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
            <th>cuentacorriente</th>
            <th>total</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>id</th>
            <th>fecha</th>
            <th>cuentacorriente</th>
            <th>total</th>
        </tr>
    </tfoot>
    <?php 
    foreach ($data['reporte'] as $r) {
        if( true){// $producto->l1!=0 || $producto->l2!=0 || $producto->l3!=0 || $producto->l4!=0 ){
    ?>
    <tr>
        <td><?php echo $r->id;?></td>
        <td><?php echo $r->fecha;?></td>
        <td><?php if($r->cuentacorriente==0){echo 'no';}else {echo 'si';}?></td>
        <td><?php echo $r->total;?></td>
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
    
    // DataTable
    var table = $('#table').DataTable({

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
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column(3 ).footer() ).html(
                //'$'+pageTotal +' ( $'+ total +' total)'//Esto es para cuando hay paginacion
                'total $'+ total
            );
            $( api.column(3 ).header() ).html(
                //'$'+pageTotal +' ( $'+ total +' total)'//Esto es para cuando hay paginacion
                'total $'+ total
            );
        },
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
    });
 
} );
</script>   