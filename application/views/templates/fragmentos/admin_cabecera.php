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
<!-- Custom-JavaScript-File-Links -->

		<!-- Default-JavaScript -->   <script type="text/javascript" src="<?= assets()?>js/jquery-2.1.4.min.js"></script>
		<!-- Bootstrap-JavaScript --> <script type="text/javascript" src="<?= assets()?>js/bootstrap.min.js"></script>

		<!-- Resopnsive-Slider-JavaScript -->
			<script src="<?= assets()?>js/responsiveslides.min.js"></script>
			
			<script>
				$(function () {
					$("#slider").responsiveSlides({
						auto: true,
						nav: true,
						speed: 1000,            // Integer: Speed of the transition, in milliseconds
						timeout: 5500,          // Integer: Time between slide transitions, in milliseconds
						namespace: "callbacks",
						pager: true,
					});
				});
			</script>
			
		<!-- //Resopnsive-Slider-JavaScript -->

		<!-- Tab-JavaScript -->
			<script src="<?= assets()?>js/cbpFWTabs.js"></script>
			<script>
				(function() {
					[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
						new CBPFWTabs( el );
					});
				})();
			</script>
		<!-- //Tab-JavaScript -->

		<!-- Owl-Carousel-JavaScript -->
			<script src="<?= assets()?>js/owl.carousel.js"></script>
			<script>
				$(document).ready(function() {
					$("#owl-demo, #owl-demo1, #owl-demo2, #owl-demo3, #owl-demo4, #owl-demo5, #owl-demp6").owlCarousel({
						autoPlay: 1000,
						items : 6,
						itemsDesktop : [1024,4],
						itemsDesktopSmall : [414,3]
					});
				});
			</script>
		<!-- //Owl-Carousel-JavaScript -->

		<!-- Stats-Number-Scroller-Animation-JavaScript -->
			<script src="<?= assets()?>js/waypoints.min.js"></script> 
			<script src="<?= assets()?>js/counterup.min.js"></script> 
			<script>
				jQuery(document).ready(function( $ ) {
					$('.counter').counterUp({
						delay: 10,
						time: 1000
					});
				});
			</script>
		<!-- //Stats-Number-Scroller-Animation-JavaScript -->

		<!-- Popup-Box-JavaScript -->
			<script src="<?= assets()?>js/jquery.chocolat.js"></script>
			<script type="text/javascript">
				$(function() {
					$('.w3portfolioaits-item a').Chocolat();
				});
			</script>
		<!-- //Popup-Box-JavaScript -->

		

	<!-- //Custom-JavaScript-File-Links -->
			<script src="<?= assets()?>js/cabecera.js"></script> 
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
			<nav class="navbar navbar-inverse agilehover-effect wthreeeffect navbar-default navbar-fixed-top" style="padding-bottom: 10px;">
				<!--  Añadimos la normativa de informar al usuario del uso de cookies -->
			
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Logo -->
					<div class="logo">
						<a class="navbar-brand logo-w3l button" href="<?= base_url()?>"><img src="<?= assets()?>images/snText.png" style="width:34px;height:34px;" class="d-inline-block align-top" alt=""> <span>TECNOLAND</span> </a>
					</div>
					<!-- //Logo -->
				</div>
				<?php if ($this->ion_auth->logged_in()){?>
				<div id="navbar" class="navbar-collapse navbar-right collapse">
					<ul class="nav navbar-nav navbar-right cross-effect" id="cross-effect">
					<?=$current_user_menu?>
					
  					</ul>
				</div><!-- //Navbar-Collapse -->
				<?php }?>
			</nav>
				
		</div>
		<!-- //Navigation -->
	</div>
	<br/><br/><br/>
	<!-- //Header -->
	<?php
    if($this->session->flashdata('message'))
    {
    ?>
      <div class="container">
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
    aria-hidden="true">&times;</span></button>
          <?php echo $this->session->flashdata('message');?>
        </div>
      </div>
    <?php
    }
    ?>
