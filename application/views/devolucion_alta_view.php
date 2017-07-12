        <div id="page-wrapper">

            <br>

            <h3></h3>
<?php
    $ventaid ='';
    if (isset($venta)){
        $ventaid = $venta->id;
    }
?>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vendedor: <?php echo $venta->vendedor;?></span>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cliente: <?php echo $venta->cliente;?></span>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha: <?php echo $venta->fecha;?></span>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total: $<?php echo $venta->total;?></span>
            <br />
            <br />

            <br />

            <br />

            <!--
            <button id="selectAll" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Todos a stock</button>
            <button id="unselectAll" class="btn btn-danger"><i class="glyphicon glyphicon-minus"></i> Seleccionar todos</button>-->
            <button class="btn btn-primary save">Guardar</button>
            <button class="btn btn-success all2stock"><i class="glyphicon glyphicon-list"></i> Todos a STOCK</button>
            <button class="btn btn-success all2RMA"><i class="glyphicon glyphicon-list"></i> Todos a RMA</button>
            <form>
            
            <br/><br/><br/>
            <div class="form-group">
                <div class="col-md-6">
                <span class="form-control" style="text-align: center; font-weight: bold;">Efectivo</span>
                <input type="radio" name="cashonota" value="1" class="form-control"><br/>
                <span class="form-control" style="text-align: center; font-weight: bold;">Nota de credito</span>
                <input type="radio" name="cashonota" value="2" class="form-control" id="cashonota">
                    <span class="help-block"></span>
                </div>
            </div>
            
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th style="width:25px;">ID</th>

                        <th>Producto</th>

                        <th>Precio</th>

                        <th>Accion</th>
                    </tr>

                </thead>

                <tbody>

                </tbody>

    

                <tfoot>

                    <tr>

                        <th>ID</th>

                        <th>Producto</th>

                        <th>Precio</th>

                        <th>Accion</th>

                    </tr>

                </tfoot>

            </table>
            </form> 
            <button class="btn btn-primary save">Guardar</button>
            <button class="btn btn-success all2stock"><i class="glyphicon glyphicon-list"></i> Todos a STOCK</button>
            <button class="btn btn-success all2RMA"><i class="glyphicon glyphicon-list"></i> Todos a RMA</button> 

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

        $('#producto').focus();

        //$(this).find('[autofocus]').focus();

    });

    

    $("#modal_form").on('hidden.bs.modal', function () {

        $(this).data('bs.modal', null);

    });

    

    $('#form').submit(function(event) {

        save();

        $('#nombre').attr('disabled',true); 

        $('#name').attr('disabled',true); 

        event.preventDefault();

    });

    //datatables
    
    table = $('#table').DataTable({ 

        "paging": false,

        "responsive": true,

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.

         // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('venta/ajax_renglones_para_devolucion/'.$venta->id)?>",

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

            "sInfo":           "Mostrando unidades del _START_ al _END_ de un total de _TOTAL_ renglones",

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
$('#table tbody').on( 'click', 'tr', function () {
        //$(this).toggleClass('selected');
    } );
//$("input:radio:even:eq(0)").prop("checked", true) seleccionar un index indicado
    $('.all2stock').click(function(){
        $("input:radio:even:gt(0)").prop("checked", true).trigger("click");
    });
    $('.all2RMA').click(function(){
        $("input:radio:odd:gt(0)").prop("checked", true).trigger("click");
    });
   /* $('#selectAll').click(function(){
        $(table.rows().nodes()).addClass('selected');
    });
    $('#selectAll').click(function(){
        $(table.rows().nodes()).addClass('selected');
    });
    $('#unselectAll').click(function(){
        $(table.rows().nodes()).removeClass('selected');
    });*/
     
    $('.save').click( function () {
         var devoluciones = $('form').serialize();
         console.log(devoluciones);
         //var devoluciones=[];
         /*table.rows('.selected').data().each(function(a){
            if(typeof  devoluciones[a[0]] === 'undefined') {
                devoluciones[a[0]]=0;
            }
            devoluciones[a[0]]++;
         });
         //console.log(devoluciones);
         //console.log('JSON: ');
         console.log(JSON.stri*ngify(devoluciones));
         */
         /*var prueba = [];
         prueba[0]= 'a';
         prueba[1]= 'b';
         jsonPrueba = JSON.stringify(prueba);
         console.log(jsonPrueba);
*/
        url = "<?php echo site_url('devolucion/ajax_add/'.$ventaid)?>";

         $.ajax({

            url : url,

            type: "POST",

            data:devoluciones,

            //Options to tell jQuery not to process data or worry about content-type.

            dataType: "JSON",

            success: function(data)

            {



                if(data.status) //if success close modal and reload ajax table

                {

                    //CARTEL Y REENVIO? QUE HAGO ACA, ES EL RESULTADO EXITOSO;

                    //alert("Alta exitosa")

                    //parent.location.reload(true); 

                    //window.close();
                    window.location.href = '<?php echo site_url("venta/ver_detalles/").'/'.$ventaid ?>';

                }

                else

                {

                    for (var i = 0; i < data.inputerror.length; i++) 

                    {

                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class

                        $('[id="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string

                    }

                }

                $('#btnSave').text('guardar'); //change button text

                $('#btnSave').attr('disabled',false); //set button enable 





            },

            error: function (jqXHR, textStatus, errorThrown)

            {

                alert('Error agregando / modificando producto');

                $('#btnSave').text('guardar'); //change button text

                $('#btnSave').attr('disabled',false); //set button enable 



            }

        });
    } );

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

        url = "<?php echo site_url('venta/ajax_add_renglon')?>";

    } else {

        url = "<?php echo site_url('venta/ajax_update_renglon')?>";

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



function delete_renglon(id)

{

    if(confirm('Esta seguro que desea borrar este renglon?'))

    {

        // ajax delete data to database

        $.ajax({

            url : "<?php echo site_url('venta/ajax_delete_renglon')?>/"+id,

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



<!-- Bootstrap modal -->
<style>
.ui-front{
    z-index: 99999;
}
.panel .nombre{
    margin-top:12px;
    text-align: center;
    font-size: 20px;
}
.panel .nombre > span {
    font-family: arial;
}
.panel .puntaje {
    font-size: 20px;
    line-height: 70px;
    text-align: center;
}
.panel .huge{
    font-size: 30px;
}
.panel .leyenda{
    font-size: 10px;
}
.panel .col-xs-3.alfa{
    padding-left: 0px;
}
.menuVentas .col-xs-3{
    padding-left: 10px;
    padding-right: 10px;
}
@media all and (max-width: 560px) {
    .panel .fa-5x{
        font-size: 9vw;
    }
    .menuVentas .col-xs-3{
        padding-left: 5px;
        padding-right: 5px;
        text-align: center;
    }
}
table.dataTable tbody tr.selected{background-color:#11c67e}

</style>
<!-- End Bootstrap modal -->