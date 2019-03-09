<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
	
<script type="text/javascript">


//Formulario de editar equipo 
function editarjugador(event,id){
	event.preventDefault(); //prevent default action 
	var post_url = "<?=site_url("admin/competiciones/inscribirJugadorEquipo/")?>"; //get form action url 
	$.ajax({
		url : post_url,
		type: "POST",
        data:  new FormData($("#"+id)[0]),
        contentType: false,
        cache: false,
        processData: false,
	}).done(function(response){ 
		var bg = $("#jimg"+id);
		bg = bg.css('background-image').trim();
		
        var res = bg.substring(5, bg.length - 2) +"?"+new Date().getTime() ;
     
		$("#jimg"+id).css("background-image","url("+res+")");
	});
	return false;	
}
//Formulario de nuevo jugador 
function nuevojugador(event,id){
	event.preventDefault(); //prevent default action 
	var post_url = "<?=site_url("admin/competiciones/inscribirJugadorEquipo/")?>"; //get form action url
	var request_method = "POST" //get form GET/POST method
	var form_data = $("#"+id).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		var jugador = response.jugador;
		var ei = jugador.equipoinscrito_id;
		var html = '<div class="col-md-4">'+
						'<div class="card mb-4 box-shadow" >'+
							'<div class="img" id="jimge'+ei+"j"+jugador.id+'" style=\'background-image: url("<?=assets()?>images/competiciones/<?=$competicion->id?>/inscrito/'+jugador.id+'/'+jugador.logotipo+'")\'>'+
								'<span>'+jugador.id+'</span>'+
							'</div>'+  				
							'<form onsubmit="return editarjugador(event,\'e'+ei+'j'+jugador.id+'\')" id="e'+ei+'j'+jugador.id+'" action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>" method="post" enctype="multipart/form-data">'+
								'<input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />'+
								'<input type="hidden" name="equipoinscrito_id" value="'+ei+'" />'+
								'<input type="hidden" name="id" value="'+jugador.id+'" />'+
								'<div class="row">'+
									'<label for="n_nombre_'+jugador.id+'"> Jugador </label>'+
									'<input id="n_nombre_'+jugador.id+'" class="form-control" name="nombre" type="text" value="'+jugador.nombre+'" />'+
								'</div>'+
								'<div class="row">'+
									'<label for="n_info_'+jugador.id+'"> Info </label>'+
									'<textarea id="n_info_'+jugador.id+'" class="form-control" name="info">'+jugador.info+'</textarea>'+
								'</div>'+
								'<div class="row">'+
									'<label for="n_logotipo_'+jugador.id+'"> Logotipo </label>'+
									'<input id="n_logotipo_'+jugador.id+'" class="form-control" name="logotipo" type="file" />'+
								'</div>'+
								'<div class="row">'+
									'<label for="n_user_'+jugador.id+'"> Id usuario registrado </label>'+
									'<input id="n_user_'+jugador.id+'" class="form-control" name="users_id" type="number"  value="'+jugador.users_id+'"  />'+
								'</div>'+
								'<div class="row">'+
									'<input type="submit" class="form-control" name="inscribirjugadorequipo" value="Guardar cambios" />'+
								'</div>'+
							'</form>'+
							'<div class="d-flex justify-content-between align-items-center">'+
								'<div class="btn-group">'+
									'<form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"  method="post">'+
										'<input type="hidden" name="competicion_id" value="<?=$competicion->id?>"/>'+
										'<input type="hidden" name="id" value="'+jugador.id+'"/>'+
										'<input type="submit" class="btn btn-sm btn-outline-secondary borrar" name="borrarjugador" value="Borrar"/>'+
									'</form>'+
									'<small class="text-muted">Updated '+jugador.fecha+'</small>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
		
		 var $nuevo = $(html);
			$("#eq_"+ei).append($nuevo);
			$nuevo.show('slow');
		});
		return false;
}
//Formulario de editar jugador 
//Formulario de borrar equipo 
//Formulario de borrar jugador

