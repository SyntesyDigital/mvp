
 /**
  * Out
  * 
  * Clase para poder gestionar los logs todos a la vez
  */ 

 var Out = new Class;

 Out._enabled = true;

 Out.extend({
	 debug : function(text){
	 	
	 	if(Out._enabled && window.console){
	 		console.log(text);
	 	}
	 },
	 
	 info : function(text){
	 	
	 	if(Out._enabled && window.console){
	 		console.info(text);
	 	}
	 },
	 
	 error : function(text){
	 	
	 	if(Out._enabled && window.console){
	 		console.error(text);
	 	}
	 },
	 
	 enable : function(){
	 	Out._enabled = true;
	 },
	 
	 disable : function(){
	 	Out._enabled = false;
	 }
});