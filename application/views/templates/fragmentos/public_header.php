<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Tecnoland</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Tecnoland Lan Party Videojuegos Gamer eSports" name="keywords">
  <meta content="Asociación dedicada a la organización de eventos de videojuegos." name="description">

  <!-- Favicons -->

  <link  rel = "apple-touch-icon"  tallas = "57x57"  href = "<?= assets()?>img/iconos/apple-icon-57x57.png" > 
  <link  rel = "apple-touch-icon"  tallas = "60x60"  href = "<?= assets()?>img/iconos/apple -icon-60x60.png " > 
  <link  rel = " apple-touch-icon "  tamaños = " 72x72 "  href = "<?= assets()?>img/iconos/apple-icon-72x72.png " > 
  <link  rel = " apple-touch-icon "  tamaños = "76x76"  href = "<?= assets()?>img/iconos/apple-icon-76x76.png" > 
  <link  rel = "apple-touch-icon "  tamaños = " 114x114 "  href = "<?= assets()?>img/iconos/apple-icon-114x114.png "> 
  <link  rel = "apple-touch-icon"  tallas = "120x120"  href = "<?= assets()?>img/iconos/apple-icon-120x120.png" > 
  <link  rel = "apple-touch-icon"  tallas = "144x144"  href = "<?= assets()?>img/iconos/apple-icon-144x144.png " > 
  <link  rel = " apple-touch-icon "  tamaños = " 152x152 "  href = "<?= assets()?>img/iconos/apple-icon-152x152.png " > 
  <link  rel = " apple-touch-icon "  tamaños = "180x180"  href = "<?= assets()?>img/iconos/apple-icon-180x180.png" > 
  <link  rel = "icon"  type = "image / png"  tamaños = "192x192"  href = "<?= assets()?>img/iconos/android-icon-192x192.png" > 
  <link  rel = "icon"  type = "image / png"  tamaños = "32x32"  href = "<?= assets()?>img/iconos/favicon-32x32.png" > 
  <link  rel = "icon"  type = "image / png"  tallas = "96x96"  href = "<?= assets()?>img/iconos/favicon-96x96.png" > 
  <link  rel = "icon"  type = "image / png"  tallas = "16x16"  href = "<?= assets()?>img/iconos/favicon-16x16. png " > 
  <link  rel = " manifest " href = "<?= assets()?>img/iconos/<?= assets()?>img/iconos/manifest.json" > 
  <meta  name ="msapplication-TileColor"  content = "#ffffff" > 
  <meta  name = "msapplication-TileImage"  content = "<?= assets()?>img/iconos/ms-icon-144x144.png" > 
  <meta  name = "theme-color"  content = "#ffffff" >

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
