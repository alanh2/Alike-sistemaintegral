<link href="<?php echo base_url('assets/css/multiple_image_upload.css')?>" rel="stylesheet">

<div id="page-wrapper" data-bind="with:venta">

<style>

.stacked{
	float:left;
}


</style>

<form action="#" id="form" class="form-horizontal">

    <div>

    <br />

        <div class="header">

            <h3 class="title">Formulario de Ventas</h3>

        </div><br />

        <div class="form">

            <!--<form action="#" id="form" class="form-horizontal">-->

                <input type="hidden" value="" name="id"/> 

                <div class="form-body">

                    <div class="form-group">

                        <label class="control-label col-md-2">Cliente</label>

                        <div class="col-md-4">

                            <select id="cliente" name="cliente" class="form-control" data-bind="value:cliente">

                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-2">Vendedor</label>

                        <div class="col-md-4">

                            <select id="vendedor" name="vendedor" class="form-control" data-bind="value:vendedor">

                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-2">Lista</label>

                        <div class="col-md-4">

                            <select id="lista" name="lista" class="form-control" data-bind="value:lista">

                            <option value="1">AL COSTO</option>

                            <option value="2">REVENTA</option>

                            <option value="3" selected="selected">PUBLICO</option>

                            <option value="4">ML</option>

                            

                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>

                    

                    

                        	

                    <div class="form-group">

                        <label class="control-label col-md-2">Metodo de pago</label>

                        <div class="col-md-4">

                            <select id="metodo" name="metodo" class="form-control" data-bind="value:metodo">

                            <option value="efectivo">EFECTIVO</option>

                            <option value="efectivo">MOTO</option>

                            <option value="efectivo">CUENTA CORRIENTE</option>

                            <option value="efectivo">MERCADO PAGO</option>

                            <option value="efectivo">BANCO</option>

                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="col-md-3">

                            <input  placeholder="Producto" data-bind="value:$root.newProductoNombre" id="newProductoNombre" class=" col-lg-4 col-lg-offset-1 ui-autocomplete-input form-control" autocomplete="off">
                            <select id="newProducto" name="marca" class="form-control stacked" data-bind="options: $root.productos,value:$root.newProducto,optionsText: 'nombre',optionsValue: 'id'">

                            </select>

                        </div>
                        <div class="col-md-3">

                            <select id="newColor" name="marca" class="form-control" data-bind="options: $root.colores,value:$root.newColor,optionsText: 'name'">

                            </select>

                        </div>

                        <div class="col-md-6">

                            <input type="button" value="Agregar renglon" class="btn-success" data-bind="enable:($root.productos().length>0), click:$root.createRenglon">

                        </div>

                    </div>           

                </div>

                

            <!--</form>-->

        </div>

        <div class="form col-md-6">

        	<div class="row">

                <div class="form-body" data-bind="foreach:renglones">

                    
                    <div class=" col-md-2">
                            <span data-bind="text: ID"></span>
                    </div>
                    <div class=" col-md-4">
                            Producto
                    </div>
                    <div class=" col-md-3">
                            <input name="" data-bind="value: cantidad" class="inputCantidad">
                    </div>
                    <div class=" col-md-3">
                            <input name="" data-bind="value: precio" class="inputCantidad">
                    </div>

                </div>

			</div>	

        </div>

        

        

        <div class="modal-footer">

		    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>

            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

        </div>

    </div>

</form>

</div>



<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>

<script src="<?php echo base_url('assets/jquery/jquery-ui.js')?>"></script>

<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>

<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>

<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>

<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>

<script src="<?php echo base_url('assets/js/common.js')?>"></script>

<script src="<?php echo base_url('assets/knockout/knockout-3.3.0.js')?>"></script>

<script src="<?php echo base_url('assets/knockout/knockoutMapping.js')?>"></script>



<script src="<?php echo base_url('assets/dashboard/js/metisMenu.js')?>"></script>

<script src="<?php echo base_url('assets/dashboard/js/raphael-min.js')?>"></script>

<!--<script src="<?php echo base_url('assets/dashboard/js/morris.min.js')?>"></script>

<script src="<?php echo base_url('assets/dashboard/js/morris-data.js')?>"></script>-->

<script src="<?php echo base_url('assets/dashboard/js/sb-admin-2.js')?>"></script>

<script src="<?php echo base_url('assets/js/multiple_image_upload.js')?>"></script>





<script type="text/javascript">

var save_method='<?php echo $save_method;?>'; //for save method string

var table;

