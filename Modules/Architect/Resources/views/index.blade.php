@extends('architect::layouts.master')

@section('content')
<div class="container dashboard">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">

      <div class="page-title">
        <h1>Benvingut {{Auth::user()->firstname}},</h1>
        <h3>Visualitza l'estat actual de les diferents seccions del portal</h3>
      </div>

      <div class="dashboard-items">
        <div class="row">

            @include('architect::partials.dashboard-counter',[
              "name" => "Continguts",
              "value" => Modules\Architect\Entities\Content::all()->count(),
              "icon" => "fa-file-o",
              "route" => route('contents')
            ])

            @include('architect::partials.dashboard-counter',[
              "name" => "Mitjans",
              "value" => Modules\Architect\Entities\Media::all()->count(),
              "icon" => "fa-picture-o",
              "route" => route('medias.index')
            ])

            @include('architect::partials.dashboard-counter',[
              "name" => "Usuaris",
              "value" => App\Models\User::all()->count(),
              "icon" => "fa-users",
              "route" => route('users')
            ])

            @include('architect::partials.dashboard-counter',[
              "name" => "Llenguatges",
              "value" => Modules\Architect\Entities\Language::all()->count(),
              "icon" => "fa-flag",
              "route" => route('languages')
            ])

            <div class="col-xs-6">
              <!-- React Table.js -->
              <div id="dashboard-table"
                title="Últimes 25 pàgines"
                route={{route('contents.modal.data')."?is_page=1"}}
              ></div>
            </div>

            <div class="col-xs-6">
              <!-- React Table.js -->
              <div id="dashboard-table"
                title="Últimes 25 notícies"
                route={{route('contents.modal.data')."?typology_id=2"}}
              ></div>
            </div>


            <div class="col-xs-12">
              <!-- React SiteMap.js-->
              <div id="dashboard-sitemap"></div>
            </div>

        </div>
      </div>

    </div>
  </div>

  <div class="separator" style="height:60px;"></div>

</div>

@stop

@push('javascripts-libs')
{{ Html::script('/modules/architect/js/libs/d3/d3.v4.min.js') }}
<script>
var routes = {
  'showContent' : "{{route('contents.show',['id' => ':id'])}}",
};
</script>
@endpush
