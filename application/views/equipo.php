<link rel="stylesheet" type="text/css" href="<?= assets()?>css/equipo.css">
<section class="equipo">
	<div class="container">
		<div class="row hader-equipo justify-content-around">
			<img class="sombra-png-negra logo-equipo" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo->id?>/<?=$equipo->logotipo?>">
		</div>
		<div class="row body-equipo">
			<div class="container-fluid">
				
				<div class="row jugadores justify-content-around text-center">
					<div class="col-12 header-jugadores">
						<h3> Squad </h3>
					</div>
					<?php
					$inscritos = $equipo->getInscrito();	
					 foreach($inscritos as $inscrito){
						$rango = 'Soldado';
						if ($equipo->capitan==$inscrito->id) {
							$rango = 'Capitan';
						}
						if ($inscrito->logotipo != "") { 
							$ruta = assets().'/images/competiciones/'.$competicion->id.'/inscrito/'.$inscrito->id.'/'.$inscrito->logotipo;		
						} 
						else{ 
							$ruta = assets().'/images/iconos/Perfil.png';
						 }
					?>
						<div class="col-3 jugador " style="background-image: url('<?=$ruta?>');">
							<div class="container-fluid">
								
								<div class="row  header-jugador" >
									
									
								</div>
								<div class="row body-jugador text-center">
									<h3 class="text-center"> <?=$inscrito->nombre?> </h3><br>

									<h3 class="text-center"> <?=$rango?> </h3>
								</div>
								<!--<div class="footer-jugador">
									<h3> <?=$rango?> </h3>
								</div>-->

							</div>	
						</div>					
					<?php }?>
				</div>
				<div class="row competiciones">
					
				</div>
			</div>
		</div>
		<div class="row footer-equipo">
			
		</div>
	</div>
</section>