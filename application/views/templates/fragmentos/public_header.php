<!DOCTYPE html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?= assets()?>css/bst4/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="<?= assets()?>css/newIndex.css">
        <link rel="stylesheet" type="text/css" href="<?= assets()?>css/efectos.css">
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="<?= assets()?>js/efectos.js"></script>
        <title>Tecnoland Alcañiz</title>
    </head>
    <style type="text/css">
       
    </style>
    <body>
    <!-- Cabecera -->
        <header>
          <div class="container-fluid">
            <!-- Menu Cabecera -->
            <div class="row header-navbar">
                <nav id="navHeader" class="navbar navbar-expand-lg navbar-dark col-12">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>                                                      
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="container">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <img id="navLogo" src="<?= assets()?>images/Alien_vec_letras_blanco.png">
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('inicio');?>"> Inicio <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('ligacod');?>"> Liga COD</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#contacto"> Contacto </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="nav-link" href="#">Disabled</a>
                                </li>-->                        
                            </ul>
                         </div>
                    </div>
                </nav>
            </div>          
            
          </div>
        </header>