//Formulario de nuevo equipo
function nuevoequipo(event,id){
	event.preventDefault(); //prevent default action 
	var post_url = "<?=site_url("admin/competiciones/inscribirEquipo/")?>"; //get form action url
	var request_method = "POST" //get form GET/POST method
	var form_data = $("#"+id).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		var equipo = response.equipo;
		var htmlnuevo = '<div class="row img-row" style="display:none" id="eq_'+equipo.id+'">'+
						'<div class="col-md-12"  >'+
							'<div class="card mb-4 box-shadow">'+
								'<div class="img equipo" style=\'background-image: url("<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/'+equipo.id+'/'+equipo.logotipo+'")\'>'+
									'<span>'+equipo.id+'</span>'+
								'</div>'+
								'<div class="card-body">'+
									'<p class="card-text">'+
										'<form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>" method="post" enctype="multipart/form-data">'+
											'<input type="hidden" name="logotipo" value="'+equipo.logotipo+'" />'+
											'<input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />'+ 
											'<input type="hidden" name="id" value="'+equipo.id+'" />'+
											'<div class="row">'+
												'<label for="n_nombre_'+equipo.id+'"> EQUIPO </label>'+
												'<input id="n_nombre_'+equipo.id+'" class="form-control" name="nombre" type="text" value="'+equipo.nombre+'" />'+
											'</div>'+
											'<div class="row">'+
												'<label for="n_info_'+equipo.id+'"> Info </label>'+
												'<textarea id="n_info_'+equipo.id+'" class="form-control" name="info">'+equipo.info+'</textarea>'+
											'</div>'+
											'<div class="row">'+
												'<label for="n_logotipo_'+equipo.id+'"> Logotipo </label>'+
												'<input id="n_logotipo_'+equipo.id+'" class="form-control" name="logotipo" type="file"/>'+
											'</div>'+
											'<div class="row">'+
												'<label for="n_capitan_'+equipo.id+'"> Capitan</label>'+
											     '<select id="n_capitan_'+equipo.id+'" class="form-control" name="capitan">'+
    													'<option value="0">Sin capitan</option>'+
												 '</select>'+
											'</div>'+
											'<div class="row">'+
												'<input type="submit" class="form-control" name="inscribirequipo" value="Guardar Info Equipo" />'+
											'</div>'+
										'</form>'+
									'</p>'+
									'<div class="d-flex justify-content-between align-items-center">'+
										'<div class="btn-group">'+
											'<form action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>" method="post">'+
												'<input type="hidden" name="competicion_id" value="<?=$competicion->id?>"/>'+
												'<input type="hidden" name="id" value="'+equipo.id+'"/>'+
												'<input type="submit" class="btn btn-sm btn-outline-secondary borrar" name="borrarequipo" value="Borrar"/>'+
											'</form>'+
										'</div>'+
										'<small class="text-muted">Updated '+equipo.fecha+'</small>'+
									'</div>'+
									'<form action="<?=site_url("admin/competiciones/inscribirJugadorEquipo/")?>" id="e'+equipo.id+'" onsubmit="return nuevojugador(event,\'e'+equipo.id+'\')" method="post" enctype="multipart/form-data">'+
	            						'<input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />'+
	            						'<input type="hidden" name="equipoinscrito_id" value="'+equipo.id+'" />'+
	            				    	'<div class="row">'+
	            							'<input type="submit" class="form-control" name="inscribirjugadorequipo" value="Nuevo Jugador" />'+
	            						'</div>'+
	            					'</form>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
	    var $nuevo = $(htmlnuevo);
		$("#listaequipos").append($nuevo);
		$nuevo.show('slow');
	});
	return false;
}
</script>

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
		
      <p>
       <!--	
        <a href="<?=site_url("admin/competiciones/partidas/".$competicion->id."?generarpartidasequipos")?>" class="btn btn-primary my-2">Generar partidas</a>
        
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
          -->
       					<form id="crearid"
								action="<?=site_url("admin/competiciones/inscribirEquipo/")?>"
								method="post" enctype="multipart/form-data" onsubmit="return nuevoequipo(event,'crearid')">
								<input type="hidden" name="competicion_id"
									value="<?=$competicion->id?>" />

								
								<div class="row">
									<input type="submit" class="form-control btn btn-secondary"
										name="inscribirequipo" value="Añadir Nuevo Equipo" />
								</div>
							</form>
      </p>
       
		</div>
	</section>
	
	<div class="album py-5 bg-light">
		<div class="container" id="listaequipos">
			
            
