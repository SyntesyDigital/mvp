@extends('architect::layouts.master')

@php
  $allTags = Modules\RRHH\Entities\Tag::orderBy('name')->get()->pluck('name');
@endphp
@section('content')
<div class="container leftbar-page">

  @include('rrhh::admin.partials.offers-nav')

  <div class="col-xs-offset-2 col-xs-10 page-content">

          <h3 class="card-title">Liste des candidats</h3>
              <a href="{{route('rrhh.admin.candidates.create')}}" class="pull-right btn btn-primary">
                  Ajouter un candidat
              </a>

          <h6 class="card-subtitle mb-2 text-muted">Tous les candidats</h6>
          <div class="filter-tags-container">
            <div class="input-div">
              <label>Tags
              <textarea type="text" name="tags"  id="textarea" class="example" rows="1"></textarea>
              </label>
            </div>
           <br clear="all">

          </div>
          <br clear="all">
          <table class="table" id="table-candidates" style="width:100%">
                        <thead>
                           <tr>
                               <th>#</th>
                               <th>Nom</th>
                               <th data-filter="select" data-values="{!! base64_encode(json_encode(\App\Models\User::getStatus())) !!}">Etat</th>
                               <th>Code postal</th>
                               <th>Localisation</th>
                               <th data-filter="select" data-values="{!! base64_encode(json_encode(\Modules\RRHH\Entities\Offers\Candidate::getTypes())) !!}">Type</th>
                               {{-- <th data-filter="select" data-values="{!! base64_encode(json_encode(\App\Models\User::getStatus())) !!}">Etat</th> --}}
                               <th></th>
                           </tr>
                        </thead>
                        <tfoot>
                           <tr>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                               <th></th>
                           </tr>
                        </tfoot>
                    </table>
    </div>
</div>
@endsection


@push('javascripts-libs')
    <!-- Datatables -->
    {{ Html::style('/modules/rrhh/plugins/datatables/datatables.min.css') }}
    {{ Html::script('/modules/rrhh/plugins/datatables/datatables.min.js') }}
    {{ Html::script('/modules/architect/js/libs/datatabletools.js') }}
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js') }}
@endpush

@push('javascripts')
    <script>
        var csrf_token = "{{csrf_token()}}";
        var routes = {
            data : '{{ route("rrhh.admin.candidates.data") }}',
        };
        var atags = [];

        @foreach ($allTags as $at)
            atags.push('{{$at}}');
        @endforeach
    </script>

    {{ Html::script('/modules/rrhh/js/admin/users/candidateslist.js') }}
    {{ Html::script('/modules/rrhh/js/textext.core.js') }}
    {{ Html::script('/modules/rrhh/js/textext.plugin.autocomplete.js') }}
    {{ Html::script('/modules/rrhh/js/textext.plugin.tags.js') }}

@endpush
