/**
*	Clase base para poder hacer Clases orientadas a objetos. Contiene
*	toda la abstracción necesaria para poder construir la clase, añadir los 
*	método mediante el extend y mediante el include. 
*	
*	- En el caso del extend es como hacer metodos direcatmente al objeto : 
*		Objeto.metodo
*	  Con lo cual no tienes aceso al this dentro del metodo, son método estaticos.
*	  
*	- En el caso del include es como hacer método utilizando el prototyp : 
*		Objeto.prototype.metodo
*	  En este caso si tienes acceso al this.
*	
*	- Tambien soporta la extensión de clases definiendo la clase madre en la construcción.
*	Por ejemplo : 
*		
*		var Animal = new Class;
*
*		Animal.include({
*			breath: function(){
*				console.log('breath');
*			}
*		});
*		
*		var Cat = new Class(Animal)
*	
*	Tener en cuenta que solo hace herencia de los metodos de instancia (los includes) que
*	utilizan el prototype.	
*	
*	- Tambien hay el uso del proxy para poder mantener el scope especifico del objeto
*	y así poder mantener el contexto. Para utilizarlo siemplemente en vez de llamar directamente
*	la función pasarle el proxy :
*		
*		this.element = jQuery(element);
*		
*		this.element.click(this.proxy(this.click));
*		
*		//mantiene el scope dentro de la función click de jQuery
*
*/
var Class = function(parent){
  
	var klass = function(){
		this.init.apply(this,arguments);
	};
	
	//change klass' prototype en caso de que tenga parent
	if (parent){
		var subclass = function() {};
		subclass.prototype = parent.prototype;
		klass.prototype = new subclass;
	};

	klass.prototype.init = function(){};
	
	//shortcuts
	klass.fn = klass.prototype;
	klass.fn.parent = klass;
	klass._super = klass.__proto__;
	
	//adding proxy function
	klass.proxy = function(func){
		var self = this;
		return (function(){
			return func.apply(self,arguments);
		});
	};
	
	//la añadimos como instancia también
	klass.fn.proxy = klass.proxy;
	
	klass.extend = function(obj){
		var extended = obj.extended;
		for(var i in obj){
			klass[i] = obj[i];
		}
		if (extended) extended(klass);
	};
  
  	klass.include = function(obj){
		var included = obj.included;
		for(var i in obj){
			klass.fn[i] = obj[i];
		}
		if (included) included(klass);
	};
	
	return klass;
};

