@extends('architect::layouts.master')

@section('content')

<div class="row">
    {!!
        Form::open([
            'url' => isset($sitelist)
                ? route('admin.tools.sitelists.update', $sitelist->id)
                : route('admin.tools.sitelists.store'),
            'method' => 'POST'
        ])
    !!}

        <input type="hidden" name="id" value="{{ $sitelist->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($sitelist) ? 'PUT' : 'POST' }}">

        <div class="col-md-offset-1 col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Détail de la liste</h3>

                    <div class="form-group">
                        <label for="name">Titre</label>
                        <input type="text" class="form-control" oninput="app.sitelist.updatePreview();" id="name" name="name" placeholder="" value="{{ $sitelist->name or '' }}">
                    </div>
                    <div class="form-group">
                       <label for="name">Identifiant</label>
                       <input type="text" class="form-control" oninput="app.sitelist.updatePreview();" id="identifier" name="identifier" placeholder="" value="{{ $sitelist->identifier or '' }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="type">Type de liste</label>
                        <select name="type" id="type" class="form-control" onchange="app.sitelist.updatePreview()">
                            <option value="select" @if(isset($sitelist)) @if($sitelist->type == 'select') selected @endif @endif>Select</option>
                            <option value="checkbox" @if(isset($sitelist)) @if($sitelist->type == 'checkbox') selected @endif @endif>Checkbox</option>
                            <option value="radios" @if(isset($sitelist)) @if($sitelist->type == 'radios') selected @endif @endif>Radios</option>
                        </select>
                    </div>


                    <div class="dashed-border">
                        <h6><b>Prévisualisation</b></h6>
                        <div id="preview">

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-body jsonbuilder">
                    <h3 class="card-title">Définition de la site list</h3>
    				<!--h6 class="card-subtitle mb-2 text-muted">Ajoutez les champs que vous souhaitez</h6-->
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="tabs"></ul>
                            <div class="content-field-dropper"  ondrop="app.sitelist.drop(event)" ondragover="app.sitelist.dragover(event)" >

                            </div>
                             <!--div class="dashed-border" id="ajouter" onclick="app.sitelist.addNewElement()">
                                <h2 class="text-center"><b>+ Ajouter</b></h2>
                            </div-->
                        </div>
                        <div class="col-md-4">
                            <div class="dashed-border" id="ajouter" onclick="app.sitelist.addNewElement()">
                                <h2 class="text-center"><b>+ Ajouter</b></h2>
                            </div>
                        </div>



                    </div>
                    <input type="hidden" name="value" class="form-control" rows="20" value="{{ $sitelist->value or '' }}">
                    <input value="Enregistrer" type="submit" class="btn btn-success pull-right" />
                </div>
            </div>
        </div>

    {{ Form::close()}}
</div>
@if(isset($sitelist))
  {{--  <div class="row">
        <div class="col-md-offset-1 col-md-10">
            {!!
                Form::open([
                    'url' => route('admin.tools.sitelists.delete', $sitelist->id),
                    'method' => 'POST',
                    'class' => 'delete-sitelist-form'
                ])
            !!}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Supprimer cette liste" class="btn btn-danger" />
            {{ Form::close() }}
        </div>
    </div>--}}
@endif

@endsection


@push('javascripts')
    <script>
    var architect_content = {!! isset($sitelist) && $sitelist->definition != "" ? $sitelist->definition:'[]' !!};
    </script>
    {{ Html::script('/js/admin/tools/app.js') }}
    {{ Html::script('/js/admin/tools/app.sitelist.js') }}
    <script type="text/javascript">
        $( document ).ready(function() {
            app.sitelist.init();
        });
    </script>
@endpush
