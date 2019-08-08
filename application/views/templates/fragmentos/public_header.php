<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Tecnoland</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Tecnoland Lan Party Videojuegos Gamer eSports" name="keywords">
  <meta content="Asociación dedicada a la organización de eventos de videojuegos." name="description">

  <!-- Favicons -->
  <link href="<?= assets()?>img/favicon.png" rel="icon">
  <link href="<?= assets()?>img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?= assets()?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?= assets()?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= assets()?>lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?= assets()?>lib/venobox/venobox.css" rel="stylesheet">
  <link href="<?= assets()?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?= assets()?>css/style.css" rel="stylesheet">
  

  
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <!-- Uncomment below if you prefer to use a text logo -->
        <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
        <a href="#intro" class="scrollto"><img src="<?= assets()?>img/logo.png" alt="" title=""></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="<?php echo site_url('#intro');?>">Home</a></li>
          <!--<li><a href="<?php echo site_url('#about');?>">Tecnoland</a></li>-->
          <li><a href="<?php echo site_url('ligacod');?>">Liga Netllar</a></li>
          <li><a href="<?php echo site_url('#speakers');?>">Actividades</a></li>
          <li><a href="<?php echo site_url('#schedule');?>">Programa</a></li>
          <li><a href="<?php echo site_url('#venue');?>">Ubicación</a></li>
          <!--<li><a href="#hotels">Hotels</a></li>-->
          <li><a href="<?php echo site_url('#gallery');?>">Galleria</a></li>
          <li><a href="<?php echo site_url('#supporters');?>">Sponsors</a></li>
          <li><a href="<?php echo site_url('#contact');?>">Contacto</a></li>
          <li class="buy-tickets"><a href="<?php echo site_url('#buy-tickets');?>">Entradas</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
