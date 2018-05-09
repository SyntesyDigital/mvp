/**
 *	Construcción del DataPicker. Debera inicializar el dataPicker y controlar
 *	los cambios de una fecha a otra. Una vez se recoja el evento de cambio de fecha
 *	se deberá notificar al padre para que actualize el contenido
 *	
 *	datePickerId : Id del input que tendra el datePicker
 *	minDate : fecha minima en formato : aaaa-mm-dd
 *	maxDate : fecha maxima
 */
 
 var DateUtils = new Class();
 
 DateUtils.daysCat = ["Dilluns","Dimarts","Dimecres","Dijous","Divendres","Dissabte","Diumenge"];
 DateUtils.monthsCat = ["Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Setembre","Octubre","Novembre","Desembre"];
 
DateUtils.formatTimestampToMySQL = function(timestamp){
	
	var date = new Date(timestamp*1000);
	
	var day = date.getDate();
	var month = date.getMonth()+1;
	var year = date.getFullYear();
		
	var day = day < 10 ? "0"+day : day;
	var month = month < 10 ? '0'+month : month;
	
	return year + "-"+month + "-"+day;
		
}

/**
 * Método que le passas un objeto Date y te devuelve el dia en catalan
 */
DateUtils.getDayCat = function(date){
	return DateUtils.daysCat[date.getDay()-1];
}

DateUtils.getMonthCat = function(date){
	return DateUtils.monthsCat[date.getMonth()];
}
