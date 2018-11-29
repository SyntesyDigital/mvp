@extends('architect::layouts.master')

@section('content')

<div class="row">
    {!!
        Form::open([
            'url' => isset($agence)
                ? route('admin.agences.update', $agence)
                : route('admin.agences.store'),
            'method' => 'POST',
            'class' => 'check-inactive-agence-form'
        ])
    !!}

        <input type="hidden" name="id" value="{{ $agence->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($agence) ? 'PUT' : 'POST' }}">

        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Edition agence : {{ isset($agence) ? $agence->name :'' }}</h3>

                    <div class="form-group">
                        {!!Form::label('name', 'Nom')!!}
                        {!!
                            Form::text('name', isset($agence->name)? $agence->name:'', [
                                'class' => 'form-control',
                                'id' => 'name'
                            ])
                        !!}
                    </div>

                     <div class="form-group" style="position:relative">
                        {!!Form::label('slug', 'Slug (automatique')!!}
                        {!!
                            Form::text('slug', isset($agence->slug)? $agence->slug:'', [
                                'class' => 'form-control',
                                'id' => 'slug'
                            ])
                        !!}
                        <a href="#" id="edit-slug" style="font-size:10px; position:absolute;top:35px;right:5px;">Modifier</a>
                    </div>

                    <div class="form-group">
                        {!!Form::label('content', 'Contenu')!!}
                        {!!
                            Form::textarea('content',  isset($agence->content) ? $agence->content:'', [
                                'class' => 'form-control',
                                'rows' => 3,
                                'id' => 'content_editor'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('meta_title', 'Meta Titre')!!}
                        {!!
                            Form::text('meta_title', isset($agence->meta_title)? $agence->meta_title:'', [
                                'class' => 'form-control',
                                'id' => 'meta_title'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('meta_description', 'Meta Description')!!}
                        {!!
                            Form::textarea('meta_description',  isset($agence->meta_description) ? $agence->meta_description:'', [
                                'class' => 'form-control',
                                'rows' => 3,
                                'id' => 'meta_description'
                            ])
                        !!}
                    </div>


                    <div class="form-group">
                        {!!Form::label('email', 'E-mail')!!}
                        {!!
                            Form::text('email', isset($agence->email)? $agence->email:'', [
                                'class' => 'form-control',
                                'id' => 'email'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('phone', 'Telephone')!!}
                        {!!
                            Form::text('phone', isset($agence->phone)? $agence->phone:'', [
                                'class' => 'form-control',
                                'id' => 'phone'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('fax', 'Fax')!!}
                        {!!
                            Form::text('fax', isset($agence->fax)? $agence->fax:'', [
                                'class' => 'form-control',
                                'id' => 'fax'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('address', 'Adresse')!!}
                        {!!
                            Form::text('address', isset($agence->address)? $agence->address:'', [
                                'class' => 'form-control',
                                'id' => 'address'
                            ])
                        !!}
                    </div>

                     <div class="form-group">
                         <div class="form-group">
                            <div class="location-box">
                                <label>Emplacement</label>
                                <div id="map-container">
                                </div>
                            </div>
                         </div>
                    </div>
                    <input type="hidden" class="form-control" id="latitude" name="latitude" value="{{ isset($agence) && $agence->latitude?$agence->latitude:''}}">
                    <input type="hidden" class="form-control" id="longitude" name="longitude" value="{{ isset($agence) && $agence->longitude?$agence->longitude:''}}">

                    <div class="form-group">
                        {!!Form::label('postal_code', 'Code Postal')!!}
                        {!!
                            Form::text('postal_code', isset($agence->postal_code) ?$agence->postal_code:'', [
                                'class' => 'form-control',
                                'id' => 'postal_code'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        <label for="name">Image</label>

                        @if(isset($agence) && $agence->image != '')
                            <?php $display_1 = 'display:none'; ?>
                            <!--small class="filename-small" id="filename-p_1">
                                <i class='fa fa-file'>
                                    <a href="/storage/agences/{{  $agence->image }}" target="_blank">{{ $agence->image }}</a>
                                </i>

                            </small-->
                            <div class="img-preview" id="filename-p_1">
                                <a href="{{ Storage::url('agences/' . $agence->image) }}" target="_blank">
                                <img src="{{ Storage::url('agences/' . $agence->image) }}" style="max-width:300px;" />
                                </a>
                                 <i class='fa fa-remove remove-file-click' onclick="deleteFile('1')"></i>
                            </div>
                        @else
                            <?php $display_1 = ''; ?>
                            <small class="filename-small" id="filename-p_1"></small>
                        @endif

                        <div class="medias-dropfiles medias-dropfiles_1 dz-div dz-div_1" style="{{ $display_1 }}">
                            <p align="center">
                                <strong>Déposez vos fichiers</strong> <br />
                                <small>ou cliquez-ici</small>
                            <p>
                        </div>
                        <div class="progress dz-div dz-div_1" style="{{ $display_1 }}">
                            <div class="progress-bar progress-bar_1" role="progressbar" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">70% Complete</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="image" name="image" value="{{ $agence->image or '' }}" >

                    <input value="Sauvegarder" type="submit" class="btn btn-success pull-right" />
                </div>
            </div>
        </div>

    {{ Form::close()}}
</div>
    @if(isset($agence))
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                {!!
                    Form::open([
                        'url' => route('admin.agences.delete', $agence->id),
                        'method' => 'POST',
                        'class' => 'delete-agence-form'
                    ])
                !!}
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" value="Supprimer cette agence" class="btn btn-danger" />
                {{ Form::close() }}
            </div>
        </div>
    @endif

@endsection

@push('javascripts-libs')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>
    {{ Html::script('/js/admin/content/contents/vendors/ckeditor/ckeditor.js') }}

{{ Html::script('/js/admin/content/contents/app.js') }}
{{ Html::script('/js/admin/content/contents/app.modal.js') }}
{{ Html::script('/js/admin/content/contents/app.editor.js')}}
@endpush


@push('javascripts')
    {{ Html::script('/js/admin/content/contents/vendors/dropzone/dropzone.js') }}

    @if(isset($agence))
        <script>
            var routes = {
                data : '{{ route("rrhh.admin.agences.data",  $agence) }}',
            };
        </script>
    @endif
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

        var csrf_token = "{{csrf_token()}}";
        var routes = '';

        $("#slug").css({pointerEvents:'none',backgroundColor:'#f3f3f3',color:'#b3b3b3'})
        $("#edit-slug").click(function(event){
            $("#slug").css({pointerEvents:'auto',backgroundColor:'#fff',color:'#000'})
            $("#edit-slug").fadeOut();
        });

    </script>

    @if(!isset($agence))
        <script>
            $("#name").change(function(event){
                $("#slug").val(accentsTidy($("#name").val()));
            });
        </script>
    @endif

     <script type="text/javascript">
            $(document).ready(function() {
                app.editor.init('content_editor', {
                    height: '300px',
                    toolbarGroups :  [
                        {"name":"basicstyles","groups":["basicstyles"]},
                        {"name":"links","groups":["links"]},
                        {"name":"paragraph","groups":["list","blocks"]},
                        {"name":"document","groups":["mode"]},
                        {"name":"styles","groups":["styles"]},
                        {"name":"architect","groups":["architect"]},
                    ],
                    removeButtons : 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
                    allowedContent: true
                });
            });
        </script>


    <script>
        var geocoder;
        var map;
        var marker;

        function ModifyUbicacion(){
            $('#latitude').val(marker.position.lat());
            $('#longitude').val(marker.position.lng());
        }

        $(document).ready(function() {
            geocoder = new google.maps.Geocoder();
            var input = /** @type {HTMLInputElement} */(
                document.getElementById('address'));
            var autocomplete = new google.maps.places.Autocomplete(input);

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                codeAddress();
            });

        });

        function initMap() {

            var lat_init = {{ isset($agence) && $agence->latitude != null ? $agence->latitude: 48.858344}};
            var lat_lng = {{ isset($agence) && $agence->longitude != null ? $agence->longitude: 2.294331}};

            var uluru = {lat: lat_init , lng: lat_lng };
            map = new google.maps.Map(document.getElementById('map-container'), {
              zoom: 9,
              center: uluru
            });
            marker = new google.maps.Marker({
              position: uluru,
              map: map,
              draggable: true
            });
            google.maps.event.addListener(marker, 'dragend', function(event) {
                ModifyUbicacion();
            });
            ModifyUbicacion();
        }

        function codeAddress() {
            var address = document.getElementById("address").value;
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    map.setZoom(9);
                    ModifyUbicacion();
                }else{
                    alert("Imposible to find");
                }
            });
        }


    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0CzJSBdXh-eWh6oFWMLFhIJaU2RSfZIw&callback=initMap&language=fr&libraries=places">
</script>



    {{ Html::script('/js/admin/agences/agencesform.js') }}
@endpush
