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
                                <?php foreach($equipos as $equipo){?>                        
                                <div class="col-sm-4 col-md-3 col-lg-2 equipo ">
                                    <a href="<?php echo site_url('equipo');?>/<?=$competicion->id?>/<?=$equipo->id?>">
                                        <figure class="borde-circular">
                                            <img class="sombra-png-negra" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo->id?>/<?=$equipo->logotipo?>">
                                        </figure>
                                    </a>
                                    <h6>
                                     <?=$equipo->nombre?>
                                    </h6>
                                </div>                                         
                                <?php }?>        
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
                                                  <th scope="col-4">Local</th>
                                                  <th scope="col-4"> VS </th>
                                                  <th scope="col-4">Visitante</th>                                                             
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php foreach($partidasPendientes as $partida){                                                               
                                                    $juegaEquipo0 = $partida->getJuegaEquipoLocal();
                                                    $juegaEquipo1 = $partida-> getJuegaEquipoVisitante();
                                                    $equipo0 = $juegaEquipo0->getEquipo();
                                                    $equipo1 = $juegaEquipo1->getEquipo();
                                                    ?>
                                                
                                                <tr scope="row">                                                  
                                                  <td scope="col-4">
                                                    
                                                        <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">
                                                    
                                                   
                                                   </td>
                                                  <td scope="col-4"> 
                                                    <a href="<?php echo site_url('ligacod/partida/'.$competicion->id.'/'.$partida->id.'');?>">
                                                        Ver </a></td>
                                                    
                                                  <td scope="col-4">
                                                    
                                                        <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">
                                                    
                                                   
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
                                                          <th scope="col-4">Local</th>
                                                          <th scope="col-4"> VS </th>
                                                          <th scope="col-4">Visitante</th>                                                           
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php foreach($partidasCerradas as $partida){
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