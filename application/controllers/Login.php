<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>bootstrap.css" />
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>linea-icon.css" />
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>fancy-buttons.css" />

    <!--=== Google Fonts ===-->
    <link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,700,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:600,400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <!--=== Other CSS files ===-->
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>custom.css" >

    <!--=== Main Stylesheets ===-->
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>style.css" />
    <link rel="stylesheet" href="<?php echo HTTP_CSS_PATH; ?>responsive.css" />

    <title>Admin Login</title>
</head>
<body>
<!--=== Principal section ===-->
<div class="container features center">
    <div class="row">
        <h3>INICIO DE SESION (PANEL)</h3>
        <div class="col-lg-4 col-lg-offset-4 login-box">
            <p>Ingresa tu nombre de usuario y contraseña para loguearte!!</p>
            <?php
            if(isset($_SESSION['error'])){
                ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
                <?php
            }
            echo validation_errors('<div class="alert alert-danger">','</div>');
            echo form_open(base_url().'users_admin/login');

            echo form_label('Nombre de usuario:');
            echo form_input(array('id' => 'username', 'name' => 'username', 'class' => 'form-control'));
            echo form_label('Contraseña:');
            echo form_input(array('id' => 'password', 'type' => 'password', 'name' => 'password', 'class' => 'form-control'));
            echo form_submit(array('id' => 'submit', 'value' => 'Ingresar', 'class'=>'login'));
            echo form_close();
            ?>
        </div>
    </div>
</div>
<!--=== Principal section Ends ===-->