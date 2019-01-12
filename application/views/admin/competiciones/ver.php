<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
$listajugadores = "";
foreach ($inscrito as $ins){
    $listajugadores .= $ins->nombre . "\n";
}

$listajugadoresequipo = "";
foreach ($inscritoequipo as $ins){
    $listajugadoresequipo .= $ins->nombre . "\n";
}

?>

<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <h1><?=$title?></h1>
      <p>Formulario rapido para copy paste de listas de jugadores o equipos</p>
      <p>Solo actualiza los nombres de las posiciones, por lo que si ya esta en marcha el torneo OJO si el primer jugador lleva 10 puntos, seguira llevando 10 puntos 
      aunque se le ponga otro nombre</p>
      
      <form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>" method="post">
          <div class="form-group">
                <label>
                Jugadores
                <textarea class="form-control" name="inscrito"><?=$listajugadores?></textarea> 
                </label>
                
                <label>
                Equipos
                <textarea class="form-control" name="inscritoequipo"><?=$listajugadoresequipo?></textarea>
                </label>
                <input type="submit" value="Guardar"/>
          </div>
      </form>
    </div>
  </div>
</div>