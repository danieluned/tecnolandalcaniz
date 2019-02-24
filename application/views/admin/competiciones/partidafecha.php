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

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
				
                <div class="col-md-12">
                    <h1>Seleccionar Fecha</h1>
                             <div class="col-xs4 col-xs-offset-4">
                                    <p>Jornada <?=$partida->jornada_id?> -
                                        del dia <?=date('d',strtotime($jornada->fechainicio))?> al
                                        <?=date('d',strtotime($jornada->fechafin))?></p>
                                     <p><b><?=$partida->horainicio?></b></p>   
                                    <p>id Partida <?=$partida->id?></p>
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
                            if($local['juega']->aceptafecha){
                                echo "<p>Aceptada</p>";
                            }else{
                                $usercapitan = $local['equipo']->getCapitanUserId();
                                if($current_user->id ==$usercapitan){
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
                            if($visitante['juega']->aceptafecha){
                                echo "<p>Aceptada</p>";
                            }else{
                                $usercapitan = $visitante['equipo']->getCapitanUserId();
                                if($current_user->id ==$usercapitan){
                                    $id_equipo = $local['equipo']->id;
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

		<div class="row">
                <div class="col">                					 
                        <?php 
                        if($local){
                            if($local['juega']->aceptafecha){
                              
                            }else{
                                $usercapitan = $local['equipo']->getCapitanUserId();
                                if($current_user->id ==$usercapitan){?>
                                    
                                     <form action="<?=site_url("admin/competiciones/aceptarfecha")?>" method="post"
                                        enctype="multipart/form-data">
                                            <input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />
                                            <input type="hidden" name="id" value="<?=$partida->id?>" />
                                            <input type="hidden" name="equipo" value="<?=$local['equipo']->id?>"/>
                                			<input type="submit" class="form-control" value="Aceptar"/>
                                    </form>       
                                     
                                     <form action="<?=site_url("admin/competiciones/proponerfecha")?>" method="post"
                                        enctype="multipart/form-data">
                                            <input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />
                                            <input type="hidden" name="id" value="<?=$partida->id?>" />
                                            <input type="hidden" name="equipo" value="<?=$local['equipo']->id?>"/>
                                            <input type="datetime-local" name="fecha"  /> 
                                			<input type="submit"  class="form-control" value="Proponer fecha"/>
                                    </form>  
                                <?php }else{
                                   
                                }
                                                        
                            }
                        }
                        ?>
                       </div>
                          <div class="col">
                  
                    
                        <?php 
                        if($visitante){
                            if($visitante['juega']->aceptafecha){
                               
                            }else{
                                $usercapitan = $visitante['equipo']->getCapitanUserId();
                                if($current_user->id ==$usercapitan){?>
                                    
                                     <form action="<?=site_url("admin/competiciones/aceptarfecha")?>" method="post"
                                        enctype="multipart/form-data">
                                            <input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />
                                            <input type="hidden" name="id" value="<?=$partida->id?>" />
                                            <input type="hidden" name="equipo" value="<?=$visitante['equipo']->id?>"/>
                                			<input type="submit" value="Aceptar"/>
                                    </form>       
                                     
                                     <form action="<?=site_url("admin/competiciones/proponerfecha")?>" method="post"
                                        enctype="multipart/form-data">
                                            <input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />
                                            <input type="hidden" name="id" value="<?=$partida->id?>" />
                                            <input type="hidden" name="equipo" value="<?=$visitante['equipo']->id?>"/>
                                            <input type="datetime-local" name="fecha" /> 
                                			<input type="submit" value="Proponer fecha"/>
                                    </form>  
                                <?php }else{
                                  
                                }
                                                        
                            }
                        }
                        ?>


                    </div>
                </div>
</div>
            </div>
        </div>
    </div>
