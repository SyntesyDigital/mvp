$(function() {

    // ------------------------------------------------------ //
    //          DELETE CANDIDATE
    // ------------------------------------------------------ //
    $('form.delete-candidate-form').on('submit', function(e){
        e.preventDefault();
        bootbox.confirm({
            message: 'Etes-vous sur de vouloir supprimer cette utilisateur ?',
            buttons: {
                confirm: {
                    label: 'Oui',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Non',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result) {
                    $('form.delete-candidate-form')
                        .off('submit')
                        .trigger('submit');
                }
            }
        });
    });


    // ------------------------------------------------------ //
    //          WARNING
    // ------------------------------------------------------ //
    $('form.check-inactive-candidate-form').on('submit', function(e){
        e.preventDefault();
        if($('#old_status').val() != inactive_value && $('#status').val() == inactive_value ){
            bootbox.confirm({
                message: 'Etes-vous sur de vouloir sauvegarder cette utilisateur comme inactif?',
                buttons: {
                    confirm: {
                        label: 'Oui',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Non',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if(result) {
                        $('form.check-inactive-candidate-form')
                            .off('submit')
                            .trigger('submit');
                    }
                }
            });
        }else{
            $('form.check-inactive-candidate-form')
                        .off('submit')
                        .trigger('submit');
        }

    });

    // ------------------------------------------------------ //
    //          DATATABLE
    // ------------------------------------------------------ //
    $('#table-candidatures').DataTable({
        language: {
            "url": "/modules/rrhh/plugins/datatables/locales/french.json"
        },
        processing: true,
        serverSide: true,
        pageLength: 10,
        ajax: routes.data,
        columns: [
            {data: 'title', name: 'title'},
            {data: 'created_at', name: 'created_at'},
            {data: 'status', name: 'status'},
        ],
        initComplete: function () {
            //$('#textarea').textext()[0].tags().addTags(utags);
        }
    });


    // ------------------------------------------------------ //
    //          TAGS
    // ------------------------------------------------------ //
    /*
    $('#textarea')
        .textext({
            plugins : 'tags autocomplete',
        })
        .bind('getSuggestions', function(e, data) {
            var list = atags;
            var textext = $(e.target).textext()[0];
            var query = (data ? data.query : '') || '';
            $(this).trigger('setSuggestions',{
                result : textext.itemManager().filter(list, query)
            });
        });
    */

    $('.convert_interimaire').on('click', function(e){
        if($('#registration_number').val() == ''){
            toastr.error('Le champ matricule est obligatoire');
        }else{
            $('#type').val(type_interim_value);
            $('form.check-inactive-candidate-form').submit();
        }
    });


    // ------------------------------------------------------ //
    //          DROPZONE
    // ------------------------------------------------------ //
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrf_token
        }
    });

    // Resume_file Drop ZOne
    var myDropzone_1 = new Dropzone('.medias-dropfiles_1', {
        url : routes.uploads.resumeFile,
        uploadMultiple: false,
        parallelUploads: 1,
        addRemoveLinks : false,
        maxFilesize: 2, // MB
        paramName : 'file',
        thumbnail: function(file, dataUrl) {
            return false;
        },
        sending: function(file, xhr, formData) {
            formData.append("_token", csrf_token);
        },
        init: function() {
            this.on("error", function(file, response) {
                toastr.error(response);
            });
        }
    });

    myDropzone_1.on("totaluploadprogress", function(progress) {
        $(".progress-bar_1").parent().addClass("progress-striped active");
        $(".progress-bar_1").width(progress + "%");
        $(".progress-bar_1").html(progress + "%");
    });

    myDropzone_1.on("maxfilesreached", function() {
        alert('Too many files added !');
    });

    myDropzone_1.on("dragenter", function() {
        $('.medias-dropfiles_1').addClass("active");
    });

    myDropzone_1.on("dragleave dragend dragover", function() {
        $('.medias-dropfiles_1').removeClass("active");
    });

    myDropzone_1.on("maxfilesexceeded", function(file) {
        alert('File ' + file.name + ' is too big !');
    });

    myDropzone_1.on("queuecomplete", function(file, response) {
        setTimeout(function(){
            $(".progress-bar_1").parent().removeClass("progress-striped active");
            $(".progress-bar_1").width("0%");
            $(".progress-bar_1").html("");

        }, 1000);
    });

    myDropzone_1.on("success", function(file, response) {
        toastr.success('Votre fichier vient d\'être enregistré');
        myDropzone_1.removeAllFiles(true);
        $('#resume_file').val(response.path);
        //$('#filename-p_1').html("<i class='fa fa-file'> "+response.path+"</i>");
        $('#filename-p_1').html("<i class='fa fa-file'> <a href='/storage/candidates/" + response.path + "' target='_blank'>" + response.path + "</a></i>");
    });
    //END Resume DropZone Init

    // Recommendation_letter Drop ZOne
    var myDropzone_2 = new Dropzone('.medias-dropfiles_2', {
        url : routes.uploads.recommendationLetterFile,
        uploadMultiple: false,
        parallelUploads: 1,
        addRemoveLinks : false,
        maxFilesize: 2, // MB
        paramName : 'file',
        thumbnail: function(file, dataUrl) {
            return false;
        },
        sending: function(file, xhr, formData) {
            formData.append("_token", csrf_token);
        },
        init: function() {
            this.on("error", function(file, response) {
                toastr.error(response.file[0]);
            });
        }
    });

    myDropzone_2.on("totaluploadprogress", function(progress) {
        $(".progress-bar_2").parent().addClass("progress-striped active");
        $(".progress-bar_2").width(progress + "%");
        $(".progress-bar_2").html(progress + "%");
    });

    myDropzone_2.on("maxfilesreached", function() {
        alert('Too many files added !');
    });

    myDropzone_2.on("dragenter", function() {
        $('.medias-dropfiles_2').addClass("active");
    });

    myDropzone_2.on("dragleave dragend dragover", function() {
        $('.medias-dropfiles_2').removeClass("active");
    });

    myDropzone_2.on("maxfilesexceeded", function(file) {
        alert('File ' + file.name + ' is too big !');
    });

    myDropzone_2.on("queuecomplete", function(file, response) {
        setTimeout(function(){
            $(".progress-bar_2").parent().removeClass("progress-striped active");
            $(".progress-bar_2").width("0%");
            $(".progress-bar_2").html("");
            $('.dz-div_2').hide();
            $('#filename-p_2').show();
        }, 1000);
    });

    myDropzone_2.on("success", function(file, response) {
        toastr.success('Votre fichier vient d\'être enregistré');
        myDropzone_2.removeAllFiles(true);
        $('#recommendation_letter').val(response.path);

        $('#filename-p_2').html("<i class='fa fa-file'> <a href='/storage/candidates/" + response.path + "' target='_blank'>" + response.path + "</a></i>");
    });
    //END Recommendation_letter DropZone Init
});


// ------------------------------------------------------ //
//          ???
// ------------------------------------------------------ //
function deleteFile(item){
    if(item == '1'){
        $('#resume_file').val('');
    }
    if(item == '2'){
        $('#recommendation_letter').val('');
    }
    $('.dz-div_'+item).show();
    $('#filename-p_'+item).html('');
}
