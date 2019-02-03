<?php 
$equipos = $competicion->getInscritoEquipo();
$jornadas = $competicion->getJornadas();

$partidas = array(); 
foreach ($jornadas as $jornada) {
    $partidas_j =$jornada->getPartidas(); 
    foreach($partidas_j as $partida){
        $partidas[] = $partida;
    }
}
?>


<link rel="stylesheet" type="text/css" href="<?= assets()?>css/liga.css">
<section class="liga">
                <div class="container ">                    
                    <div class="row header-liga text-center">
                        <img src="<?= assets()?>images/Liga_png.png" class="rounded mx-auto d-block">
                    </div>
                    <div class="row body-liga">
                        <div class="container-fluid">
                            <div class="row equipos justify-content-around text-center">
                        <?php foreach($equipos as $equipo){?>
                        
                                <div class="equipo">
                                    <figure>
                                        <img src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo->id?>/<?=$equipo->logotipo?>">
                                    </figure>
                                    <h6>
                                     <?=$equipo->nombre?>
                                    </h6>
                                </div>
                            
                            
                        <?php }?>
                                                                                    
                    		</div>
                    <div class="row jornada">
                        <div class="container-fluid">
                            <div class="row header-jornada justify-content-around">
                                <div class="col-6 text-center">
                                    <h2>Partidas</h2>
                                </div>
                            </div>
                            <div class="row partidas d-flex justify-content-around">
                                
                               <?php foreach($partidas as $partida){
                                $equipos = $partida->getJuegaEquipos();
                                $equipo0 = $equipos[0]->getEquipo();
                                $equipo1 = $equipos[1]->getEquipo();
                                ?>
                               <div class="partida col-4 text-center">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">              
                                            </div>
                                            <div class="col-6">
                                                <img src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5><?=$equipo0->nombre?></h5>
                                            </div>
                                            <div class="col">
                                                <h5><?=$equipo1->nombre?></h5>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                                   
                               <?php }?>
                                                        
                           </div>

                        </div>
                    </div>
                    <div class="row resultados">
                        <div class="container-fluid">
                            <div class="row header-resultados justify-content-around">
                                <div class="col-6 text-center">
                                    <h2>Resultados</h2>
                                </div>
                            </div>
                            <div class="row lista-resultados">
                                
                                <div class="resultado col-4 text-center">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="http://icons.iconarchive.com/icons/fazie69/league-of-legends/512/Brand-Zombie-icon.png">              
                                            </div>                                            
                                            <div class="col-6">
                                                <img src="http://icons.iconarchive.com/icons/fazie69/league-of-legends/512/Brand-Zombie-icon.png">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5>1 - 2</h5>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="resultado col-4 text-center">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="http://icons.iconarchive.com/icons/fazie69/league-of-legends/512/Brand-Zombie-icon.png">              
                                            </div>                                            
                                            <div class="col-6">
                                                <img src="http://icons.iconarchive.com/icons/fazie69/league-of-legends/512/Brand-Zombie-icon.png">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5>1 - 2</h5>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                                <div class="resultado col-4 text-center">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="http://icons.iconarchive.com/icons/fazie69/league-of-legends/512/Brand-Zombie-icon.png">              
                                            </div>                                            
                                            <div class="col-6">
                                                <img src="http://icons.iconarchive.com/icons/fazie69/league-of-legends/512/Brand-Zombie-icon.png">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h5>1 - 2</h5>
                                            </div>
                                        </div>
                                    </div>                                   
                                </div>
                            </div>
                        </div>                        
                    </div>        
                        </div>                        
                    </div>                    
                </div>
            </section>