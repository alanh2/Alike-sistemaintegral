        <div id="page-wrapper">

            <br>

            <h3></h3>
<?php
    $ventaid ='';
    if (isset($venta)){
        $ventaid = $venta->id;
    }
?>
        <?php
            $this->view('venta_menu_view');
        ?>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vendedor: <?php echo $venta->vendedor;?></span>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cliente: <?php echo $venta->cliente;?></span>
            <br />
            <br />

            <button id="agregar" class="btn btn-success" onclick="add_renglon()"><i class="glyphicon glyphicon-plus"></i> Agregar Renglon</button>

            <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>

            <br />

            <br />

            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>

                    <tr>

                        <th style="width:25px;">ID</th>

                        <th>Producto</th>

                        <th>Precio</th>

                        <th>Cantidad</th>

                        <th>Subtotal</th>

                        <th style="width:225px;">Accion</th>

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

                        <th>Accion</th>

                    </tr>

                </tfoot>

            </table> 





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
var autocompleteProductos=[];
$.ajax({

        url: "<?php echo site_url('producto/ajax_autocomplete')?>"

        , "type": "POST"

        , data:{length:'',start:0}

        , dataType: 'JSON'

        , success: function (data) {


            //iterate over the data and append a select option

            $.each(data.productos, function (key, val) {
                var producto=
                                {
                                    id:val.id,
                                    codigo: val.codigo,
                                    label: val.marca+" "+val.modelo+" "+val.nombre,
                                    nombre: val.nombre,
                                    modelo: val.modelo,
                                    marca:val.marca,
                                    subcategoria:val.subcategoria
                                };
                             
                autocompleteProductos.push(producto);
            })

        console.log(autocompleteProductos);
        }

        , error: function () {

            //if there is an error append a 'none available' option

            //$select_colores.html('<option id="-1">ninguno disponible</option>');

        }

    });
    /*autocompleteProductos = [
        {
            codigo: "1",
            label: "IPHONE - LCD - 4S",
            nombre:"512G",
            marca:"IPHONE",
            modelo:"4S",
            categoria:"LCD",
        },{
            codigo: "2",
            label: "IPHONE - LCD - 5S",
            nombre:"513G",
            marca:"IPHONE",
            modelo:"5S",
            categoria:"LCD",
        },{
            codigo: "3",
            label: "SAMSUNG - LCD - S7",
            nombre:"514G",
            marca:"IPHONE",
            modelo:"S7",
            categoria:"LCD",
        },{
            codigo: "4",
            label: "SAMSUNG - LCD - S7EDGE",
            nombre:"512T",
            marca:"SAMSUNG",
            modelo:"S7EDGE",
            categoria:"LCD",
        }
    ];
    console.log(autocompleteProductos);*/
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
        $p=$('#producto').autocomplete({
          minLength: 0,
          source: autocompleteProductos,
          focus: function( event, ui ) {
            $('#producto').val( ui.item.nombre );
            $('#productoValue').val( ui.item.id );
          },
          change: function( event, ui ) {
            $('#producto').val( ui.item.nombre );
            $('#productoValue').val( ui.item.id );
          },
          select: function( event, ui ) {
            $('#producto').val( ui.item.nombre);
            $('#productoValue').val( ui.item.id );
            return false;
          }
        });
    $('#producto').change(function() {

        $select_colores = $('#stock');

        $.ajax({

            url: "<?php echo site_url('stock/ajax_dropdown')?>/"+$('#productoValue').val()+"/<?php echo $venta->id; ?>"

            , "type": "POST"

            , data:{length:'',start:0,producto:$('#productoValue').val()}

            , dataType: 'JSON'

            , success: function (data) {

                //clear the current content of the select

                $select_colores.html('');

                //iterate over the data and append a select option

                //var options='';
                $.each(data.colores, function (key, val) {
                    $select_colores.append($("<option></option>").attr("value",val.id).text(val.nombre+"*"+val.cantidad+"("+val.l1+","+val.l2+","+val.l3+","+val.l4+")")); 
                    //options += '<option value="' + val.id + '">' + val.nombre + '</option>'; 
                    //console.log(val);

                })

                   // $('#color').html(options);
            }

            , error: function () {

                //if there is an error append a 'none available' option

                //$select_colores.html('<option id="-1">ninguno disponible</option>');

            }

        });

    });
    table = $('#table').DataTable({ 

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

            "url": "<?php echo site_url('venta/ajax_renglones/'.$venta->id)?>",

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


function add_renglon()

{

    save_method = 'add';

    $('#form')[0].reset(); // reset form on modals

    $('.form-group').removeClass('has-error'); // clear error class

    $('.help-block').empty(); // clear error string

    $('#modal_form').modal('show'); // show bootstrap modal

    $('.modal-title').text('Agregar Renglon'); // Set Title to Bootstrap modal title

    $('#producto').focus();
}
function edit_renglon(id)

{
    
    save_method = 'update';

    $('#form')[0].reset(); // reset form on modals

    $('.form-group').removeClass('has-error'); // clear error class

    $('.help-block').empty(); // clear error string



    //Ajax Load data from ajax

    $.ajax({

        url : "<?php echo site_url('venta/ajax_edit_renglon/')?>/" + id,

        type: "GET",

        dataType: "JSON",

        success: function(data)

        {

            

            $('[name="id"]').val(data.id);


            $('[name="categoria"]').val(data.categoriaid);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded

            $('.modal-title').text('Editar Renglon'); // Set title to Bootstrap modal title

            $('#producto').val(data.producto);

            $('#cantidad').val(data.cantidad);

            $('#precio').val(data.precio_unitario);
            $select_colores = $('#stock');
            $select_colores.html('');
            $select_colores.append($("<option></option>").attr("value",0).text(data.color)); 
                    
            $('#producto,#stock').attr('disabled',true);
            //$p.data('uiAutocomplete')._trigger('select', 'autocompleteselect', {item:{value:val.stockid}});

        },

        error: function (jqXHR, textStatus, errorThrown)

        {

            alert('Error get data from ajax');

        }

    });

}
$( "#producto" ).on( "autocompleteselect", function( event, ui ) {console.log(event);} );


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
                    <input type="hidden" value="<?php echo $venta->id;?>" name="venta"/> 

                    <div class="form-body">

                        <div class="form-group">

                            <label class="control-label col-md-3">Nombre</label>

                            <div class="col-md-9">

                                <input id="producto" name="producto" placeholder="Producto" class="form-control" type="text" autocomplete="off">
                                <input type="hidden" name="productovalue" id="productoValue" />
                                <span class="help-block"></span>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-md-3">Color</label>

                            <div class="col-md-9">

                                <select id="stock" name="stock" class="form-control">

                                </select>

                                <span class="help-block"></span>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-md-3">Cantidad</label>

                            <div class="col-md-9">

                                <input id="cantidad" name="cantidad" placeholder="Cantidad" class="form-control" type="text">
                                <span class="help-block"></span>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="control-label col-md-3">Precio</label>

                            <div class="col-md-9">

                                <input id="precio" name="precio" placeholder="Precio" class="form-control" type="text">
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
</style>
<!-- End Bootstrap modal -->