<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 40px;">
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('admin/grupos/crear');?>" class="btn btn-primary">Create group</a>
    </div>
  </div>
  <div class="row">
  <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if(!empty($grupos))
    {
        echo '<table class="table table-hover table-bordered table-condensed">';
        echo '<tr><td>ID</td><td>Group name</td></td><td>Group description</td><td>Operations</td></tr>';
        foreach($grupos as $grupo)
      {
          echo '<tr>';
          echo '<td>'.$grupo->id.'</td><td>'.anchor('admin/usuarios/index/'.$grupo->id,$grupo->name).'</td><td>'.$grupo->description.'</td><td>'.anchor('admin/grupos/editar/'.$grupo->id,'<i class="fas fa-edit"></i>');
          if(!in_array($grupo->name, array('admin','members'))) echo ' '.anchor('admin/grupos/borrar/'.$grupo->id,'<i style="color:red;" class="fas fa-trash-alt"></i>',array('class'=>'borrar'));
          echo '</td>';
          echo '</tr>';
      }
      echo '</table>';
    }
  ?>
  </div>
</div>
</div>