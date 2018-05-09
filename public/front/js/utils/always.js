/**
 * 
 * Cosas que siempre hago y nunca me acuerdo!
 * 
 */



/**
 * Anular la itneracción de los links
 */

if(event.preventDefault) 
	event.preventDefault();
else 
	event.returnValue = false;
		
		
/**
 * Uso del TweenMax
 */

TweenMax.to($('html, body'),2,{scrollTop: $(link).offset().top,ease:Power2.easeInOut});

/**
 * Seleccionar un elemento cerca
 */

$(".banner-item").mouseenter($.proxy(this.hoverItem));

hoverItem : function(event){
 		
	if(event.preventDefault) 
        event.preventDefault();
    else 
        event.returnValue = false;
	
	var link = event.target;
	
	//cogemos el id del hover
	var itemId = $(link).closest(".banner-item").attr("id");
	
	Out.debug("Se ha seleccionado el item : "+itemId);
	
	//subimos el titulo
	TweenMax.to($("#"+itemId+" .banner-item-title"),1,{
		height: 70,
		ease:Power2.easeInOut
		});
	
	//llevamos la parte de arriba a esta posición
}

/**
 * Split
 */
var divIdArray = contid.split("_");
var id = divIdArray[1];

