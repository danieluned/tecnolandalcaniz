<link rel="stylesheet" type="text/css" href="<?= assets()?>css/liga.css">
<section class="liga">
                <div class="container ">                    
                    <div class="row header-liga text-center">
                        <img src="<?= assets()?>images/ligas/liga_cod_netllar.png" class="rounded mx-auto d-block">
                    </div>
                    <div class="row body-liga">
                        <div class="container-fluid">
                            <div class="row equipos justify-content-around text-center">
                                <div class="container-fluid">
                                    <!--<div class="row justify-content-around header-equipos">
                                        <div class="col-6 text-center">
                                            <h2></h2>
                                        </div>
                                    </div>  -->  
                                    <fieldset>
                                        <legend class="scheduler-border"><h2> Equipos </h2></legend>
                                        <div class="row justify-content-around body-equipos effect5">
                                                          
                                            <div class="col-sm-4 col-md-3 col-lg-2 equipo ">
                                                <a href="#">
                                                    <figure class="borde-circular">
                                                    <?php if ($local['equipo']){?>
                                                     <img class="sombra-png-negra" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$local['equipo']->id?>/<?=$local['equipo']->logotipo?>">
                                                    
                                                     <?php }else{?>
                                                      <img class="sombra-png-negra" src="https://cdn0.iconfinder.com/data/icons/jobs-occupations-careers/240/occupation-02-012-512.png">
                                                    
                                                    <?php  }?>
                                                       </figure>
                                                </a>
                                                <h6>
                                                  <?php if ($local['equipo']){?>
                                                	 <?=$local['equipo']->nombre?>
                                                  <?php }else{?>
                                                     
                                                   <?php  }?>
                                                </h6>
                                            </div>   
                                            <div class="col-sm-4 col-md-3 col-lg-2 equipo ">
                                            <img class="sombra-png-negra" src="http://cdn.onlinewebfonts.com/svg/img_418591.png">
                                                    
                                          
                                            </div>                                      
                                           <div class="col-sm-4 col-md-3 col-lg-2 equipo ">
                                                <a href="#">
                                                    <figure class="borde-circular">
                                                    <?php if ($vistante['equipo']){?>
                                                     <img class="sombra-png-negra" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$vistante['equipo']->id?>/<?=$vistante['equipo']->logotipo?>">
                                                    
                                                     <?php }else{?>
                                                      <img class="sombra-png-negra" src="https://cdn0.iconfinder.com/data/icons/jobs-occupations-careers/240/occupation-02-012-512.png">
                                                    
                                                    <?php  }?>
                                                       </figure>
                                                </a>
                                                <h6>
                                                  <?php if ($vistante['equipo']){?>
                                                	 <?=$vistante['equipo']->nombre?>
                                                  <?php }else{?>
                                                     
                                                   <?php  }?>
                                                </h6>
                                            </div>     
                                        </div>
                                    </fieldset>
                                </div>
                       			
                                                                                    
                    		</div>

                            <div class="row jornada">
                                <div class="container-fluid">
                                    <div class="row header-jornada">
                                    
                                    </div>
                                    <div class=" row body-jornada">
                                        
                                            <div class="col-12 partidas">
                                                <div class="container-fluid">
                                                    <div class="header-partidas text-center">
                                                        <h2> Partidas </h2>
                                                    </div>                                                    
                                                    <div class="body-partidas">
                                                        <table class="table table-striped table-dark text-center sombra-png-negra">
                                                          
                                                          <thead>
                                                            <tr>
                                                              <th scope="col">#</th>
                                                              <th scope="col">Local</th>
                                                              <th scope="col"> - </th>
                                                              <th scope="col">Visitante</th>                                                             
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <?php foreach($partidasPendientes as $partida){
                                                                $equipos = $partida->getJuegaEquipos();
                                                                $equipo0 = $equipos[0]->getEquipo();
                                                                $equipo1 = $equipos[1]->getEquipo();
                                                                ?>
                                                            <tr>
                                                              <th scope="row">1</th>
                                                              <td>
                                                                <a href="#">
                                                                    <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">
                                                                </a>
                                                                <p><?=$equipo0->nombre?></p>
                                                               </td>
                                                              <td> VS </td>
                                                              <td>
                                                                <a href="#">
                                                                    <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">
                                                                </a>
                                                                <p><?=$equipo1->nombre?></p>
                                                              </td>
                                                            </tr>
                                                            <?php }?>
                                                          </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 resultados">
                                                    <div class="container-fluid">   
                                                        <div class="header-resultados text-center"> 
                                                            <h2> Resultados </h2>
                                                        </div>
                                                        <div class="body-resultados">   
                                                            <table class="table table-striped table-dark text-center sombra-png-negra">

                                                                  <thead>

                                                                    <tr>
                                                                      <th scope="col">#</th>
                                                                      <th scope="col">Local</th>
                                                                      <th scope="col"> - </th>
                                                                      <th scope="col">Visitante</th>                                                             
                                                                    </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                    <?php foreach($partidasCerradas as $partida){
                                                                        $equipos = $partida->getJuegaEquipos();
                                                                        $equipo0 = $equipos[0]->getEquipo();
                                                                        $equipo1 = $equipos[1]->getEquipo();
                                                                        ?>
                                                                    <tr>
                                                                      <th scope="row">1</th>
                                                                      <td>
                                                                        <a href="#">
                                                                            <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">
                                                                        </a>
                                                                        <p><?=$equipo0->nombre?></p>
                                                                       </td>
                                                                      <td> <?=$equipos[0]->puntuacion?> - <?=$equipos[1]->puntuacion?> </td>
                                                                      <td>
                                                                        <a href="#">
                                                                            <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">
                                                                        </a>
                                                                        <p><?=$equipo1->nombre?></p>
                                                                      </td>
                                                                    </tr>
                                                                    <?php }?>
                                                                  </tbody>
                                                                </table>
                                                        </div>  
                                                    </div>  
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                              
                            <div class="row sponsors-liga">
                                <div class="container-fluid">
                                    <div class="row organiza text-center">
                                        <div class="container-fluid">        <fieldset>
                                                    <legend class="scheduler-border"><h2> Organiza </h2></legend>                               
                                            <div class="row body-organiza justify-content-around">
                                                 
                                                    <img src="<?=assets()?>images/sponsor/netllar.gif">
                                                    <img src="<?=assets()?>images/icCabecera.png">
                                                                      
                                            </div>
                                            </fieldset>  
                                        </div>
                                    </div>
                                    <div class="row colabora text-center">
                                        <div class="container-fluid">
                                            <fieldset>
                                                    <legend class="scheduler-border"><h2> Colabora </h2></legend>
                                            <div class="row body-organiza justify-content-around">
                                                
                                                <img src="<?=assets()?>images/sponsor/Logotipo_MPG_Mini.png">
                                                
                                                
                                            </div>
                                            </fieldset>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                </div>
            </section>