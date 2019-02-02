<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
$aux = "crear"; 
if(!$crear){
    $aux = "editar/".$competicion->id;
}
?>
<script>
$(function(){
	$("select[name='moo']").change(function(){
		if($(this).val() == "1"){
			$("label.sinequipo input").prop("disabled",true);
			$("label.sinequipo").hide();
			
			$("label.equipo input").prop("disabled",false);
			$("label.equipo").show();
			
			
		}else{
			$("label.sinequipo input").prop("disabled",false);
			$("label.sinequipo").show();
			
			$("label.equipo input").prop("disabled",true);
			$("label.equipo").hide();
		}
	});
});
</script>
<div class="container" style="margin-top: 60px;">
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <h1><?=$title?></h1>
      
      <form action="<?=site_url("admin/competiciones/".$aux)?>" method="post">
          <div class="form-group">
                <label>
                ID
                <input class="form-control" type="text" readonly value="<?=$competicion->id?>"/>
                <input class="form-control" type="hidden" name="id" value="<?=$competicion->id?>"/>
                </label>
                
                <label>
                Nombre
                <input class="form-control" type="text" name="nombre" value="<?=$competicion->nombre?>"/>
                </label>
                <label >
                Información
                <input class="form-control" type="text" name="info" value="<?=$competicion->info?>"/>
                </label>
                <label>
                Modo
                <select class="form-control" name="modo">
                	<!-- <option <?php echo $competicion->modo == 0? "selected='selected'":"";?> value="0">Torneo</option>
                	<option <?php echo $competicion->modo == 1? "selected='selected'":"";?> value="1">Liga</option>
                	<option <?php echo $competicion->modo == 2? "selected='selected'":"";?> value="2">Sorteo</option> -->
                	<option <?php echo $competicion->modo == 3? "selected='selected'":"";?> value="3">Liga + Torneo final (Equipos)</option>
                </select>
                </label> 
                            
                <label>
                Maximo de equipos
                <input class="form-control" type="number"  name="maxequipos" value="<?=$competicion->maxequipos?>"/>
                </label>
                
                <label>
                Minimo de equipos
                <input class="form-control" type="number" name="minequipos" value="<?=$competicion->minequipos?>"/>
                </label>
                
                <label>
                Maximo de jugadores por equipo
                <input class="form-control" type="number" name="maxjugadoresequipo" value="<?=$competicion->maxjugadoresequipo?>"/>
                </label>
                
                <label>
                Minimo de jugadores por equipo
                <input class="form-control" type="number" name="minjugadoresequipo" value="<?=$competicion->minjugadoresequipo?>"/>
                </label>
                
				<label>
                Minimo de jugadores
                <input class="form-control" type="number" name="minjugadores" value="<?=$competicion->minjugadores?>"/>
                </label>
                
                <label>
                Maximo de jugadores
                <input class="form-control" type="number" name="maxjugadores" value="<?=$competicion->maxjugadores?>"/>
                </label>
                
                <label>
                Inicio inscripcion
                <input class="form-control" type="datetime-local" name="inicioinscripcion" value="<?=date("Y-m-d\TH:i:s", strtotime($competicion->inicioinscripcion))?>"/>
                </label> 
                <label>
                Fin inscripcion
                <input class="form-control" type="datetime-local" name="fininscripcion" value="<?=date('Y-m-d\TH:i:s',strtotime($competicion->fininscripcion))?>"/>
                </label>
                
                <label>
                Inicio fase regular
                <input class="form-control" type="datetime-local" name="iniciofaseregular" value="<?=date('Y-m-d\TH:i:s',strtotime($competicion->iniciofaseregular))?>"/>
                </label>
                <label>
                Fin fase regular
                <input class="form-control" type="datetime-local" name="finfaseregular" value="<?=date('Y-m-d\TH:i:s',strtotime($competicion->finfaseregular))?>"/>
                </label>
                
                <label>
                Inicio fecha presencial
                <input class="form-control" type="datetime-local" name="iniciofechapresencial" value="<?=date('Y-m-d\TH:i:s',strtotime($competicion->iniciofechapresencial))?>"/>
                </label>
                <label>
                Fin fecha presencial
                <input class="form-control" type="datetime-local" name="finfechapresencial" value="<?=date('Y-m-d\TH:i:s',strtotime($competicion->finfechapresencial))?>"/>
                </label>
                
                <label>
                Coste inscripcion
                <input class="form-control" type="number"  name="costeinscripcion" step="0.01" value="<?=$competicion->costeinscripcion?>"/>
                 </label>
                 <label >
                Coste inscripcion equipo
                <input class="form-control" type="number" " name="costeinscripcionequipo" step="0.01" value="<?=$competicion->costeinscripcionequipo?>"/>
                 </label>
                 
                 <label>
                Puntos por ganar
                <input class="form-control" type="number" name="ganar" value="<?=$competicion->ganar?>"/>
                </label>
                <label>
                Puntos por perder
                <input class="form-control" type="number" name="perder" value="<?=$competicion->perder?>"/>
                </label>
                <label>
                Puntos por empatar
                <input class="form-control" type="number" name="empatar" value="<?=$competicion->empatar?>"/>
                </label>
                <input type="submit" value="Guardar"/>
          </div>
      </form>
    </div>
  </div>
</div>