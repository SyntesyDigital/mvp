@extends('architect::layouts.master')

@section('content')


<div class="row">
    {!!
        Form::open([
            'id'  => 'form-filelist',
            'url' => route('admin.tools.filelist.update', $filelist->id),
            'method' => 'POST',
            'enctype' => 'multipart/form-data'
        ])
    !!}

        <input type="hidden" name="id" value="{{ $filelist->id }}" />
        <input type="hidden" name="_method" value="{{ isset($filelist) ? 'PUT' : 'POST' }}">
        <input type="hidden" name="name" value="{{ $filelist->name }}">
        <input type="hidden" name="identifier" value="{{ $filelist->identifier }}">

        <div class="col-md-offset-1 col-md-6">
            <div class="card">
                <div class="card-body jsonbuilder">
                    <h3 class="card-title">Liste des documents</h3>
    				<!--h6 class="card-subtitle mb-2 text-muted">Ajoutez les champs que vous souhaitez</h6-->
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="tabs"></ul>
                            <div class="content-field-dropper"  ondrop="app.filelist.drop(event)" ondragover="app.filelist.dragover(event)" >

                            </div>
                            <br>
                        </div>
                    </div>
                    <input type="hidden" name="value" class="form-control" rows="20" value="{{ $filelist->value or '' }}">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-ajouter">
                <div class="card-body">
                    <h3 class="card-title" id="title">Ajouter un fichier</h3>

                    <div class="form-group">
                        <input type="text" class="form-control fichier-field" id="filename" name="filename" placeholder="Nom du document" value="">
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="filetype" id="filetype" class="form-control">
                            <option value="feuilles">Feuilles d'heures</option>
                            <option value="demande">Demande de congés</option>
                            <option value="livret">Livret d'accueil</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="margin-right: 20px;">Visible</label>
                        <div class="radio" style="display: inline;">
                            <label style="font-size: .8em">
                                <input type="radio" name="visible" value="1" checked>OUI
                            </label>
                            <label style="font-size: .8em">
                                <input type="radio" name="visible" value="0">NON
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="filenum" class="fichier-field" id="filenum" value="" />
                    <input type="hidden" name="fileurl" class="fichier-field" id="fileurl" value="" />
                    <input type="hidden" name="filedate" class="fichier-field" id="filedate" value="" />

                    <div class="medias-dropfiles dz-div">
                        <p align="center">
                            <strong>Déposez votre fichier</strong> <br />
                            <small>ou cliquez ici</small>
                        <p>
                    </div>

                    <div class="progress dz-div">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <span class="sr-only">70% Complete</span>
                      </div>
                    </div>
                    <small id="filename-p"></small>
                    <input value="Sauvegarder" type="button" onclick="app.filelist.addEditFile()" class="btn btn-primary pull-right " />
                </div>
            </div>
        </div>

    {{ Form::close()}}

</div>
@endsection

@push('javascripts-libs')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>
@endpush

@push('javascripts')

    {{ Html::script('/js/admin/content/contents/vendors/dropzone/dropzone.js') }}

    {{ Html::script('/js/admin/tools/app.js') }}
    {{ Html::script('/js/admin/tools/app.filelist.js') }}
    <script type="text/javascript">
        var token = "{{ csrf_token() }}";

        $( document ).ready(function() {
            app.filelist.init();
        });
    </script>
@endpush
