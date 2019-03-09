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
								<div class="row body-jugador">
									<div class="col">										
										<h3> <?=$rango?> </h3>
										<h3> <?=$inscrito->nombre?> </h3>
									</div>
								</div>
								

							</div>	
						</div>					
					<?php }?>
				</div>
				<div class="col-12 resultados">
							<div class="container-fluid">   
									<div class="header-resultados text-center"> 
											<h2> Resultados </h2>
									</div>
									<!--<div class="body-resultados">   
											<table class="table table-striped table-dark text-center sombra-png-negra">

														<thead>

															<tr>                                                          
																<th scope="col-4">Local</th>
																<th scope="col-4"> VS </th>
																<th scope="col-4">Visitante</th>                                                           
															</tr>
														</thead>
														<tbody>
															<?php 
															$partidasCerradas = $equipo->getPartidasCerradas();
															foreach($partidasCerradas as $partida){
																	$juegaEquipo0 = $partida->getJuegaEquipoLocal();
																	$juegaEquipo1 = $partida-> getJuegaEquipoVisitante();
																	$equipo0 = $juegaEquipo0->getEquipo();
																	$equipo1 = $juegaEquipo1->getEquipo();
															?>
															<tr>                                                          
																<td scope="col-4">
																	<a href="#">
																			<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">
																	</a>
																
																	</td>

																<td scope="col-4"> <?=$juegaEquipo0->puntuacion?> - <?=$juegaEquipo1->puntuacion?> </td>

																<td scope="col-4">
																	<a href="#">
																			<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">
																	</a>
																	
																</td>
															</tr>
															<?php }?>
														</tbody>
													</table>
									</div>  -->
							</div>  
			</div>
				<div class="row competiciones">
					
				</div>
			</div>
		</div>
		<div class="row footer-equipo">
			
		</div>
	</div>
</section>