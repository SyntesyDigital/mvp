@extends('architect::layouts.master')

@section('content')
<div class="body medias">
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

    <div class="row">
        <div class="col-md-offset-1 col-md-10" style="margin-top:30px;">
            <div class="card">
				<div class="card-body">
                    <table class="table" id="table-medias" data-url="{{route('medias.data')}}">
                        <thead>
                           <tr>
                               {{-- <th>#</th> --}}
                               <th></th>
                               <th>Filename</th>
                               <th data-filter="select">Type</th>
                               <th></th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                           </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop




@push('plugins')
    {{ Html::script('/modules/architect/plugins/dropzone/dropzone.min.js') }}
    {{ HTML::style('/modules/architect/plugins/dropzone/dropzone.min.css') }}

    {{ Html::script('/modules/architect/plugins/datatables/datatables.min.js') }}
    {{ HTML::style('/modules/architect/plugins/datatables/datatables.min.css') }}

    {{ Html::script('/modules/architect/plugins/bootbox/bootbox.min.js') }}
    {{ Html::script('/modules/architect/js/libs/datatabletools.js') }}
    {{ Html::script('/modules/architect/js/libs/dialog.js') }}
    {{ Html::script('/modules/architect/js/libs/medias.js') }}
@endpush

@push('javascripts-libs')
<script>
    medias.init({
        'identifier' : '.medias-dropfiles',
        'table' : $('#table-medias'),
        'urls': {
            'index' : '{{ route('medias.index') }}',
            'store' : '{{ route('medias.store') }}',
            'show' : '{{ route('medias.show') }}',
            'delete' : '{{ route('medias.delete') }}',
            'update' : '{{ route('medias.update') }}'
        }
    })
</script>
@endpush

@push('stylesheets')

@endpush
