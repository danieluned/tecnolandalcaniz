<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
		<h1><?=$competicion->nombre?></h1>
		
		 <h2>Pruebas</h2>
      <table class="table table-hover table-bordered table-condensed">
          <tr>
          	<td>Id Partida</td>
          	<td>Usuario</td>
          	<td>Fichero</td>
          	<td>Fecha de subida</td>
          	<td>Enlace</td>
          </tr>    
	  <?php foreach($pruebas as $prueba){?>
	     <tr>
             <td><?=$prueba->partida_id?></td>
             <td><?=$prueba->users_id?></td>
             <td><?=$prueba->filename?></td>
             <td><?=$prueba->fecha?></td>
             <td><a href="<?=assets()?>/images/competiciones/<?=$prueba->competicion_id?>/pruebas/<?=$prueba->filename?>">Enlace</a></td>            
            </tr>
         <?php } ?>
     </table>
     
    
    </div>
    
     </div>
  </div>
