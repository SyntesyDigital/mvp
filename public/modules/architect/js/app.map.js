app.map = {


	map : null,
	marker : null,
	
	//TODO only for WWF, remove for others
	accessToken : 'pk.eyJ1Ijoid3dmY2xpbWF0ZWNyb3dkIiwiYSI6ImM4NjQ4YzIwMTM2MjNjYjYxNjRjNjA3MzQ5ZGIyMmIzIn0.rxFzrnKLfpXFIGiGW4VYQA',
	
	defaults : {
   		mapId : "leaflets"
   },
   
   settings : null,
   
   
   init : function(options){
   	
   		var _this = app.map;
   		
   		_this.settings = $.extend({}, _this.defaults, options);
   		
   		var latlng = [39.41922, -0.19775];
   		
   		if($(_this.settings.fields.root).find("#lat").val() != "" && 
   			$(_this.settings.fields.root).find("#lng").val() != ""){
   				
   			latlng = [
   				$(_this.settings.fields.root).find("#lat").val(),
   				$(_this.settings.fields.root).find("#lng").val()
   			];
   		}
   	
   		_this.map = L.map(_this.settings.mapId).setView(latlng, 14);
   		
   		_this.sateliteLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
		    //minZoom: 6,
		    //maxZoom: 9,
		    subdomains:['mt0','mt1','mt2','mt3']
		});
		
		var redMarker = L.AwesomeMarkers.icon({
					    icon: 'circle',
					    prefix : 'fa',
					    markerColor: 'red'
					  });
		
		_this.marker = L.marker(latlng, {icon: redMarker,draggable:'true'}).addTo(this.map); 
		
		
		
		_this.marker.on('dragend', function(){
				var latlng = _this.marker.getLatLng();
				
				app.debug(latlng);
				
				app.debug("id : "+_this.settings.fields.root);
				
				
				$(_this.settings.fields.root).find("#lat").val(latlng.lat);
				$(_this.settings.fields.root).find("#lng").val(latlng.lng);
				
				_this.updateLocation(latlng.lat,latlng.lng);
			});	
		
		$(_this.settings.fields.root).find("#search").change(_this.search);
		$(_this.settings.fields.root).find("#lat").change(_this.updateMarker);
		$(_this.settings.fields.root).find("#lng").change(_this.updateMarker);
		
		
		
		_this.googleLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
		});
		
		
		_this.map.addLayer(_this.googleLayer);
		
		_this.map.scrollWheelZoom.disable();
   		_this.map.invalidateSize();
   		
   		
		_this.map.on('click',function(e){
        	app.debug("clicke on position "+e.latlng);
        });
        
        
        $(document).on("mainImageSelected", function(event,obj){
        	
        	app.debug("mainImageSelected :: ");
            app.debug(obj);
        	
        	if(obj.hasOwnProperty('lat') && obj.hasOwnProperty('lng') && !isNaN(obj.lat) && obj.lat != null){
	
            	$(_this.settings.fields.root).find("#lat").val(obj.lat);
				$(_this.settings.fields.root).find("#lng").val(obj.lng);
				
				_this.updateMarker();
				
            }
            else {
            	alert("This image has no geo position.");
            }
        	
        });
        
        $('.image-latlng').on("click", function(e){
	        e.preventDefault();
	
	        var el = $(this);
	
	        app.mediaSelector.init({
	            'onSubmit' : function(obj) {
	                
	                app.debug("app.image - date : ");
	                app.debug(obj);
	
					if(obj.hasOwnProperty('lat') && obj.hasOwnProperty('lng') && !isNaN(obj.lat) && obj.lat != null){
	
	                	$(_this.settings.fields.root).find("#lat").val(obj.lat);
						$(_this.settings.fields.root).find("#lng").val(obj.lng);
						
						_this.updateMarker();
						
	                }
	                else {
	                	alert("This image has no geo position.");
	                }
	                
	                app.mediaSelector.close();
	            }
	        });
	    });

        
   },
   
   search : function(){
   	
   		var _this = app.map;
   	
   		var query = $(_this.settings.fields.root).find("#search").val();
						
		//
						
						
		$.getJSON( "https://maps.googleapis.com/maps/api/geocode/json?address="+query,function(data){
			
			app.debug(data);
				
			if(data.results.length > 0){
				
				var latlng = [$.parseJSON(data.results[0].geometry.location.lat),$.parseJSON(data.results[0].geometry.location.lng)];
				
				$(_this.settings.fields.root).find("#lat").val(data.results[0].geometry.location.lat);
				$(_this.settings.fields.root).find("#lng").val(data.results[0].geometry.location.lng);
				
				_this.map.panTo(latlng);
				_this.marker.setLatLng(latlng);
				
				_this.updateLocation(latlng[0],latlng[1]);
				
			}
			
		});
   	
   	
   },
   
   getCountryCode : function(res){
		
		var context = res.features[0].context;
		
		for(var i=0;i<context.length;i++){
			if(context[i].id.indexOf("country") != -1){
				
				app.debug(context[i].short_code);
				
				return context[i].short_code; 
			}
		}
		
		return "";
	},
   
   updateLocation : function(latitude,longitude){
   	
   		var _this = app.map;
   	
   		$.getJSON(
			'https://api.mapbox.com/v4/geocode/mapbox.places/'+longitude+','+latitude+'.json?access_token=' + _this.accessToken,
			function(data){
				app.debug("Result of mapbox : ");
				app.debug(data);		
				app.debug(data.features[0].place_name);
				
				var countryCode = _this.getCountryCode(data);
				app.debug("country : "+countryCode);
				
				$("#locationField").val(data.features[0].place_name);
				$("#countryCode").val(countryCode);
			}
		);
   	
   },
   
   updateMarker : function(){
   	
   		var _this = app.map;
   		
   		var latlng = [
   				$(_this.settings.fields.root).find("#lat").val(),
   				$(_this.settings.fields.root).find("#lng").val()
   			];
		
		_this.map.panTo(latlng);
		_this.marker.setLatLng(latlng);
		
		_this.updateLocation(latlng[0],latlng[1]);
   	
   },
}
