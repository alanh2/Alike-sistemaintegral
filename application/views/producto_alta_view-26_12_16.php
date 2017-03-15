<div id="page-wrapper">
    <div>
    <br />
        <div class="header">
            <h3 class="title">Formulario de Productos</h3>
        </div><br />
        <div class="form">
            <form action="#" id="form" class="form-horizontal">
                <input type="hidden" value="" name="id"/> 
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-2">Codigo</label>
                        <div class="col-md-4">
                            <input name="codigo" placeholder="Codigo" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Nombre</label>
                        <div class="col-md-4">
                            <input name="nombre" placeholder="Nombre" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Marca</label>
                        <div class="col-md-4">
                            <select id="marca" name="marca" class="form-control">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Modelo</label>
                        <div class="col-md-4">
                            <select id="modelo" name="modelo" class="form-control">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Categoria</label>
                        <div class="col-md-4">
                            <select id="categoria" name="categoria" class="form-control">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">SubCategoria</label>
                        <div class="col-md-4">
                            <select id="subcategoria" name="subcategoria" class="form-control">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Proveedor</label>
                        <div class="col-md-4">
                            <select id="proveedor" name="proveedor" class="form-control">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <select id="newColor" name="marca" class="form-control" data-bind="options: colores,value:newColor,optionsText: 'name'">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="button" value="Agregar color" class="btn-success" data-bind="enable:(colores().length>0), click:createColorProducto">
                        </div>
                    </div>           
                </div>
            </form>
        </div>
        <div class="form col-md-12">
        	<div class="row">
                <div class="form-body" data-bind="foreach:coloresProducto">
                    <div class=" col-md-6">
                    	<h2><span data-bind="text: name"></span>
                <button type="button" class="close" data-bind="click:$root.deleteColorProducto" aria-label="Close"><span aria-hidden="true">&times;</span></button></h2>
                        <div class="modal-body form">
                            <form action="#" id="form" class="form-horizontal">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Costo</label>
                                    <div class="col-md-8">
                                        <input id="costo" name="costo" placeholder="Costo" class="form-control" type="text" data-bind="value:costo">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Lista 1</label>
                                    <div class="col-md-4">
                                        <input id="lista1precio" name="lista1" placeholder="Precio" class="form-control lista" type="text" data-bind="value:lista1">
                                        <span class="help-block"></span>
                                    </div>
                                    <label class="control-label col-md-2">Ganancia</label>
                                    <div class="col-md-2">
                                        <input id="lista1porcentaje" name="lista1" placeholder="%" class="form-control porcentaje" type="text" data-bind="value:porcentaje1">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Lista 2</label>
                                    <div class="col-md-4">
                                        <input id="lista2precio" name="lista2" placeholder="Precio" class="form-control lista" type="text" data-bind="value:lista2">
                                        <span class="help-block"></span>
                                    </div>
                                    <label class="control-label col-md-2">Ganancia</label>
                                    <div class="col-md-2">
                                    <input id="lista2porcentaje" name="lista2" placeholder="%" class="form-control porcentaje" type="text" data-bind="value:porcentaje2">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Lista 3</label>
                                    <div class="col-md-4">
                                        <input id="lista3precio" name="lista3" placeholder="Precio" class="form-control lista" type="text" data-bind="value:lista3">
                                        <span class="help-block"></span>
                                    </div>
                                    <label class="control-label col-md-2">Ganancia</label>
                                    <div class="col-md-2">
                                    <input id="lista3porcentaje" name="lista3" placeholder="%" class="form-control porcentaje" type="text" data-bind="value:porcentaje3">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Lista 4</label>
                                    <div class="col-md-4">
                                        <input id="lista4precio" name="lista4" placeholder="Precio" class="form-control lista" type="text" data-bind="value:lista4">
                                        <span class="help-block"></span>
                                    </div>
                                    <label class="control-label col-md-2">Ganancia</label>
                                    <div class="col-md-2">
                                    <input id="lista4porcentaje" name="lista4" placeholder="%" class="form-control porcentaje" type="text" data-bind="value:porcentaje4">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </form>
                        </div>     
                	</div>
                </div>
			</div>	
        </div>
        
        
        <div class="modal-footer">
		    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
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

<script type="text/javascript">

