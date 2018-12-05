app.contentField = {

    url : "/admin/contents/fields",

    add: function(obj) {
        var type = obj.data('type');
        var typologyId = $("#content-form").find('select[name="typology_id"]').val();

        console.log("type: "+type);
        console.log("tipology : "+typologyId);

        $(".content-fields").each(function(i, div) {
            var languageId = $(this).data("language");
            //app.contentField.getFieldHTML(type, "inputs[" + languageId + "]", typologyId, $(this));
            app.contentField.getFieldHTML(type, "name_1", typologyId, $(this));
        });
    },


    getFieldHTML: function(type, fieldName, typologyId, el) {

        var request = $.ajax({
            url: app.contentField.url,
            method: "POST",
            data: {
                type : type,
                typology_id : typologyId,
                fieldname : fieldName
            },
            dataType: "html"
        });

        request.done(function( response ) {

          el.append(response);

        });

        request.fail(function( response ) {
            //alert(response.responseText);
        });
    },



}
