@extends('architect::layouts.master')

@section('content')

<!-- React Component Medias/MediaEditModal -->
<div id="media-edit-modal"></div>

<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">{{ __('List of media') }}</h3>
    				<h6 class="card-subtitle mb-2 text-muted">{{ __('All content media can be found here.') }}</h6>

                    <div class="medias-dropfiles">
                        <p align="center">
                            <strong>{{ __('Put your file here') }}</strong> <br />
                            <small>{{ __('or click') }}</small>
                        <p>
                    </div>

                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width:0%">
                        <span class="sr-only"></span>
                      </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    medias.init({
        'identifier' : '.medias-dropfiles',
        'urls': {
            'store' : '{{ route('medias.store') }}',
            'show' : '{{ route('medias.show') }}',
            'delete' : '{{ route('medias.delete') }}',
            'update' : '{{ route('medias.update') }}',
        }
    })
</script>

@stop

@push('javascripts-libs')
    {{ Html::script('/modules/architect/plugins/dropzone/dropzone.min.js') }}
    {{ Html::script('/modules/architect/js/libs/medias.js') }}
@endpush

@push('stylesheets')
    {{ HTML::style('/modules/architect/plugins/dropzone/dropzone.min.css') }}
@endpush
