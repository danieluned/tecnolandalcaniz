<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
$listajugadores = "";
foreach ($inscrito as $ins){
    $listajugadores .= $ins->nombre . "\n";
}

$listaequipos = "";
foreach ($inscritoequipo as $ins){
    $listaequipos .= $ins->nombre . "\n";
}

?>
<script>
function allowDrop(ev) {
	  ev.preventDefault();
	}

	function drag(ev) {
	  ev.dataTransfer.setData("text", ev.target.id);
	}

	function drop(ev) {
	  ev.preventDefault();
	  var data = ev.dataTransfer.getData("text");
	  ev.target.appendChild(document.getElementById(data));
	}

</script>
<style>
.drop {
  width: 350px;
  height: 70px;
  padding: 10px;
  border: 1px solid #aaaaaa;
}
</style>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2">
      <h1><?=$title?></h1>
      <p>Formulario rapido para copy paste de listas de jugadores o equipos</p>
      <p>Solo actualiza los nombres de las posiciones, por lo que si ya esta en marcha el torneo OJO si el primer jugador lleva 10 puntos, seguira llevando 10 puntos 
      aunque se le ponga otro nombre</p>
      
      <form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>" method="post">
          <div class="form-group">
                <label for="a">
                Jugadores
                </label>
                <textarea id="a" data-limit-rows="true" rows="<?=$competicion->maxjugadores?>" class="form-control" name="inscrito"><?=$listajugadores?></textarea> 
                
                 <input type="submit" class="form-control" value="Guardar"/>
          </div>
      </form>
       <form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>" method="post">
          <div class="form-group">
                <label for="b">
                Equipos
                </label>
                <textarea id="b" data-limit-rows="true" rows="<?=$competicion->maxequipos?>" class="form-control" name="inscritoequipo"><?=$listaequipos?></textarea>
                
                <input type="submit" class="form-control" value="Guardar"/>
          </div>
      </form>
     
     <?php  foreach ($inscritoequipo as $eq){
                $listajugadoresequipo = "";
                $capitan = "";
                 
                foreach ($inscrito as $ju){
                    
                    if($eq->id == $ju->equipoinscrito_id){
                        if($eq->capitan == $ju->equipoinscrito_id){
                            $capitan = $ins->nombre;
                        }
                        $listajugadoresequipo .= $ins->nombre . "\n";
                    }
                    
                }
               

        ?>
      <form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>" method="post">
          <div class="form-group">
                <label for="c_<?=$eq->id?>">
                Jugadores del equipo <span style="font-weight: lighter;">"<?=$eq->nombre?>"</span>
                </label>
                <textarea id="c_<?=$eq->id?>" data-limit-rows="true" rows="<?=$competicion->maxjugadoresequipo?>" class="form-control" name="inscritojugadoresequipo"><?=$listajugadoresequipo?></textarea>
                <label for="d_<?=$eq->id?>">
                Capitan del <span style="font-weight: lighter;">"<?=$eq->nombre?>"</span>
                </label>
                <input type="text" id="d_<?=$eq->id?>" class="form-control" name="capitan" value="<?=$capitan?>"/>
                <input type="submit" class="form-control" value="Actualizar: '<?=$eq->nombre?>'"/>
          </div>
      </form>

 	<?php } ?>
 	<hr/>
 	<?php  foreach ($inscrito as $ju){
 	          // if(!$ju->equipoinscrito_id){
 	           ?>
 	    <p id="drag1<?=$ju->id?>" src="img_logo.gif" draggable="true" ondragstart="drag(event)" width="336" height="69"><?=$ju->nombre?></p>
 	
         <?php
                //	}
         	}
 	    ?>
               
          
 	<?php  foreach ($inscritoequipo as $eq){
 	
 	    ?>
               
          <div class="drop" id="equipoventana_<?=$eq->id?>" ondrop="drop(event)" ondragover="allowDrop(event)"></div>       
     <?php  } ?>
   </div>
  </div>
</div>