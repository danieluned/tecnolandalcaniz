<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('admin/competiciones/crear');?>" class="btn btn-primary">Crear competicion</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if($competiciones){?>
    
      <table class="table table-hover table-bordered table-condensed">
      <tr>
      	<td>ID</td><td>Nombre</td><td>Acciones</td>
      </tr>
      <?php foreach($competiciones as $competicion){?>
      
       <tr>
         <td><?=$competicion->id?></td>
         <td><?=$competicion->nombre?></td>
          <td>
           <?=anchor('admin/competiciones/editar/'.$competicion->id,'<i class="fas fa-edit"></i>')?>
           <?=anchor('admin/competiciones/borrar/'.$competicion->id,'<i style="color:red;" class="fas fa-trash-alt"></i>');?>
          </td>
        </tr>
     <?php } ?>
     </table>
   <?php  }?>
    
    </div>
  </div>
</div>