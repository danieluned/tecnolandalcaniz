<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
	
	
	Modificado ->
	Parametros
	   $title  title de la pagina
	   $keywords lista de palabras sobre que va esta pagina
-->



<!DOCTYPE html>
<html lang="es">



<!-- Head -->
<head>

<title><?= $title?></title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?= $keywords?>">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Meta-Tags -->
<link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/gif">
<!-- Custom-Stylesheet-Links -->
<!-- Bootstrap-CSS -->	  <link rel="stylesheet" href="<?= assets()?>css/bootstrap.min.css"  type="text/css" media="all">
<!-- Index-Page-CSS -->	  <link rel="stylesheet" href="<?= assets()?>css/style.css"		   type="text/css" media="all">
<!-- Owl-Carousel-CSS --> <link rel="stylesheet" href="<?= assets()?>css/owl.carousel.css"   type="text/css" media="all">
<!-- Chocolat-CSS -->	  <link rel="stylesheet" href="<?= assets()?>css/chocolat.css"	   type="text/css" media="all">
<!-- Animate-CSS -->	  <link rel="stylesheet" href="<?= assets()?>css/animate-custom.css" type="text/css" media="all">
<!-- //Custom-Stylesheet-Links -->
		<link rel="stylesheet" href="<?= assets()?>css/cabecera.css" type="text/css" media="all">
<!-- Fonts -->
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700"	   type="text/css" media="all">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,100,300,500" type="text/css" media="all">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Press+Start+2P"		   type="text/css" media="all">
<!-- //Fonts -->

<!-- Font-Awesome-File-Links -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- TTF --> <link rel="stylesheet" href="<?= assets()?>fonts/fontawesome-webfont.ttf" type="text/css" media="all">
<!-- //Font-Awesome-File-Links -->

<!--  Custom  -->
<?php echo $before_head;?>
</head>
<!-- //Head -->



<!-- Body -->
<body>
    <!-- Header -->
	<div class="agileheader" id="agileitshome">

		<!-- Navigation -->
		<div class="w3lsnavigation">
			<nav class="navbar navbar-inverse agilehover-effect wthreeeffect navbar-default navbar-fixed-top">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Logo -->
					<div class="logo">
						<a class="navbar-brand logo-w3l button" href="#"><img src="<?= assets()?>images/snText.png" style="width:34px;height:34px;" class="d-inline-block align-top" alt=""> TECNOLAND <span class="hidden-xs">ALCAÑIZ</span></a>
					</div>
					<!-- //Logo -->
				</div>

				<div id="navbar" class="navbar-collapse navbar-right collapse">
					<ul class="nav navbar-nav navbar-right cross-effect" id="cross-effect">
						<li><a class="scroll" href="#wthreetabsaits">LAN PARTY</a></li>
						<li><a class="scroll" href="#wthreeblogsaits">BF-PARTY</a></li>
						<li><a class="scroll" href="#agilecontactw3ls">CONTACTO</a></li>
						
						<?php if ($this->ion_auth->logged_in()){?>
        				
						<li><a href="<?php echo site_url('usuario/perfil');?>">Perfil</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo site_url('usuario/logout');?>">Logout</a></li>
          				
        				<?php }else{?>
        				<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<b class="caret"></b></a>
							<div class="dropdown-menu">
								<form action="<?=site_url('usuario/login')?>" method="post">
									<div id="login" class="animate w3loginagile form">
										<h3>Login</h3>
										<input type="text" Name="identity" placeholder="email">
										<input type="password" Name="password" placeholder="password">
										<div class="send-button wthree agileits">
											<input type="submit" value="Login">
										</div>
										<div class="clearfix"></div>
									</div>
								</form>
								
								<div id="register" class="animate w3registeragile form">
									<a href="<?=site_url('usuario/login')?>">Crear una cuenta</a>
								</div>
								
							</div>
						</li>
        				<?php }?>
						
					</ul>
				</div><!-- //Navbar-Collapse -->

			</nav>
		</div>
		<!-- //Navigation -->
	</div>
	<br/><br/><br/>
	