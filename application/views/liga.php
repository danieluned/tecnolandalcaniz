<?php 
$equipos = $competicion->getInscritoEquipo();
$jornadas = $competicion->getJornadas();

$partidasPendientes = array(); 
$partidasCerradas = array(); 
foreach ($jornadas as $jornada) {
    $partidasPendientes_j =$jornada->getPartidasPendientes(); 
    foreach($partidasPendientes_j as $partida){
        $partidasPendientes[] = $partida;
    }
    $partidasCerradas_j =$jornada->getPartidasCerradas();
    foreach($partidasCerradas_j as $partida){
        $partidasCerradas[] = $partida;
    }
}
?>


<link rel="stylesheet" type="text/css" href="<?= assets()?>css/liga.css">
<section class="liga">
                <div class="container ">                    
                    <div class="row header-liga text-center">
                        <img src="<?= assets()?>images/ligas/Banner_superior.png" class="rounded mx-auto d-block">
                    </div>
                    <div class="row body-liga">
                        <div class="container-fluid">
                            <div class="row equipos justify-content-around text-center">
                                <div class="container-fluid">
                                    <div class="row justify-content-around header-equipos">
                                        <div class="col-6 text-center">
                                            <h2>Equipos</h2>
                                        </div>        
                                    </div>    
                                    <div class="row justify-content-around body-equipos">
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
                                </div>
                       			
                                                                                    
                    		</div>
                    <div class="row jornada">
                        <div class="container-fluid">
                            <div class="row header-jornada justify-content-around">
                                <div class="col-6 text-center">
                                    <h2>Partidas</h2>
                                </div>
                            </div>
                            <div class="row partidas d-flex justify-content-around">
                                
                               <?php foreach($partidasPendientes as $partida){
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
                                    <div class="row lista-resultados justify-content-around">
                                        <?php foreach($partidasCerradas as $partida){
                                        $equipos = $partida->getJuegaEquipos();
                                        $equipo0 = $equipos[0]->getEquipo();
                                        $equipo1 = $equipos[1]->getEquipo();
                                        ?>
                                        <div class="resultado col-4 text-center">
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
                                                        <h5><?=$equipos[0]->puntuacion?> - <?=$equipos[1]->puntuacion?></h5>
                                                    </div>
                                                </div>
                                            </div>                                   
                                        </div>
                                        <?php }?>
                                        
                                    </div>
                                </div>                        
                            </div>        
                            <div class="row sponsors-liga">
                                <div class="container-fluid">
                                    <div class="row organiza">
                                        <div class="container-fluid">
                                            <dis class="row header-organiza justify-content-around">
                                                <div class="col  text-center">
                                                    <h3> Organiza </h3>
                                                </div>
                                            </dis>
                                            <div class="row body-organiza justify-content-around">
                                                <img src="<?=assets()?>images/sponsor/netllar.gif">
                                                <img src="<?=assets()?>images/icCabecera.png">                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row colabora">
                                        <div class="container-fluid">
                                            <dis class="row header-organiza justify-content-around">
                                                <div class="col  text-center">
                                                    <h3> Colabora </h3>
                                                </div>
                                            </dis>
                                            <div class="row body-organiza justify-content-around">
                                                <img src="<?=assets()?>images/sponsor/Logotipo_MPG_Mini.png">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                </div>
            </section>