app.modules.galleryItems = {
   
   defaults : {
   		galleryId : ".gallery",
   		dots : true,
   		slidesToShow : 4,
   },
   
   settings : null,
   
   init : function(options){
   	
   		var _this = this;
   	
   		_this.settings = $.extend({}, _this.defaults, options);
   	
   		app.debug("Gallery Items :: id : "+_this.settings.galleryId);
   	
   		$(_this.settings.galleryId).slick({
		  dots: _this.settings.dots,
		  infinite: false,
		  speed: 500,
		  slidesToShow: _this.settings.slidesToShow,
		  slidesToScroll: _this.settings.slidesToShow,
		  centerPadding: '60px',
		  variableWidth: true,
		  lazyLoad: 'ondemand',
		  accessibility : true,
		});
		
		 $(".open-link").click(function(event){
		 	var link = event.target;
		 	
		 	var url = $(link).closest(".open-link").data("href");
		 	
		 	window.open(url,'_blank');
			
		 });
   	
   }

};
