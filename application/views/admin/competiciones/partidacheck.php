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
				 <?php  
				 
                 $horaactual = new DateTime();                        
                 $min  = (new DateTime($partida->horainicio))->sub(new DateInterval("PT1H")); 
                 $max = (new DateTime($partida->horainicio))-> sub(new DateInterval("PT15M"));
                 $estado = 0;
                
                   if($min < $horaactual && $horaactual < $max ){
                       $estado = 1;
                 }else{
                     if($horaactual < $min){
                        $estado = 0;
                     }
                     if ($max <=  $horaactual){
                         $estado = 2;
                     }
                     
                 }?>
                <div class="col-md-12">
                    <h1>Comprobación de asistencia</h1>
                             <div class="col-xs4 col-xs-offset-4">
                                    <p>Jornada <?=$partida->jornada_id?></p>
                                     <p>Fecha asignada: <?=$partida->horainicio?></p>
                                     <p>Hora de check: desde <?=$min->format("H:i")?> hasta <?=$max->format("H:i")?></b></p>
                                     
                                    
                                      <p id="demo"></p>
                                    
                                   
							</div>
							
							 <script>
							$(window).load(function(){
								function intervalo(){
		                        	   // Get todays date and time
		                               var now = new Date().getTime();
		                              
		                               // Find the distance between now and the count down date
		                               var distance = countDownDate - now;
		                             
		                               // Time calculations for days, hours, minutes and seconds
		                               var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		                               var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		                               var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		                               var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		                             
		                               // Display the result in the element with id="demo"
		                               var str = "Se abrira en ";
		                               if(estado == 0){
		                            	   str = "Se abrira en ";
		                               }else if(estado == 1){
		                            	   str = "Se cerrara en ";
		                               }else{
		                            	   str = "Ya se ha cerrado. ";
		                               }
		                               document.getElementById("demo").innerHTML = str +" "+ days + "d " + hours + "h "
		                               + minutes + "m " + seconds + "s ";
		                               $("#demo").css("color",color);
		                               // If the count down is finished, write some text 
		                               if (distance < 0) {
		                                   
		                            	   clearInterval(x);
		                                   if(estado == 0){
		                                	   countDownDate = max;
		                                	   x = setInterval(intervalo, 1000);
		                                	   color = "red";
										      estado = 1; 
										      $("input[type='submit']").removeAttr("disabled");
										      
		                                   }else if(estado == 1){
		                                	   document.getElementById("demo").innerHTML = "EXPIRED";
											  estado = 2;
											  $("input[type='submit']").attr("disabled","disabled");
		                                   }else{
		                                	   estado = -1;
		                                       document.getElementById("demo").innerHTML = "EXPIRED";
		                                       $("input[type='submit']").attr("disabled","disabled");
		                                   }
		                                
		                               }
		                                 
		                           }
							
    							 var estado = <?=$estado?>;
    							 var color = "green";
    							 var min = new Date("<?=$min->format("Y-m-d H:i:s")?>").getTime();
    							 var max = new Date("<?=$max->format("Y-m-d H:i:s")?>").getTime();
                                // Set the date we're counting down to
                                 var countDownDate = min;
                                if(estado == 0){
                                	color = "green";
                                	countDownDate = min;
                                	$("input[type='submit']").attr("disabled","disabled");
                                }else if (estado == 1){
                                	color = "red";
                                	countDownDate = max;
                                	$("input[type='submit']").removeAttr("disabled");
                                }else{
                                	$("input[type='submit']").attr("disabled","disabled");
                                	color = "red";
                                	countDownDate = null;
                                }
                              
                                // Update the count down every 1 second
                                var x = setInterval(intervalo, 1000);

							});

							
							 
                            </script>
							
				   </div>	
				    <div class="row">    
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo col-offset-2">
                      		<figure class="borde-circular">
                       			<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$local['equipo']->id?>/<?=$local['equipo']->logotipo?>">
                            	
                           </figure>      
                         
                          <?php
                          if($local){
                            if($local['juega']->presentado){
                              echo "Check realizado";
                            }else{
                                $usercapitan = $local['equipo']->getCapitanUserId();
                                if($current_user->id ==$usercapitan){
                                    if (!$cerrado){?>
                                        <form action="<?=site_url("admin/competiciones/aceptarcheck")?>" method="post"
                                        enctype="multipart/form-data">
                                            <input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />
                                            <input type="hidden" name="id" value="<?=$partida->id?>" />
                                            <input type="hidden" name="equipo" value="<?=$local['equipo']->id?>"/>
                                			<input type="submit" disabled class="form-control" value="Asisto"/>
                                    </form>  
                                    <?php }else{
                                        echo "Falta checkear";
                                    }
                                  
                                 ?>
                                    
                                          
                                     
                                <?php }else{
                                    echo "Falta checkear";
                                }
                                                        
                            }
                        }
                        ?>              		     
                       </div>                                              
                       
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo ">VS</div>     
                       
                       <div class="col-sm-4 col-md-3 col-lg-2 equipo ">
                       <figure class="borde-circular">
                       		<img class="logo-equipo-small sombra-png-blanca" src="<?=assets()?>images/competiciones/<?=$competicion->id?>/inscritoequipo/<?=$visitante['equipo']->id?>/<?=$visitante['equipo']->logotipo?>">
                        </figure>
                               <?php 
                        if($visitante){
                            if($visitante['juega']->presentado){
                                echo "Check realizado";
                            }else{
                                $usercapitan = $visitante['equipo']->getCapitanUserId();
                                if($current_user->id ==$usercapitan){?>
                                    <?php if (!$cerrado){?>
                                         <form action="<?=site_url("admin/competiciones/aceptarcheck")?>" method="post"
                                            enctype="multipart/form-data">
                                                <input type="hidden" name="competicion_id" value="<?=$competicion->id?>" />
                                                <input type="hidden" name="id" value="<?=$partida->id?>" />
                                                <input type="hidden" name="equipo" value="<?=$visitante['equipo']->id?>"/>
                                    			<input type="submit" disabled class="form-control" value="Asisto"/>
                                        </form>     
                                    <?php }else{
                                        echo "Falta checkear";
                                    }?>
                                      
                                     
                                <?php }else{
                                    echo "Falta checkear";
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