<?php
$equipos = $competicion->getInscritoEquipo();
foreach ($equipos as $equipo) {
    ?>

    		<div class="row img-row">
    			<div class="col-md-12"  >
    				
    				
					<div class="card mb-4 box-shadow">
					<div class="img equipo" style='background-image: url("<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$equipo->id?>/<?=$equipo->logotipo?>")'>
					<span><?=$equipo->id?></span>
    				</div>

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
    									<label for="n_nombre_<?=$equipo->id?>"> EQUIPO </label> <input id="n_nombre_<?=$equipo->id?>"
    										class="form-control" name="nombre" type="text"
    										value="<?=$equipo->nombre?>" />
    
    								</div>
    
    								<div class="row">
    									<label for="n_info_<?=$equipo->id?>"> Info </label>
    									<textarea id="n_info_<?=$equipo->id?>" class="form-control" name="info"><?=$equipo->info?></textarea>
    
    								</div>
    
    								<div class="row">
    									<label for="n_logotipo_<?=$equipo->id?>"> Logotipo </label> <input
    										id="n_logotipo_<?=$equipo->id?>" class="form-control" name="logotipo"
    										type="file"/>
    
    								</div>
    								<div class="row">
    									<label for="n_capitan_<?=$equipo->id?>"> Capitan</label>
    									<select id="n_capitan_<?=$equipo->id?>" class="form-control" name="capitan">
    									<?php $inscrito = $equipo->getInscrito();
  
    									if (count($inscrito) > 0) {?>
    									   	<option value="0">Sin seleccionar</option>
    									   
    									    <?php foreach ($inscrito as $jugador) {?>
    									        	<option value="<?=$jugador->id?>" <?=$equipo->capitan == $jugador->id?"selected":""?>><?=$jugador->id?> <?=$jugador->nombre?></option>
    									        
    									    <?php } 
    									}else{?>
    									    <option value="0">Se necesita añadir un jugador</option>
    							<?php }?>
                                         
    									</select>
    									
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
									<input type="submit" class="btn btn-sm btn-outline-secondary borrar" name="borrarequipo" value="Borrar EQUIPO"/>
									</form>
								</div>
								<small class="text-muted">Updated <?=$equipo->fecha ?></small>
							</div>
							<form
            					action="<?=site_url("admin/competiciones/inscribirJugadorEquipo/")?>"
            					method="post" enctype="multipart/form-data">
            					<input type="hidden" name="competicion_id"
            						value="<?=$competicion->id?>" /> <input type="hidden"
            						name="equipoinscrito_id" value="<?=$equipo->id?>" />
            				
            
            					<div class="row">
            						<input type="submit" class="form-control"
            							name="inscribirjugadorequipo" value="Nuevo Jugador" />
            					</div>
            				</form>
						</div>
				</div>
				</div>
    	<?php
    if (count($inscrito) > 0) {
        foreach ($inscrito as $jugador) {
            ?>

<div class="col-md-4">
			<div class="card mb-4 box-shadow" >
			<?php 
			$ruta = "inscritoequipo/".$equipo->id."/".$equipo->logotipo; 
			if($jugador->logotipo ){
			 $ruta = "inscrito/".$jugador->id."/".$jugador->logotipo;   
			}
			?>
			<div id="jimge<?=$equipo->id?>j<?=$jugador->id?>" class="img" style='background-image: url("<?=assets()?>images/competiciones/<?=$competicion->id?>/<?=$ruta?>")'>
			<span><?=$jugador->id?></span>
    				</div>  				
				<form onsubmit="return editarjugador(event,'e<?=$equipo->id?>j<?=$jugador->id?>')" id="e<?=$equipo->id?>j<?=$jugador->id?>"
					action="<?=site_url("admin/competiciones/ver/".$competicion->id)?>"
					method="post" enctype="multipart/form-data">
					<input type="hidden" name="competicion_id"
						value="<?=$competicion->id?>" /> <input type="hidden"
						name="equipoinscrito_id" value="<?=$equipo->id?>" /> <input
						type="hidden" name="id" value="<?=$jugador->id?>" />
					<div class="row">
						<label for="n_nombre_<?=$jugador->id?>"> Jugador </label> <input id="n_nombre_<?=$jugador->id?>"
							class="form-control" name="nombre" type="text"
							value="<?=$jugador->nombre?>" />

					</div>

					<div class="row">
						<label for="n_info_<?=$jugador->id?>"> Info </label>
						<textarea id="n_info_<?=$jugador->id?>" class="form-control" name="info"><?=$jugador->info?></textarea>

					</div>

					<div class="row">
						<label for="n_logotipo_<?=$jugador->id?>"> Logotipo </label> <input id="n_logotipo_<?=$jugador->id?>"
							class="form-control" name="logotipo" type="file"
							 />

					</div>
					<div class="row">
						<label for="n_user_<?=$jugador->id?>"> Id usuario registrado </label> 
						<input id="n_user_<?=$jugador->id?>"
							class="form-control" name="users_id" type="number"  value="<?=$jugador->users_id?>" 
							 />

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
						<input type="submit" class="btn btn-sm btn-outline-secondary borrar" name="borrarjugador" value="Borrar"/>
						</form>

						<small class="text-muted">Updated <?=$jugador->fecha ?></small>
					</div>
				</div>
				</div>
				</div>
<?php
        }
      
    }?>
    
   
		
</div>
<hr/>				
<?php }?>


	</div>
</div>
</div>


	
		