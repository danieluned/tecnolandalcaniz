<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container" style="margin-top: 60px;">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<h1><?=$competicion->nombre?></h1>
			<h4><?=$competicion->info?></h4>
			<h2>Lista de equipos</h2>
		</div>
	</div>
</div>
<hr/>
<?php
$equipos = $competicion->getInscritoEquipo();
foreach ($equipos as $equipo) {
    ?>
<div class="container">
	<div class="row">
		<div class="col-sm">
			<img style="" class="img-fluid"
				src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo->id?>/<?=$equipo->logotipo?>"></img>
			<div class="row">
				<form
					action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
					method="post" enctype="multipart/form-data">
					<input type="hidden" name="competicion_id"
						value="<?=$competicion->id?>" /> <input type="hidden" name="id"
						value="<?=$equipo->id?>" />


					<div class="row">
						<label for="n_nombre"> Nombre </label> <input id="n_nombre"
							class="form-control" name="nombre" type="text"
							value="<?=$equipo->nombre?>" />

					</div>

					<div class="row">
						<label for="n_info"> Info </label>
						<textarea id="n_info" class="form-control" name="info"><?=$equipo->info?></textarea>

					</div>

					<div class="row">
						<label for="n_logotipo"> Logotipo </label> <input id="n_logotipo"
							class="form-control" name="logotipo" type="file" />

					</div>

					<div class="row">
						<input type="submit" class="form-control" name="inscribirequipo"
							value="Guardar Info Equipo" />
					</div>
				</form>
			</div>

			<div class="col-sm">
    	<?php
    $inscrito = $equipo->getInscrito();
    if (count($inscrito) > 0) {
        foreach ($inscrito as $jugador) {
            ?>
			<hr/>
<div class="container">

	<div class="row">
	<img style="" class="img-fluid"
				src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscrito/<?=$jugador->id?>/<?=$jugador->logotipo?>"></img>
			
		<form
			action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
			method="post" enctype="multipart/form-data">
			<input type="hidden" name="competicion_id"
				value="<?=$competicion->id?>" />
			<input type="hidden" name="equipoinscrito_id" value="<?=$equipo->id?>"/>
			<input type="text" disabled value="<?=$jugador->id?>"/>
			<input type="hidden" name="id" value="<?=$jugador->id?>"/>
			<div class="row">
				<label for="n_nombre"> Nombre </label> <input id="n_nombre"
					class="form-control" name="nombre" type="text" value="<?=$jugador->nombre?>" />

			</div>

			<div class="row">
				<label for="n_info"> Info </label>
				<textarea id="n_info" class="form-control" name="info"><?=$jugador->info?></textarea>

			</div>

			<div class="row">
				<label for="n_logotipo"> Logotipo </label> <input id="n_logotipo"
					class="form-control" name="logotipo" type="file" value="<?=$jugador->info?>" />

			</div>

			<div class="row">
				<input type="submit" class="form-control" name="inscribirjugadorequipo"
					value="Guardar cambios" />
			</div>
		</form>
	</div>
</div>

<?php
        }
    } else {
        ?>
Sin jugadores
<?php
    }
    ?>	         
    <hr/>
<div class="container">

	<div class="row">
		<form
			action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
			method="post" enctype="multipart/form-data">
			<input type="hidden" name="competicion_id"
				value="<?=$competicion->id?>" />
			<input type="hidden" name="equipoinscrito_id" value="<?=$equipo->id?>"/>
			<div class="row">
				<label for="n_nombre"> Nombre </label> <input id="n_nombre"
					class="form-control" name="nombre" type="text"  />

			</div>

			<div class="row">
				<label for="n_info"> Info </label>
				<textarea id="n_info" class="form-control" name="info"></textarea>

			</div>

			<div class="row">
				<label for="n_logotipo"> Logotipo </label> <input id="n_logotipo"
					class="form-control" name="logotipo" type="file"  />

			</div>

			<div class="row">
				<input type="submit" class="form-control" name="inscribirjugadorequipo"
					value="Añadir Nuevo Jugador" />
			</div>
		</form>
	</div>
</div>          		
			</div>

		</div>
	</div>
</div>
<hr/>
<?php }?>
<hr/>
<div class="container">

	<div class="row">
		<form
			action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
			method="post" enctype="multipart/form-data">
			<input type="hidden" name="competicion_id"
				value="<?=$competicion->id?>" />

			<div class="row">
				<label for="n_nombre"> Nombre </label> <input id="n_nombre"
					class="form-control" name="nombre" type="text" value="" />

			</div>

			<div class="row">
				<label for="n_info"> Info </label>
				<textarea id="n_info" class="form-control" name="info"></textarea>

			</div>

			<div class="row">
				<label for="n_logotipo"> Logotipo </label> <input id="n_logotipo"
					class="form-control" name="logotipo" type="file" value="" />

			</div>

			<div class="row">
				<input type="submit" class="form-control" name="inscribirequipo"
					value="Añadir Nuevo Equipo" />
			</div>
		</form>
	</div>
</div>