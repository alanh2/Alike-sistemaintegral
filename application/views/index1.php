<style>
/* aca syle personal*/

.producto{
	font-family:"Museo Sans 300";
	font-size:17pt;
	color:#FFF;
	text-align:center;
	height:35px;
	padding-top:5px;
	margin-bottom:7.5px;
	}

.producto_descripcion{
	font-family:"Museo Sans 300";
	font-size:13pt;
	color:#000;
}
.mas_info{
	font-family:"Museo Sans 500";
	font-size:12pt;
	color:#595959;
	
	}
.producto_primero{
	background-color:#005473;
}
.producto_segundo{
	background-color:#005C68;
}
.producto_tercero{
	background-color:#961F42;
}
.producto_cuarto{
	background-color:#801F63;
}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tresor Travel</title>
<link rel="stylesheet" href="css/fonts.css" type="text/css">
<link rel="stylesheet" href="css/slider.css" type="text/css">
<link rel="stylesheet" href="css/common.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="js/common.js"></script> 
<script src="js/jquery.flexslider-min.js"></script>
<link href="css/pulldown.css" rel="stylesheet">
</head>

<body>

<div class="container_12 header" style="vertical-align:bottom;">
    <div class="grid_12 alpha omega">
        <div class="grid_4 omega">
            <a href="index.php"><img src="recursos/imagenes/logotresortravel.jpg"/></a>
        </div>
        <div class="grid_2 alhpha omega">&nbsp;</div>
        <div class="grid_3 alpha omega" align="right">
            <div style="padding-top:25px">
                <ul class="menu" style="display:table">
                    <li style="display:table-cell; vertical-align:middle"><a href="#">Inicio</a></li>
                    <li style="display:table-cell; vertical-align:middle"><a href="#">Quienes Somos</a></li>
                    <li style="display:table-cell; vertical-align:middle"><a href="#">Contacto</a></li>
                    <li style="display:table-cell;"><a target="_blank" href="http://www.fb.com/tresortravel" class="fb">&nbsp;</a></li>
                </ul>
            </div>
        </div>
        <div class="grid_3 alpha omega" style="float:right;">
                <div style="padding-top:25px;">
                	<div style="font-size:17pt; color:#961F42; font-family:'Museo 700'; float:right">&nbsp;4328-1896</div>
                    <div style="font-size:17pt; color:#961F42; font-family:'Museo 100'; float:right">(5411)</div>
                    
	                <a href="mailto:info@tresortravel.com.ar" style="text-decoration: none;"><div style="font-size:14pt; color:#595959; font-family:'Museo Sans 500'; float:right;">info@tresortravel.com.ar</div></a>
                </div>
                
        </div>
    </div>
</div>
<div class="container_12"><div class="separador"></div></div>

<div class="container_12" style="background-color:#FFF">
    <div><div class="container_12"><div class="separador"></div></div>

<div class="container_12"><div class="separador"></div></div>
<div align="center"><img src="mantenimiento.jpg"/></div>
</div>
<?php include("footer.php");?>
</body>
</html>


<script>
$(document).ready(function () {
	$('.flexslider').flexslider({
		animation: 'fade',
		controlsContainer: '.flexslider'
	});
});
</script>
<script>
    $('nav').pulldown();    
</script>