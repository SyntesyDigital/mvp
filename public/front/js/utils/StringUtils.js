/**
 *	Clase para tener funciones para gestionar strings y formateos no estandars
 */
 
 var StringUtils = new Class();
 
 /**
 * Función que pasa de salto de linea en br
 */
StringUtils.formatToBR = function(original){
	return original.replace(/\n/g,"<br />");
}

/**
 * Caanvia el codigo utf-8 de comilla a comilla
 */
StringUtils.formatQuotes = function(original){
	text = text.replace(/\u0092/g, "'");
	return text;
}
