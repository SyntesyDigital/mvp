var app = {
   
   dev : true,
   
   isMobile : false,
   isTabled : false,
   isIe : false,
   
   debug : function(message){
   
   		//only in dev	
   		if(app.dev && window.console){
	 		console.log(message);
	 	}
   },
   
   error : function(message){
   	
   		if(window.console){
	 		console.error(message);
	 	}
   },
   
   /********** globals *************/
   
   //ITEM_WIDTH : 372,
  	
   /********** modules *************/
  
   modules : {},
   
   init : function(){
   	
   		if (navigator.userAgent.match(/Tablet|iPad/i)){

		    // do tablet stuff
		    app.isTabled = true;

		} else if(navigator.userAgent.match(/IEMobile|Windows Phone|Lumia|Android|webOS|iPhone|iPod|Blackberry|PlayBook|BB10|Mobile Safari|Opera Mini|\bCrMo\/|Opera Mobi/i) ) {
		    // do mobile stuff
		    app.isMobile = true;

			//Code to force a widnwo width
			
		    //var viewport = document.querySelector("meta[name=viewport]");
			//viewport.setAttribute('content', 'width=600');

		} else {
		    // do desktop stuff if necessary
		    
		}

	    var ua = window.navigator.userAgent;
	    var msie = ua.indexOf("MSIE ");

	    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))  // If Internet Explorer, return version number
	    {
	    	//is explorer
	        app.isIe = true;
	    }
   	   	
  },
  
  resize : function(){
  	
  		//general resize if necessary
  	
  		/*
   		if(!app.isMobile && $(window).width() < 480){
   			viewport = document.querySelector("meta[name=viewport]");
			viewport.setAttribute('content', 'width=480');
   		}
   		else {
   			viewport = document.querySelector("meta[name=viewport]");
			viewport.setAttribute('content', 'width=device-width, initial-scale=1.0');
   		}
   		*/
   		
  },

};



