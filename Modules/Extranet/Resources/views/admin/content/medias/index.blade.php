@extends('architect::layouts.master')

@section('content')
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des médias</h3>
    				<h6 class="card-subtitle mb-2 text-muted">Tous les médias des contenus se trouvent ici</h6>

                    <div class="medias-dropfiles">
                        <p align="center">
                            <strong>Déposez vos fichiers</strong> <br />
                            <small>ou cliquez-ici</small>
                        <p>
                    </div>

                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <span class="sr-only">70% Complete</span>
                      </div>
                    </div>

                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Preview</th>
                            <th>Nom du fichier</th>
                            <th></th>
                        </tr>
                        <tbody id="medias-rows">
                        @foreach($medias as $media)
                            <tr>
                                <td>{{$media->id}}</td>
                                <td>
                                    @if($media->type == "image")
                                        <a href="#" onClick="app.mediaSelector.init({}, {{ $media->id }}); return false;">
                                            <img src="{{ Storage::url('medias/' . $media->stored_filename) }}" style="max-height: 80px"/>
                                        </a>
                                    @endif
                                </td>
                                <td>{{$media->uploaded_filename}}</td>
                                <td class="text-right">
                                    {!!
                                        Form::open([
                                            'url' => route('admin.content.medias.delete', $media),
                                            'method' => 'POST',
                                            'class' => 'toggle-delete'
                                        ])
                                    !!}
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Supprimer" class="btn btn-sm btn-danger" />
                                        <a href="#" onClick="app.mediaSelector.init({}, {{$media->id}}); return false;" class="btn btn-sm btn-success">Editer</a>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach()
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('javascripts-libs')
<script>
	var WEBROOT = "";
</script>
<!-- Vendors -->
{{ Html::script('/js/admin/content/contents/vendors/handlebars/handlebars.js') }}
{{ Html::script('/js/admin/content/contents/vendors/dropzone/dropzone.js') }}

<!-- TOASTR -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>

<!-- CROPPER -->
<script src="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.4/cropper.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.4/cropper.min.css"></link>

<!-- CMS libs -->
{{ Html::script('/js/admin/content/contents/app.js') }}
{{ Html::script('/js/admin/content/contents/app.modal.js') }}
{{ Html::script('/js/admin/content/contents/app.mediaselector.js') }}

@endpush

@push('javascripts')
<script>


var myDropzone = new Dropzone('.medias-dropfiles', {
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
            toastr.error(response);
        });
    }
});

myDropzone.on("totaluploadprogress", function(progress) {
    $(".progress-bar").parent().addClass("progress-striped active");
    $(".progress-bar").width(progress + "%");
    $(".progress-bar").html(progress + "%");
});

myDropzone.on("maxfilesreached", function() {
    toastr.error('Too many files added !');
});

myDropzone.on("dragenter", function() {
    $('.medias-dropfiles').addClass("active");
});

myDropzone.on("dragleave dragend dragover", function() {
    $('.medias-dropfiles').removeClass("active");
});

myDropzone.on("maxfilesexceeded", function(file) {
    toastr.error('File ' + file.name + ' is too big !');
});

/*
myDropzone.on("complete", function(file, response) {
    setTimeout(function(){
        $(".progress-bar").parent().removeClass("progress-striped active");
        $(".progress-bar").width("0%");
        $(".progress-bar").html("");
    }, 2000);
});
*/

myDropzone.on("queuecomplete", function(file, response) {
    setTimeout(function(){
        $(".progress-bar").parent().removeClass("progress-striped active");
        $(".progress-bar").width("0%");
        $(".progress-bar").html("");
    }, 2000);

    myDropzone.removeAllFiles(true);

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
                        html += '<img src="/storage/medias/' + value.stored_filename + '" style="max-height: 80px"/>';
                    html += '</td>';

                    html += '<td>';
                        html += value.uploaded_filename;
                    html += '</td>';


                    html += '<td align="right">';
                        html += '<form action="' + removeUrl.replace(':id', value.id) + '" method="POST" enctype="multipart/form-data" class="toggle-delete">';
                        html += '<input type="hidden" name="_token" value="{{ csrf_token() }}" />';
                        html += '<input type="hidden" name="_method" value="DELETE">';
                        html += '<input type="submit" value="Supprimer" class="btn btn-sm btn-danger" />';
                        html += '<a href="#" onClick="app.mediaSelector.init({}, ' + value.id + '); return false;" class="btn btn-sm btn-success">Editer</a>';
                        html += '</form>';
                    html += '</td>';

                html += '</tr>';

                $('#medias-rows').append(html);
                toogleDelete();
            });
       }
    });
});


myDropzone.on("success", function(file, response) {

    myDropzone.removeAllFiles(true);

    toastr.success('Votre fichier vient d\'être enregistré');

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

                toogleDelete();


            });
       }
    });
});

function toogleDelete() {
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

</script>
@endpush
