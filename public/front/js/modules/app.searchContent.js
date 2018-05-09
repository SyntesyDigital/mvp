app.modules.searchContent = {
   
   contents : null,
   templates   : [],
   
   categories : ['','social','gestion','ecologicas','economicas'],
   selectedCategory : 0,
   searchText : "",
   
   defaults : {
   		
   },
   
   settings : null,
   
   init : function(options){
   	
   		var _this = app.modules.searchContent;
   		
   		_this.settings = $.extend({}, _this.defaults, options);
   	
   		$(".select-category").click(_this.selectCategory);
   		$(".search-btn").click(_this.search);
   },
   
   search : function(event){
   	
   		event.preventDefault();
   	
		var _this = app.modules.searchContent;
		
		_this.searchText = $(".search-input").val();
		app.debug("search :: searchText : "+_this.searchText);
		
		
		if(_this.searchText != ""){
			
			_this.selectedCategory = 0;
			
			_this.colapse();
			
			_this.getItems();
		}
   	
   },
   
   colapse : function(){
   	
   		$("ul.buttons-container").addClass("colapsed");
   		
   		$("a.select-category").each(function( index ){
   			$(this).html($(this).data('collapsed'));
   		});
   		
   		$("#module-search").addClass("colapsed");
   },
   
   selectCategory : function(event){
   	
   		event.preventDefault();
   	
		var _this = app.modules.searchContent;
		
		var link = event.target;
		
		$(".search-input").val("");
		
		_this.selectedCategory = $(link).closest(".select-category").data("category");
   		
   		_this.colapse();
   		
   		app.debug("selectCategory :: "+_this.selectedCategory);
   		
   		_this.getItems();
   		
   },
   
   getItems : function(){
   	
   		app.debug("app.modules.searchContent :: getItems");
   	
   		var _this = app.modules.searchContent;
   		
   		var params = "typology_id="+_this.settings.tipology+"&language_id="+_this.settings.languageId;
   		
   		if(_this.selectedCategory > 0){
   			params += "&category="+_this.categories[_this.selectedCategory];
   		}
   		
   		if(_this.searchText != ""){
   			params += "&search="+_this.searchText;
   		}
   		
   		
   		$(_this.settings.contentId).slideUp(1000,function(){
   			
   			app.debug("slide up complete");
   			
   			$(_this.settings.contentId).empty();
   			
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
	   					
	   				}
	   				
	   				_this.contents.push(currentContent);
	   			}
	
				app.debug(_this.contents);
				
				_this.buildContent();
				
				
	   		});
   			
   			
   		});
   		
   		
   	
   },
   
   buildContent : function(){
   	
   		var _this = app.modules.searchContent;
   	
   		var template = Handlebars.compile(this.getTemplate("tool"));
   		
   		app.debug("Media path : "+_this.settings.routes.mediaPath);
   		
   		var header = {};
   		
   		if(_this.selectedCategory > 0){
   			
   			var resultText = _this.settings.resultText[0];
   			
   			if(_this.contents.length == 0 || _this.contents.length > 1){
   				resultText = _this.settings.resultText[1];
   			}
   			
   			header = {
   				icon : _this.selectedCategory,
   				title : _this.settings.callTexts[_this.selectedCategory].title,
   				resultText : _this.contents.length + " "+resultText
   			};
   		}
   		else {
   			
   			var resultText = _this.settings.resultText[0];
   			
   			if(_this.contents.length == 0 || _this.contents.length > 1){
   				resultText = _this.settings.resultText[1];
   			}
   			
   			header = {
   				resultText : _this.contents.length + " "+resultText
   			};
   		}
   		
   		var content = template({
	           CONTENTS : _this.contents,
	           MEDIA_PATH : _this.settings.routes.mediaPath,
	           HEADER : header
	      });
   	
   		$(_this.settings.contentId).html(content);
   		
   		$(_this.settings.contentId).slideDown(1000);
   	
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
   }
   
};

//------------------------------------------------------------//
//                  PRELOAD TEMPLATES
//------------------------------------------------------------//
$.get('/front/js/tpl/tool.handlebars', function(content) {
    $.each($.parseHTML(content), function( i, el ) {
        if(typeof(el.id) !== "undefined" && el.nodeName == "SCRIPT") {
            app.modules.searchContent.templates[el.id] = $(el).html();
        }
    });
});

