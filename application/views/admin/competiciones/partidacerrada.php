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
                                    <p>Jornada <?=$partida->jornada_id?> -
                                        del dia <?=date('d',strtotime($jornada->fechainicio))?> al
                                        <?=date('d',strtotime($jornada->fechafin))?></p>
                                        
                                        <p>Hora de inicio: <?=$partida->horainicio?></p>
										<p>id Partida <?=$partida->id?></p>
							</div>
				   </div>	
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
				   </div>				
               
                     
                  
                    
                       
             

		<div class="row">
                <div class="col-md-offset-3"> 
              
                 
            
					<?php 
						$gana=array("Empate","Local","Visitante");
					?>
					<div class="row">	
						
						  <div>
						 		<p>Punto Caliente</p> 
								<p>Mapa: <b><?=$partida->mapa1?></b></p>
								<p>Gana: <?=$gana[$partida->mapa1_resultado]?></p>
						   </div>
						
					</div>
					<div class="row">	
						
						  <div>
						 		<p>Buscar y Destruir</p> 
								<p>Mapa: <b><?=$partida->mapa2?></b></p>
								<p>Gana: <?=$gana[$partida->mapa2_resultado]?></p>
						   </div>
						
					</div>
					<div class="row">	
						
						  <div>
						 		<p>Control</p> 
								<p>Mapa: <b><?=$partida->mapa3?></b></p>
								<p>Gana: <?=$gana[$partida->mapa3_resultado]?></p>
						   </div>
						
					</div>
					
					
                  
                    </div>
                </div>
</div>
</div>



	
		