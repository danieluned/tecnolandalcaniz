<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
		<h1><?=$competicion->nombre?></h1>
		  <?php 
      $estados = array("pendiente" => "Falta determinar fecha", "jugando"=> "Falta subir resultados", "cerrada" => "Partida cerrada");?>
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
	  
	  <h2>Partidas pendientes</h2>
      <table class="table table-hover table-bordered table-condensed">
          <tr>
          	<td>Id Partida</td>
          	<td>Jornada</td>
          	<td>Hora inicio</td>
          	<td>Estado</td>
          	<td>Acciones</td>
          </tr>
          <?php foreach($partidaspendientes as $partida){?>    
           <tr>
             <td><?=$partida->id?></td>
             <td><?=$partida->jornada_id?></td>
             <td><?=$partida->horainicio?></td>
             <td><?=$estados[$partida->estado]?></td>
              <td>
              	 <?=anchor ('admin/competiciones/veralineacion/'.$competicion->id.'/'.$partida->id.'/'.$eq->id,'Alineacion')?>     
             	 <?=anchor ('admin/competiciones/partida/'.$competicion->id.'/'.$partida->id,'Examinar')?>     
              </td>
            </tr>
         <?php } ?>
     </table>
     
     <h2>Partidas Jugandose</h2>
     <table class="table table-hover table-bordered table-condensed">
          <tr>
          	<td>Id Partida</td>
          	<td>Jornada</td>
          	<td>Hora inicio</td>
          	<td>Estado</td>
          	<td>Acciones</td>
          </tr>
          <?php  foreach($partidasjugando as $partida){?>
         <tr>
             <td><?=$partida->id?></td>
             <td><?=$partida->jornada_id?></td>
             <td><?=$partida->horainicio?></td>
             <td><?=$estados[$partida->estado]?></td>
              <td>
               <?=anchor ('admin/competiciones/veralineacion/'.$competicion->id.'/'.$partida->id.'/'.$eq->id,'Alineacion')?>     
             	 <?=anchor ('admin/competiciones/partida/'.$competicion->id.'/'.$partida->id,'Examinar')?>     
              </td>
            </tr>
         <?php } ?>
     </table>

   
	  <h2>Partidas Jugadas</h2>
      <table class="table table-hover table-bordered table-condensed">
          <tr>
          	<td>Id Partida</td>
          	<td>Jornada</td>
          	<td>Hora inicio</td>
          	<td>Estado</td>
          	<td>Acciones</td>
          </tr>
           
          <?php foreach($partidascerradas as $partida){?>
         <tr>
             <td><?=$partida->id?></td>
             <td><?=$partida->jornada_id?></td>
             <td><?=$partida->horainicio?></td>
             <td><?=$estados[$partida->estado]?></td>
              <td>
               <?=anchor ('admin/competiciones/veralineacion/'.$competicion->id.'/'.$partida->id.'/'.$eq->id,'Alineacion')?>     
             	 <?=anchor ('admin/competiciones/partida/'.$competicion->id.'/'.$partida->id,'Examinar')?>     
              </td>
            </tr>
         <?php } ?>
     </table>
     
<?php }?>
    </div>
    
     </div>
  </div>