var save_method='<?php echo $data['save_method'];?>'; //for save method string
var table;
var vm;
$(document).ready(function() {

	vm = new AppViewModel();
	ko.applyBindings(vm);
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
	$('#categoria').change(function() {
		$select_subcategorias = $('#subcategoria');
		//request the JSON data and parse into the select element
		$.ajax({
			url: "<?php echo site_url('subcategoria/ajax_dropdown')?>"
			, "type": "POST"
			, data:{length:'',start:0,categoria:$('#categoria').val()}
			, dataType: 'JSON'
			, success: function (data) {
				//clear the current content of the select
				$select_subcategorias.html('');
				//iterate over the data and append a select option
				$.each(data.subcategorias, function (key, val) {
					$select_subcategorias.append('<option value="' + val.id + '">' + val.nombre + '</option>');
				})
			}
			, error: function () {
				//if there is an error append a 'none available' option
				$select_subcategorias.html('<option id="-1">ninguno disponible</option>');
			}
		});
	});
	$select_proveedores = $('#proveedor');
	//request the JSON data and parse into the select element
	$.ajax({
		url: "<?php echo site_url('proveedor/ajax_dropdown')?>"
		, "type": "POST"
		, data:{length:'',start:0}
		, dataType: 'JSON'
		, success: function (data) {
			//clear the current content of the select
			$select_proveedores.html('');
			//iterate over the data and append a select option
			$.each(data.proveedores, function (key, val) {
				$select_proveedores.append('<option value="' + val.id + '">' + val.nombre + '</option>');
			})
		}
		, error: function () {
			//if there is an error append a 'none available' option
			$select_proveedores.html('<option id="-1">ninguna disponible</option>');
		}
	});
	$select_marcas= $('#marca');
	//request the JSON data and parse into the select element
	$.ajax({
		url: "<?php echo site_url('marca/ajax_dropdown')?>"
		, "type": "POST"
		, data:{length:'',start:0}
		, dataType: 'JSON'
		, success: function (data) {
			//clear the current content of the select
			$select_marcas.html('');
			//iterate over the data and append a select option
			$.each(data.marcas, function (key, val) {
				$select_marcas.append('<option value="' + val.id + '">' + val.nombre + '</option>');
			})
		}
		, error: function () {
			//if there is an error append a 'none available' option
			$select_marcas.html('<option id="-1">ninguna disponible</option>');
		}
	});
	$('#marca').change(function() {
		$select_modelos= $('#modelo');
		//request the JSON data and parse into the select element
		$.ajax({
			url: "<?php echo site_url('modelo/ajax_dropdown')?>"
			, "type": "POST"
			, data:{length:'',start:0,marca:$('#marca').val()}
			, dataType: 'JSON'
			, success: function (data) {
				//clear the current content of the select
				$select_modelos.html('');
				//iterate over the data and append a select option
				$.each(data.modelos, function (key, val) {
					$select_modelos.append('<option value="' + val.id + '">' + val.nombre + '</option>');
				})
			}
			, error: function () {
				//if there is an error append a 'none available' option
				$select_modelos.html('<option id="-1">ninguno disponible</option>');
			}
		});
	});
	/*$select_colores = $('#newColor');
	//request the JSON data and parse into the select element
	$.ajax({
		url: "<?php echo site_url('color/ajax_dropdown')?>"
		, "type": "POST"
		, data:{length:'',start:0}
		, dataType: 'JSON'
		, success: function (data) {
			//clear the current content of the select
			$select_colores.html('');
			//iterate over the data and append a select option
			$.each(data.colores, function (key, val) {
				$select_colores.append('<option value="' + val.id + '">' + val.name+ '</option>');
			})
		}
		, error: function () {
			//if there is an error append a 'none available' option
			$select_colores.html('<option id="-1">ninguno disponible</option>');
		}
	});*/
	$select_colores = $('#newColor');
	$.ajax({
		url: "<?php echo site_url('color/ajax_dropdown')?>"
		, "type": "POST"
		, data:{length:'',start:0}
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
                //CARTEL Y REENVIO? QUE HAGO ACA, ES EL RESULTADO EXITOSO;
				alert("Alta exitosa")
				parent.location.reload(true); 
				window.close();
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

</script>
<script>
	function AppViewModel() {
		var self = this;
		self.colores=ko.observableArray();
		self.newColor=ko.observable();
		self.coloresProducto= ko.observableArray();
		self.deleteColorProducto = function (color) { 
			self.colores.push(color);
			self.coloresProducto.remove(color) 
		};
	    self.createColor = function (id,nombre,name) {
			self.colores.push(new Color(id,nombre,name));
	    };
	    self.createColorProducto = function () {
			//self.coloresProducto.push(new Color('','',self.newColor().name()));
			self.coloresProducto.push(self.newColor());
			console.log(self.newColor());
			self.colores.remove(self.newColor());
			if (self.colores().length==0){
				//verificar longitud de colores, si es 0 disable
				//alert("asd");
			}
			window.scrollTo(0,document.body.scrollHeight);		
	    };
		
		self.save = function() {
			//var data=ko.toJSON({ renglones: self.renglones, cliente:self.cliente, pago: self.pago, fecha:self.fecha, })
			var data=ko.toJSON({ venta:self.venta })
			var url='<?php echo site_url('venta/add_venta_post')?>'
			console.log(data);
			$.ajax({
				url         : url,
				type        : 'POST',
				ContentType : 'application/json',
				data        : {'data': data}
			}).done(function(response){console.log(response);});
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
			
			self.calcularPorcentaje=function(lista){
				//console.log("Calcular porcentaje");
				return parseFloat(lista)*100/parseFloat(self.costo());
			};
			
			self.calcularLista=function(porcentaje){
				//console.log("Calcular lista");
				return parseFloat(porcentaje())*parseFloat(self.costo())/100;
			};
			
			self.lista1= ko.computed({
				read: function () {
					return self.calcularLista(self.porcentaje1);
				},
				write: function (value) {
					self.porcentaje1(self.calcularPorcentaje(value));
					return value;
				}
			});
			self.lista2= ko.computed({
				read: function () {
					return self.calcularLista(self.porcentaje2);
				},
				write: function (value) {
					self.porcentaje2(self.calcularPorcentaje(value));
					return value;
				}
			});
			self.lista3= ko.computed({
				read: function () {
					return self.calcularLista(self.porcentaje3);
				},
				write: function (value) {
					self.porcentaje3(self.calcularPorcentaje(value));
					return value;
				}
			});
			self.lista4= ko.computed({
				read: function () {
					return self.calcularLista(self.porcentaje4);
				},
				write: function (value) {
					self.porcentaje4(self.calcularPorcentaje(value));
					return value;
				}
			});
		}
		
		
		//self.showFormularioPago = ko.observable(false);
		//self.pago=ko.observable(new Pago());
	    //self.newProductoNombre = ko.observable();
	    //self.newProductoMarca = ko.observable();
	    //self.newProductoCategoria = ko.observable();
	    //self.newProductoPrecioSugerido = ko.observable();
	    //self.newProductoID = ko.observable();
	    //self.newProductoStock = ko.observable();
	    //self.newProductoStockMinimo = ko.observable();
		
		//Venta
		//self.venta=ko.observable(new Venta());
		//self.cliente=ko.observable();
		//self.fecha= ko.observable();
		//self.renglones = ko.observableArray();
		/*
	    self.deleteRenglon = function (renglon) { self.renglones.remove(renglon) };
	    self.total=ko.computed(function(){
		var total = 0;
			for(var p = 0; p < self.renglones().length; ++p)
			{
				total += parseFloat(self.renglones()[p].precio()*self.renglones()[p].cantidad());
			}
			return total.toFixed(2);
		});
		self.newRenglon = function () {
			self.venta().renglones.push(new Renglon(self.newProductoID(),self.newProductoNombre(),self.newProductoMarca(),self.newProductoCategoria(),self.newProductoPrecioSugerido(),0));
			//autocompleteProductos
			//autocompleteProductosEnUso
			$('#newProductoNombre').val("");
				
	    };
	    self.save = function() {
			//var data=ko.toJSON({ renglones: self.renglones, cliente:self.cliente, pago: self.pago, fecha:self.fecha, })
			var data=ko.toJSON({ venta:self.venta })
			var url='<?php echo site_url('venta/add_venta_post')?>'
			console.log(data);
			$.ajax({
				url         : url,
				type        : 'POST',
				ContentType : 'application/json',
				data        : {'data': data}
			}).done(function(response){console.log(response);});
		};*/
	}
</script>
<style>
.form-group{
	margin-bottom: 5px;
}
</style>