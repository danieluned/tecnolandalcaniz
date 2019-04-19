<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
table img{
    max-height: 50px;
    width: 50px;
} 
</style>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
		<h1><?=$competicion->nombre?></h1>
		  <?php 
      $estados = array("pendiente" => "Comprobar alineación y hacer check antes de la hora", "jugando"=> "Subir resultados", "cerrada" => "Partida cerrada");?>
	  <?php foreach($equipos as $equipo){
	      $eq = $equipo['equipo'];
      $partidaspendientes = $equipo['partidaspendientes'];
      $partidasjugando = $equipo['partidasjugando'];
      $partidascerradas = $equipo['partidascerradas'];
	  ?>
	    <div class="row">    
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo col-offset-2">
                      		<figure class="borde-circular">
   			<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$eq->id?>/<?=$eq->logotipo?>">
        	 <p><?=$eq->nombre?></p>
       </figure>
                       </div>     
            </div>
	  
	  
     
     <h2>Partidas en curso</h2>
     <table class="table table-hover table-bordered table-condensed">
          <tr>
          	<td>Jornada</td>
          	<td>Hora inicio</td>
          	<td>Local</td>
          	<td>Visitante</td>
          	<td>Estado</td>
          	<td>Acciones</td>
          </tr>
          <?php  foreach($partidasjugando as $partida){
              $jvisi = $partida->getJuegaEquipoVisitante(); 
              $visi = $jvisi->getEquipo();
              $jlocal = $partida->getJuegaEquipoLocal(); 
              $local = $jlocal->getEquipo();
              ?>
         <tr>
             <td><?=$partida->jornada_id?></td>
             <td><?=$partida->horainicio?></td>
            <td><img class="img-responsive img-rounded" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$local->id?>/<?=$local->logotipo?>"></td>
             <td><img class="img-responsive img-rounded" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$visi->id?>/<?=$visi->logotipo?>"></td>
             <td>
             	<?php 
             	if($partida->estado=="jugando"){
             	    ?>Falta por aceptar resultados:
             	    <?php 
             	    if (!$jlocal->conforme){
             	        ?><img class="img-responsive img-rounded" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$local->id?>/<?=$local->logotipo?>"><?php 
             	    }
             	    if (!$jvisi->conforme){
             	        ?><img class="img-responsive img-rounded" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$visi->id?>/<?=$visi->logotipo?>"><?php  
             	    }
             	    
             	}else{?>
             	    <?=$estados[$partida->estado]?>
             	<?php }
             	
             	?>
            
             </td>
              <td>
              <?php switch($partida->estado){
                  case "pendiente":?>
                   <?=anchor ('admin/competiciones/veralineacion/'.$competicion->id.'/'.$partida->id,'Seleccionar Alineación')?>     
              	   <?=anchor ('admin/competiciones/partida/'.$competicion->id.'/'.$partida->id,'Checkear asistencia')?>     
                      <?php break;
                  case "jugando":
                     
                      ?>                  
              	   <?=anchor ('admin/competiciones/partida/'.$competicion->id.'/'.$partida->id,'Subir resultados')?>   
                      <?php break;
                 default:?>
                  <?=anchor ('admin/competiciones/veralineacion/'.$competicion->id.'/'.$partida->id,'Ver alineación')?>            
              	   <?=anchor ('admin/competiciones/partida/'.$competicion->id.'/'.$partida->id,'Ver Resultado')?>   
                      <?php break;
              }?>
              
              </td>
            </tr>
         <?php } ?>
     </table>
<h2>Proximas partidas</h2>
      <table class="table table-hover table-bordered table-condensed">
          <tr>
          	<td>Jornada</td>
          	<td>Hora inicio</td>
          	<td>Local</td>
          	<td>Visitante</td>
          
          </tr>
          <?php foreach($partidaspendientes as $partida){
              $visi = $partida->getEquipoVisitante();
              $local = $partida->getEquipoLocal();
              ?>    
           <tr>
             <td><?=$partida->jornada_id?></td>
             <td><?=$partida->horainicio?></td>
            <td><img class="img-responsive img-rounded" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$local->id?>/<?=$local->logotipo?>"></td>
             <td><img class="img-responsive img-rounded" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$visi->id?>/<?=$visi->logotipo?>"></td>
             
            </tr>
         <?php } ?>
     </table>
   
	  <h2>Partidas cerradas</h2>
      <table class="table table-hover table-bordered table-condensed">
          <tr>
          	<td>Jornada</td>
          	<td>Hora</td>
          	<td>Local</td>
          	<td>Visitante</td>
          	<td>Acciones</td>
          </tr>
           
          <?php foreach($partidascerradas as $partida){
              $visi = $partida->getEquipoVisitante(); 
              $local = $partida->getEquipoLocal();
          ?>
         <tr>
             <td><?=$partida->jornada_id?></td>
             <td><?=$partida->horainicio?></td>
             <td><img class="img-responsive img-rounded" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$local->id?>/<?=$local->logotipo?>"></td>
             <td><img class="img-responsive img-rounded" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$visi->id?>/<?=$visi->logotipo?>"></td>
              <td>
               <?=anchor ('admin/competiciones/veralineacion/'.$competicion->id.'/'.$partida->id,'Alineacion')?>     
             	 <?=anchor ('admin/competiciones/partida/'.$competicion->id.'/'.$partida->id,'Resultado')?>     
              </td>
            </tr>
         <?php } ?>
     </table>
     
<?php }?>
    </div>
    
     </div>
  </div>
