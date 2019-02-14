 <!--
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
                            </div>  --> 