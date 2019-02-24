<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<style>
section.album {
    width: 100%;
    overflow-x: scroll(or auto);
}

.img {
    width: 100px;
    height: 100px;
    /* background-image:url('http://www.mandalas.com/mandala/htdocs/images/Lrg_image_Pages/Flowers/Large_Orange_Lotus_8.jpg'); */
    background-repeat: no-repeat;
    background-position: center center;
    border: 1px solid red;
    background-size: cover;
    display: inline-block;

    color: red;

    font-size: x-large;

    text-emphasis-color: chartreuse;

    font-size: 23px;
}

.img span {
    background-color: white;
}

.img.equipo {
    color: green;
    border: 1px solid green;
}

.img.new {
    color: yellow;
    border: 1px solid yellow;
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
        </div>
    </section>

    
<div class="container">
            
				<div class="row">
				
                    <div class="col-md-12">
                        <h1>Alineacion</h1>
                                 <div class="col-xs4 col-xs-offset-4">
                                        <p>Jornada <?=$partida->jornada_id?> -
                                            del dia <?=date('d',strtotime($jornada->fechainicio))?> al
                                            <?=date('d',strtotime($jornada->fechafin))?></p>
                                            
                                            <p>Hora de inicio: <?=$partida->horainicio?></p>
    										<p>id Partida <?=$partida->id?></p>
    							</div>
    				   </div>	
    				   
				   </div>	
				   <div class="row">
				   <?php if($partida->estado == 'pendiente'){?>
				    	<div class="col-md-12">
				    		<form action="<?=site_url("admin/competiciones/guardaralineacion")?>" method="post"
                                        enctype="multipart/form-data">
                                          <input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />
                                            <input type="hidden" name="id" value="<?=$partida->id?>" />
                                            <input type="hidden" name="equipo" value="<?=${$modificar}['equipo']->id?>"/>
                                            
				    		<?php 
				    		$equipo = ${$modificar}['equipo'];
				    		foreach(${$modificar}['inscritos'] as $jugador){?>
				    					
				    		         <div class="col-md-2">
				    		         <label for="j_<?=$jugador->id?>">
				    		         	<div class="card mb-4 box-shadow" >
				    		         	<?php 
                                			$ruta = "inscritoequipo/".$equipo->id."/".$equipo->logotipo; 
                                			if($jugador->logotipo ){
                                			 $ruta = "inscrito/".$jugador->id."/".$jugador->logotipo;   
                                			}
                                			?>
										 <div class="img" style='background-image: url("<?=assets()?>images/competiciones/<?=$competicion->id?>/<?=$ruta?>")'>
											<span><?=$jugador->id?></span>
											
    									</div>
				    		         </div> 
				    		         <?php 
				    		         $checked = '';
				    		         foreach(${$modificar}['alineados'] as $j2){
				    		             if($j2->id == $jugador->id){
				    		             $checked = 'checked';
				    		             }
				    		         }?>
				    		         </label>
				    		         <div><?=$jugador->nombre?></div>
				    		         <input id="j_<?=$jugador->id?>" type="checkbox" name="jugadores[]" value="<?=$jugador->id?>" <?=$checked?>/>
				    		  	  </div>
				    		<?php }?>
				    		<input type="submit" class="form-control" value="Guardar Alineacion"/>
				    		</form>
				   		</div>
				   <?php }else{?>
				    <div class="row">    
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo col-offset-2">
                      		<figure class="borde-circular">
                       			<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$local['equipo']->id?>/<?=$local['equipo']->logotipo?>">
                            	 <p>LOCAL: <?=$local['equipo']->nombre?></p>
                           </figure>
                       		     
                      
                      
                       </div>                                              
                       
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo ">VS</div>     
                       
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo ">
                       <figure class="borde-circular">
                       		<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$visitante['equipo']->id?>/<?=$visitante['equipo']->logotipo?>">
                               <p>VISITANTE: <?=$visitante['equipo']->nombre?></p>
                               </figure>
                               
                       </div>             
                          
                   </div>
				  		 <div class="col-md-6">
				  		<?php $equipo = $local['equipo'];?>
				  		 <?php foreach($local['alineados'] as $jugador){?>
				  		 
				    		         <div class="col-md-2">
				    		         	<div class="card mb-4 box-shadow" >
				    		         	<?php 
                                			$ruta = "inscritoequipo/".$equipo->id."/".$equipo->logotipo; 
                                			if($jugador->logotipo ){
                                			 $ruta = "inscrito/".$jugador->id."/".$jugador->logotipo;   
                                			}
                                			?>
										 <div class="img" style='background-image: url("<?=assets()?>images/competiciones/<?=$competicion->id?>/<?=$ruta?>")'>
											<span><?=$jugador->id?></span>
											
    									</div>
				    		         </div> 
				    		         <div><?=$jugador->nombre?></div>
				    		  	  </div>
				    		<?php }?>
				   		</div>
				   		<div class="col-md-6">
				   		<?php 
				   		$equipo = $visitante['equipo'];
				   		foreach($visitante['alineados'] as $jugador){?>
				    		         <div class="col-md-2">
				    		         	<div class="card mb-4 box-shadow" >
				    		         	<?php 
                                			$ruta = "inscritoequipo/".$equipo->id."/".$equipo->logotipo; 
                                			if($jugador->logotipo ){
                                			 $ruta = "inscrito/".$jugador->id."/".$jugador->logotipo;   
                                			}
                                			?>
										 <div class="img" style='background-image: url("<?=assets()?>images/competiciones/<?=$competicion->id?>/<?=$ruta?>")'>
											<span><?=$jugador->id?></span>
											
    									</div>
				    		         </div> 
				    		         <div><?=$jugador->nombre?></div>
				    		  	  </div>
				    		<?php }?>
				   		</div>
				   <?php }?>
				   		
				   </div>			

</div>
</div>



	
		