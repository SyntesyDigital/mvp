@extends('architect::layouts.master')

@section('content')
{!!
    Form::open([
        'url' => isset($sitelist)
            ? route('rrhh.admin.sitelists.update', $sitelist->id)
            : route('rrhh.admin.sitelists.store'),
        'method' => 'POST'
    ])
!!}

{{ Form::hidden('id', isset($sitelist) ? $sitelist->id : null) }}
{{ Form::hidden('_method', isset($sitelist) ? 'PUT' : 'POST') }}

<div class="page-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('rrhh.admin.sitelists.index')}}" class="btn btn-default">
                    <i class="fa fa-angle-left"></i>
                </a>

                <h1>
                    <i class="fa fa-reorder"></i> Listes
                </h1>

                <div class="float-buttons pull-right">
                    {!!
                        Form::submit(Lang::get('architect::fields.save'), [
                            'class' => 'btn btn-primary'
                        ])
                    !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container rightbar-page sitelist">

    {{-- RIGHT COLUMN --}}
      <div class="col-md-9 page-content">
          <div class="card-body jsonbuilder">
            <h3 class="card-title">Définition de la liste</h3>
            <ul class="tabs"></ul>
                <div class="content-field-dropper"  ondrop="app.sitelist.drop(event)" ondragover="app.sitelist.dragover(event)" ></div>
                {!!
                    Form::hidden('value', isset($sitelist) ? $sitelist->value : null, [
                        'rows' => 20,
                        'class' => 'form-control'
                    ])
                !!}
          </div>
      </div>

  {{-- SIDEBAR --}}
      <div class="sidebar">
          <a href="#" class="btn btn-primary" id="ajouter" onclick="app.sitelist.addNewElement()">
              Ajouter un element à la liste
          </a>
          <hr />
          {{-- <div class="dashed-border" id="ajouter" onclick="app.sitelist.addNewElement()">
              <h3 class="text-center"><b>Ajouter un element</b></h3>
          </div> --}}

          <div class="form-group">
              <label for="name">Titre</label>
              {!!
                  Form::text('name', isset($sitelist) ? $sitelist->name : null, [
                      'oninput' => 'app.sitelist.updatePreview();',
                      'class' => 'form-control',
                      'id' => 'name'
                  ])
              !!}
          </div>

          <div class="form-group">
             <label for="name">Identifiant</label>
             {!!
                 Form::text('identifier', isset($sitelist) ? $sitelist->identifier : null, [
                     'oninput' => 'app.sitelist.updatePreview();',
                     'class' => 'form-control',
                     'id' => 'identifier',
                     'readonly' => 'readonly'
                 ])
             !!}
          </div>

          <div class="form-group">
              <label for="type">Type de liste</label>
              {!!
                  Form::select('type', [
                      'select' => 'Select',
                      'checkbox' => 'Checkbox',
                      'radios' => 'Radios',
                  ], $sitelist->type, [
                      'onchange' => 'app.sitelist.updatePreview();',
                      'class' => 'form-control',
                      'id' => 'type',
                  ])
              !!}
          </div>

          <hr />
          <h3>Prévisualisation</h3>
          <div id="preview"></div>

          {{ Form::close()}}
          <hr />

          <div class="form-group">
              {!!
                  Form::open([
                      'url' => route('rrhh.admin.sitelists.delete', $sitelist->id),
                      'method' => 'POST',
                      'class' => 'delete-sitelist-form'
                  ])
              !!}
              <input type="hidden" name="_method" value="DELETE">
              <input type="submit" value="Supprimer cette liste" class="btn btn-sm btn-danger" />
              {{ Form::close() }}
          </div>
      </div>

</div>


@endsection


@push('javascripts')
    <script>
    var architect_content = {!! isset($sitelist) && $sitelist->definition != "" ? $sitelist->definition:'[]' !!};
    </script>
    {{ Html::script('/modules/rrhh/js/admin/tools/app.js') }}
    {{ Html::script('/modules/rrhh/js/admin/tools/app.sitelist.js') }}
    <script type="text/javascript">
        $( document ).ready(function() {
            app.sitelist.init();
        });
    </script>
@endpush
