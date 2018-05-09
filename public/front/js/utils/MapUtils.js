define([
  'jquery',
  'underscore', 
  'backbone',
  'utils/Out'
  ], function($, _, Backbone,Out){
  	
  var MapUtils = Backbone.View.extend({

    initialize: function() {
      
    },

  },{

	//las definimos al inicio o a cada resize
	MAP_HEIGHT:600,
	MAP_WIDTH:600,

	resize : function(){
		
	},
	
	centerWithModal : function(map,latlng,zoom){
	
		Out.debug("centerWithModal :: "+latlng+" zoom : "+zoom);	
		/*
		map.on('moveend',function(){
			//map.off('moveend');
			map.panBy(new L.Point(300,0));	
		})
		*/
		
		var left = (Out.MODAL_WIDTH - 60) / 2;
		
		var currentPoint = map.project(latlng,zoom);
		var panedLatLng = map.unproject(new L.Point(currentPoint.x + left,currentPoint.y ),zoom);
			
		map.setView(panedLatLng,zoom);
		map.invalidateSize();
		
	},
	
	centerWithoutModal : function(map,latlng,zoom){
		
		map.setView(latlng,zoom);
		
	},
	
  });
  return MapUtils;
});
