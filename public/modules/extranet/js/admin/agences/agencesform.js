$(function() {

    $('form.delete-agence-form').on('submit', function(e){
        e.preventDefault();
        bootbox.confirm({
            message: 'Etes-vous sur de vouloir supprimer cette agence ?',
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
                    $('form.delete-agence-form')
                        .off('submit')
                        .trigger('submit');
                }
            }
        });
    });


       // Resume_file Drop ZOne
    var myDropzone_1 = '';

    myDropzone_1 = new Dropzone('.medias-dropfiles_1', {
                        url : '/admin/agences/filestore',
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
        $('.dz-div_1').hide(); 
        $('#image').val(response.path);
        $('#filename-p_1').html("<i class='fa fa-file'> "+response.path+"</i>");
    });
    //END Resume DropZone Init
});

function deleteFile(item){
    if(item == '1'){
        $('#image').val('');
    }
    $('.dz-div_'+item).show();
    $('#filename-p_'+item).html('');
    
}