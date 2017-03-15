<div id="page-wrapper" data-bind="with:cobro">
<form action="#" id="form" class="form-horizontal">
    <div>
    <br />
        <div class="header">
            <h3 class="title">Formulario de Cobros</h3>
        </div><br />
        <div class="form">
            <!--<form action="#" id="form" class="form-horizontal">-->
                <input type="hidden" value="" name="id"/> 
                <div class="form-body">
                    <div class="form-group" style="display:none;">
                        <label class="control-label col-md-2">Codigo</label>
                        <div class="col-md-4">
                            <input name="codigo" placeholder="Codigo" class="form-control" type="text" data-bind="value:codigo">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Nombre</label>
                        <div class="col-md-4">
                            <input name="nombre" placeholder="Nombre" class="form-control" type="text" data-bind="value:nombre">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Marca</label>
                        <div class="col-md-4">
                            <select id="marca" name="marca" class="form-control" data-bind="value:marca">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Modelo</label>
                        <div class="col-md-4">
                            <select id="modelo" name="modelo" class="form-control" data-bind="value:modelo">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Categoria</label>
                        <div class="col-md-4">
                            <select id="categoria" name="categoria" class="form-control" data-bind="value:categoria">
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">SubCategoria</label>

                        <div class="col-md-4">

                            <select id="subcategoria" name="subcategoria" class="form-control" data-bind="value:subcategoria">

                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-md-2">Proveedor</label>

                        <div class="col-md-4">

                            <select id="proveedor" name="proveedor" class="form-control" data-bind="value:proveedor">

                            </select>

                            <span class="help-block"></span>

                        </div>

                    </div>         

                </div>

            <!--</form>-->

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

    <?php if (isset($data['cobro'])){?>

    var cobro=<?php echo json_encode( $data['cobro']);?>;
    console.log(cobro);

    var editColores=[];
    editColores=<?php echo json_encode( $data['colores']);?>;
    console.log(editColores);
    <?php } ?>

var save_method='<?php echo $data['save_method'];?>'; //for save method string

var table;

var vm;

$(document).ready(function() {


	vm = new AppViewModel();

	ko.applyBindings(vm);
    //datatables
    $('.datepicker').datepicker({

        autoclose: true,

        format: "yyyy-mm-dd",

        todayHighlight: true,

        orientation: "top auto",

        todayBtn: true,

        todayHighlight: true,  

    });

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



function save()

{

    $('#btnSave').text('saving...'); //change button text

    $('#btnSave').attr('disabled',true); //set button disable 

    var url;



    if(save_method == 'add') {

        url = "<?php echo site_url('cobro/ajax_add')?>";

    } else {

        url = "<?php echo site_url('cobro/ajax_update')?>";

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

            alert('Error agregando / modificando cobro');

            $('#btnSave').text('guardar'); //change button text

            $('#btnSave').attr('disabled',false); //set button enable 



        }

    });

}

window.reset = function (e) {

    e.wrap('<form>').closest('form').get(0).reset();

    e.unwrap();

}


</script>