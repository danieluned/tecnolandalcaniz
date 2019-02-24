<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<style>

section.album {
  width: 100%; 
  overflow-x: scroll(or auto);
}
.img{
	width:100px;
	height:100px;
    /* background-image:url('http://www.mandalas.com/mandala/htdocs/images/Lrg_image_Pages/Flowers/Large_Orange_Lotus_8.jpg'); */
	background-repeat:no-repeat;
	background-position:center center;
	border:1px solid red;
	background-size:cover;
    display:inline-block;

color: red;

font-size: x-large;

text-emphasis-color: chartreuse;

font-size: 23px;
}
.img span {
background-color: white;
}
.img.equipo {
color:green;
border:1px solid green;
}
.img.new{
color:yellow;
border:1px solid yellow;
}
hr {
    border-top: 5px solid #8c8b8b;
}
</style> 
<script>
$(function(){ 
	$("select[name='local']").trigger('change'); 
	$("select[name='visitante']").trigger('change'); 
});
function alineacion(competicion_id, partida_id, equipo_id, html_destino){
	
	   var url = '<?=site_url("admin/competiciones/alineacion/")?>'+competicion_id+'/'+partida_id+'/'+equipo_id;
	    $.getJSON( url, function( data ) {
		     
	    	  var items = [];
	    	  $.each( data.inscritos, function( key, val ) {
		    	 var juega = '';
		    	$.each( data.alineados,function(key2,val2){
					if(val.id == val2.id){
						juega = 'checked';
					} 
		    	});
		    	items.push( "<input class='form-check-input' id='p_"+val.id+"_"+partida_id+"' type='checkbox' value='"+val.id+"' name='jugadores[]' "+juega+"/><label for='p_"+val.id+"_"+partida_id+"'>"+val.nombre+"</label>" );
	    	  });
	    	 
	    	  $(html_destino).html(items.join(""));
	   });
}
</script>
<div role="main">
	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading"><?=$competicion->nombre?></h1>
			<p class="lead text-muted"><?=$competicion->info?></p>
			
      <p>
      
        <a href="<?=site_url("admin/competiciones/partidas/".$competicion->id."?generarpartidasequipos")?>" class="btn btn-primary my-2">Generar partidas</a>
        
        <a href="<?=site_url("admin/competiciones/partidas/".$competicion->id."?borrarpartidas")?>" class="btn btn-secondary my-2">Borrar Partidas</a>
         
      </p>
       
		</div>
	</section>

	<div class="album py-5 bg-light">
		<div class="container">
			
            
