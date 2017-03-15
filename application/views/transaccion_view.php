<form action="#" id="efectivo" class="form-horizontal">
    <input type="hidden" value="1" name="tipo_transaccion"/> 
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-3">Monto</label>
            <div class="col-md-9">
                <input id="monto" name="monto" placeholder="Monto" class="form-control" type="text" value="100" autofocus>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Fecha</label>
            <div class="col-md-9">
                <input id="fecha" name="fecha" type="text" value="2017-02-07 17:21:17">
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-md-9 col-md-offset-3">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
    </div>
</form>



<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/common.js')?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/dashboard/js/metisMenu.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/dashboard/js/raphael-min.js')?>"></script>
<!--<script src="<?php echo base_url('assets/dashboard/js/morris.min.js')?>"></script>
<script src="<?php echo base_url('assets/dashboard/js/morris-data.js')?>"></script>-->
<script type="text/javascript" src="<?php echo base_url('assets/dashboard/js/sb-admin-2.js')?>"></script>


<script type="text/javascript">

$(document).ready(function() {
	$('#form').submit(function(event) {
		save();
		$('#nombre').attr('disabled',true); 
		event.preventDefault();
	});
    //datepicker
    /*$('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });*/

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

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url = "<?php echo site_url('transaccion/ajax_add_cheque/')?>";
    $.ajax({
        url : url,
        type: "POST",
        data: $('#efectivo').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {

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
            $('#nombre').attr('disabled',false); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('guardar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            $('#nombre').attr('disabled',false); 

        }
    });
}
function delete_cliente(id)
{
    if(confirm('Esta seguro que desea borrar este cliente?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('cliente/ajax_delete')?>/"+id,
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

function delete_mensaje(id)
{
    if(confirm('Esta seguro que desea borrar este mensaje?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('comentariocliente/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                _cargar_mensajes($('[name="clienteidmensaje"]').val());
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/starrr.css')?>">
<script src="<?php echo base_url('assets/js/starrr.js')?>"></script>
<script type="text/javascript">
(window.jQuery, window);

    $('#star1').starrr({
      change: function(e, value){
        if (value) {
          $('#puntaje').val(value);
        }
      }
    });
</script>
<!-- End Bootstrap modal -->