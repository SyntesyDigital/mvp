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
            pagination: null,
            typologies: self.options.typologies
        }), {
            onComplete: function() {

                $('select[name="typology_id"]').off('change').on('change', function(e){
                    self.options.typology_id = $(this).val();
                    app.contentSelector.setContent(self.options);
                });

                $('input[name="q"]').off('keyup').on('keyup', function(e){
                    self.options.q = $(this).val();
                    app.contentSelector.setContent(self.options);
                });

                app.contentSelector.setContent(self.options);
            }
        });
    },

    setContent: function(options)
    {
        var filter = null;

        var languageId = options.language_id !== undefined ? options.language_id : null;
        var typologyId = options.typology_id !== undefined ? options.typology_id : null;
        var q = options.q !== undefined ? options.q : '';

        $.get(options.URLs.index + '&q='+q+'&typology_id='+ typologyId + '&language_id=' + languageId + 'page=' + app.contentSelector.page, {}, function(response) {

            var template = Handlebars.compile(app.contentSelector.getTemplate("pagination"));

            // var last_page = response.last_page;
            // var prev_page = (parseInt(app.contentSelector.page) - 1);
            // var next_page = (parseInt(app.contentSelector.page) + 1);
            //
            // if(prev_page <=1) {
            //     prev_page = 1;
            // }
            //
            // if(prev_page >= last_page) {
            //     prev_page = last_page;
            // }
            //
            // var pages = [];
            // for (i = 1; i <= last_page; i++) {
            //     pages.push({
            //         "page" : i
            //     });
            // }
            //
            // $(".contentSelector .pages").html(template({
            //     "pagination" : {
            //         'prev_page' : prev_page,
            //         'pages' : pages,
            //         'next_page' : (parseInt(app.contentSelector.page) + 1)
            //     }
            // }));

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
                toastr.success('Content added successfully');
            });

            // Lazy content ajusting
            // var h = $(".site-modal .content").innerHeight();
            // $(".site-modal .mediaSelector-content").height(h);

            // Ecouteur
            // $(".selectorTable a").click(function(e) {
            //     e.preventDefault();
            //     app.contentSelector.loadMediaData($(this).attr('href').replace(/^#/, ''));
            // });
            //
            // // Listener pagination
            // $("#site-modal .content .pages a").click(function(e) {
            //     e.preventDefault();
            //     app.contentSelector.page = $(this).attr("data-page");
            //     app.contentSelector.setContent(options);
            // });

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
$.get(WEBROOT+'/architect/js/tpl/contentselector.handlebars', function(content) {
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
