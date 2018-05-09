app.modules.gallery = {
   
   defaults : {
   		galleryId : ".gallery"
   },
   
   settings : null,
   
   init : function(options){
   	
   		var _this = this;
   	
   		_this.settings = $.extend({}, _this.defaults, options);
   		
   		app.debug("Init gallery ...");
   		
   	
   		$(_this.settings.galleryId).slick({
		  dots: true,
		  infinite: false,
		  speed: 500,
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  centerMode: true,
		  centerPadding: '60px',
		  variableWidth: true,
		  lazyLoad: 'ondemand',
		  accessibility : true,
		});
   	
   },
   
   destroy : function(){
   	
   		$(this.settings.galleryId).slick('unslick');
   	
   }

};
