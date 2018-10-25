@extends('architect::layouts.master')

@section('content')
<div class="container dashboard">
  <div class="row">
    <div class="col-md-offset-2 col-md-8">

      <div class="page-title">
        <h1>{{Lang::get('architect::home.wellcome')}} {{Auth::user()->firstname}},</h1>
        <h3>{{Lang::get('architect::home.current_state')}}</h3>
      </div>

      <div class="dashboard-items">
        <div class="row">

            @if(Auth::user()->hasRole(["admin"]))

              @include('architect::partials.dashboard-counter',[
                "name" => Lang::get('architect::home.contents'),
                "value" => Modules\Architect\Entities\Content::all()->count(),
                "icon" => "fa-file-o",
                "route" => route('contents')
              ])

              @include('architect::partials.dashboard-counter',[
                "name" => Lang::get('architect::home.media'),
                "value" => Modules\Architect\Entities\Media::all()->count(),
                "icon" => "fa-picture-o",
                "route" => route('medias.index')
              ])

              @include('architect::partials.dashboard-counter',[
                "name" => Lang::get('architect::home.users'),
                "value" => App\Models\User::all()->count(),
                "icon" => "fa-users",
                "route" => route('users')
              ])

              @include('architect::partials.dashboard-counter',[
                "name" => Lang::get('architect::home.languages'),
                "value" => Modules\Architect\Entities\Language::all()->count(),
                "icon" => "fa-flag",
                "route" => route('languages')
              ])

            @endif

            <div class="col-xs-6">
              <!-- React Table.js -->
              <div id="dashboard-table"
                title={{Lang::get('architect::home.pages')}}
                route={{route('contents.modal.data')."?is_page=1"}}
              ></div>
            </div>

            <div class="col-xs-6">
              <!-- React Table.js -->
              <div id="dashboard-table"
                title={{Lang::get('architect::home.news')}}
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
