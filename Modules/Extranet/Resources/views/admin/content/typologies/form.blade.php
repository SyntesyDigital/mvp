@extends('architect::layouts.master')

@section('content')

@if(isset($typology))
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            {!!
                Form::open([
                    'url' => route('admin.content.typologies.delete', $typology->id),
                    'method' => 'POST'
                ])
            !!}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Supprimer cette typologie" class="btn btn-danger" />
            {{ Form::close() }}
        </div>
    </div>
@endif

<div class="row">
    {!!
        Form::open([
            'url' => isset($typology)
                ? route('admin.content.typologies.update', $typology->id)
                : route('admin.content.typologies.store'),
            'method' => 'POST'
        ])
    !!}

        <input type="hidden" name="id" value="{{ $typology->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($typology) ? 'PUT' : 'POST' }}">

        <div class="col-md-offset-1 col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Nouvelle typologie</h3>
    				<h6 class="card-subtitle mb-2 text-muted">Information de la typologie</h6>

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{ $typology->name or '' }}">
                    </div>
                   <div class="form-group">
                       <label for="name">Identifiant</label>
                       <input type="text" class="form-control" id="identifier" name="identifier" placeholder="" value="{{ $typology->identifier or '' }}">
                   </div>

                   <div class="form-group">
                       <label for="name">Afficher dans le menu</label>
                       <select name="display_menu" class="form-control">
                           <option value="0" @if(isset($typology)) @if($typology->display_menu == 0) selected @endif @endif>No</option>
                           <option value="1" @if(isset($typology)) @if($typology->display_menu == 1) selected @endif @endif>Yes</option>
                       </select>
                   </div>

                   <div class="form-group">
                      <label for="name">Personalisable depuis le contenu</label>
                      <select name="customizable" class="form-control">
                          <option value="0" @if(isset($typology)) @if($typology->customizable == 0) selected @endif @endif>No</option>
                          <option value="1" @if(isset($typology)) @if($typology->customizable == 1) selected @endif @endif>Yes</option>
                      </select>
                  </div>

                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-body jsonbuilder">
                    <h3 class="card-title">Définition de la typologie</h3>
    				<h6 class="card-subtitle mb-2 text-muted">Ajoutez les champs que vous souhaitez</h6>
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="tabs">
                                <li class="tab-visual active" onclick="toggleEditor('visual')">Visual</li>
                                <li class="tab-json" onclick="toggleEditor('json')">Json</li>
                            </ul>
                            <div class="content-field-dropper" ondrop="drop(event)" ondragover="allowDrop(event)" >

                            </div>
                             <div class="content-json-editor">
                                <textarea id="jsonviewer" name="definition"  class="form-control" rows="10" >{{ $typology->definition or '' }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="content-field-list">
                                <ul>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="text"><i class="fa fa-i-cursor"></i>Text string</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="richtext"><i class="fa fa-file-text-o"></i>Rich text</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="date"><i class="fa fa-calendar"></i>Date</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="image"><i class="fa fa-image"></i>Image</li>
                                    {{-- <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="images"><i class="fa fa-th"></i>Image gallery</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="select"><i class="fa fa-cube"></i>Selector</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="select-multiple"><i class="fa fa-cubes"></i>Multiple selector</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="array-content"><i class="fa fa-sitemap"></i>Grouped content</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="titletextimage"><i class="fa fa-newspaper-o"></i>Title, text &amp; image</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="map"><i class="fa fa-map-o"></i>Map</li>
                                    <li draggable="true" ondragstart="drag(event)"  class="content-field-item" aria-data="map-story"><i class="fa fa-map-marker"></i>Map story</li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <textarea type="hidden" name="definition" class="form-control" rows="20" value="{{ $typology->definition or '' }}"></textarea> --}}
                    <input value="Enregistrer" type="submit" class="btn btn-success pull-right" />
                </div>
            </div>
        </div>

    {{ Form::close()}}
</div>
@endsection


@push('javascripts')
    <script>
    var architect_content = {!! isset($typology) && $typology->definition != "" ? $typology->definition:'[]' !!};
    </script>
    {{ Html::script('/js/admin/content/typologies/form.js') }}
@endpush
