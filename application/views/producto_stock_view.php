<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax CRUD with Bootstrap modals and Datatables</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery-ui.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/datepicker3.css')?>" rel="stylesheet">
	<style>
	.ui-menu-item{ background-color:white; border: 1px solid #0000FF;}
	</style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head> 
<body>
    <div class="container">
        <h1 style="font-size:20pt">SL PRO AUDIO</h1>

        <h3>Registrar Ventas</h3>
        <br />
        
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/jquery/jquery-ui.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.js')?>"></script>
<script src="<?php echo base_url('assets/knockout/knockout-3.3.0.js')?>"></script>
<script src="<?php echo base_url('assets/knockout/knockoutMapping.js')?>"></script>

<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

    //datepicker
    $('#fecha').datepicker({
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
</script>

<!--Formulario ventas-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Registrar Venta</h1>
        </div>
    </div><!--/.row-->
    <!--/.row-->
    
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">Pedido</div>
                <div class="panel-body">
                <div class="row" data-bind="with:venta">
                    <input type="text" placeholder="Cliente" class="col-lg-4 col-lg-offset-1" id="clientes" autocomplete="off">
                    <input type="text"  data-bind="value:fecha" id="fecha" placeholder="Fecha" class="col-lg-4 col-lg-offset-1">
                </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Pago</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" data-bind="checked: showFormularioPago">Paga
                                    </label>
                                </div>
                        </div>
                        <div data-bind="if: showFormularioPago">
                            <div data-bind="with:venta">
                            	<div data-bind="with:pago">
                                    <div class="row">
                                        <input type="text" data-bind="value:usd" placeholder="USD" class="form-control col-lg-4">
                                        <input type="text" data-bind="value:pesos" placeholder="Pesos" class="form-control col-lg-4">
                                        <input type="text" data-bind="value:tarifa" placeholder="Tarifa" class="form-control col-lg-4">
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <input type="text" data-bind="value:descuento" placeholder="Descuento" class="form-control col-lg-4">
                                        <input type="text" data-bind="value:detalle" placeholder="Detalle" class="form-control col-lg-4">
                                    </div>
                            	</div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">Productos</div>
                <div class="panel-body">
                <table border="0" style="text-align: center" width="100%">
                <thead>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th></th>
                    </thead>
                <tbody data-bind="foreach:venta().renglones">
                <tr>
                    <td align="center"><span data-bind="text: ID" ></span></td>
                    <td align="center"><span data-bind="text: modelo"></span></td>
                    <td align="center"><span data-bind="text: marca" /></span></td>
                    <td align="center"><span data-bind="text: categoria" /></span></td>
                    <td align="center"><input name="" data-bind="value: precio" class="inputCantidad" /></td>

                    <td align="center"><input data-bind="value: cantidad" class="inputCantidad" /></td>
                    <td align="center">
                        <a href="#" data-bind="click:$root.deleteRenglon">
                            <img src="<?php echo base_url('assets/images/DeleteRed.png')?>" width="25px" style="padding:5px">
                        </a>
                    </td>
                </tr>
                <!--<tr><td colspan="7" class="backgroundBlack">&nbsp;</td></tr>-->
                </tbody>
            </table>
                    <!--<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                        <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true" >ID</th>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="name"  data-sortable="true">ID</th>
                            <th data-field="price" data-sortable="true">Precio</th>
                        </tr>
                        </thead>
                    </table>-->
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Confirmar</div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <br/>
                        <div class="row">
                        Total : $<span data-bind="text:venta().total"></span><br/>
                        <input data-bind="click: save" type="button" value="Confirmar Pedido" class="btn btn-primary btn-md"/>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>

</div>
		<!--/.row-->

<!--Fin formulario de ventas-->
</body>
</html>
<script>
	function AppViewModel() {
		var self = this;
		self.showFormularioPago = ko.observable(false);
		self.pago=ko.observable(new Pago());
	    self.newProductoNombre = ko.observable();
	    self.newProductoMarca = ko.observable();
	    self.newProductoCategoria = ko.observable();
	    self.newProductoPrecioSugerido = ko.observable();
	    self.newProductoID = ko.observable();
	    self.newProductoStock = ko.observable();
	    self.newProductoStockMinimo = ko.observable();
		
		//Venta
		self.venta=ko.observable(new Venta());
		self.cliente=ko.observable();
		self.fecha= ko.observable();
		self.renglones = ko.observableArray();
		
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
    };
	}
	
	function Venta(){
		var self=this;
		self.cliente=ko.observable();
		self.fecha=ko.observable();
		self.renglones = ko.observableArray();
		self.pago=ko.observable(new Pago());
		self.subtotal=ko.computed(function(){
		var subtotal = 0;
			for(var p = 0; p < self.renglones().length; ++p)
			{
				subtotal += parseFloat(self.renglones()[p].precio()*self.renglones()[p].cantidad());
			}
			return subtotal.toFixed(2);
		});
		self.descuento=ko.observable(0);
		self.total=ko.computed(function(){
			if (isNaN(self.subtotal()-self.pago().descuento())){
				self.descuento(0);	
			}else{
				self.descuento(self.pago().descuento());
			}			
			return (self.subtotal()-self.descuento());
		});
	}
	function Cliente(id,nombre,apellido,tipoCliente){
		var self = this;
		self.ID=id;
		self.nombre=nombre;
		self.apellido=apellido;
		self.tipoCliente=tipoCliente;
		
	};
	function Pago(usd, pesos, tarifa, descuento, detalle){
		var self = this;
		self.usd=ko.observable(usd);
		self.pesos=ko.observable(pesos);
		self.descuento=ko.observable(descuento);
		self.tarifa=ko.observable(tarifa);
		self.detalle=ko.observable(detalle);
	};
	function Renglon(id, modelo, marca, categoria,precio,cantidad) {
	    var self = this;
	    self.ID=id;
	    self.modelo = ko.observable(modelo);
	    self.marca = ko.observable(marca);
	    self.categoria = ko.observable(categoria);
		self.precio = ko.observable(precio);
		self.cantidad = ko.observable(cantidad);

	};
	// Activates knockout.js
    var vm;
	var autocompleteClientes = [
		{
			codigo:"1",
			label:"Mike Hambra",
			nombre:"Mike",
			apellido:"Hambra",
			tipoCliente:"1"
		},
		{
			codigo:"2",
			label:"Sergio Levinsonas",
			nombre:"Sergio",
			apellido:"Levinsonas",
			tipoCliente:"0"
		},
	];
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
    $(document).ready(function () {
    	
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
		$('#clientes').autocomplete({
	      minLength: 0,
	      source: autocompleteClientes,
	      focus: function( event, ui ) {
	        $('#clientes').val( ui.item.label );
	      },
	      change: function( event, ui ) {
	        $('#clientes').val( ui.item.label );
	      },
	      select: function( event, ui ) {
	        $('#clientes').val( ui.item.label);
			vm.venta().cliente(new Cliente(ui.item.codigo,ui.item.nombre,ui.item.apellido,ui.item.tipoCliente));
			/*vm.cliente.ID(ui.item.codigo);
	        vm.cliente.nombre(ui.item.nombre);
	        vm.cliente.apellido(ui.item.apellido);
	        vm.cliente.tipoCliente(ui.item.tipoCliente);*/
			return false;
	      }
	    });
        
    });
</script>