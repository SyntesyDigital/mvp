@extends('architect::layouts.master')
@php
  $allTags = App\Models\Tag::orderBy('name')->get()->pluck('name');
@endphp
@section('content')
<div class="body">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <div class="card">
				<div class="card-body">

                    <h3 class="card-title">Liste des candidats
                        <a href="{{route('admin.candidates.create')}}" class="pull-right btn btn-primary">
                            Ajouter un candidat
                        </a>
                    </h3>
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
                               <th data-filter="select" data-values="{!! base64_encode(json_encode(\App\Models\Offers\Candidate::getTypes())) !!}">Type</th>
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
        </div>
    </div>
</div>
@endsection

@push('javascripts-libs')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>

@endpush

@push('javascripts')
    <script>
    var csrf_token = "{{csrf_token()}}";
    var routes = {
        data : '{{ route("admin.candidates.data") }}',
    };
    var table_candidats = '';
    </script>


    <script>
      var atags = [];
      @foreach ($allTags as $at)
          atags.push('{{$at}}');
      @endforeach
    </script>

    {{ Html::script('js/libs/datatabletools.js')}}
    {{ Html::script('/js/admin/users/candidateslist.js') }}
    {{ Html::script('/js/textext.core.js') }}
    {{ Html::script('/js/textext.plugin.autocomplete.js') }}
    {{ Html::script('/js/textext.plugin.tags.js') }}
@endpush
