/**
*	Clase que nos permite registrar un evento sin utilizar el DOM.
*	Pare ello solo es necesario que la clase extenda de PubSub
*/
var PubSub = {
	subscribe : function (ev, callback){
		
		//creamos el objeto donde guardar los callbacks
		var calls = this._callbacks || (this._callbacks = {});
		
		//creamos un array con las claves en caso de que no exista
		(this._callbacks[ev] || (this._callbacks[ev] = [])).push(callback);
		
		return this;
	},
	
	publish : function () {
		
		//pasamos los argumentos a un array real
		var args = Array.prototype.slice.call(arguments, 0);
		
		//extraemos el primer elemento
		var ev = args.shift();
		
		var list, calls, i, l;
		if(!(calls = this._callbacks)) return this;
		if(!(list = this._callbacks[ev])) return this;
		
		//invocamos los callbacks
		for (i = 0,l = list.length;i < l;i++)
			list[i].apply(this, args);
		
		return this;
	}
}