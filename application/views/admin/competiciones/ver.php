<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>

section.album {
  width: 100%; 
  overflow-x: scroll(or auto);
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
			<div class="row">
            
<?php
$equipos = $competicion->getInscritoEquipo();
foreach ($equipos as $equipo) {
    ?>
    			<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<img class="card-img-top" style="height: 200px;"
							src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo->id?>/<?=$equipo->logotipo?>"
							alt="logotipo equipo <?=$equipo->nombre?>">
						<div class="card-body">
							<p class="card-text">
							
							
    							<form
    								action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
    								method="post" enctype="multipart/form-data">
    								<input type="hidden" name="logotipo"
    									value="<?=$equipo->logotipo ?>" /> 
    									<input type="hidden"
    									name="competicion_id" value="<?=$competicion->id?>" /> 
    									<input
    									type="hidden" name="id" value="<?=$equipo->id?>" />
    
    
    								<div class="row">
    									<label for="n_nombre"> EQUIPO </label> <input id="n_nombre"
    										class="form-control" name="nombre" type="text"
    										value="<?=$equipo->nombre?>" />
    
    								</div>
    
    								<div class="row">
    									<label for="n_info"> Info </label>
    									<textarea id="n_info" class="form-control" name="info"><?=$equipo->info?></textarea>
    
    								</div>
    
    								<div class="row">
    									<label for="n_logotipo"> Logotipo </label> <input
    										id="n_logotipo" class="form-control" name="logotipo"
    										type="file" />
    
    								</div>
    
    								<div class="row">
    									<input type="submit" class="form-control"
    										name="inscribirequipo" value="Guardar Info Equipo" />
    								</div>
    							</form>
							
							</p>

							<div class="d-flex justify-content-between align-items-center">
								<div class="btn-group">
									<form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>" method="post"> 
									<input type="hidden" name="competicion_id" value="<?=$competicion->id?>"/>
									<input type="hidden" name="id" value="<?=$equipo->id?>"/>
									<input type="submit" class="btn btn-sm btn-outline-secondary" name="borrarequipo" value="Borrar"/>
									</form>
								</div>
								<small class="text-muted">Updated <?=$equipo->fecha ?></small>
							</div>
							
						</div>
				


				<hr><hr>
    	<?php
    $inscrito = $equipo->getInscrito();
    if (count($inscrito) > 0) {
        foreach ($inscrito as $jugador) {
            ?>


	<img class="card-img-top" style="height: 100px; width:100px;"
					src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscrito/<?=$jugador->id?>/<?=$jugador->logotipo?>"></img>

				<form
					action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
					method="post" enctype="multipart/form-data">
					<input type="hidden" name="competicion_id"
						value="<?=$competicion->id?>" /> <input type="hidden"
						name="equipoinscrito_id" value="<?=$equipo->id?>" /> <input
						type="text" disabled value="<?=$jugador->id?>" /> <input
						type="hidden" name="id" value="<?=$jugador->id?>" />
					<div class="row">
						<label for="n_nombre"> Jugador </label> <input id="n_nombre"
							class="form-control" name="nombre" type="text"
							value="<?=$jugador->nombre?>" />

					</div>

					<div class="row">
						<label for="n_info"> Info </label>
						<textarea id="n_info" class="form-control" name="info"><?=$jugador->info?></textarea>

					</div>

					<div class="row">
						<label for="n_logotipo"> Logotipo </label> <input id="n_logotipo"
							class="form-control" name="logotipo" type="file"
							value="<?=$jugador->info?>" />

					</div>

					<div class="row">
						<input type="submit" class="form-control"
							name="inscribirjugadorequipo" value="Guardar cambios" />
					</div>
				</form>
				<div class="d-flex justify-content-between align-items-center">
					<div class="btn-group">
						<form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"  method="post"> 
						<input type="hidden" name="competicion_id" value="<?=$competicion->id?>"/>
						<input type="hidden" name="id" value="<?=$jugador->id?>"/>
						<input type="submit" class="btn btn-sm btn-outline-secondary" name="borrarjugador" value="Borrar"/>
						</form>

						<small class="text-muted">Updated <?=$jugador->fecha ?></small>
					</div>
				</div>
<?php
        }
    } 
    ?>	         
    <hr><hr>

		<form
					action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
					method="post" enctype="multipart/form-data">
					<input type="hidden" name="competicion_id"
						value="<?=$competicion->id?>" /> <input type="hidden"
						name="equipoinscrito_id" value="<?=$equipo->id?>" />
					<div class="row">
						<label for="n_nombre"> Jugador Nuevo </label> <input id="n_nombre"
							class="form-control" name="nombre" type="text" />

					</div>

					<div class="row">
						<label for="n_info"> Info </label>
						<textarea id="n_info" class="form-control" name="info"></textarea>

					</div>

					<div class="row">
						<label for="n_logotipo"> Logotipo </label> <input id="n_logotipo"
							class="form-control" name="logotipo" type="file" />

					</div>

					<div class="row">
						<input type="submit" class="form-control"
							name="inscribirjugadorequipo" value="Nuevo Jugador" />
					</div>
				</form>

	</div>
				</div>
<?php }?>
<div class="col-md-4">
					<div class="card mb-4 box-shadow">
						<div class="card-img-top" style="height: 300px;"></div>
						<div class="card-body">
							<p class="card-text">
							
							
							<form
								action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
								method="post" enctype="multipart/form-data">
								<input type="hidden" name="competicion_id"
									value="<?=$competicion->id?>" />

								<div class="row">
									<label for="n_nombre"> Nuevo Equipo </label> <input id="n_nombre"
										class="form-control" name="nombre" type="text" value="" />

								</div>

								<div class="row">
									<label for="n_info"> Info </label>
									<textarea id="n_info" class="form-control" name="info"></textarea>

								</div>

								<div class="row">
									<label for="n_logotipo"> Logotipo </label> <input
										id="n_logotipo" class="form-control" name="logotipo"
										type="file" value="" />

								</div>

								<div class="row">
									<input type="submit" class="form-control"
										name="inscribirequipo" value="Añadir Nuevo Equipo" />
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>