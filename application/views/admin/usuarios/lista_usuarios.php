<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-12">
      <a href="<?php echo site_url('admin/usuarios/crear');?>" class="btn btn-primary">Crear usuario</a>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
    <?php
    if(!empty($usuarios))
    {
      echo '<table class="table table-hover table-bordered table-condensed">';
      echo '<tr><td>ID</td><td>Usuario</td></td><td>Nombre</td><td>Correo</td><td>Ultimo logeo</td><td>Acciones</td></tr>';
      foreach($usuarios as $usuario)
      {
        echo '<tr>';
        echo '<td>'.$usuario->id.'</td><td>'.$usuario->username.'</td><td>'.$usuario->first_name.' '.$usuario->last_name.'</td></td><td>'.$usuario->email.'</td><td>'.date('Y-m-d H:i:s', $usuario->last_login).'</td><td>';
        if($current_user->id != $usuario->id) echo anchor('admin/usuarios/editar/'.$usuario->id,'<span class="glyphicon glyphicon-pencil"></span>').' '.anchor('admin/usuarios/borrar/'.$usuario->id,'<span class="glyphicon glyphicon-remove"></span>');
        else echo '&nbsp;';
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    ?>
    </div>
  </div>
</div>