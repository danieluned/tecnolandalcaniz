
	$(window).ready(function(){
	$(".btPlegar").click(function(){
             var caja = $(this).attr("apartado");
             mostrarOcultarCaja(caja);
    });
})
     
    var mostrarOcultarCaja = function(caja){
           if($("#"+caja).hasClass('desplegado')) {
                    $("#"+caja).removeClass('desplegado');
                   
                    
                }else {
                	$(".plegable").removeClass('desplegado');
                	/*$("#lol").removeClass('desplegado');
                    $("#st2").removeClass('desplegado');
                    $("#hstn").removeClass('desplegado');
                    $("#cod").removeClass('desplegado');
                    $("#smb").removeClass('desplegado');
                    $("#ffps4").removeClass('desplegado');
                    $("#cosply").removeClass('desplegado');
                    $("#hdd").removeClass('desplegado');
                    $("#fkt").removeClass('desplegado');*/
                    
                    $("#"+caja).addClass('desplegado');
                }
    }
	/*
	$(window).ready(function(){
	$(".torneo").click(function(){
		//elemento = this.attr('value');
		elemnto = this.value();
	      if($(elemento).hasClass('desplegado')){
	         $(elemento).removeClass('desplegado');
	      }else{
	         $(elemento).addClass('desplegado');
	      }
	})

	$(window).ready(function(){
	$('.torneo').click(function(){
		//elemento = this.attr('value');
	      if($(elemento).hasClass('desplegado')){
	         $(elemento).removeClass('desplegado');
	      }else{
	         $(elemento).addClass('desplegado');
	      }
	   })
	})*/