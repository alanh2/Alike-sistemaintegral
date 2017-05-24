<link href="<?php echo base_url('assets/css/multiple_image_upload.css')?>" rel="stylesheet">
<div id="page-wrapper" data-bind="with:venta">
<style>
.stacked{
	float:left;
}
</style>
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
<form action="#" id="form" class="form-horizontal">
    <div>
    <br />
        <div class="header">
        </div><br />
        <div class="row">

        <div class="form col-md-6">

            <!--<form action="#" id="form" class="form-horizontal">-->
                <?php if (isset($venta)){?>
                <input type="hidden" value="<?php echo $venta->id;?>" name="id"/> 
                <?php }?>
                <div class="form-body">

                    <div class="form-group">

                        <label class="control-label col-md-3">Cliente</label>

                        <div class="col-md-8">

                            <select id="cliente" name="cliente" class="form-control" data-bind="value:cliente">

                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-3">Vendedor</label>

                        <div class="col-md-8">

                            <select id="vendedor" name="vendedor" class="form-control" data-bind="value:vendedor">

                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>
               

                    <div class="form-group">
                        <label class="control-label col-md-3">Cuenta corriente:</label>
                        <div class="slideThree">    
                            <input type="checkbox" value="1" id="slideThree" name="cuentacorriente" style="display: none;" />
                            <label for="slideThree"></label>
                        </div>
                    </div>
            <!--</form>-->
    		        <div class="modal-footer">

    				    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>

    		            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

    		        </div>
        </div>
        <div id="mensajesAnteriores" class="col-md-6"></div>
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
/*var autocompleteProductos=[];
$.ajax({

        url: "<?php echo site_url('producto/ajax_autocomplete')?>"

        , "type": "POST"

        , data:{length:'',start:0}

        , dataType: 'JSON'

        , success: function (data) {


            //iterate over the data and append a select option

            $.each(data.productos, function (key, val) {
                var producto=[
                                {
                                    codigo: val.codigo,
                                    label: val.marca+" "val.modelo+" "+val.nombre,
                                    nombre: val.nombre,
                                    modelo: val.modelo,
                                    marca:val.marca,
                                    subcategoria:val.subcategoria
                                }
                             ]
                autocompleteProductos[];
            })

        }

        , error: function () {

            //if there is an error append a 'none available' option

            //$select_colores.html('<option id="-1">ninguno disponible</option>');

        }

    });*/
