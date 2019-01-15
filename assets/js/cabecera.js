
$( document ).ready(function() {
	/*
	$("#brand_name").attrchange({
	    trackValues: true, // Default to false, if set to true the event object is updated with old and new value.
	    callback: function (event) { 
	        //event               - event object
	        //event.attributeName - Name of the attribute modified
	        //event.oldValue      - Previous value of the modified attribute
	        //event.newValue      - New value of the modified attribute
	        //Triggered when the selected elements attribute is added/updated/removed
	    	alert(event);
	    	$("#brand_name_logo").attr("width",$(this).attr("font-size"));
			$("#brand_name_logo").attr("height",$(this).attr("font-size"));
	    }        
	});
	
	$("#brand_name").change(function(event){
		alert(event);
	});
	*/
	$('img[alt="www.000webhost.com"]').hide();
	

	
	
	/* Mostrar un texto escribiendo */
	var txt = 'Bienvenido al panel admin.';
	var i = 0;
	var speed = 150;
	
	function escribir() {
	  if (i < txt.length) {
	    document.getElementById("saludar").innerHTML += txt.charAt(i);
	     i++;
	     setTimeout(escribir, speed);
	  }
	 
	 
	}
	if ($("#saludar").size()>0){
		escribir();
	}
	
	
	$(".borrar").on("click", function(e) {
		var r = confirm("¿Borrar!?");
		if(!r){
			 e.preventDefault();	
		}
	});
	

	  $('textarea[data-limit-rows=true]')
	    .on('keypress', function (event) {
	        var textarea = $(this),
	            text = textarea.val(),
	            numberOfLines = (text.match(/\n/g) || []).length + 1,
	            maxRows = parseInt(textarea.attr('rows'));

	        if (event.which === 13 && numberOfLines === maxRows ) {
	          return false;
	        }
	    });
	  
	 
});
