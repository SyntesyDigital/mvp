var medias = {

    _dropzone : null,
    _settings : null,
    _defaults : {

    },

    init: function(options)
    {
        this._settings = $.extend({}, this._defaults, options);
    },


    initDropzone: function()
    {

        var _this = this;

        this._dropzone = new Dropzone('.medias-dropfiles', {
            url : '{{ action("Admin\Content\MediaController@store") }}',
            uploadMultiple: false,
            parallelUploads: 1,
            // acceptedFiles:'image/jpeg,image/png,image/gif',
            addRemoveLinks : false,
            maxFilesize: 2, // MB
            paramName : 'file',
            thumbnail: function(file, dataUrl) {
                /* do something else with the dataUrl */
                return false;
            },
            sending: function(file, xhr, formData) {
                formData.append("_token", "{{ csrf_token() }}");
            },
            init: function() {
                this.on("error", function(file, response) {
                    toastr.error(response.file[0]);
                });
            }
        });

        this._dropzone.on("totaluploadprogress", function(progress) {
            $(".progress-bar").parent().addClass("progress-striped active");
            $(".progress-bar").width(progress + "%");
            $(".progress-bar").html(progress + "%");
        });

        this._dropzone.on("maxfilesreached", function() {
            toastr.error('Too many files added !');
        });

        this._dropzone.on("dragenter", function() {
            $('.medias-dropfiles').addClass("active");
        });

        this._dropzone.on("dragleave dragend dragover", function() {
            $('.medias-dropfiles').removeClass("active");
        });

        this._dropzone.on("maxfilesexceeded", function(file) {
            toastr.error('File ' + file.name + ' is too big !');
        });



        this._dropzone.on("queuecomplete", function(file, response) {
            setTimeout(function(){
                $(".progress-bar").parent().removeClass("progress-striped active");
                $(".progress-bar").width("0%");
                $(".progress-bar").html("");
            }, 2000);

            _this.removeAllFiles(true);
            _this.onSuccessUpload();
        });


        this._dropzone.on("success", function(file, response) {
            this._dropzone.removeAllFiles(true);
            toastr.success('Votre fichier vient d\'être enregistré');
        });
    },

    onSuccessUpload: function()
    {
        var _this = this;

        $.ajax({
           url: '{{ action("Admin\Content\MediaController@index") }}',
           type: 'GET',
           dataType: 'json',
           error: function(response) {
                console.log(response);
           },
           success: function(response) {
                $('#medias-rows').empty();

                var removeUrl = '{{ action('Admin\Content\MediaController@delete', ':id') }}';

                $.each(response.data, function( index, value ) {
                    var html = '<tr>';

                        html += '<td width="50">';
                            html += value.id;
                        html += '</td>';

                        html += '<td width="80">';
                            html += '<img src="' + value.file + '" style="max-height: 80px"/>';
                        html += '</td>';

                        html += '<td>';
                            html += value.filename + '';
                        html += '</td>';

                        html += '<td align="right">';
                            html += '<form action="' + removeUrl.replace(':id', value.id) + '" method="POST" enctype="multipart/form-data" class="">';
                            html += '<input type="hidden" name="_token" value="{{ csrf_token() }}" />';
                            html += '<input type="hidden" name="_method" value="DELETE">';
                            html += '<input type="submit" value="Supprimer" class="btn btn-link" />';
                            html += '</form>';
                            html += '<a href="#" onClick="app.mediaSelector.init({}, ' + value.id + '); return false;" class="btn btn-success">Editer</a>';
                        html += '</td>';

                    html += '</tr>';

                    $('#medias-rows').append(html);

                    _this.initEvents();


                });
           }
        });
    },


    initEvents: function()
    {
        $('.toggle-delete').off('submit').on('submit', function(e){

            var _this = $(this);

            e.preventDefault();
            bootbox.confirm({
                message: 'Etes-vous sur de vouloir supprimer cet élément ?',
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
                        _this.off('submit')
                            .trigger('submit');
                    }
                }
            });
        });
    }




}
