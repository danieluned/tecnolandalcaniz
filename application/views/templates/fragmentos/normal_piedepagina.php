<!-- Footer -->
	<div class="agilefooterwthree" id="agilefooterwthree">
		<div class="container">

			<div class="agilefooterwthree-grids">
				<div class="col-md-3 agilefooterwthree-grid agilefooterwthree-grid1">
					<h4>INFORMATION</h4>
					<ul>
						<li><a href="#">SPECIALS</a></li>
						<li><a href="#">NEW PRODUCTS</a></li>
						<li><a href="#">TOP SELLERS</a></li>
						<li><a href="#">BLOGS</a></li>
						<li><a href="#">REVIEWS</a></li>
						<li><a href="#">NEWS</a></li>
					</ul>
				</div>
				<div class="col-md-3 agilefooterwthree-grid agilefooterwthree-grid2">
					<h4>CATEGORIES</h4>
					<ul>
						<li><a href="#">GAME GENRES</a></li>
						<li><a href="#">PC GAMES</a></li>
						<li><a href="#">PLAYSTATION GAMES</a></li>
						<li><a href="#">XBOX GAMES</a></li>
						<li><a href="#">WII GAMES</a></li>
						<li><a href="#">ALL GAMES</a></li>
					</ul>
				</div>
				<div class="col-md-3 agilefooterwthree-grid agilefooterwthree-grid3">
					<h4>MY ACCOUNT</h4>
					<ul>
						<li><a href="#">MY ACCOUNT</a></li>
						<li><a href="#">MY ORDERS</a></li>
						<li><a href="#">MY DOWNLOADS</a></li>
						<li><a href="#">EDIT PROFILE</a></li>
						<li><a href="#">CHANGE PASSWORD</a></li>
						<li><a href="#">DONATE</a></li>
					</ul>
				</div>
				<div class="col-md-3 agilefooterwthree-grid agilefooterwthree-grid4">
					<h4>CONTACT</h4>
					<address>
						<ul>
							<li>40019 S.p.A</li>
							<li>Parma Via Modena</li>
							<li>Sant'Agata Bolognese</li>
							<li>BO, Italy</li>
							<li>+1 (734) 123-4567</li>
							<li><a class="mail" href="mailto:mail@example.com">info@example.com</a></li>
						</ul>
					</address>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="agilefooterwthreebottom">
				<div class="col-md-6 agilefooterwthreebottom-grid agilefooterwthreebottom-grid1">
					<div class="copyright">
						<p>� 2017 Game Robo. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="=_blank"> W3layouts </a></p>
					</div>
				</div>
				<div class="col-md-6 agilefooterwthreebottom-grid agilefooterwthreebottom-grid2">
					<div class="agilesocialwthree">
						<ul class="social-icons">
							<li><a href="#" class="facebook w3ls" title="Go to Our Facebook Page"><i class="fa w3ls fa-facebook-square" aria-hidden="true"></i></a></li>
							<li><a href="#" class="twitter w3l" title="Go to Our Twitter Account"><i class="fa w3l fa-twitter-square" aria-hidden="true"></i></a></li>
							<li><a href="#" class="googleplus w3" title="Go to Our Google Plus Account"><i class="fa w3 fa-google-plus-square" aria-hidden="true"></i></a></li>
							<li><a href="#" class="instagram wthree" title="Go to Our Instagram Account"><i class="fa wthree fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#" class="youtube w3layouts" title="Go to Our Youtube Channel"><i class="fa w3layouts fa-youtube-square" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>

		<a href="#agileitshome" class="agileto-top scroll" title="To Top"><img src="<?= assets()?>images/to-top.png" alt="Game Robo"></a>

	</div>
	<!-- //Footer -->



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

		<!-- Smooth-Scrolling-JavaScript -->
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll").click(function(event){
						event.preventDefault();
						$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
					});
				});
			</script>
		<!-- //Smooth-Scrolling-JavaScript -->

	<!-- //Custom-JavaScript-File-Links -->
			<script src="<?= assets()?>js/cabecera.js"></script> 
			
	<!--  Custom files -->
	 <?php echo $before_body?>
</body>
<!-- //Body -->



</html>