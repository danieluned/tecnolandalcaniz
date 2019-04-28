<?php 
$equipos = $competicion->getInscritoEquipo();

//$jornadas = $competicion->getJornadas();

$jornadasJugando = $competicion->getJornadasJugando();

$jornadasCerradas = $competicion->getJornadasCerradas();

$jornadasPendientes = $competicion->getJornadasPendientes();

/*
$partidasPendientes = array(); 
$partidasCerradas = array(); 
foreach ($jornadasJugando as $jornada) {
    $partidasPendientes_j =$jornada->getPartidasPendientes(); 
    foreach($partidasPendientes_j as $partida){
        $partidasPendientes[] = $partida;
    }
    $partidasCerradas_j =$jornada->getPartidasCerradas();
    foreach($partidasCerradas_j as $partida){
        $partidasCerradas[] = $partida;
    }
}*/
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

                <div class="row jornadas-en-curso">
                    <div class="container-fluid">
                        
                        <?php 
                        
                        foreach ($jornadasJugando as $jornada) {

                            $partidasPendientes = array(); 
                            $partidasCerradas = array(); 
                            
                            $partidasPendientes_j =$jornada->getPartidasPendientes(); 
                                                        
                            foreach($partidasPendientes_j as $partida){
                                $partidasPendientes[] = $partida;
                            }
                            
                            $partidasCerradas_j =$jornada->getPartidasCerradas();
                            
                            foreach($partidasCerradas_j as $partida){
                                $partidasCerradas[] = $partida;
                            }
                        
                        ?> 

                        <div class="row header-jornada-en-curso text-center">
                            <div class="col-12">
                                <h2> Jornada <?=$jornada->id?> en curso</h2>
                            </div>
                        </div>
                        <div class=" row body-jornada-en-curso">
                        <?php
                            $cols="";
                            if(count($partidasCerradas)<=0||count($partidasPendientes)<=0){
                                $cols = "12";
                            }else{
                                $cols = "6";
                            }
                            if(count($partidasPendientes)>0){                            
                                ?>
                                <div class="col-sm-12 col-md-<?=$cols?> partidas">
                                    <div class="container-fluid">
                                        <div class=" row header-partidas text-center">
                                            

                                        </div>                                                    
                                        <div class="row body-partidas">
                                            <table class="table table-striped table-dark text-center sombra-png-negra">
                                              
                                              <thead>
                                                <tr>
                                                    <th colspan="3">Proximas</th>
                                                </tr>
                                                <tr>                                                  
                                                  <th scope="col-4">Local</th>
                                                  <th scope="col-4"> VS </th>
                                                  <th scope="col-4">Visitante</th>                                                             
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php 
                                                foreach($partidasPendientes as $partida){                                                               
                                                    $juegaEquipo0 = $partida->getJuegaEquipoLocal();
                                                    $juegaEquipo1 = $partida-> getJuegaEquipoVisitante();
                                                    $equipo0 = $juegaEquipo0->getEquipo();
                                                    $equipo1 = $juegaEquipo1->getEquipo();
                                                    $fecha = $partida->horainicio;
                                                    $hora = $partida->horainicio;
                                                    $fecha = date('d/m',$fecha);
                                                    $hora  = date('h:m',$hora);
                                                    
                                                ?>
                                                
                                                <tr scope="row">                                                  
                                                  <td scope="col-4">
                                                    
                                                        <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">
                                                        <p><?=$equipo0->nombre?></p>
                                                   
                                                   </td>
                                                    <td scope="col-4"> 
                                                    <!--<a href="<?php echo site_url('ligacod/partida/'.$competicion->id.'/'.$partida->id.'');?>">
                                                        Ver </a>-->
                                                        <samp><?=date_format(date_create($partida->horainicio),'d/m')?></samp>
                                                        <samp><?=date_format(date_create($partida->horainicio),'h:m')?></samp>
                                                    </td>
                                                    
                                                  <td scope="col-4">
                                                    
                                                        <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">
                                                        <p><?=$equipo1->nombre?></p>
                                                   
                                                  </td>
                                                </tr><?php }?>
                                                
                                                
                                              </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php }                                    
                                    if(count($partidasCerradas)>0){                                    
                                    ?>
                                <div class="col-sm-12 col-md-<?=$cols?> resultados">
                                        <div class="container-fluid">   
                                            <div class="header-resultados text-center"> 
                                                
                                            </div>
                                            <div class="body-resultados">   
                                                
                                            <table class="table table-striped table-dark text-center sombra-png-negra">

                                                      <thead>
                                                        <tr>
                                                            <th colspan="3">Resultados</th>
                                                        </tr>
                                                        <tr>                                                          
                                                          <th scope="col-4">Local</th>
                                                          <th scope="col-4"> VS </th>
                                                          <th scope="col-4">Visitante</th>                                                           
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php 
                                                            foreach($partidasCerradas as $partida){
                                                                $juegaEquipo0 = $partida->getJuegaEquipoLocal();
                                                                $juegaEquipo1 = $partida-> getJuegaEquipoVisitante();
                                                                $equipo0 = $juegaEquipo0->getEquipo();
                                                                $equipo1 = $juegaEquipo1->getEquipo();
                                                                $resultados = $partida->resultados();
                                                                
                                                        ?>
                                                        <tr>                                                          
                                                          <td scope="col-4">
                                                            
                                                                <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">                                                                
                                                            
                                                            <p><?=$equipo0->nombre?></p>
                                                         
                                                           </td>

                                                          <td scope="col-4"> <?php echo $resultados['local']['puntos']." - ". $resultados['visitante']['puntos']?> </td>

                                                          <td scope="col-4">
                                                            
                                                                <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">                                                                
                                                            
                                                            <p><?=$equipo1->nombre?></p>
                                                            
                                                          </td>
                                                        </tr><?php }?>
                                                            
                                                      </tbody>
                                                    </table>
                                            </div>  
                                        </div>  
                                </div>
                                <?php }?>
                        </div><?php } ?>
                            
                    </div>                    
                </div>
                <?php                                     
                    if(count($jornadasPendientes)>0){                                    
                ?>
                <div class="row jornadas-pendientes">
                    <div class="container-fluid">
                        
                        <div class="row headder-jornadas-pendientes text-center">
                        <div class="col-12">
                            <fieldset>
                                <legend class="scheduler-border"><button class="btn btn-dark" data-toggle="collapse" data-target="#body-jornadas-pendientes" aria-expanded="false" aria-controls="body-jornadas-pendientes">Jornadas Pendientes</button></legend>                                                                
                            </fieldset>
                                
                            </div>
                        </div>
                        
                        <div id="body-jornadas-pendientes" class=" collapse row body-jornadas-pendientes justify-content-around ">
                            
                                <?php                         
                                foreach ($jornadasPendientes as $jornada) {
                                    $partidasPendientes = array(); 
                                    $partidasCerradas = array(); 
                                    $partidasPendientes_j =$jornada->getPartidasPendientes(); 
                                    foreach($partidasPendientes_j as $partida){
                                        $partidasPendientes[] = $partida;
                                    }
                                    $partidasCerradas_j =$jornada->getPartidasCerradas();
                                    foreach($partidasCerradas_j as $partida){
                                        $partidasCerradas[] = $partida;                                   }
                                                                        
                                        $fechainicio = $jornada->fechainicio;  
                                        $fechaInicioJornada = date_format(date_create($jornada->fechainicio),'d/m');                                              
                                        $fechaFinJornada = date_format(date_create($jornada->fechafin),'d/m');
                                        
                                        
                                ?> 

                                <div class="col-sm-12 col-md-6  jornada-pendiente">
                                    
                                    <table class="table table-striped table-dark text-center sombra-png-negra">
                                        <thead>
                                            <tr>
                                                <th colspan="3"><p>Jornada <?=$jornada->id?></p>
                                                <p><?=$fechaInicioJornada?> - <?=$fechaFinJornada?></p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                        <?php 
                                            foreach($partidasPendientes as $partida){
                                                $juegaEquipo0 = $partida->getJuegaEquipoLocal();
                                                $juegaEquipo1 = $partida-> getJuegaEquipoVisitante();
                                                $equipo0 = $juegaEquipo0->getEquipo();
                                                $equipo1 = $juegaEquipo1->getEquipo();
                                        ?>
                                            <tr>
                                                <td >                                                    
                                                    <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">
                                                    <p><?=$equipo0->nombre?></p>
                                                </td>
                                                <td>
                                                    <span> VS </span>
                                                </td>
                                                <td>                                                    
                                                    <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">
                                                    <p><?=$equipo1->nombre?></p>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        
                                </div><?php }?>                                
                        </div>
                    </div>                                    
                </div><?php }
                        if(count($jornadasCerradas)>0){ 
                    ?> 

                <div class="row jornadas-cerradas">
                    <div class="container-fluid">
                        
                        <div class="row headder-jornadas-cerradas text-center">
                            <div class="col-12">
                               <fieldset>
                               <legend class="scheduler-border"><button class="btn btn-dark" data-toggle="collapse" data-target="#body-jornadas-cerradas" aria-expanded="false" aria-controls="body-jornadas-cerradas">Jornadas Cerradas</button></legend>
                                </fieldset>
                            </div>
                        </div>
                        
                        <div id="body-jornadas-cerradas" class=" collapse row body-jornadas-cerradas justify-content-around">
                            
                                <?php                         
                                foreach ($jornadasCerradas as $jornada) {
                                    $partidasPendientes = array(); 
                                    $partidasCerradas = array(); 
                                    $partidasPendientes_j =$jornada->getPartidasPendientes(); 
                                    foreach($partidasPendientes_j as $partida){
                                        $partidasPendientes[] = $partida;
                                    }
                                    $partidasCerradas_j =$jornada->getPartidasCerradas();
                                    foreach($partidasCerradas_j as $partida){
                                        $partidasCerradas[] = $partida;                                   }
                                ?> 

                                <div class="col-sm-12 col-md-6 jornada-cerrada">
                                    
                                    <table class="table table-striped table-dark text-center sombra-png-negra">
                                        <thead>
                                            <tr >
                                                <th colspan="3">Jornada <?=$jornada->id?></th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                        <?php 
                                            foreach($partidasCerradas as $partida){
                                                $juegaEquipo0 = $partida->getJuegaEquipoLocal();
                                                $juegaEquipo1 = $partida-> getJuegaEquipoVisitante();
                                                $equipo0 = $juegaEquipo0->getEquipo();
                                                $equipo1 = $juegaEquipo1->getEquipo();
                                                
                                                $resultados = $partida->resultados();
                                                
                                        ?>
                                            <tr>
                                                <td scope="col-4">
                                                    <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo0->id?>/<?=$equipo0->logotipo?>">                                                                                                
                                                </td>
                                                
                                                <td scope="col-4"> <?php echo $resultados['local']['puntos']." - ".$resultados['visitante']['puntos']?> </td>
                                                
                                                <td scope="col-4">
                                                    <img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo1->id?>/<?=$equipo1->logotipo?>">
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                        
                                </div><?php }?>                                
                        </div>
                    </div>                                    
                </div>  <?php }?>                
                <div class="row sponsors-liga">
                    <div class="container-fluid">
                        <div class="row organiza text-center">
                            <div class="container-fluid">        
                                <fieldset class="fieldset-horizontal">
                                        <legend class="scheduler-border"><h2> Organiza </h2></legend>                               
                                <div class="row body-organiza justify-content-around">
                                     
                                        <img src="<?=assets()?>images/sponsor/netllar_negro.png">
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