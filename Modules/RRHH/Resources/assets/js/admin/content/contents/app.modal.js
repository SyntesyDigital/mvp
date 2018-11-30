app.modal = {

    el : null,

    settings : {
        css : {},
        onComplete : function() {

        },
    },

    init: function(content, options) {

        var self = this;

        self.el = $("#site-modal");

        jQuery.extend(self.settings, options);

        $("#site-modal .wrapper").css(self.settings.css);
        $("#site-modal .content").html(content);

        $("#site-modal").fadeIn(250, self.settings.onComplete);

        $("#site-modal .close").click(function(e) {
		    e.preventDefault();
		    app.modal.close();
	    });

        $(document).keyup(function(e) {
		    if (e.keyCode == 27) {
			    app.modal.close();
		    }
	    });
    },

    close: function() {
        //$("#site-modal .overlay").fadeOut(250);
        $("#site-modal").fadeOut(500, function() {
            $("#site-modal .content").empty();
        });
    },

    get: function(){
        return $("#site-modal");
    }

}