autocompleteProductos = [
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
            vm.newProducto(vm.generarProducto(ui.item));

            /*vm.newProductoID(ui.item.codigo);
            vm.newProductoStock(ui.item.stock);
            //vm.newProductoCategoria(ui.item.categoria);
            vm.newProductoNombre(ui.item.nombre);
            vm.newProductoMarca(ui.item.marca);
            vm.newProductoCategoria(ui.item.categoria);
            if(vm.cliente.ID=="1"){
                vm.newProductoPrecioSugerido(ui.item.precioPublico);
            }else{
                vm.newProductoPrecioSugerido(ui.item.precioReventa);
            }*/
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

function _cargar_mensajes(clienteid){
        $.ajax({
        url : "<?php echo site_url('comentariocliente/ajax_list/')?>/" + clienteid,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            var promedio = parseFloat(0);
            var cantidad = parseFloat(0);
            var resultado ="";
            $.each(data, function(i, item) {
                resultado= resultado+'<div class="row mensaje mensaje'+item[0]+' col-md-10"><label class="comentario col-md-12">'+item[1]+'</label><label class="puntaje col-md-12">';
                for(i=0;i<item[2];i++){
                    resultado = resultado+'<i class="fa fa-star"></i>';
                }
                resultado = resultado+'</label></div>';
                promedio = parseFloat(promedio) + parseFloat(item[2]);
                cantidad++;
            });
            resultado = '</label></div>' + resultado;
            if (data.length != 0){
                promedio = Math.round((parseFloat(promedio) / cantidad)*2); //multiplico para agarrar los medios
                estrellas ='';
                for(i=1;i<promedio;i=i+2){
                    estrellas = estrellas + '<i class="fa fa-star"></i>';
                }
                if (promedio - i == 1 ){ 
                    estrellas = estrellas + '<i class="fa fa-star-half-o"></i>';
                }
                resultado = 'Puntaje promedio: ' + estrellas + '<span class="numero">('+ parseFloat(promedio)/2 + '/5)</span> ' + resultado;
            }else{
                resultado = ' <span class="numero">No hay comentarios</span> ' + resultado;
            }
            resultado = '<div class="row mensaje col-md-10"><label class="comentario col-md-12">'+resultado;
            $('#mensajesAnteriores').html(resultado);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
$('#cliente').change(function(){
    _cargar_mensajes($('#cliente').val());    
});

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
            <?php if (isset($venta)){?>
                    $('[name="cliente"]').val('<?php echo $venta->clienteid;?>');
                    $('[name="vendedor"]').val('<?php echo $venta->vendedorid;?>');
            
            <?php }else{?>
                $('[name="cliente"]').val('504');
            <?php }?>
            _cargar_mensajes($('#cliente').val()); 

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

        url = "<?php echo site_url('venta/ajax_add')?>";

    } else {

        url = "<?php echo site_url('venta/ajax_update')?>";
    }

    // ajax adding data to database

    $.ajax({

        url : url,

        type: "POST",

        data: $('#form').serialize(),

        //Options to tell jQuery not to process data or worry about content-type.

        dataType: "JSON",

        success: function(data)

        {

            if(data.status) //if success close modal and reload ajax table

            {
        if(save_method=='add'){
                //alert("Alta exitosa");


        }else{
				//alert("Modificacion exitosa");
        }
				//parent.location.reload(true); 
                window.location.href = '<?php echo site_url("venta/renglones_venta/"); ?>'+'/'+data.id;
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

<script type="text/javascript">

	function AppViewModel() {

		var self = this;

		//agregar los attributos del producto

		self.venta=ko.observable(new Venta());

        self.productos=ko.observableArray();
        self.newProducto=ko.observable();       
        /*self.newProductoNombre = ko.observable();
        self.newProductoMarca = ko.observable();
        self.newProductoCategoria = ko.observable();
        self.newProductoID = ko.observable();*/

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

        self.generarProducto = function (p) {
            return new Producto(p);

        };

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

/* SLIDE THREE */
.slideThree {
    width: 80px;
    height: 26px;
    background: #337ab7;
    margin: 0px 0px 0px 200px;

    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    position: relative;

    -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
}

.slideThree:after {
    content: 'NO';
    font: 12px/26px Arial, sans-serif;
    color: #DDD;
    position: absolute;
    right: 10px;
    z-index: 0;
    font-weight: bold;
    text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}

.slideThree:before {
    content: 'SI';
    font: 12px/26px Arial, sans-serif;
    color: #FFF;
    position: absolute;
    left: 10px;
    z-index: 0;
    font-weight: bold;
}

.slideThree label {
    display: block;
    width: 34px;
    height: 20px;

    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;

    -webkit-transition: all .4s ease;
    -moz-transition: all .4s ease;
    -o-transition: all .4s ease;
    -ms-transition: all .4s ease;
    transition: all .4s ease;
    cursor: pointer;
    position: absolute;
    top: 3px;
    left: 3px;
    z-index: 1;

    -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    background: #fcfff4;

    background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}

.slideThree input[type=checkbox]:checked + label {
    left: 43px;
}




.form-group{
	margin-bottom: 5px;
}
.thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
}
#mensajesAnteriores{
    float: left;
    max-height: 270px;
    overflow-y: auto;
    overflow-x: hidden;
}
#mensajesAnteriores .numero{
	font-family:Arial, serif;
}
#mensajesAnteriores .fa{
    color:#ffd119;
}
.mensaje, .comentario, .puntaje{
    width: 100%;
    float:left;
}
.mensaje{
    position: relative;
    margin-top: 10px;
}
.mensaje a{
    position: absolute;
    top: 0;
    right: -5px;
}
.modal-body {
    float: left;
    padding: 15px;
    position: relative;
    width: 100%;
}
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