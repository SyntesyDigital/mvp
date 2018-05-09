app.modules.mapItems = {
   
   map : null,
   contents : null,
   templates   : [],
   
   defaults : {
   		mapId : "leaflet-map",
   },
   
   settings : null,
   
   init : function(options){
   	
   		var _this = app.modules.mapItems;
   		
   		_this.settings = $.extend({}, _this.defaults, options);
   	
   		_this.map = L.map('leaflet-map').setView([39.41922, -0.19775], 6);
   		
   		_this.sateliteLayer = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
		    minZoom: 6,
		    maxZoom: 9,
		    subdomains:['mt0','mt1','mt2','mt3']
		});
		
		/*
		_this.googleLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
		    minZoom: 3,
			maxZoom: 7
		});
		*/
		
		_this.map.addLayer(_this.sateliteLayer);
		
		_this.map.scrollWheelZoom.disable();
   		_this.map.invalidateSize();
   		
		_this.map.on('click',function(e){
        	app.debug("clicke on position "+e.latlng);
        });
        
        //setup lines
        _this.currentItem = 0;
        
        _this.modalLeft = $("#item-modal").offset().left;
        
        _this.canvas = document.getElementById('map-canvas');
		_this.context = _this.canvas.getContext('2d');
		_this.canvas.width = $("#line-overlay").width();
		_this.canvas.height = $("#line-overlay").height();
		
		_this.TIME_ITERATION = 1; // seconds
		_this.FRAMES_PER_SECOND = 15;
		_this.currentStep = 0;
		_this.maxSteps = _this.TIME_ITERATION * _this.FRAMES_PER_SECOND; 
		
		_this.stopAnimation = true;
		_this.linesAnimating = false;
        
        
        
        
        _this.getItems();
   	
   },
   
   getItems : function(){
   	
   		app.debug("app.modules.mapItems :: getItems");
   	
   		var _this = app.modules.mapItems;
   		
   		var params = "typology_id="+_this.settings.tipology+"&language_id="+_this.settings.languageId;
   		
   		$.getJSON(_this.settings.routes.getContents,params,function(data){
   			
   			app.debug(data);
   			
   			_this.contents = new Array();
   			
   			for(var i=0;i<data.contents.length;i++){
   				var currentContent = data.contents[i]; 
   				
   				for(var j=0;j<currentContent.fields.length;j++){
   					var currentField = currentContent.fields[j];
   					//app.debug(currentField["value"]);
   					
   					if(_this.isJsonString(currentField["value"])){
   						currentContent[currentField["name"]] = JSON.parse(currentField["value"]);
   					}
   					else {
   						currentContent[currentField["name"]] = currentField["value"];
   					}
   					
   					//setup lines
   					currentContent.line = {
   						animationEnabled : true,
   						currentStep : 0
   					};
   					
   				}
   				
   				_this.contents.push(currentContent);
   			}

			app.debug(_this.contents);
			
			_this.buildModal();
			_this.buildMap();
			
   		});
   	
   },
   
   buildModal : function(){
   	
   		var _this = app.modules.mapItems;
   	
   		var template = Handlebars.compile(this.getTemplate("mapitem"));
   		
   		app.debug("Media path : "+_this.settings.routes.mediaPath);
   		
   		var content = template({
	           CONTENTS : _this.contents,
	           MEDIA_PATH : _this.settings.routes.mediaPath,
	           INICIATIVA_PATH : _this.settings.routes.seeMore
	      });
   	
   		$("#map-items-container").html(content);
   		
   		$("#map-items-container").slick({
		  dots: false,
		  infinite: true,
		  speed: 500,
		  slidesToShow: 1,
		  centerMode: true,
		  variableWidth: true,
		  lazyLoad: 'ondemand',
		  accessibility : true,
		});
		
		// On before slide change
		$("#map-items-container").on('beforeChange', function(event, slick, currentSlide, nextSlide){
		  app.debug(nextSlide);
		  
		  _this.updateItem(nextSlide);
		  
		});
		
		_this.updateItem(0);
   	
   },
   
   buildMap : function(){
   	
   		var _this = app.modules.mapItems;
   	
   		var LeafIcon = L.Icon.extend({
			    options: {
			        shadowUrl: '/front/images/map-icon-shadow.png',
			        iconSize:     [32, 40],
			        shadowSize:   [32, 40],
			        iconAnchor:   [15, 40],
			        shadowAnchor: [15, 40],
			        popupAnchor:  [15, -30]
			    }
			});
			
		var smallIcon = new LeafIcon({iconUrl: '/front/images/map-icon.png'});
   	
   		//add markers
   		
   		for(var i=0;i<_this.contents.length;i++){
   			var current = _this.contents[i];
   			
   			//create marker
   			var marker = L.marker([current.map_1.lat, current.map_1.lng],
	    		{icon:smallIcon,
	    		 iniciativa_id: i}
	    		).addTo(_this.map);
   			
   			marker.on('click',_this.onMarkerClicked);
   			
   		}
   		
   		_this.startLinesAnimation();
   	
   },
   
   onMarkerClicked : function(event){
   	
   	var _this = app.modules.mapItems;
   	
   	app.debug("onMarkerClicked :: "+event);
   	app.debug("Iniciativa id : "+event.target.options.iniciativa_id);
   	
   	$("#map-items-container").slick('slickGoTo',event.target.options.iniciativa_id);
   	_this.updateItem(event.target.options.iniciativa_id);
   	
   },
   
   updateItem : function(index){
   		
   		var _this = app.modules.mapItems;
   		
   		//reset lines
   		for(var i=0;i<_this.contents.length;i++){
   			
   			_this.contents[i].line = {
   						animationEnabled : true,
   						currentStep : 0
   					};
   		}
   	
   		_this.currentItem = index;
   		
   		$("#see-more").attr("href",_this.settings.routes.seeMore + '/'+_this.contents[_this.currentItem].slug);
   		
   },
   
   isJsonString : function(str) {
	    try {
	        JSON.parse(str);
	    } catch (e) {
	        return false;
	    }
	    return true;
	},
	
	getTemplate: function(id) {
		
        if(typeof(this.templates[ id ]) != "undefined") {
            return this.templates[ id ];
        }

        return null;
   },
   

	//------------------------------------------------------------//
	//                  LINES
	//------------------------------------------------------------//


	animateLines : function (){
		
		var _this = app.modules.mapItems;	
		
		//setTimeout(function() {
			
			
			//borramos el escenario
			_this.context.clearRect(0, 0, _this.canvas.width, _this.canvas.height);
			
			//Out.debug(_this.root.find("#modal-view").css('right'));
			
			var startX = _this.modalLeft;
			var startY = 220;
			
			//var currentContent = _this.contents[0];
			
			
			var endPoint = _this.map.latLngToContainerPoint(
				[
					_this.contents[_this.currentItem].map_1.lat,
					_this.contents[_this.currentItem].map_1.lng
				]);
					
			_this.drawLine(_this.context,
					startX,startY,
					endPoint.x,endPoint.y,
					'#ffab24',
					_this.contents[_this.currentItem].line.currentStep);	
					
			//app.debug(currentContent);
					
			//si se ha llegado al final
			if(_this.contents[_this.currentItem].line.animationEnabled)
				_this.contents[_this.currentItem].line.currentStep++;
			
			if(_this.contents[_this.currentItem].line.currentStep >= _this.maxSteps){
				_this.contents[_this.currentItem].line.animationEnabled = false;
				_this.contents[_this.currentItem].line.currentStep = _this.maxSteps;
			}
			
			/*
			if(animationEnabled)
				requestAnimationFrame(animateLines);
			*/
			if(!_this.stopAnimation){
				requestAnimationFrame(_this.animateLines);
			}
			else {
				//borramos el escenario
				_this.context.clearRect(0, 0, _this.canvas.width, _this.canvas.height);
			}
		//}, 1000 / _this.FRAMES_PER_SECOND);
	},
    
     drawLine : function (context,startX,startY,endX,endY,color,currentStep){
     	
		var _this = app.modules.mapItems;				
						
		//calculamos la posicíon actual
		var interpolation = currentStep/_this.maxSteps;
		var currentX = startX + (endX - startX)*interpolation;
		var currentY = startY + (endY - startY)*interpolation;
		
		context.beginPath();
		context.moveTo(startX, startY);
		context.lineTo(currentX, currentY);
		
		context.lineWidth = 1;
		context.strokeStyle = color;
		context.stroke();
		
	},
    
    startLinesAnimation : function (){
		
		var _this = app.modules.mapItems;
		
		if(_this.stopAnimation){
			//ponemos las condiciones al inicio
			_this.stopAnimation = false;
			
			//empezamos la animación
			_this.animateLines();
		}
	},
	
	stopLinesAnimation : function(){
		var _this = app.modules.mapItems;
		
		_this.stopAnimation = true;
	},



};


//------------------------------------------------------------//
//                  PRELOAD TEMPLATES
//------------------------------------------------------------//
$.get('/front/js/tpl/mapitem.handlebars', function(content) {
    $.each($.parseHTML(content), function( i, el ) {
        if(typeof(el.id) !== "undefined" && el.nodeName == "SCRIPT") {
            app.modules.mapItems.templates[el.id] = $(el).html();
        }
    });
});

