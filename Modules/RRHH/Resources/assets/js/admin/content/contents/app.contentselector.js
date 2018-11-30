app.contentSelector = {

    page        : 1,
    templates   : [],
    options     : {},

    init: function(settings)
    {
        var self = this;

        jQuery.extend(self.options, settings);

        var template = Handlebars.compile(this.getTemplate("main"));

        app.modal.init(template({
            medias: null,
            pagination: null
        }), {
            onComplete: function() {
                app.contentSelector.setContent(self.options);
            }
        });
    },

    setContent: function(options)
    {
        var filter = null;

        var languageId = options.language_id !== undefined ? options.language_id : null;


        $.get(options.URLs.index + '&language_id=' + languageId + 'page=' + app.contentSelector.page, {}, function(response) {

            var template = Handlebars.compile(app.contentSelector.getTemplate("pagination"));

            // Rendu
            var template = Handlebars.compile(app.contentSelector.getTemplate("contents"));
            var html = template({
                contents: response.contents.data,
                language_id: options.language_id
            });

            $(".contentSelector .list").html(html);

            $('.add-content').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                options.onClickAdd(id);
            });

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
$.get(WEBROOT + '/js/admin/content/contents/tpl/contentselector.handlebars', function(content) {
    $.each($.parseHTML(content), function( i, el ) {
        if(typeof(el.id) !== "undefined" && el.nodeName == "SCRIPT") {
            app.contentSelector.templates[el.id] = $(el).html();
        }
    });
});
//------------------------------------------------------------//


Handlebars.registerHelper('ifCond', function(v1, v2, options) {
  if(v1 === v2) {
    return options.fn(this);
  }
  return options.inverse(this);
});
