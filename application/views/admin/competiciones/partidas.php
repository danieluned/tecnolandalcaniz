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
<div role="main">
	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading"><?=$competicion->nombre?></h1>
			<p class="lead text-muted"><?=$competicion->info?></p>
			<!-- 
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
       -->
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
					action="<?=site_url("admin/competiciones/partidas/".$competicion->id)?>#p_<?=$partida->id?>"
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
						<label for="p_comentario_<?=$partida->id?>"> Comentario</label> <input id="p_comentario_<?=$partida->id?>"
							class="form-control" name="comentario" type="text" max-length="200"
							 />

					</div>
				<div class="row">
						<label for="p_verificado_<?=$partida->id?>"> Verificado</label> <input id="p_verificado_<?=$partida->id?>"
							class="form-control" name="verificado" type="checkbox" 
							 />

					</div> 
					<div class="row">
						<label for="p_estado_<?=$partida->id?>"> Estado</label> 
						<select name="p_estado_<?=$partida->id?>">
							<option value="pendiente" <?=$partida->estado == "pendiente"?"selected":""?>>Pendiente</option>
							<option value="cerrada" <?=$partida->estado == "cerrada"?"selected":""?>>Cerrada</option>
							<option value="jugando" <?=$partida->estado == "jugando"?"selected":""?>>Jugando</option>
							<option value="disputa" <?=$partida->estado == "disputa"?"selected":""?>>Disputa</option>
							<option value="verificando" <?=$partida->estado == "verificando"?"selected":""?>>Verificando</option>
						</select>

					</div>
					<div class="row">
						<label for="p_info_<?=$partida->id?>"> Info</label> <input id="p_info_<?=$partida->id?>"
							class="form-control" name="info" type="text" 
							 />

					</div>
					<div class="row">
						<label for="p_visitante_<?=$partida->id?>">Visitante</label>
						<select id="p_visitante_<?=$partida->id?>" name="visitante">
							<option>Sin seleccionar</option>
							<?php 
							$equipospartida = $partida->getJuegaEquipos();
							foreach($equipos as $equipo){?>
							    <option <?php 
							    if(count($equipospartida)>1 && $equipospartida[1]->equipoinscrito_id == $equipo->id ){
							        echo "selected";
							    }?> value="<?=$equipo->id?>"><?=$equipo->id?> <?=$equipo->nombre?></option>
							<?php 
							}
							?>
						</select>
					</div>
					
					<div class="row">
						<label for="p_local_<?=$partida->id?>">Visitante</label>
						<select id="p_local_<?=$partida->id?>" name="local">
						<option>Sin seleccionar</option>
							<?php 
							foreach($equipos as $equipo){?>
							    <option <?php 
							    if(count($equipospartida)>0 && $equipospartida[0]->equipoinscrito_id == $equipo->id ){
							        echo "selected";
							    }?> value="<?=$equipo->id?>"><?=$equipo->id?> <?=$equipo->nombre?></option>
							<?php 
							}
							?>
						</select>
					</div>
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
						<label for="p_resultado">Resultado</label> 
						<input id="p_resultado"
							class="form-control" name="resultado" type="text"
							 max-length="45"/>

					</div>

					<div class="row">
						<label for="p_horainicio"> Hora inicio </label>
						<input id="p_horainicio" class="form-control" name="horainicio" type="datetime-local" />

					</div>

					<div class="row">
						<label for="p_comentario"> Comentario</label> <input id="p_comentario"
							class="form-control" name="comentario" type="text" max-length="200"
							 />

					</div>
				<div class="row">
						<label for="p_verificado"> Verificado</label> <input id="p_verificado"
							class="form-control" name="verificado" type="checkbox" 
							 />

					</div> 
					<div class="row">
						<label for="p_estado_<?=$partida->id?>"> Estado</label> 
						<select name="p_estado_<?=$partida->id?>">
							<option value="pendiente">Pendiente</option>
							<option value="cerrada" >Cerrada</option>
							<option value="jugando" >Jugando</option>
							<option value="disputa" >Disputa</option>
							<option value="verificando" >Verificando</option>
						</select>

					</div>
					<div class="row">
						<label for="p_info"> Info</label> <input id="p_info"
							class="form-control" name="info" type="text" 
							 />

					</div>
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
    									<label for="n_fechainicio"> Fecha inicio</label> 
    									<input id="n_fechainicio"
    										class="form-control" name="fechainicio" type="datetime-local"
    										 />
    									
    								</div>
   								 <div class="row">
    									<label for="n_fechaifin"> Fecha fin</label> 
    									<input id="n_fechaifin"
    										class="form-control" name="fechafin" type="datetime-local"
    										 />
    									
    								</div>
    								<div class="row">
    									<label for="n_info"> Información </label> 
    									<input
    										id="n_info" class="form-control" name="info"
    										type="text"/>
    
    								</div>
    								<div class="row">
    									<label for="n_tipo"> Tipo </label> 
    									<input
    										id="n_tipo" class="form-control" name="tipo"
    										type="text" />
    
    								</div>
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


	
		