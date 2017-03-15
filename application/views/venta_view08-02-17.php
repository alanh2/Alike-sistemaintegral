<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Stock</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/common.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head> 
<body>
<div class="">
    <div class="row">
        <div class="col-sm-3 col-lg-1">
            <div id="box">
                <a class="btn btn-info " href="producto" title="Edit" style="width:100px"><i class="glyphicon glyphicon-bullhorn"></i> Producto</a><br>
                <a class="btn btn-info " href="venta" title="Edit" style="width:100px"><i class="glyphicon glyphicon-shopping-cart"></i> Venta</a><br>
                <a class="btn btn-info " href="stock" title="Edit" style="width:100px"><i class="glyphicon glyphicon-list" ></i> Stock</a><br>
            </div>
        </div>
        <div class="col-sm-9">
        <!--
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 ">
    -->
        <h1 style="font-size:20pt">SL PRO AUDIO</h1>

        <h3>Venta</h3>
        <br />
        <button class="btn btn-success" onclick="location.href='<?php echo base_url()?>index.php/venta/add_venta/'"><i class="glyphicon glyphicon-plus"></i> Registrar Venta</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Subtotal</th>
                    <th>Descuento</th>
                    <th>Total</th>
                    <th style="width:225px;">Accion</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
                <tr>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Subtotal</th>
                    <th>Descuento</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            </table>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script src="<?php echo base_url('assets/knockout/knockout-3.3.0.js')?>"></script>
<script src="<?php echo base_url('assets/knockout/knockoutMapping.js')?>"></script>
<script src="<?php echo base_url('assets/js/common.js')?>"></script>


<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('venta/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1,-2,-3,-4 ], //last column
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
	$('#fecha').datepicker()
		.on('changeDate', function(ev){                 
			$('#fecha').datepicker('hide');
		});

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



function add_venta()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Agregar Venta'); // Set Title to Bootstrap modal title
}

function edit_venta(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('venta/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			
			$('[name="id"]').val(data.id);
            $('[name="marca"]').val(data.marcaid);
            $('[name="categoria"]').val(data.categoriaid);
            $('[name="modelo"]').val(data.modelo);
            $('[name="stock"]').val(data.stock);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Venta'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

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
        url = "<?php echo site_url('venta/ajax_add')?>";
    } else {
        url = "<?php echo site_url('venta/ajax_update')?>";
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
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_venta(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('venta/ajax_delete')?>/"+id,
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
		
		self.cliente=ko.observable();
		self.productos = ko.observableArray();
	    self.renglones = ko.observableArray();
	    self.deleteRenglon = function (renglon) { self.renglones.remove(renglon) };
	    self.total=ko.computed(function(){
		var total = 0;
			for(var p = 0; p < self.renglones().length; ++p)
			{
				total += parseInt(self.renglones()[p].precio()*self.renglones()[p].cantidad());
			}
			return total;
		});
		self.newRenglon = function () {
			self.renglones.push(new Renglon(self.newProductoID(),self.newProductoNombre(),self.newProductoMarca(),self.newProductoCategoria(),self.newProductoPrecioSugerido(),0));
			$('#newProductoNombre').val("");
				
	    };
	    self.addRenglon=function(p/*producto*/){
	    	self.renglones.push(p);
	    }
	    self.initRenglones= function(productos){
	    	$.each(productos,function(index,value){
	    		self.addRenglon(value);
	    	});
	    };
	    self.initRenglonesJSON=function(json){
	    	ko.mapping.fromJS(json, {}, self.renglones);
	    }
	    self.save = function() {
	   	var data=ko.toJSON({ renglones: self.renglones, cliente:self.cliente, pago: self.pago })
	   	var url='<?php echo site_url('venta/add_venta')?>'
        console.log(data);
        $.ajax({
            url         : url,
            type        : 'POST',
            ContentType : 'application/json',
            data        : {'data': data}
        }).done(function(response){console.log(response);});
    };
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
	var productos=[{"ID":"1","modelo":"sarasa","marca":"marca","categoria":"pianos","precio":"23","cantidad":"24"}];
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
	var autocompleteProductos = [
      {
        codigo: "1",
        label: "API AUDIO - Guitarras - 512",
		nombre:"512",
		marca:"API AUDIO",
		categoria:"Guitarras",
		precioPublico:"11",
		precioReventa:"10"
      },{
        codigo: "2",
        label: "API AUDIO - Guitarras - 513",
		nombre:"513",
		marca:"API AUDIO",
		categoria:"Guitarras",
		precioPublico:"11",
		precioReventa:"10"
      },{
        codigo: "3",
        label: "API AUDIO - Guitarras - 514",
		nombre:"514",
		marca:"API AUDIO",
		categoria:"Guitarras",
		precioPublico:"11",
		precioReventa:"10"
      },
    ];
 
    $(document).ready(function () {
    	
        vm = new AppViewModel();
        ko.applyBindings(vm);
        //vm.initRenglonesJSON(productos);
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
			vm.cliente=new Cliente(ui.item.codigo,ui.item.nombre,ui.item.apellido,ui.item.tipoCliente)
			/*vm.cliente.ID(ui.item.codigo);
	        vm.cliente.nombre(ui.item.nombre);
	        vm.cliente.apellido(ui.item.apellido);
	        vm.cliente.tipoCliente(ui.item.tipoCliente);*/
			return false;
	      }
	    });
        
    });
</script>

</body>
</html>