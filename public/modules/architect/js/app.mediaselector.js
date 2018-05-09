app.mediaSelector = {

    page        : 1,
    pageSize    : 10,
    templates   : [],
    options     : {},
    URLs : {
        "post" :  "/architect/medias/save",
        "lists" : "/architect/medias",
        "show" : "/architect/medias/"
    },
    isCropped: false,
    image: null,

    setPath : function(url) {
        app.mediaSelector.url = url;
    },

    init: function(settings, id)
    {
        var self = this;
        var template = Handlebars.compile(this.getTemplate("main"));

        jQuery.extend(self.options, settings);

        app.modal.init(template({
            medias: null,
            pagination: null
        }), {
            onComplete: function() {
                app.mediaSelector.setContent(self.options);

                $('input[name="search"]').keyup(function(){
                    app.mediaSelector.setContent({
                        filter: $(this).val()
                    });
                });

                if(id) {
                    app.mediaSelector.loadMediaData(id);
                }
            }
        });
    },

    onSubmit: function(data)
    {
        if(app.mediaSelector.options.onSubmit) {
            app.mediaSelector.options.onSubmit(data);
            return;
        }

        if(app.mediaSelector.isCropped) {
            app.mediaSelector.image.cropper('getCroppedCanvas').toBlob(function (blob) {
                var formData = new FormData();

                formData.append('file', blob);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax(app.mediaSelector.URLs.post, {
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function () {
                        location.reload();
                    },
                    error: function () {
                        console.log('Upload error');
                    }
                });
            });

            return;
        }

        $.ajax({
           url: app.mediaSelector.URLs.show + data.id + '/update',
           type: 'POST',
           data: data,
           dataType: 'json',
           error: function() {
           },
           success: function(response) {
             location.reload();
           }
        });
    },

    setCropper: function()
    {
        app.mediaSelector.image = $(".fixed-dragger-cropper > img");

        app.mediaSelector.image.cropper({
              //aspectRatio: 640 / 320,
              autoCropArea: 0.6, // Center 60%
              multiple: false,
              dragCrop: false,
              dashed: true,
              movable: true,
              resizable: true,
              built: function () {
                  $(this).cropper("zoom", 0.5);
              }
        });

        $('#site-modal .toggle-cropper-cancel')
            .removeClass('hide')
            .on('click', function(e){
                e.preventDefault();
                app.mediaSelector.image.cropper("destroy");
                $(this).addClass('hide');
                app.mediaSelector.isCropped = false;
            });

        app.mediaSelector.isCropped = true;

    },

    setContent: function(options)
    {
        var filter = null;

        if(options) {
            if(typeof(options.filter) != "undefined") {
                filter = options.filter;
            }
        }

        $.get(app.mediaSelector.URLs.lists + '?page=' + app.mediaSelector.page, {
            filter: filter
        }, function(response) {

			var pages = [];
            var nbPages = 0;
            var page = 0;

            var template = Handlebars.compile(app.mediaSelector.getTemplate("pagination"));
            var last_page = response.last_page;
            var prev_page = (parseInt(app.mediaSelector.page) - 1);
            var next_page = (parseInt(app.mediaSelector.page) + 1);

            if(prev_page <=1) {
                prev_page = 1;
            }

            if(prev_page >= last_page) {
                prev_page = last_page;
            }

            var pages = [];
            for (i = 1; i <= last_page; i++) {
                pages.push({
                    "page" : i
                });
            }

            $(".mediaSelector .pages").html(template({
                "pagination" : {
                    'prev_page' : prev_page,
                    'pages' : pages,
                    'next_page' : (parseInt(app.mediaSelector.page) + 1)
                }
            }));

            // Rendu
            var template = Handlebars.compile(app.mediaSelector.getTemplate("medias"));

            $(".mediaSelector .selectorTable").html(
                template({
                    MEDIAS: response.data,
                })
            );

            // Lazy content ajusting
            // var h = $(".site-modal .content").innerHeight();
            // $(".site-modal .mediaSelector-content").height(h);

            // Ecouteur
            $(".selectorTable a").click(function(e) {
                e.preventDefault();
                app.mediaSelector.loadMediaData($(this).attr('href').replace(/^#/, ''));
            });

            // Listener pagination
            $("#site-modal .content .pages a").click(function(e) {
                e.preventDefault();
                app.mediaSelector.page = $(this).attr("data-page");
                app.mediaSelector.setContent(options);
            });

            app.mediaSelector.setDropZone();
        });
    },


    loadMediaData: function(id)
    {
        // Chargement du media.
        $.get(app.mediaSelector.URLs.show + id, null, function(response) {

            // Ajout des données dans la page.
            var template = Handlebars.compile(app.mediaSelector.getTemplate("form-image"));

            $("#site-modal .content .form")
                .empty()
                .append(template(response));

            $("#site-modal .content .clear-form").click(function(e) {
                $("#site-modal .content .form").empty().append("<div class=\"filedropzone\"></div>");
                app.mediaSelector.setDropZone();
            });

            $('#site-modal a.toggle-cropper').on('click', function(e){
                e.preventDefault();
                app.mediaSelector.setCropper();
            });

            var objectData = response;

            $("#site-modal .content .form form").submit(function(e) {

                // Stop event.
	            e.preventDefault();

	            // Initialise j'objet JSON qui contient les valeurs du formulaire.
	            var formData = {};

	            // Ajoute les valeurs du formulaire dans l'objet.
                jQuery.map($(this).serializeArray(), function(n, i){
                    formData[ n['name'] ] = n['value'];
                });

                if(objectData.hasOwnProperty('lat') && objectData.hasOwnProperty('lng')){
                	formData.lat = objectData.lat;
                	formData.lng = objectData.lng;
                }

                if(objectData.hasOwnProperty('taken_at')){
                	formData.taken_at = objectData.taken_at;
                }

                // L'objet JSON de la meta.
                /*
                json["value"]   = JSON.stringify(json);

                // La clé de la meta.
                json["key"]     = ND.mediaSelector.key;
                */

                // Saving...
	            app.mediaSelector.onSubmit(formData);

            });
        });
    },


    setDropZone: function()
    {

        var objId = ".filedropzone";

        var options = {
            url : app.mediaSelector.URLs.post,
            paramName : 'file',
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

        myDropzone.on("success", function(file, response) {
            if(app.isJSON(response)) {
                var response = JSON.parse(response);
            }

            // Gestion d'erreur.
            if(response.error) {
                app.alert(response.message);
                return;
            }

            $(objId).removeClass("active");

            app.mediaSelector.setContent();

            if(response.id) {
                app.mediaSelector.loadMediaData(response.id);
            }
        });
    },

    close: function() {
        app.modal.close();
    },

    remove: function(element) {
        var el = $(element).parent().parent();

        el.fadeOut(500, function() {
            el.remove();
        });
    },

    getTemplate: function(id)
    {
        if(typeof(this.templates[ id ]) != "undefined") {
            return this.templates[ id ];
        }

        return null;
    }

}
//------------------------------------------------------------//


//------------------------------------------------------------//
//                  PRELOAD TEMPLATES
//------------------------------------------------------------//
$.get(WEBROOT + '/architect/js/tpl/mediaselector.handlebars', function(content) {
    $.each($.parseHTML(content), function( i, el ) {
        if(typeof(el.id) !== "undefined" && el.nodeName == "SCRIPT") {
            app.mediaSelector.templates[el.id] = $(el).html();
        }
    });
});

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

Handlebars.registerHelper('media_path', function (conditional, options) {
    return app.mediaSelector.url;
});

Handlebars.registerHelper("math", function(lvalue, operator, rvalue, options) {
    lvalue = parseFloat(lvalue);
    rvalue = parseFloat(rvalue);

    return {
        "+": lvalue + rvalue,
        "-": lvalue - rvalue,
        "*": lvalue * rvalue,
        "/": lvalue / rvalue,
        "%": lvalue % rvalue
    }[operator];
});
//------------------------------------------------------------//
