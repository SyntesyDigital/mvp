app.mediaSelector = {

    page: 1,
    pageSize: 10,
    templates: [],
    options: {},
    URLs: {
        "post": WEBROOT + "/admin/content/medias",
        "lists": WEBROOT + "/admin/content/medias",
        "show": WEBROOT + "/admin/content/medias/"
    },
    isCropped: false,
    image: null,

    setPath: function(url) {
        app.mediaSelector.url = url;
    },

    init: function(settings, id) {

        var self = this;
        this.url = '/storage/medias/';

        jQuery.extend(self.options, settings);

        var template = Handlebars.compile(this.getTemplate("main"));

        app.modal.init(template({
            medias: null,
            pagination: null
        }), {
            onComplete: function() {
                app.mediaSelector.setContent(self.options);

                if (id) {
                    app.mediaSelector.loadMediaData(id);
                }
            }
        });
    },

    base64ToBlob: function(base64, mime)
    {
        mime = mime || '';
        var sliceSize = 1024;
        var byteChars = window.atob(base64);
        var byteArrays = [];

        for (var offset = 0, len = byteChars.length; offset < len; offset += sliceSize) {
            var slice = byteChars.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

        return new Blob(byteArrays, {type: mime});
    },

    onSubmit: function(data) {

        data['_token'] = $('meta[name="csrf-token"]').attr('content');

        if (app.mediaSelector.options.onSubmit) {
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
            method: 'POST',
            data: data,
            dataType: 'json',
            error: function() {},
            success: function(response) {
                location.reload();
            }
        });
    },

    setContent: function(options) {
        var filter = null;

        if (options) {
            if (typeof(options.filter) != "undefined") {
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

            if (prev_page <= 1) {
                prev_page = 1;
            }

            if (prev_page >= last_page) {
                prev_page = last_page;
            }

            var pages = [];
            for (i = 1; i <= last_page; i++) {
                pages.push({
                    "page": i
                });
            }

            $(".mediaSelector .pages").html(template({
                "pagination": {
                    'prev_page': prev_page,
                    'pages': pages,
                    'next_page': (parseInt(app.mediaSelector.page) + 1)
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


    loadMediaData: function(id) {
        // Chargement du media.
        $.get(app.mediaSelector.URLs.show + id, null, function(response) {

            // Ajout des données dans la page.
            var template = Handlebars.compile(app.mediaSelector.getTemplate("form-image"));

            app.debug("loadMediaData : ");
            app.debug(response);

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
                jQuery.map($(this).serializeArray(), function(n, i) {
                    formData[n['name']] = n['value'];
                });

                // Saving...
                app.mediaSelector.onSubmit(formData);

            });


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


    setDropZone: function()
    {

        var objId = ".filedropzone";

        if (parseInt($(objId).data('init')) == 1) {
            return false;
        }

        var _dropzone = new Dropzone(objId, {
            url: app.mediaSelector.URLs.post,
            paramName: 'file',
            addRemoveLinks : false,
            thumbnail: function(file, dataUrl) {
                return false;
            },
            sending: function(file, xhr, formData) {
                formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            },
            init: function() {
                this.on("error", function(file, response) {
                    toastr.error(response.file[0]);
                });
            }
        });

        $(objId).data('init', 1);

        _dropzone.on("totaluploadprogress", function(progress) {
            $("#progress-bar").parent().addClass("progress-striped active");
            $("#progress-bar").width(progress + "%");
            $("#progress-bar").html(progress + "%");
        });

        _dropzone.on("maxfilesreached", function() {
            alert('Too many files added !');
        });

        _dropzone.on("dragenter", function() {
            $(objId).addClass("active");
        });

        _dropzone.on("dragleave dragend dragover", function() {
            $(objId).removeClass("active");
        });

        _dropzone.on("maxfilesexceeded", function(file) {
            alert('File ' + file.name + ' is too big !');
        });

        _dropzone.on("success", function(file, response) {
            if (app.isJSON(response)) {
                var response = JSON.parse(response);
            }

            // Gestion d'erreur.
            if (response.error) {
                app.alert(response.message);
                return;
            }

            $(objId).removeClass("active");

            app.mediaSelector.setContent();

            if (response.id) {
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

    getTemplate: function(id) {
        if (typeof(this.templates[id]) != "undefined") {
            return this.templates[id];
        }

        return null;
    }

}
//------------------------------------------------------------//


//------------------------------------------------------------//
//                  PRELOAD TEMPLATES
//------------------------------------------------------------//
$.get(WEBROOT + '/js/admin/content/contents/tpl/mediaselector.handlebars', function(content) {
    $.each($.parseHTML(content), function(i, el) {
        if (typeof(el.id) !== "undefined" && el.nodeName == "SCRIPT") {
            app.mediaSelector.templates[el.id] = $(el).html();
        }
    });
});

//------------------------------------------------------------//

//------------------------------------------------------------//
//                  HANDLEBARS HELPERS
//------------------------------------------------------------//
Handlebars.registerHelper('ifvalue', function(conditional, options) {
    if (options.hash.value == conditional) {
        return options.fn(this)
    } else {
        return options.inverse(this);
    }
});

Handlebars.registerHelper('media_path', function(conditional, options) {
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
