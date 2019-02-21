@extends('architect::layouts.master')

@section('content')

{!!
    Form::open([
        'url' => isset($category)
            ? route('admin.content.categories.update', $category)
            : route('admin.content.categories.store'),
        'method' => 'POST'
    ])
!!}

<input type="hidden" name="id" value="{{ $category->id or '' }}" />
<input type="hidden" name="_method" value="{{ isset($category) ? 'PUT' : 'POST' }}">

<div class="col-md-7 col-md-offset-1">
    <!-- Tab panes -->
    <div class="tab-content">
        @foreach($languages as $i => $l)
        <div role="tabpanel" class="tab-pane @if($i == 0) active @endif" id="{{$l->iso}}">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{$l->name}}</h3>
                    <h6 class="card-subtitle mb-2 text-muted">Le titre de la catégorie en {{$l->name}}</h6>

                    <!-- DEFAULT FIELDS -->
                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" id="name_{{$l->id}}" name="inputs[{{ $l->id }}][name]" class="form-control" value="@if(isset($category)){{ $category->getFieldValue('name', $l->id) }}@endif" />
                    </div>

                    <div class="form-group" style="position:relative">
                        <label>Slug (automatique)</label>
                        <input type="text" id="slug_{{$l->id}}" name="inputs[{{ $l->id }}][slug]" class="form-control" value="@if(isset($category)){{ $category->getFieldValue('slug', $l->id) }}@endif" />
                        <a href="#" id="edit-slug-{{$l->id}}" style="font-size:10px; position:absolute;top:35px;right:5px;">Modifier</a>
                    </div>

                    @push('javascripts-libs')
                    <script>
                        $("#slug_{{$l->id}}").css({pointerEvents:'none',backgroundColor:'#f3f3f3',color:'#b3b3b3'})
                        $("#edit-slug-{{$l->id}}").click(function(event){
                            $("#slug_{{$l->id}}").css({pointerEvents:'auto',backgroundColor:'#fff',color:'#000'})
                            $("#edit-slug-{{$l->id}}").fadeOut();
                        });
                        $("#name_{{$l->id}}").change(function(event){
                            $("#slug_{{$l->id}}").val(accentsTidy($("#name_{{$l->id}}").val()));
                        });
                    </script>
                    @endpush

                    <!-- IMAGE FIELD -->
                    <div class="form-group">
                        <label>Image</label>
                        <div>

                            <a href="#" class="btn btn-sm btn-success image-toogle">Ajouter</a>
                            <a href="#" class="btn btn-sm btn-warning image-toogle-remove">Supprimer</a>

                            <input type="hidden" name="inputs[{{ $l->id }}][image]" value="@if(isset($category)){{ $category->getFieldValue('image', $l->id) }}@endif" class="form-control"  />

                            <table class="table table-striped table-hover" id="crosslinks-table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="img-preview">

                                    @if(isset($category))
                                        @if($category->getFieldValue('image', $l->id))
                                          <tr>
                                            <td width="100" height="100">
                                                <img width="200px;" height="auto" src="{{ env('MEDIA_PATH') }}{{ $category->getFieldValue('image', $l->id) }}" />
                                            </td>
                                            <td>
                                                {{ $category->getFieldValue('image', $l->name) }}
                                            </td>
                                            <td width="100">
                                                <a href="#" data-remove="inputs[{{ $l->id }}][image]" class="btn image-toogle-remove">Remove</a>
                                            </td>
                                          </tr>
                                        @endif
                                     @endif
                                 </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- END IMAGE FIELD -->


                    <!-- DESCRIPTION FIELD -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="inputs[{{ $l->id }}][description]" class="form-control">@if(isset($category)){{ $category->getFieldValue('description', $l->id) }}@endif</textarea>
                    </div>
                    <!-- END DESCRIPTION FIELD -->

                </div>
            </div>
        </div>
        @endforeach()
    </div>

    <input value="Enregistrer" type="submit" class="btn btn-success pull-right" />
</div>


