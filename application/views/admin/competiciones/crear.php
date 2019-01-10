<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
$(function(){
	$("select[name='porequipos']").change(function(){
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
      <h1>Crear competición</h1>
      <form action="<?=site_url("admin/competiciones/crear")?>" method="post">
          <div class="form-group">
                <label >
                Nombre
                <input class="form-control" type="text" name="nombre"/>
                </label>
                <label>
                ¿Por equipos?
                <select class="form-control" name="porequipos">
                	<option selected="selected" value="0">No</option>
                	<option value="1">Si</option>
                </select>
                </label>             
                <label class="equipo" style="display:none;">
                Maximo de equipos
                <input class="form-control" type="number"  name="maxequipos" disabled/>
                </label>
                
                <label class="equipo" style="display:none;">
                Minimo de equipos
                <input class="form-control" type="number" name="minequipos" disabled/>
                </label>
                
                <label class="equipo" style="display:none;">
                Maximo de jugadores por equipo
                <input class="form-control" type="number" name="maxjugadoresequipo" disabled/>
                </label>
                
                <label class="equipo" style="display:none;">
                Minimo de jugadores por equipo
                <input class="form-control" type="text" name="minjugadoresequipo" disabled/>
                </label>
                
				<label class="sinequipo">
                Minimo de jugadores
                <input class="form-control" type="text" name="minjugadores"/>
                </label>
                
                <label class="sinequipo">
                Maximo de jugadores
                <input class="form-control" type="text" name="minjugadores"/>
                </label>
                
                <label>
                Inicio inscripcion
                <input class="form-control" type="datetime-local" name="inicioinscripcion"/>
                </label> 
                <label>
                Fin inscripcion
                <input class="form-control" type="datetime-local" name="fininscripcion"/>
                </label>
                
                <label>
                Inicio fase regular
                <input class="form-control" type="datetime-local" name="iniciofaseregular"/>
                </label>
                <label>
                Fin fase regular
                <input class="form-control" type="datetime-local" name="iniciofaseregular"/>
                </label>
                
                <label>
                Inicio fecha presencial
                <input class="form-control" type="datetime-local" name="iniciofaseregular"/>
                </label>
                <label>
                Fin fecha presencial
                <input class="form-control" type="datetime-local" name="iniciofaseregular"/>
                </label>
                
                <label class="sinequipo">
                Coste inscripcion
                <input class="form-control" type="number" placeholder="0.00" name="costeinscripcion" min="0" value="0" step="0.01"/>
                 </label>
                 <label class="equipo" style="display:none;">
                Coste inscripcion equipo
                <input class="form-control" type="number" disabled placeholder="0.00" name="costeinscripcionequipo" min="0" value="0" step="0.01"/>
                 </label>
                 
                 <label>
                Puntos por ganar
                <input class="form-control" type="number" name="ganar"/>
                </label>
                <label>
                Puntos por perder
                <input class="form-control" type="number" name="perder"/>
                </label>
                <label>
                Puntos por empatar
                <input class="form-control" type="number" name="empatar"/>
                </label>
                <input type="submit" value="Crear"/>
          </div>
      </form>
    </div>
  </div>
</div>