<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/css/jquery-ui.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/dashboard/css/metisMenu.min.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/dashboard/css/timeline.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/dashboard/css/sb-admin-2.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/dashboard/css/morris.css')?>" rel="stylesheet">

    <link href="<?php echo base_url('assets/dashboard/css/font-awesome.min.css')?>" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url('linea-icon.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('fancy-buttons.css'); ?>" />

    <!--=== Google Fonts ===-->
    <link href='http://fonts.googleapis.com/css?family=Bangers' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:300,700,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:600,400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <!--=== Other CSS files ===-->
    <link rel="stylesheet" href="<?php echo base_url('custom.css'); ?>" >

    <!--=== Main Stylesheets ===-->
    <link rel="stylesheet" href="<?php echo base_url('style.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('responsive.css'); ?>" />

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
            echo form_open('users_admin/login');

            echo form_label('Nombre de usuario:');
            echo form_input(array('id' => 'nombre', 'name' => 'nombre', 'class' => 'form-control'));
            echo form_label('Contraseña:');
            echo form_input(array('id' => 'clave', 'type' => 'password', 'name' => 'clave', 'class' => 'form-control'));
            echo form_submit(array('id' => 'submit', 'value' => 'Ingresar', 'class'=>'login'));
            echo form_close();
            ?>
        </div>
    </div>
</div>
<!--=== Principal section Ends ===-->