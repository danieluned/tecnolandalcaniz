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
                    <h1>Hoja de resultados</h1>
                             <div class="col-xs4 col-xs-offset-4">
                                    <p>Jornada <?=$partida->jornada_id?></p>
                                        
                                        <p>Hora: <?=$partida->horainicio?></p>
							</div>
				   </div>	
				    <div class="row">    
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo col-offset-2">
                      		<figure class="borde-circular">
                       			<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$local['equipo']->id?>/<?=$local['equipo']->logotipo?>">
                            	 <p>LOCAL: <?=$local['equipo']->nombre?></p>
                           </figure>
                       		     <?php 
                      
                        if($local){
                            if($local['juega']->conforme){
                                echo "<p>Aceptada</p>";
                            }else{
                                $usercapitan = $local['equipo']->getCapitanUserId();
                                if($current_user->id ==$usercapitan){
                                    
                                    $id_equipo = $local['equipo']->id;
                                   echo "<p>¿Aceptas o propones?</p>";   
                                 }else{
                                    echo "<p>Aun no se ha aceptado</p>";   
                                }
                                                        
                            }
                        }else{
                            echo "-NO hay equipo--"; 
                        }
                        ?>
                       </div>                                              
                       
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo ">VS</div>     
                       
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo ">
                       <figure class="borde-circular">
                       		<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$visitante['equipo']->id?>/<?=$visitante['equipo']->logotipo?>">
                               <p>VISITANTE: <?=$visitante['equipo']->nombre?></p>
                               </figure>
                                <?php 
                        if($visitante){
                            if($visitante['juega']->conforme){
                                echo "<p>Aceptada</p>";
                            }else{
                                $usercapitan = $visitante['equipo']->getCapitanUserId();
                                if($current_user->id ==$usercapitan){
                                    $id_equipo = $visitante['equipo']->id;
                                    echo "<p>¿Aceptas o propones?</p>";   
                                }else{
                                    echo "<p>Aun no se ha aceptado</p>";   
                                }
                                                        
                            }
                        }else{
                            echo "-No hay equipo--"; 
                        }
                        ?>
                       </div>             
                     	
				
                   </div>
				   </div>	
				   
				   <?php //Si aun no hay nadie que haya propuesto entonces no se puede aceptar
				   if($local['juega']->conforme || $visitante['juega']->conforme){?>    
					<div class="row">
						<p>Punto Caliente: <?=$partida->mapa1?>  - 
						<?php
						// El resultado codificado es 0 empate , 1 gana local, 2 gana visitante
						if($partida->mapa1_resultado == 1 ){
						    echo $local['equipo']->nombre;
						}else if($partida->mapa1_resultado == 2){
						    echo $visitante['equipo']->nombre; 
						   }else{
						   
						       echo "Empate";
						   }?></p> 
					</div>
					
					
				
						 
						
					<div class="row">
						<p>Buscar y Destruir: <?=$partida->mapa2?>  - 
						<?php
						// El resultado codificado es 0 empate , 1 gana local, 2 gana visitante
						if($partida->mapa2_resultado == 1 ){
						    echo $local['equipo']->nombre;
						}else if($partida->mapa2_resultado == 2){
						    echo $visitante['equipo']->nombre; 
						   }else{
						   
						       echo "Empate";
						   }?></p> 
					</div>
					
					<div class="row">
						<p>Control: <?=$partida->mapa3?>  - 
						<?php
						// El resultado codificado es 0 empate , 1 gana local, 2 gana visitante
						if($partida->mapa3_resultado == 1 ){
						    echo $local['equipo']->nombre;
						}else if($partida->mapa3_resultado == 2){
						    echo $visitante['equipo']->nombre; 
						   }else{
						   
						       echo "Empate";
						   }?></p> 
					</div>
				<?php }?>
				<?php //Si aun no hay nadie que haya propuesto entonces no se puede aceptar
				   if($local['juega']->conforme || $visitante['juega']->conforme){?>
				   	<?php if($id_equipo){?>
				       <form
    					action="<?=site_url("admin/competiciones/aceptarresultado")?>"
    					method="post" enctype="multipart/form-data">
    					<input type="hidden" name="competicion_id"
    						value="<?=$competicion->id?>" /> 
    				    <input type="hidden"
    						name="id" value="<?=$partida->id?>" />
    				    <input type="hidden" name="equipo" value="<?=$visitante['equipo']->id?>"/>
    						
    						<div class="row">
    						<label for="prueba2">Documento de prueba y aceptar el resultado actual</label>
    						 <input id="prueba2" class="form-control" name="prueba" type="file" />							
    					</div>
    					<div class="row">
    				
                        		<input
        						type="hidden" name="equipo" value="<?=$id_equipo?>" />
                                <input type="submit" class="form-control"
        							name="guardar_partida" value="Aceptar cambios" />
                          
                     
    						
    					</div>			
                     
                        </form>
    					<hr/>
    					    <?php }?>
				   <?php }
				?>
				
				
							
               
                     
                  
                    
                       
             

		<div class="row">
                <div class="col-md-offset-3"> 
               <?php 
               if($id_equipo){?>
                   <form
					action="<?=site_url("admin/competiciones/proponerresultado")?>"
					method="post" enctype="multipart/form-data">
					<input type="hidden" name="competicion_id"
						value="<?=$competicion->id?>" /> 
				    <input type="hidden"
						name="id" value="<?=$partida->id?>" />
				     <input
						type="hidden" name="equipo" value="<?=$id_equipo?>" />
					<h2>Proponer resultado</h2>
				
					<div class="row">
						<p>Punto Caliente</p> 
					</div>
					<div class="row">	
						<?php
						$mapasPuntoCaliente = $this->mapa->callofdutyPuntoCaliente();
						 foreach ($mapasPuntoCaliente as $mapa){
						 ?>
						  <div>
								<label class="form-control" for="mapa1_<?=$mapa?>"><?=$mapa?>
								</label>
								<input class="form-control" type="radio" id="mapa1_<?=$mapa?>" name="mapa1" value="<?=$mapa?>" <?=$partida->mapa1 == $mapa?'checked':''?>>
								
						   </div>
						<?php  
						 }?>
					</div>
					<div class="row">
						 
						 <p>¿Quien gano?</p>
					</div>
					<div class="row">
						<div>
						 <label class="form-control" for="mapa1_resultado_local"><?=$local['equipo']->nombre?>
						  </label>
						 <input class="form-control" id="mapa1_resultado_local" type="radio" name="mapa1_resultado" value="1" <?=$partida->mapa1_resultado==1?'checked':''?>>
						</div>
						<div>
						<label class="form-control" for="mapa1_resultado_empate">Empate
						  </label>
						 <input class="form-control" id="mapa1_resultado_empate" type="radio" name="mapa1_resultado" value="0" <?=$partida->mapa1_resultado==0?'checked':''?>>
						 </div>
						 <div>
						 <label class="form-control" for="mapa1_resultado_visitante"><?=$visitante['equipo']->nombre?>
						  </label>
						 <input class="form-control" id="mapa1_resultado_visitante" type="radio" name="mapa1_resultado" value="2" <?=$partida->mapa1_resultado==2?'checked':''?>>
						 </div>
					</div>
					<hr/>
					<div class="row">
						<p>Buscar y Destruir</p> 
					</div>
					<div class="row">	
						<?php
						$mapasbyd = $this->mapa->callofdutyByD();
						foreach ($mapasbyd as $mapa){
						 ?>
						  <div>
								<label class="form-control" for="mapa2_<?=$mapa?>"><?=$mapa?>
								</label>
								<input class="form-control" type="radio" id="mapa2_<?=$mapa?>" name="mapa2" value="<?=$mapa?>" <?=$partida->mapa2 == $mapa?'checked':''?>>
								
						   </div>
						<?php  
						 }?>
					</div>
					<div class="row">
						 
						 <p>¿Quien gano?</p>
					</div>
					<div class="row">
					<div>
						 <label class="form-control" for="mapa2_resultado_local"><?=$local['equipo']->nombre?>
						  </label>
						 <input class="form-control" id="mapa2_resultado_local" type="radio" name="mapa2_resultado" value="1" <?=$partida->mapa2_resultado==1?'checked':''?>>
					</div>
					<div>
						<label class="form-control" for="mapa2_resultado_empate">Empate
						  </label>
						 <input class="form-control" id="mapa2_resultado_empate" type="radio" name="mapa2_resultado" value="0" <?=$partida->mapa2_resultado==0?'checked':''?>>
						 </div><div>
						 <label class="form-control" for="mapa2_resultado_visitante"><?=$visitante['equipo']->nombre?>
						  </label>
						 <input class="form-control" id="mapa2_resultado_visitante" type="radio" name="mapa2_resultado" value="2" <?=$partida->mapa2_resultado==2?'checked':''?>>
						 </div>
					</div>
					<hr/>
					<div class="row">
						<p>Control</p> 
					</div>
					<div class="row">	
						<?php
						$mapasControl = $this->mapa->callofdutyControl();
						foreach ($mapasControl as $mapa){
						 ?>
						  <div>
								<label class="form-control" for="mapa3_<?=$mapa?>"><?=$mapa?>
								</label>
								<input class="form-control" type="radio" id="mapa3_<?=$mapa?>" name="mapa3" value="<?=$mapa?>" <?=$partida->mapa3 == $mapa?'checked':''?>>
								
						   </div>
						<?php  
						 }?>
					</div>
					<div class="row">
						 
						 <p>¿Quien gano?</p>
					</div>
					<div class="row">
					<div>
						 <label class="form-control" for="mapa3_resultado_local"><?=$local['equipo']->nombre?>
						  </label>
						 <input class="form-control" id="mapa3_resultado_local" type="radio" name="mapa3_resultado" value="1" <?=$partida->mapa3_resultado==1?'checked':''?>>
						</div><div>
						<label class="form-control" for="mapa3_resultado_empate">Empate
						  </label>
						 <input class="form-control" id="mapa3_resultado_empate" type="radio" name="mapa3_resultado" value="0" <?=$partida->mapa3_resultado==0?'checked':''?>>
						 </div><div>
						 <label class="form-control" for="mapa3_resultado_visitante"><?=$visitante['equipo']->nombre?>
						  </label>
						 <input class="form-control" id="mapa3_resultado_visitante" type="radio" name="mapa3_resultado" value="2" <?=$partida->mapa3_resultado==2?'checked':''?>>
						 </div>
					</div>
					<hr/>
					
					<div class="row">
						<label for="prueba1">Documento de prueba y proponer cambios</label>
						 <input id="prueba1" class="form-control" name="prueba" type="file" />							
					</div>
					
					<div class="row">
					<?php if(!$id_equipo){?>
                    		
                     <h2>Debes ser capitan para rellenar el formulario</h2>
                     <?php }else{?>
                         <input type="submit" class="form-control"
							name="guardar_partida" value="Proponer resultado" />
                   <?php  }?>
						
					</div>
				</form>
               <?php }
                 ?>
                 
            
                
              
				
					
			
				  
				      
			
				
				
				
                  
                    </div>
                </div>
</div>
</div>



	
		