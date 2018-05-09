app.overlaySelector = {

    templates   : [],

    options     : {
        'onSubmit' : null
    },

    URLs : {
        "post" : "/admin/medias/save",
        "lists" : "/admin/medias",
        "show" : "/admin/medias/"
    },

    init: function(settings)
    {
        var self = this;

        jQuery.extend(self.options, settings);

        var template = Handlebars.compile(this.getTemplate("main"));

        console.log(self.options);

        app.modal.init(template(), {
            onComplete : function() {
                app.overlaySelector.setContent(self.options);
            }
        });

    },


    setContent: function(options)
    {
        $.get(app.overlaySelector.URLs.lists + '?page_number=' + app.overlaySelector.page, {type: "overlay"}, function(response) {

            // Rendu
            var template = Handlebars.compile(app.overlaySelector.getTemplate("medias"));
            $(".overlaySelector .selectorTable").html(
                template({
                    MEDIAS: response,
                })
            );

            // Lazy content ajusting
            var h = $(".site-modal .content").innerHeight();
            $(".site-modal .overlaySelector .content").height(h);


            // Ecouteur
            $(".selectorTable a").click(function(e) {
                e.preventDefault();

                if(app.overlaySelector.options.onItemClick) {
                    app.overlaySelector.options.onItemClick($(this).attr('href').replace(/^#/, ''));
                }
            });

        });
    },


    getTemplate: function(id)
    {
        if(typeof(this.templates[ id ]) != "undefined") {
            return this.templates[ id ];
        }

        return null;
    },

    close: function() {
        app.modal.close();
    }

}


//------------------------------------------------------------//
//                  PRELOAD TEMPLATES
//------------------------------------------------------------//
$.get('/architect/js/tpl/overlayselector.handlebars', function(content) {
    $.each($.parseHTML(content), function( i, el ) {
        if(typeof(el.id) !== "undefined" && el.nodeName == "SCRIPT") {
            app.overlaySelector.templates[el.id] = $(el).html();
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
//------------------------------------------------------------//
