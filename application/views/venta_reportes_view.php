<link href="<?php echo base_url('assets/css/multiple_image_upload.css')?>" rel="stylesheet">

<div id="page-wrapper" data-bind="with:producto">

<form action="generar_reporte" id="form" class="form-horizontal" target="_blank">

    <div>

    <br />

        <div class="header">

            <h3 class="title">Reporte de Productos</h3>

        </div><br />

        <div class="form">

            <!--<form action="#" id="form" class="form-horizontal">--> 

                <div class="form-body">

                    <div class="form-group">

                        <label class="control-label col-md-2">Local</label>

                        <div class="col-md-4">

                            <select id="local" name="local" class="form-control" data-bind="value:local">
                            <option value="">Todos</option>
                            <option value="1">ORSHICELL</option>
                            <option value="2">SALVACELL</option>
                            <option value="3">SEICELL</option>
                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-2">Fecha Desde</label>
                        
                        <div class="col-md-1">

                            <input id="fechadesde" name="fechadesde" class="form-control datepicker"/>
                        </div>

                        <div class="col-md-4">

                            <span class="help-block"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-2">Fecha Hasta</label>

                        <div class="col-md-1">

                            <input id="fechahasta" name="fechahasta" class="form-control datepicker"/>
                        
                        </div>

                        <div class="col-md-4">

                            <span class="help-block"></span>

                        </div>

                    </div>

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
                    <!--
                    <div class="form-group">

                        <label class="control-label col-md-2">Columnas</label>

                        <div class="col-md-4">
                            
                            <table width="200px">
                            <tr><td>Mostrar Cantidad</td><td><input type="checkbox" name="mostrar_cantidad"></td></tr>
                            <tr><td>Mostrar Costo</td><td><input type="checkbox" name="mostrar_costo" ></td></tr>
                            <tr><td>Mostrar Lista 1</td><td><input type="checkbox" name="mostrar_l1" ></td></tr>
                            <tr><td>Mostrar Lista 2</td><td><input type="checkbox" name="mostrar_l2" ></td></tr>
                            <tr><td>Mostrar Lista 3</td><td><input type="checkbox" name="mostrar_l3" ></td></tr>
                            <tr><td>Mostrar Lista 4</td><td><input type="checkbox" name="mostrar_l4" ></td></tr>
                            </table>
                            <span class="help-block"></span>

                        </div>

                     </div>
                     -->         

                </div>

        </div>


    
        <div class="modal-footer">

            <!--<button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-lg">Generar Reporte</button>-->
                <button type="submit" id="btnSave" class="btn btn-primary btn-lg">Generar Reporte</button>

        </div>

    </div>

</form>

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

<script src="<?php echo base_url('assets/js/multiple_image_upload.js')?>"></script>





<script type="text/javascript">

    <?php if (isset($data['producto'])){?>

    var producto=<?php echo json_encode( $data['producto']);?>;
    console.log(producto);
    $('#nombre').focus();
    var editColores=[];
    editColores=<?php echo json_encode( $data['colores']);?>;
    console.log(editColores);
    <?php } ?>

var table;

var vm;

