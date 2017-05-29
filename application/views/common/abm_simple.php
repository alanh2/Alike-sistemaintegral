<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
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

var modal_abierto=false;
$(document).ready(function() {
	<?php if(isset($_REQUEST['search'])){?>
		$search="<?php echo $_REQUEST['search']; ?>";
	<?php }else{?>
		$search='';
		<?php }?>
	$(document).keypress(function(event) {
		if(event.charCode==43){//+
			if(!modal_abierto){
                $("#agregar").trigger("click");
                modal_abierto=true;
		    }
        }
		//alert('Handler for .keypress() called. - ' + event.charCode);
	});
	
	$('#modal_form').on('shown.bs.modal', function () {
		$('#nombre').focus();
		//$(this).find('[autofocus]').focus();
	});
	
	$("#modal_form").on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null);
        modal_abierto=false;
	});
	
	$('#form').submit(function(event) {
		save();
		$('#nombre').attr('disabled',true); 
		event.preventDefault();
	});
});
</script>
<style type="text/css">
#page-wrapper{
    background-image: url("<?php echo base_url('assets/images/fondo_claro.jpg');?>");
}
#table{ background:#ffffff; }
</style>