var vm;
var autocompleteProductosEnUso=[];
    var autocompleteProductos = [
      {
        codigo: "1",
        label: "API AUDIO - Guitarras - 512",
        nombre:"512G",
        marca:"API AUDIO",
        categoria:"Guitarras",
        precioPublico:"11",
        precioReventa:"10"
      },{
        codigo: "2",
        label: "API AUDIO - Guitarras - 513",
        nombre:"513G",
        marca:"API AUDIO",
        categoria:"Guitarras",
        precioPublico:"11",
        precioReventa:"10"
      },{
        codigo: "3",
        label: "API AUDIO - Guitarras - 514",
        nombre:"514G",
        marca:"API AUDIO",
        categoria:"Guitarras",
        precioPublico:"11",
        precioReventa:"10"
      },{
        codigo: "4",
        label: "API AUDIO - Tambores - 512",
        nombre:"512T",
        marca:"API AUDIO",
        categoria:"Tambores",
        precioPublico:"12",
        precioReventa:"14"
    }
    ];
$(document).ready(function() {



	vm = new AppViewModel();

	ko.applyBindings(vm);
    $('#newProductoNombre').autocomplete({
          minLength: 0,
          source: autocompleteProductos,
          focus: function( event, ui ) {
            $('#newProductoNombre').val( ui.item.nombre );
          },
          change: function( event, ui ) {
            $('#newProductoNombre').val( ui.item.nombre );
          },
          select: function( event, ui ) {
            $('#newProductoNombre').val( ui.item.nombre);
            vm.newProductoID(ui.item.codigo);
            vm.newProductoStock(ui.item.stock);
            //vm.newProductoCategoria(ui.item.categoria);
            vm.newProductoNombre(ui.item.nombre);
            vm.newProductoMarca(ui.item.marca);
            vm.newProductoCategoria(ui.item.categoria);
            if(vm.cliente.ID=="1"){
                vm.newProductoPrecioSugerido(ui.item.precioPublico);
            }else{
                vm.newProductoPrecioSugerido(ui.item.precioReventa);
            }
            return false;
          }
        });
    //datatables

    table = $('#table').DataTable({ 



		"responsive": true,

        "processing": true, //Feature control the processing indicator.

        "serverSide": true, //Feature control DataTables' server-side processing mode.

        "order": [], //Initial no order.

		 // Load data for the table's content from an Ajax source

        "ajax": {

            "url": "<?php echo site_url('producto/ajax_list')?>",

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

/*$('#costo').change(function(){

	var costo=parseFloat($('#costo').val());

	$('.lista').each(function(){

		//QUE IMPORTA MAS, % O LISTA?

	});	

});*/

$('.lista').change(function () {

	//alert("agregar funcion cuando modificas costo que modifique todas las listas");

	var costo=parseFloat($('#costo').val());

	var precio=parseFloat($(this).val());

	$('#'+$(this).attr('name')+'porcentaje').val(precio*100/costo-100);

});



$('.porcentaje').change(function () {

	alert("agregar funcion cuando modificas costo que modifique todas las listas");

	var costo=parseFloat($('#costo').val());

	var porcentaje=parseInt($(this).val());

	$('#'+$(this).attr('name')+'precio').val((porcentaje+100)*costo/100);

});

	$select_productos = $('#newProducto');

	$.ajax({

		url: "<?php echo site_url('producto/ajax_dropdown')?>"

		, "type": "POST"

		, data:{length:'',start:0}

		, dataType: 'JSON'

		, success: function (data) {

			//clear the current content of the select

			$select_productos.html('');

			//iterate over the data and append a select option

			$.each(data.productos, function (key, val) {

				vm.createProducto(val);
			})

		}

		, error: function () {

			//if there is an error append a 'none available' option

			//$select_colores.html('<option id="-1">ninguno disponible</option>');

		}

	});
    $('#newProducto').change(function() {

        $select_colores = $('#newColor');

    $.ajax({

        url: "<?php echo site_url('color/ajax_dropdown')?>"

        , "type": "POST"

        , data:{length:'',start:0,producto:$('#newProducto').val()}

        , dataType: 'JSON'

        , success: function (data) {

            //clear the current content of the select

            $select_colores.html('');

            //iterate over the data and append a select option

            $.each(data.colores, function (key, val) {

                vm.createColor(val.id,val.nombre,val.name);

                //console.log(val);

                //vm.colores.push(val);

            })

        }

        , error: function () {

            //if there is an error append a 'none available' option

            //$select_colores.html('<option id="-1">ninguno disponible</option>');

        }

    });


    });
    $select_clientes = $('#cliente');

    //request the JSON data and parse into the select element

    $.ajax({

        url: "<?php echo site_url('cliente/ajax_dropdown')?>"

        , "type": "POST"

        , data:{length:'',start:0}

        , dataType: 'JSON'

        , success: function (data) {

            //clear the current content of the select

            $select_clientes.html('');

            //iterate over the data and append a select option

            $.each(data.clientes, function (key, val) {

                $select_clientes.append('<option value="' + val.id + '">' + val.nombre + '</option>');

            })

        }

        , error: function () {

            //if there is an error append a 'none available' option

            $select_clientes.html('<option id="-1">ninguna disponible</option>');

        }

    });

    $select_vendedores = $('#vendedor');

    //request the JSON data and parse into the select element

    $.ajax({

        url: "<?php echo site_url('vendedor/ajax_dropdown')?>"

        , "type": "POST"

        , data:{length:'',start:0}

        , dataType: 'JSON'

        , success: function (data) {

            //clear the current content of the select

            $select_vendedores.html('');

            //iterate over the data and append a select option

            $.each(data.vendedores, function (key, val) {

                $select_vendedores.append('<option value="' + val.id + '">' + val.nombre + '</option>');

            })

        }

        , error: function () {

            //if there is an error append a 'none available' option

            $select_vendedores.html('<option id="-1">ninguna disponible</option>');

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







function add_producto()

{

    save_method = 'add';

    $('#form')[0].reset(); // reset form on modals

    $('.form-group').removeClass('has-error'); // clear error class

    $('.help-block').empty(); // clear error string

    $('.modal-title').text('Agregar Producto'); // Set Title to Bootstrap modal title

}





function save()

{

    $('#btnSave').text('saving...'); //change button text

    $('#btnSave').attr('disabled',true); //set button disable 

    var url;



    if(save_method == 'add') {

        url = "<?php echo site_url('producto/ajax_add')?>";

    } else {

        url = "<?php echo site_url('producto/ajax_update')?>";

    }



			var formData = new FormData($('form')[0]);

			

    // ajax adding data to database

    $.ajax({

        url : url,

        type: "POST",

        data: formData,//$('#form').serialize(),

        //Options to tell jQuery not to process data or worry about content-type.

        cache: false,

        contentType: false,

        processData: false,

        dataType: "JSON",

        success: function(data)

        {



            if(data.status) //if success close modal and reload ajax table

            {

                //CARTEL Y REENVIO? QUE HAGO ACA, ES EL RESULTADO EXITOSO;

				alert("Alta exitosa")

				//parent.location.reload(true); 

				//window.close();

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

            alert('Error agregando / modificando producto');

            $('#btnSave').text('guardar'); //change button text

            $('#btnSave').attr('disabled',false); //set button enable 



        }

    });

}

window.reset = function (e) {

    e.wrap('<form>').closest('form').get(0).reset();

    e.unwrap();

}

//$('#files').on("change", function(){ reset($('#files'));});

</script>

<script>

	function AppViewModel() {

		var self = this;

		//agregar los attributos del producto

		self.venta=ko.observable(new Venta());

        self.productos=ko.observableArray();

        
        self.newProductoNombre = ko.observable();
        self.newProductoMarca = ko.observable();
        self.newProductoCategoria = ko.observable();
        self.newProductoID = ko.observable();

		self.colores= ko.observableArray();

		self.deleteFile = function (file) {

				self.producto().files.remove(file) ;

			};

		self.deleteColor = function (color) { 

			self.colores.push(color);

			self.producto().colores.remove(color);

		};

	    self.createColor = function (id,nombre,name) {

			self.colores.push(new Color(id,nombre,name));

	    };
        self.createRenglon = function(){
            self.venta().renglones.push(new Renglon());
        }

	    self.createProducto = function (p) {

			self.productos.push(new Producto(p));

	    };

	    self.createColorProducto = function () {

			self.producto().colores.push(self.newColor());

			console.log(self.newColor());

			self.colores.remove(self.newColor());

			if (self.colores().length==0){

				//verificar longitud de colores, si es 0 disable

				//alert("asd");

			}

			window.scrollTo(0,document.body.scrollHeight);		

	    };

		

		self.newRenglon = function () {

			self.venta().renglones.push(new Renglon(self.newProductoID(),self.newProductoNombre(),self.newProductoMarca(),self.newProductoCategoria(),self.newProductoPrecioSugerido(),0));

			//autocompleteProductos

			//autocompleteProductosEnUso

			$('#newProductoNombre').val("");

				

	    };

		function Venta(){

			var self=this;

			self.codigo=ko.observable();

			self.renglones=ko.observableArray();

		}



		function Color(id,nombre,name){

			var self=this;

			self.id=id;

			self.nombre=ko.observable(nombre);

			self.name=ko.observable(name);

			self.costo=ko.observable(0);

			self.porcentaje1=ko.observable(0);

			self.porcentaje2=ko.observable(0);

			self.porcentaje3=ko.observable(0);

			self.porcentaje4=ko.observable(0);

		}

		function Producto(p){

			var self=this;

            self.codigo=ko.observable(p.codigo);

            self.id=ko.observable(p.id);

			self.nombre=ko.observable(p.nombre);

			self.marca=ko.observable(p.marca);

			self.modelo=ko.observable(p.modelo);

			self.subcategoria=ko.observable(p.subcategoria);

			self.proveedor=ko.observable(p.proveedor);

			self.colores=ko.observableArray();

		}

        function Renglon(){
            
            var self=this;

            self.producto=ko.observable();
            self.precio=ko.observable();
            self.cantidad=ko.observable();
            self.total=ko.observable();

        }

	}

</script>

<style>

.form-group{

	margin-bottom: 5px;

}

.thumb {

    height: 75px;

    border: 1px solid #000;

    margin: 10px 5px 0 0;

}

    

</style>