$(document).ready(function() {

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

            $select_clientes.append('<option value="">Todos</option>');

            $.each(data.clientes, function (key, val) {

                $select_clientes.append('<option value="' + val.id + '">' + val.nombre + '</option>');

            })
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

            $select_vendedores.append('<option value="">Todos</option>');

            $.each(data.vendedores, function (key, val) {

                $select_vendedores.append('<option value="' + val.id + '">' + val.nombre + '</option>');

            })

        }

        , error: function () {

            //if there is an error append a 'none available' option

            $select_vendedores.html('<option id="-1">ninguna disponible</option>');

        }

    });

    //datatables
    //get a reference to the select element
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
    
    <?php if (isset($data['producto'])){?>
        $('[name="id"]').val(producto.id);
        $('[name="nombre"]').val(producto.nombre);
        $('[name="proveedor"]').val(producto.proveedorid);
    
    <?php } ?>

});



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

                //alert("Alta exitosa")

                //parent.location.reload(true); 

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

        self.producto=ko.observable(new Producto());

        self.colores=ko.observableArray();

        self.newColor = ko.observable();
        self.coloresProducto= ko.observableArray();

        self.deleteFile = function (file) {

                self.producto().files.remove(file) ;

            };

        self.deleteProductoColor = function (color) { 

            self.colores.push(color);

            self.producto().colores.remove(color);

        };

        self.createColor = function (id,nombre,name) {

            self.colores.push(new Color(id,nombre,name));

        };
        self.crearProductoColor = function(color){
            //function Color(id,nombre,name,costo=0,porcentaje1=0,porcentaje2=0,porcentaje3=0,porcentaje4=0,cantidad=0,tieneStock=0){
            koColor=new Color(color.colorid,color.nombre,color.name,color.costo,color.porcentaje1,color.porcentaje2,color.porcentaje3,color.porcentaje4,color.cantidad,color.tieneStock);
            self.producto().colores.push(koColor);
            self.colores.remove(self.obtenerColor(color.colorid));
            
        }
        self.createProductoColor = function () {

            var color=self.obtenerColor(self.newColor());
            console.log(color);
            self.producto().colores.push(color);

            //console.log(self.newColor());

            self.colores.remove(color);

            if (self.colores().length==0){

                //verificar longitud de colores, si es 0 disable

                //alert("asd");

            }

            window.scrollTo(0,document.body.scrollHeight);      

        };

        
        self.obtenerColor = function(id){
                    return ko.utils.arrayFirst(self.colores(), function(color) {
                       return color.id === id;
                    });
        }

        function Producto(){

            var self=this;

            self.codigo=ko.observable();

            self.nombre=ko.observable();

            self.marca=ko.observable();

            self.modelo=ko.observable();

            self.categoria=ko.observable();

            self.subcategoria=ko.observable();

            self.proveedor=ko.observable();

            self.colores=ko.observableArray();

            /*

            self.files=  ko.observableArray([]);

            self.fileSelect= function (elemet,event) {

                var files =  event.target.files;// FileList object

        

                // Loop through the FileList and render image files as thumbnails.

                for (var i = 0, f; f = files[i]; i++) {

        

                  // Only process image files.

                  if (!f.type.match('image.*')) {

                    continue;

                  }          

        

                  var reader = new FileReader();

        

                  // Closure to capture the file information.

                  reader.onload = (function(theFile) {

                      return function(e) {                             

                          self.files.push(new FileModel(escape(theFile.name),e.target.result));

                      };                            

                  })(f);

                  // Read in the image file as a data URL.

                  reader.readAsDataURL(f);

                }

                //reset($('#files'));

            };*/

        }

        /*

        var FileModel= function (name, src) {

            var self = this;

            this.name = name;

            this.src= src ;

            console.log(this);

        };*/



        function Color(id,nombre,name,costo=0,porcentaje1=0,porcentaje2=0,porcentaje3=0,porcentaje4=0,cantidad=0,tieneStock=0){

            var self=this;

            self.id=id;

            self.nombre=ko.observable(nombre);

            self.name=ko.observable(name);

            self.costo=ko.observable(costo);

            self.porcentaje1=ko.observable(porcentaje1);

            self.porcentaje2=ko.observable(porcentaje2);

            self.porcentaje3=ko.observable(porcentaje3);

            self.porcentaje4=ko.observable(porcentaje4);

            self.tieneStock=ko.observable(tieneStock);

            self.cantidad=ko.observable(cantidad);
            

            self.calcularPorcentaje=function(lista){

                //console.log("Calcular porcentaje");

                return (parseFloat(lista)-parseFloat(self.costo()))*100/parseFloat(self.costo());

            };

            

            self.calcularLista=function(porcentaje){

                //console.log(parseFloat(porcentaje())+parseFloat(100));

                return Math.round((parseFloat(porcentaje())+parseFloat(100))*parseFloat(self.costo())/100);

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

.thumb {

    height: 75px;

    border: 1px solid #000;

    margin: 10px 5px 0 0;

}

    

</style>