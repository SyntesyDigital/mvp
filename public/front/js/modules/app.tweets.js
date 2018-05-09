app.modules.tweets = {
   
   defaults : {
   		
   },
   
   settings : null,
   
   init : function(options){
   	
   		var _this = app.modules.tweets;
   		
   		_this.settings = $.extend({}, _this.defaults, options);
   		
   		
   }
};
