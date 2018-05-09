app.overlayCreator = {

    templates   : [],
    initialized : false,

    options     : {
        'onSubmit' : null
    },

    URLs : {
        "post" : "/admin/medias/save",
        "lists" : "/admin/medias",
        "show" : "/admin/medias/"
    },

    setPath : function(url) {
        app.overlayCreator.url = url;
    },

    init: function(id, settings)
    {
        var self = this;

        jQuery.extend(self.options, settings);

        var template = Handlebars.compile(this.getTemplate("main"));

        app.modal.init(template(), {
            onComplete : function() {
                app.overlayCreator.setDropZone();
                $('.overlayCreator form').on("submit", app.overlayCreator.onSubmit);
                if(id) {
                    app.overlayCreator.load(id);
                }
            }
        });

    },

    onSubmit: function(e) {
        e.preventDefault();

        var formData = {
            "_method" : "PUT"
        };

        formData = {};

        jQuery.map($(e.target).serializeArray(), function(n, i){
            formData[ n['name'] ] = n['value'];
        });

        if(formData.id !== "undefined") {
            $.ajax({
               url: app.overlayCreator.URLs.show + formData.id + '/save',
               type: 'POST',
               data: formData,
               dataType: 'json',
               error: function() {
               },
               success: function(response) {
                 app.modal.close();
                 location.reload();
               }
            });
        }

    },

    getTemplate: function(id)
    {
        if(typeof(this.templates[ id ]) != "undefined") {
            return this.templates[ id ];
        }

        return null;
    },


    load: function(id)
    {
        $.ajax({
           url: app.overlayCreator.URLs.show + id,
           type: 'GET',
           dataType: 'json',
           error: function() {
           },
           success: function(data) {
             $('#overlayCreator-image').html('<img src="' + app.overlayCreator.url + data.file + '" />');
             $('.overlayCreator input[name="id"]').val(data.id);
             $('.overlayCreator input[name="title"]').val(data.title);
             $('.overlayCreator input[name="metadata[zoom]"]').val(data.metadata.zoom);
             $('.overlayCreator input[name="metadata[sw][latitude]"]').val(data.metadata.sw.latitude);
             $('.overlayCreator input[name="metadata[sw][longitude]"]').val(data.metadata.sw.longitude);
             $('.overlayCreator input[name="metadata[ne][latitude]"]').val(data.metadata.ne.latitude);
             $('.overlayCreator input[name="metadata[ne][longitude]"]').val(data.metadata.ne.longitude);
             $('.overlayCreator input[name="metadata[color]"]').val(data.metadata.color);
             $('.overlayCreator input[name="metadata[line]"]').val(data.metadata.line);
             $('.overlayCreator input[name="metadata[pan]"]').val(data.metadata.pan);

             app.overlayCreator.initMap(data.file, data.metadata);
           }
        });
    },


    initMap: function(image)
    {
        $("#map-wrapper").height( app.modal.el.find(".wrapper .content").height() - 30);
        $("#map-wrapper").width( app.modal.el.find(".wrapper .content").width() - 200);

    	app.overlayCreator.map = L.map('add-overlay-map').setView([21.57572, 103.24951], 6);

        var sateliteLayer = L.tileLayer('http://otile1.mqcdn.com/tiles/1.0.0/sat/{z}/{x}/{y}.jpg', {
    		    attribution: '&copy MapQuest',
    		    minZoom: 5,
    		    maxZoom: 10
    		});

    	var googleLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    		    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    		    minZoom: 5,
    			maxZoom: 10
    		});


		app.overlayCreator.map.on('click',function(e){
		        	//console.log("clicke on position "+e.latlng);
		        	$("#map-coordenates").html("Map coordinates : ["+e.latlng.lat+","+e.latlng.lng+"]");
		        });

    	app.overlayCreator.satelite = true;
    	app.overlayCreator.map.addLayer(sateliteLayer);

        app.overlayCreator.image = {
            "url" : app.overlayCreator.url + image,
            "bounds" : [ [
                $("input[name='metadata[sw][latitude]']").val(),
                $("input[name='metadata[sw][longitude]']").val()
            ],[
                $("input[name='metadata[ne][latitude]']").val(),
                $("input[name='metadata[ne][longitude]']").val()
            ]],
            "zoom" : 6,
            "width" : 0,
            "height" : 0
        };

    	app.overlayCreator.image.overlay = new L.imageOverlay(app.overlayCreator.image.url, app.overlayCreator.image.bounds);
    	app.overlayCreator.map.addLayer(app.overlayCreator.image.overlay);
        //app.overlayCreator.map.keyboard.disable();

    	app.overlayCreator.southWestMarker = L.marker(app.overlayCreator.image.bounds[0],{draggable:"true"}).addTo(app.overlayCreator.map);

    	var middlePosition = [
    		app.overlayCreator.image.bounds[0][0] + (app.overlayCreator.image.bounds[1][0] - app.overlayCreator.image.bounds[0][0])/2,
    		app.overlayCreator.image.bounds[0][1] + (app.overlayCreator.image.bounds[1][1] - app.overlayCreator.image.bounds[0][1])/2,
    	];

    	//var middleMarker = L.marker(middlePosition,{draggable:"true"}).addTo(map);

    	app.overlayCreator.northEastMarker = L.marker(app.overlayCreator.image.bounds[1]).addTo(app.overlayCreator.map);

        $("<img/>").attr("src", app.overlayCreator.image.url).load(function(){
    	     app.overlayCreator.image.width = this.width;
    	     app.overlayCreator.image.height = this.height;
    	     app.overlayCreator.setImage();
    	});

        app.overlayCreator.initialized = true;

    	app.overlayCreator.southWestMarker.on('dragend', app.overlayCreator.setImage);

        $('.map').keydown(function(e){


			var x = 0;
    	    var y = 0;
    	    var pixels = 1;

            console.log(e);

			switch(e.keyCode){
                case 87 : //W
    	    		y = y - pixels;
    	    	break;

                case 83 : //S
    	    		y = y + pixels;
    	    	break;

                case 68 : //D
    	    		x = x + pixels;
    	    	break;

				case 65 : //A
    	    		x = x - pixels;
    	    	break;

                default:
    	    	break;

    	    }

    	    var swPoint = app.overlayCreator.map.latLngToContainerPoint(app.overlayCreator.southWestMarker.getLatLng());
    		var nePoint = app.overlayCreator.map.latLngToContainerPoint(app.overlayCreator.northEastMarker.getLatLng());

    		swPoint.x = swPoint.x + x;
    		swPoint.y = swPoint.y + y;
    		app.overlayCreator.southWestMarker.setLatLng(app.overlayCreator.map.containerPointToLatLng(swPoint));

    		nePoint.x = nePoint.x + x;
    		nePoint.y = nePoint.y + y;
    		app.overlayCreator.northEastMarker.setLatLng(app.overlayCreator.map.containerPointToLatLng(nePoint));


    	    app.overlayCreator.onDragEnd();


    	});

    	$("#toggle-satelite").click(function(event){
			if(app.overlayCreator.satelite){
				app.overlayCreator.satelite = false;

				app.overlayCreator.map.addLayer(googleLayer);
	    		app.overlayCreator.map.removeLayer(sateliteLayer);
			} else {
				app.overlayCreator.map.removeLayer(googleLayer);
	    		app.overlayCreator.map.addLayer(sateliteLayer);
				app.overlayCreator.satelite = true;
			}
		});

    },


    setImage: function()
    {
		var zoom = $('.overlayCreator input[name="metadata[zoom]"]').val();

		//app.overlayCreator.map.setZoom(zoom);

		var swPoint = app.overlayCreator.map.latLngToContainerPoint( app.overlayCreator.southWestMarker.getLatLng() );
		var nePoint = new L.Point(swPoint.x + app.overlayCreator.image.width, swPoint.y - app.overlayCreator.image.height);

		app.overlayCreator.northEastMarker.setLatLng( app.overlayCreator.map.containerPointToLatLng(nePoint) );

		app.overlayCreator.onDragEnd();
	},


    onDragEnd: function()
    {
		app.overlayCreator.map.removeLayer(app.overlayCreator.image.overlay);
		app.overlayCreator.image.bounds = [app.overlayCreator.southWestMarker.getLatLng(), app.overlayCreator.northEastMarker.getLatLng()];
    	app.overlayCreator.image.overlay = new L.imageOverlay(app.overlayCreator.image.url, app.overlayCreator.image.bounds);
		app.overlayCreator.map.addLayer(app.overlayCreator.image.overlay);

        $("input[name='metadata[sw][latitude]']").val(app.overlayCreator.image.bounds[0].lat);
        $("input[name='metadata[sw][longitude]']").val(app.overlayCreator.image.bounds[0].lng);

        $("input[name='metadata[ne][latitude]']").val(app.overlayCreator.image.bounds[1].lat);
        $("input[name='metadata[ne][longitude]']").val(app.overlayCreator.image.bounds[1].lng);
        //
		// $("#sw").val("["+app.overlayCreator.image.bounds[0].lat+","+app.overlayCreator.image.bounds[0].lng+"]");
		// $("#ne").val("["+app.overlayCreator.image.bounds[1].lat+","+app.overlayCreator.image.bounds[1].lng+"]");
	},

    setDropZone: function()
    {

        var objId = ".filedropzone";

        var options = {
            url                 : app.overlayCreator.URLs.post,
            paramName           : 'media',
            thumbnail: function(file, dataUrl) {
                /* do something else with the dataUrl */
            }
        };

        if(parseInt($(objId).data('init')) == 1) {
            return false;
        }

        var myDropzone = new Dropzone(objId, options);

        $(objId).data('init', 1);

        myDropzone.on("totaluploadprogress", function(progress) {
            $("#progress-bar").parent().addClass("progress-striped active");
            $("#progress-bar").width(progress + "%");
            $("#progress-bar").html(progress + "%");
        });

        myDropzone.on("maxfilesreached", function() {
            alert('Too many files added !');
        });

        myDropzone.on("dragenter", function() {
            $(objId).addClass("active");
        });

        myDropzone.on("dragleave dragend dragover", function() {
            $(objId).removeClass("active");
        });

        myDropzone.on("maxfilesexceeded", function(file) {
            alert('File ' + file.name + ' is too big !');
        });

        // Add parameters
        myDropzone.on('sending', function(file, xhr, formData){
            if($('.overlayCreator input[name="id"]').length > 0) {
                formData.append('id', $('.overlayCreator input[name="id"]').val());
                formData.append('type', 'overlay');
            }
        });

        myDropzone.on("success", function(file, response) {

            myDropzone.removeAllFiles(true);

            if(app.isJSON(response)) {
                var response = JSON.parse(response);
            }

            // Gestion d'erreur.
            if(response.error) {
                app.alert(response.message);
                return;
            }

            $(objId).removeClass("active");

            if(response.id) {
                $('#overlayCreator-image').html('<img src="' + app.overlayCreator.url + response.file + '" />');
                $('.overlayCreator input[name="id"]').val(response.id);

                if(app.overlayCreator.initialized) {
                    app.overlayCreator.map.remove();
                }

                app.overlayCreator.initMap(response.file);
            }
        });
    },

}


//------------------------------------------------------------//
//                  PRELOAD TEMPLATES
//------------------------------------------------------------//
// $.get('/architect/js/tpl/overlaycreator.handlebars', function(content) {
//     $.each($.parseHTML(content), function( i, el ) {
//         if(typeof(el.id) !== "undefined" && el.nodeName == "SCRIPT") {
//             app.overlayCreator.templates[el.id] = $(el).html();
//         }
//     });
// });
//------------------------------------------------------------//


//------------------------------------------------------------//
//                  HANDLEBARS HELPERS
//------------------------------------------------------------//
Handlebars.registerHelper('ifvalue', function (conditional, options) {
    if (options.hash.value == conditional) {
        return options.fn(this)
    } else {
        return options.inverse(this);
    }
});
//------------------------------------------------------------//
