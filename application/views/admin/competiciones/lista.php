<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
  <?php if($this->ion_auth->in_group('admin')){?>
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('admin/competiciones/crear');?>" class="btn btn-primary">Crear competicion</a>
    </div>
  </div>
  <?php }?>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
    <?php
   
    if($competicionesadmin){?>
    
    	<h1>Competiciones (admin)</h1>
      <table class="table table-hover table-bordered table-condensed">
      <tr>
      	<td>ID</td>
      	<td>Nombre</td>
      	<td>Acciones</td>
      </tr>
      <?php foreach($competicionesadmin as $competicion){?>
     
       <tr>
         <td><?=$competicion->id?></td>
         <td><?=$competicion->nombre?></td>
          <td>
         
          	
          	
           <?php if($this->ion_auth->in_group('admin')){?>
           	   <?=anchor ('admin/competiciones/pruebas/'.$competicion->id,'Pruebas ')?>
                <?=anchor ('admin/competiciones/partidas/'.$competicion->id,'Partidas ')?>
               <?=anchor ('admin/competiciones/ver/'.$competicion->id,'Participantes ')?>
               <?=anchor('admin/competiciones/editar/'.$competicion->id,'<i class="fas fa-edit"></i>')?>
                <?=anchor('admin/competiciones/borrar/'.$competicion->id,'<i style="color:red;" class="fas fa-trash-alt"></i>',array('class'=>'borrar'));?>
          	<?php }?>
          </td>
        </tr>
     <?php } ?>
     </table>
   <?php  }
    if($competicionescapitan){
    ?>
    	<h1>Competiciones</h1>
      <table class="table table-hover table-bordered table-condensed">
      <tr>
      	<td>ID</td>
      	<td>Nombre</td>
      	<td>Acciones</td>
      </tr>
      <?php foreach($competicionescapitan as $competicion){?>
     
       <tr>
         <td><?=$competicion->id?></td>
         <td><?=$competicion->nombre?></td>
          <td>
          <?php if($this->ion_auth->in_group('capitan')){?>
                <?=anchor ('admin/competiciones/partidascapitan/'.$competicion->id,'Partidas ')?>
          	<?php }?>
          	
          	
         
          </td>
        </tr>
     <?php } ?>
     </table>
   <?php  }?>
    </div>
  </div>
</div>