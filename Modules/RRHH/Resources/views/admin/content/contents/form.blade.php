@extends('architect::layouts.master')

@section('content')
<div class="body">
    <div class="row">
        {!!
            Form::open([
                'url' => isset($content)
                    ? route('admin.content.update', $content)
                    : route('admin.content.store'),
                'method' => 'POST'
            ])
        !!}

        <input type="hidden" name="id" value="{{ $content->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($content) ? 'PUT' : 'POST' }}">

        <input type="hidden" name="typology_id" value="{{ $content->typology_id or $typology->id }}" />

        <div class="col-md-7 col-md-offset-1 ">
            <!-- Tab panes -->
            <div class="tab-content">
                @foreach($languages as $i => $l)
                <div role="tabpanel" class="tab-pane @if($i == 0) active @endif" id="{{$l->iso}}">
                    <div class="card">
        				<div class="card-body">
                            <!--  <h3 class="card-title">{{$l->name}}</h3>
                          <h6 class="card-subtitle mb-2 text-muted">Le contenu de votre article en {{$l->name}}</h6>-->

                            <!-- DEFAULT FIELDS -->
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" id="title_{{$l->id}}" name="inputs[{{ $l->id }}][title]" class="form-control" value="@if(isset($content)){{ $content->getFieldValue('title', $l->id) }}@endif" />
                            </div>
                            <div class="form-group" style="position:relative">
                                <label>Slug (automatique)</label>
                                <input type="text" id="slug_{{$l->id}}" name="inputs[{{ $l->id }}][slug]" class="form-control" value="@if(isset($content)){{ $content->getFieldValue('slug', $l->id) }}@endif" />
                                <a href="#" id="edit-slug-{{$l->id}}" style="font-size:10px; position:absolute;top:35px;right:5px;">Modifier</a>
                            </div>

                            @push('javascripts-libs')
                            <script>
    							$("#slug_{{$l->id}}").css({pointerEvents:'none',backgroundColor:'#f3f3f3',color:'#b3b3b3'})
    							$("#edit-slug-{{$l->id}}").click(function(event){
    								$("#slug_{{$l->id}}").css({pointerEvents:'auto',backgroundColor:'#fff',color:'#000'})
    								$("#edit-slug-{{$l->id}}").fadeOut();
    							});
    						</script>
                            @endpush

                            @if(!isset($content))
                                @push('javascripts-libs')
                                    <script>
                                        $("#title_{{$l->id}}").change(function(event){
                                            $("#slug_{{$l->id}}").val(accentsTidy($("#title_{{$l->id}}").val()));
                                        });
                                    </script>
                                @endpush
                            @endif
                            @include('admin.content.contents.custom_fields', [
                                'content' => isset($content) ? $content : null,
                                'typology' => $typology,
                                'l' => $l
                            ])
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <input value="Enregistrer" type="submit" class="btn btn-success pull-right" />
        </div>

        <div class="col-md-3" style="margin-bottom:30px;">
            <div class="card">
				<div class="card-body">
                    <h3 class="card-title">Etat</h3>
    				<h6 class="card-subtitle mb-2 text-muted">Si votre articlé est publié ou en brouillon</h6>

                    <div class="form-group">
                        {!!
                            Form::select('status', [
                                '0' => 'Brouillon',
                                '1' => 'Publié'
                            ], isset($content) ? $content->status : null, [
                                'class' => 'form-control'
                            ])
                        !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3" style="margin-bottom:30px;">
            <div class="card">
				<div class="card-body">
                    <h3 class="card-title">Catégorie</h3>
    				<h6 class="card-subtitle mb-2 text-muted">La catégorie de votre article</h6>

                    <div class="">
                        {!!
                            Form::select('attributes[categories][]',
                                $categories,
                                isset($content) ? $content->getCategoriesIds() : null,
                                [
                                    'placeholder' => '---'
                                ]
                            )
                        !!}
                    </div>
                </div>
            </div>
        </div>

  {{--      <div class="col-md-3">
            <div class="card">
				<div class="card-body">
                    <h3 class="card-title">Langages</h3>
    				<h6 class="card-subtitle mb-2 text-muted">Les langues de votres articles</h6>

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
--}}

        {!! Form::close() !!}
    </div>

</div>
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
</script>

<script>
$('#myTabs a').click(function (e) {
    e.preventDefault()
   $(this).tab('show')
})
</script>
@endpush