<div class="col-md-3" >

    <!-- IDENTIFIER -->
    <div class="card" style="margin-bottom:30px;">
        <div class="card-body">
            <h3 class="card-title">Identifiant</h3>
            <h6 class="card-subtitle mb-2 text-muted">Obligatoire et alpha-numérique</h6>

            <div class="form-group">
                {!!
                    Form::text('identifier', isset($category) ? $category->identifier : null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ex: category_1'
                    ])
                !!}
            </div>
        </div>
    </div>

    <!-- STATUS -->
    <div class="card"  style="margin-bottom:30px;">
        <div class="card-body">
            <h3 class="card-title">Etat</h3>
            <h6 class="card-subtitle mb-2 text-muted">Si votre catégorie est publié ou en brouillon</h6>

            <div class="form-group">
                {!!
                    Form::select('status', [
                        '0' => 'Brouillon',
                        '1' => 'Publié'
                    ], isset($category) ? $category->status : null, [
                        'class' => 'form-control'
                    ])
                !!}

            </div>
        </div>
    </div>

    <!-- TYPOLOGY -->
    <div class="card" style="margin-bottom:30px;">
        <div class="card-body">
            <h3 class="card-title">Typologie</h3>
            <h6 class="card-subtitle mb-2 text-muted">Obligatoire</h6>

            <div class="form-group">
                {!!
                    Form::select('typology_id',
                        App\Models\Content\Typology::pluck('name', 'id'),
                        isset($category) ? $category->typology_id : null,
                        [
                            'class' => 'form-control',
                            'placeholder' => 'Choissisez une typologie'
                        ]
                    )
                !!}
            </div>
        </div>
    </div>

    <!-- LANGUAGES -->
    <div class="card" style="margin-bottom:30px;">
        <div class="card-body">
            <h3 class="card-title">Langages</h3>
            <h6 class="card-subtitle mb-2 text-muted">Les langues de cette catégorie</h6>

            <ul class="nav content-nav" role="tablist">
                @foreach($languages as $i => $l)
                <li role="presentation" class=" @if($i == 0) active @endif">
                    <a href="#{{ $l->iso }}" aria-controls="{{ $l->name }}" role="tab" data-toggle="tab">{{ $l->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>






{!! Form::close() !!}

@endsection


@push('javascripts-libs')

<script>
	var WEBROOT = "";
</script>

<!-- Moment -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>

<!-- Vendors -->
{{ Html::script('/js/admin/content/contents/vendors/handlebars/handlebars.js') }}
{{ Html::script('/js/admin/content/contents/vendors/dropzone/dropzone.js') }}
{{ Html::script('/js/admin/content/contents/vendors/ckeditor/ckeditor.js') }}

<!-- CROPPER -->
<script src="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.4/cropper.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/cropper/3.1.4/cropper.min.css"></link>

<!-- CMS libs -->
{{ Html::script('/js/admin/content/contents/app.js') }}
{{ Html::script('/js/admin/content/contents/app.modal.js') }}
{{ Html::script('/js/admin/content/contents/app.editor.js') }}
{{ Html::script('/js/admin/content/contents/app.mediaselector.js') }}
{{ Html::script('/js/admin/content/contents/app.contentfield.js') }}

<!-- TOASTR -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>



<!-- DATETIMEPICKER -->
{{ Html::style('/js/admin/content/contents/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}
{{ Html::script('/js/admin/content/contents/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}

<script>

function accentsTidy(s){
    var r = s.toLowerCase();
    //r = r.replace(new RegExp("\\s", 'g'),"");
    r = r.replace(new RegExp("[àáâãäå]", 'g'),"a");
    r = r.replace(new RegExp("æ", 'g'),"ae");
    r = r.replace(new RegExp("ç", 'g'),"c");
    r = r.replace(new RegExp("[èéêë]", 'g'),"e");
    r = r.replace(new RegExp("[ìíîï]", 'g'),"i");
    r = r.replace(new RegExp("ñ", 'g'),"n");
    r = r.replace(new RegExp("[òóôõö]", 'g'),"o");
    r = r.replace(new RegExp("œ", 'g'),"oe");
    r = r.replace(new RegExp("[ùúûü]", 'g'),"u");
    r = r.replace(new RegExp("[ýÿ]", 'g'),"y");
    r = r.replace(new RegExp("\\W", 'g'),"-");
    r = r.replace(/\-\-+/g, '-') // Replace multiple - with single -
    
    return r;
};

$(".image-toogle-remove").on('click',function(e){
    e.preventDefault();
    $(this).parent().find('input').val("");
    $(this).parent().find('.img-preview').empty();
});

$('.image-toogle').on("click", function(e){
    e.preventDefault();

    var el = $(this);

    app.mediaSelector.init({
        onSubmit : function(obj) {

            if(app.mediaSelector.isCropped) {
                app.mediaSelector.image.cropper('getCroppedCanvas').toBlob(function (blob) {

                    var formData = new FormData();
                    formData.append('file', blob);
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    console.log('croppted');

                    $.ajax(app.mediaSelector.URLs.post, {
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            el.find('input[type="hidden"]').val(response.stored_filename);

                            $(document).trigger("mainImageSelected", [response]);

                            var imagePreview = '<tr><td width="100" height="100">';
                            imagePreview  += '<img width="200px;" height="auto" src="/storage/medias/' + response.stored_filename + '" />';
                            imagePreview  += '</td><td></td><td width="100"></tr>';

                            el.parent().find('.img-preview').html(imagePreview);

                            app.mediaSelector.close();
                        },
                        error: function () {
                            console.log('Upload error');
                        }
                    });
                });

                return;
            } else {
                el.parent().find('input[type="hidden"]').val(obj.file);

                $(document).trigger("mainImageSelected", [obj]);

                var imagePreview = '<tr><td width="100" height="100">';
                imagePreview  += '<img width="200px;" height="auto" src="/storage/medias/' + obj.file + '" />';
                imagePreview  += '</td><td></td><td width="100"></tr>';

                el.parent().find('.img-preview').html(imagePreview);

                app.mediaSelector.close();
            }
        }
    });
});

$('#myTabs a').click(function (e) {
    e.preventDefault()
   $(this).tab('show')
})
</script>
@endpush

@section('javascripts')
@endsection
