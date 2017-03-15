<link href="<?php echo base_url('assets/css/multiple_image_upload.css')?>" rel="stylesheet">

<div id="page-wrapper" data-bind="with:venta">

<style>

.stacked{
	float:left;
}
</style>
    <br />
<?php
    $ventaid ='';
    if (isset($venta)){
        $ventaid = $venta->id;
    }
?>
        <div class="header"></div><br />
        <?php
            $this->view('venta_menu_view');
        ?>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vendedor: <?php echo $venta->vendedor;?></span>
            <br />
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cliente: <?php echo $venta->cliente;?></span>
            <br />
            <br />
        <div class="form">

			<form action="#" id="form" class="form-horizontal">
                <input id="ventaid" name="ventaid" type="hidden"/> 
                <input id="clienteid" name="clienteid" type="hidden" />
                <input id="ventasenviosid" name="ventasenviosid" type="hidden" />

                <div class="form-body">
					<div class="form-group">
						<label class="control-label col-md-3">Elija el método de envio</label>
						<div class="col-md-5">
						    <select id="metodos" name="metodo" class="form-control" data-bind="value:metodo">
						    </select>
						    <span class="help-block"></span>
						</div>
					</div>
                </div>

            </div>
		        <div class="modal-footer">
				    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
		            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		        </div>
        </form>
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
var table;


$(document).ready(function() {
    $select_metodos = $('#metodos');
    $.ajax({
        url: "<?php echo site_url('metodoenvio/ajax_dropdown')?>"
        , "type": "GET"
        , data:{}
        , dataType: 'JSON'
        , success: function (data) {
            $select_metodos.html('');
            $.each(data.metodos, function (key, val) {
                $select_metodos.append('<option value="' + val.id + '">' + val.nombre + '</option>');
            })
        }
        , error: function () {
            $select_metodos.html('<option id="-1">ninguno disponible</option>');

        }

    });

    $.ajax({
        url: "<?php echo site_url('venta/ajax_venta2/'.$venta->id)?>"
        , "type": "GET"
        , data:{}
        , dataType: 'JSON'
        , success: function (data) {
            $("#ventaid").val(data.id);
            $("#clienteid").val(data.clienteid);
        }
        , error: function () {
        }

    });

    $.ajax({
        url: "<?php echo site_url('venta/ajax_datos_envio_por_venta/'.$venta->id)?>"
        , "type": "GET"
        , data:{}
        , dataType: 'JSON'
        , success: function (data) {
            if (data != null){
                $("#metodos").val(data.metodoenvioid);
                $("#ventasenviosid").val(data.id);
            }
        }
        , error: function () {
        }

    });

    $("#metodos").change(function(){
    	$(".metodo").hide();
    	switch ($("#metodos").val()){
    		case "1": //Retira el cliente
    			break;
    		case "2": //OCA
    			//$(".metodo.oca").show();
    			break;
            case "3": //OCA Express
                //$(".metodo.ocaexpress").show();
                break;
            case "4": //Moto
                //$(".metodo.moto").show();
                break;
    		case "5": //Otros
    			//$(".metodo.otros").show();
    			break;
    	}
	});
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





function save()
{

    $('#btnSave').text('saving...'); //change button text

    $('#btnSave').attr('disabled',true); //set button disable 

    var url;

    url = "<?php echo site_url('venta/completar_envio')?>";

    $.ajax({

        url : url,

        type: "POST",

        data: $('#form').serialize(),

        //Options to tell jQuery not to process data or worry about content-type.

        dataType: "JSON",

        success: function(data)

        {

            if(data.resultado == 'Ok') //if success close modal and reload ajax table
            {
				alert("Envio completado");
				window.location.href = '<?php echo site_url("venta/metodo_pago_venta/").'/'.$venta->id ?>';
            }else{
				alert("Ocurrio un error al intentar hacer la grabación")
            }

            $('#btnSave').text('guardar'); //change button text

            $('#btnSave').attr('disabled',false); //set button enable 

        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error, no pudo ser completada la venta');
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


<style>

.form-group{
	margin-bottom: 5px;
}
.thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
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
.metodo{
	display: none;
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