<?php
$equipos = $competicion->getInscritoEquipo();
$jornadas = $competicion->getJornadas();
foreach ($jornadas as $jornada) {
    ?>

    		<div class="row img-row">
    			<div class="col-md-12"  >
    				
    				
					<div class="card mb-4 box-shadow">
					<div class="img equipo">
					<span id="j_<?=$jornada->id?>"><?=$jornada->id?></span>
					
    				</div>

						<div class="card-body">
							<p class="card-text">
							

    							<form
    								action="<?=site_url("admin/competiciones/partidas/".$competicion->id)?>#j_<?=$jornada->id?>"
    								method="post" enctype="multipart/form-data">
    								 
    									<input type="hidden"
    									name="competicion_id" value="<?=$competicion->id?>" /> 
    									<input
    									type="hidden" name="id" value="<?=$jornada->id?>" />
    
    
    								<div class="row">
    									<label for="n_fechainicio_<?=$jornada->id?>"> Fecha inicio</label> 
    									<input id="n_fechainicio_<?=$jornada->id?>"
    										class="form-control" name="fechainicio" type="datetime-local"
    										value="<?=date('Y-m-d\TH:i:s',strtotime($jornada->fechainicio))?>"/>
    									
    								</div>
   								 <div class="row">
    									<label for="n_fechaifin_<?=$jornada->id?>"> Fecha fin</label> 
    									<input id="n_fechaifin_<?=$jornada->id?>"
    										class="form-control" name="fechafin" type="datetime-local"
    										value="<?=date('Y-m-d\TH:i:s',strtotime($jornada->fechafin))?>"/>
    									
    								</div>
    								<div class="row">
    									<label for="n_info_<?=$jornada->id?>"> Información </label> 
    									<input
    										id="n_info_<?=$jornada->id?>" class="form-control" name="info"
    										type="text" value="<?=$jornada->info?>"/>
    
    								</div>
    								<div class="row">
    									<label for="n_tipo_<?=$jornada->id?>"> Tipo </label> 
    									<input
    										id="n_tipo_<?=$jornada->id?>" class="form-control" name="tipo"
    										type="text" value="<?=$jornada->tipo?>"/>
    
    								</div>
    								<div class="row">
    									<input type="submit" class="form-control"
    										name="guardar_jornada" value="Guardar Info Jornada" />
    								</div>
    							</form>
							
							</p>
							
							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<form action="<?=site_url("admin/competiciones/partidas/".$competicion->id)?>" method="post"> 
									<input type="hidden" name="competicion_id" value="<?=$competicion->id?>"/>
									<input type="hidden" name="id" value="<?=$jornada->id?>"/>
									<input type="submit" class="btn btn-sm btn-outline-secondary borrar" name="borrar_jornada" value="Borrar"/>
									</form>
								</div>
							</div>
							
						</div>
				</div>
				</div>
    	<?php
    	$partidas = $jornada->getPartidas();
    	if (count($partidas) > 0) {
    	    foreach ($partidas as $partida) {
            ?>

<div class="col-md-4">
			<div class="card mb-4 box-shadow" >
    			<div class="img">
    				<span id="p_<?=$partida->id?>"><?=$partida->id?></span>
    				
        		</div>  				
				<form
					action="<?=site_url("admin/competiciones/partidas/".$competicion->id)?>"
					method="post" enctype="multipart/form-data">
					<input type="hidden" name="competicion_id"
						value="<?=$competicion->id?>" /> 
				    <input type="hidden"
						name="id" value="<?=$partida->id?>" />
				     <input
						type="hidden" name="jornada_id" value="<?=$jornada->id?>" />
					<div class="row">
						<label for="p_resultado_<?=$partida->id?>">Resultado</label> 
						<input id="p_resultado_<?=$partida->id?>"
							class="form-control" name="resultado" type="text"
							value="<?=$partida->resultado?>" max-length="45"/>

					</div>

					<div class="row">
						<label for="p_horainicio_<?=$partida->id?>"> Hora inicio </label>
						<input id="p_horainicio_<?=$partida->id?>" class="form-control" name="horainicio" type="datetime-local" value="<?=date('Y-m-d\TH:i:s',strtotime($partida->horainicio))?>"/>

					</div>

					<div class="row">
						<label for="p_comentario_<?=$partida->id?>"> Comentario</label> <textarea id="p_comentario_<?=$partida->id?>"
							class="form-control" name="comentario"  ><?=$partida->comentario?></textarea>
							 

					</div>
					<div class="row">
						<label for="p_verificado_<?=$partida->id?>"> Verificado</label> <input id="p_verificado_<?=$partida->id?>"
							class="form-control" name="verificado" type="checkbox"  value="1" <?=$partida->verificado?"checked='checked'":""?>
							 />

					</div> 
					<div class="row">
						<label for="p_estado_<?=$partida->id?>"> Estado</label> 
						<select name="estado" id="p_estado_<?=$partida->id?>">
							<option value="pendiente" <?=$partida->estado == "pendiente"?"selected":""?>>Pendiente</option>
							<option value="cerrada" <?=$partida->estado == "cerrada"?"selected":""?>>Cerrada</option>
							<option value="jugando" <?=$partida->estado == "jugando"?"selected":""?>>Jugando</option>
							<option value="disputa" <?=$partida->estado == "disputa"?"selected":""?>>Disputa</option>
							<option value="verificando" <?=$partida->estado == "verificando"?"selected":""?>>Verificando</option>
						</select>

					</div>
					<div class="row">
						<label for="p_propone_fecha_<?=$partida->id?>"> Id del equipo que esta proponiendo fecha</label> 
						<input id="p_propone_fecha_<?=$partida->id?>" class="form-control" name="propone_fecha" type="number" value="<?=$partida->propone_fecha?>"/>
					</div>
					<div class="row">
						<label for="p_info_<?=$partida->id?>"> Info</label> <input id="p_info_<?=$partida->id?>"
							class="form-control" name="info" type="text"  value="<?=$partida->info?>"
							 />

					</div>
					<div class="row">
						<label for="p_mapa1_<?=$partida->id?>">Punto Caliente</label> 
						<select id="p_mapa1_<?=$partida->id?>" class="form-control" name="mapa1" >
						<?php foreach($this->mapa->callofdutyPuntocaliente() as $mapa){?>
						     <option value='<?=$mapa?>' <?=$partida->mapa1==$mapa?'selected':''?>><?=$mapa?></option>
						<?php }?>
						</select>
						<select class="form-control" name="mapa1_resultado" class="form-control">
							<option value="0" <?=$partida->mapa1_resultado==0?'selected':''?>>Empate</option>
							<option value="1" <?=$partida->mapa1_resultado==1?'selected':''?>>Local</option>
							<option value="2" <?=$partida->mapa1_resultado==2?'selected':''?>>Visitante</option>
						</select>
					</div>
					
					<div class="row">
						<label for="p_mapa2_<?=$partida->id?>">ByD</label> 
						<select id="p_mapa2_<?=$partida->id?>" class="form-control" name="mapa2" >
						<?php foreach($this->mapa->callofdutyByD() as $mapa){?>
						     <option value='<?=$mapa?>' <?=$partida->mapa2==$mapa?'selected':''?>><?=$mapa?></option>
						<?php }?>
						</select>
						<select class="form-control" name="mapa2_resultado" class="form-control">
							<option value="0" <?=$partida->mapa2_resultado==0?'selected':''?>>Empate</option>
							<option value="1" <?=$partida->mapa2_resultado==1?'selected':''?>>Local</option>
							<option value="2" <?=$partida->mapa2_resultado==2?'selected':''?>>Visitante</option>
						</select>
					</div>
					
					<div class="row">
						<label for="p_mapa3_<?=$partida->id?>">Control</label> 
						<select id="p_mapa3_<?=$partida->id?>" class="form-control" name="mapa3" >
						<?php foreach($this->mapa->callofdutyControl() as $mapa){?>
						     <option value='<?=$mapa?>' <?=$partida->mapa3==$mapa?'selected':''?>><?=$mapa?></option>
						<?php }?>
						</select>
						<select class="form-control" name="mapa1_resultado" class="form-control">
							<option value="0" <?=$partida->mapa3_resultado==0?'selected':''?>>Empate</option>
							<option value="1" <?=$partida->mapa3_resultado==1?'selected':''?>>Local</option>
							<option value="2" <?=$partida->mapa3_resultado==2?'selected':''?>>Visitante</option>
						</select>
					</div>
					
					
					<hr>
					<div class="row">
						<label for="p_local_<?=$partida->id?>">Local</label>
						<select class="form-control" id="p_local_<?=$partida->id?>" name="local" onchange="alineacion(<?=$competicion->id?>,<?=$partida->id?>,this.value,p_local_jugadores_<?=$partida->id?>)">
							<option>Sin seleccionar</option>
							<?php 
							$local = $partida->getJuegaEquipoLocal();
							foreach($equipos as $equipo){?>
							    <option <?php 
							    if($local && $local->equipoinscrito_id == $equipo->id ){
							        echo "selected";
							    }?> value="<?=$equipo->id?>"><?=$equipo->id?> <?=$equipo->nombre?></option>
							<?php 
							}
							?>
						</select>
					</div> 
					
					<p>Alineacion Local</p>
					<div class="row" class="form-control" id="p_local_jugadores_<?=$partida->id?>">
					</div>	
					<div class="row">
						
    					<input id="p_local_acepta_<?=$partida->id?>" class="form-check-label" type="checkbox" name="local_aceptafecha" value="1" <?=$local->aceptafecha?"checked":""?>/>
    					<label for="p_local_acepta_<?=$partida->id?>">acepta fecha local</label>
    					<input id="p_local_acepta2_<?=$partida->id?>" class="form-check-label" type="checkbox" name="local_aceptaresultado" value="1" <?=$local->conforme?"checked":""?>/>
						<label for="p_local_acepta2_<?=$partida->id?>">acepta resultados</label>
    				</div>	
						<hr>	
					<div class="row">
						<label for="p_visitante_<?=$partida->id?>">Visitante</label>
						<select  class="form-control" id="p_visitante_<?=$partida->id?>" name="visitante" onchange="alineacion(<?=$competicion->id?>,<?=$partida->id?>,this.value,p_visitante_jugadores_<?=$partida->id?>)">
						<option>Sin seleccionar</option>
							<?php 
							$visitante = $partida->getJuegaEquipoVisitante();
							foreach($equipos as $equipo){?>
							    <option <?php 
							    if($visitante && $visitante->equipoinscrito_id == $equipo->id ){
							        echo "selected";
							    }?> value="<?=$equipo->id?>"><?=$equipo->id?> <?=$equipo->nombre?></option>
							<?php 
							}
							?>
						</select>
					</div>
					
					<p>Alineacion visitante</p>
					<div class="row" class="form-control" id="p_visitante_jugadores_<?=$partida->id?>">						
					</div>
					
					
    				<div class="row">
    					
    					<input id="p_visitante_acepta_<?=$partida->id?>" class="form-check-label" type="checkbox" name="visitante_aceptafecha" value="1" <?=$visitante->aceptafecha?"checked":""?>/>
						<label for="p_visitante_acepta_<?=$partida->id?>">acepta fecha local</label>
						<input id="p_visitante_acepta2_<?=$partida->id?>" class="form-check-label" type="checkbox" name="visitante_aceptaresultado" value="1" <?=$visitante->conforme?"checked":""?>/>
						<label for="p_visitante_acepta2_<?=$partida->id?>">acepta resultados</label>
					</div>
    						
					<hr>
					<div class="row">
						<input type="submit" class="form-control"
							name="guardar_partida" value="Guardar cambios" />
					</div>
				</form>
				<div class="d-flex justify-content-between align-items-center">
					<div class="btn-group">
						<form action="<?=site_url("admin/competiciones/partidas/".$competicion->id)?>"  method="post"> 
						<input type="hidden" name="competicion_id" value="<?=$competicion->id?>"/>
						<input type="hidden" name="id" value="<?=$partida->id?>"/>
						<input type="submit" class="btn btn-sm btn-outline-secondary borrar" name="borrar_partida" value="Borrar"/>
						</form>
					</div>
				</div>
				</div>
				</div>
<?php
        }
      
    }
    
    ?>
		<div class="col-md-4 nuevo-boton">
					<div class="card mb-4 box-shadow">
					<div class="img new" id="p_new"></div>
					
				<form
					action="<?=site_url("admin/competiciones/partidas/".$competicion->id)?>#p_new"
					method="post" enctype="multipart/form-data">
					<input type="hidden" name="competicion_id"
						value="<?=$competicion->id?>" /> 
				   
				     <input
						type="hidden" name="jornada_id" value="<?=$jornada->id?>" />					
					
					<div class="row">
						<input type="submit" class="form-control"
							name="guardar_partida" value="Añadir Partida" />
					</div>
				</form>
				

	</div>
				</div>
		
</div>
<hr/>				
<?php }?>



<div class="row">		
	<div class="col-md-12" >		
		  <div class="card mb-4 box-shadow">
					<div class="img new" id="j_new"></div>
					
						<div class="card-body">
							<p class="card-text">
							
							
							<form
    								action="<?=site_url("admin/competiciones/partidas/".$competicion->id)?>#j_new"
    								method="post" enctype="multipart/form-data">
    								 
    									<input type="hidden"
    									name="competicion_id" value="<?=$competicion->id?>" /> 
    									
    
    
    						
    								<div class="row">
    									<input type="submit" class="form-control"
    										name="guardar_jornada" value="Añadir Jornada" />
    								</div>
    							</form>
						</div>
					</div>
				</div>
				</div>			

	</div>
</div>
</div>


	
		