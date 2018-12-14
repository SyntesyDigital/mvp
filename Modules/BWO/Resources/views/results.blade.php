@extends('bwo::layouts.master', [
    'htmlTitle' => '',
    'metaDescription' => '',
    'pageTitle' => 'Nos offres d\'emploi',
    'searchBar' => true
])

@section('content')

<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/offer-banner.jpg')}}')">
  <div class="horizontal-inner-container">
    <h1>VOTRE RECHERCHE</h1>
  </div>
</div>

<div class="offers-container">
  <div class="horizontal-inner-container">
    <form method="get" action="{{route('search')}}">
      <div class="lightest-gray-search-container">
        <ol class="breadcrumb">
          <li><a href="{{route('home')}}">ACCUEIL</a></li>
          <li>OFFRES</li>
        </ol>

        <div class="btn btn-red btn-search" id="btn-search">
          <i class="fa fa-search"></i>RECHERCHER
        </div>
        <div class="input-search-container">
          <input class="form-control input-round search-input" type="text" placeholder="Métier, ville, contrat..." name="search" value="">
        </div>
        <div class="checkboxes">
          <label>
             {{Form::checkbox('job', '1')}}[Métier]
          </label>
          <label>
              {{Form::checkbox('city', '1')}}[Ville]
          </label>
          <label>
            {{Form::checkbox('contract', '1')}}[Contrat]
          </label>
        </div>
        <div class="filter-btn">
          <div class="btn btn-dark-gray" id="btn-more">VOIR PLUS DE FILTRES</div>
          <div class="btn btn-dark-gray" id="btn-less">VOIR MOINS DE FILTRES</div>
        </div>
      </div>
      <div class="light-gray-search-container">
        <div class="col-sm-4 select-container">
          {!! Form::Label('job', 'Choisissez votre métier:') !!}
          <div class="multiselect">
            <div class="selectBox" checkbox="2" >
              <select class="form-control">
                <option>----</option>
              </select>
              <div class="overSelect"></div>
            </div>
            <div class="checkboxes" id="checkboxes_2">
              @php
                $list = Modules\RRHH\Entities\Tools\SiteList::where('identifier', 'jobs1')->first();
                $jobs = collect(json_decode($list->value, true))->mapWithKeys(function ($item, $key) {
                    return [$item['value'] => $item['name']];
                });
                $jobs = $jobs->toArray();
              @endphp
              @foreach($jobs as $key => $value)
                <label for="job_{{$key}}"><input type="checkbox" value="{{$key}}" name="job[]" id="job_{{$key}}" {{in_array($key,$selected_job)?'checked="checked"':''}} />{{$value}}</label>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-sm-4 select-container">
          {!! Form::Label('contract', 'Choisissez votre type de contrat:') !!}
          <div class="multiselect">
            <div class="selectBox" checkbox="3">
              <select class="form-control">
                <option>----</option>
              </select>
              <div class="overSelect"></div>
            </div>
            <div class="checkboxes" id="checkboxes_3">
              @php
                $list = Modules\RRHH\Entities\Tools\SiteList::where('identifier', 'contracts')->first();
                $contracts = collect(json_decode($list->value, true))->mapWithKeys(function ($item, $key) {
                    return [$item['value'] => $item['name']];
                });
                $contracts = $contracts->toArray();
              @endphp
              @foreach($contracts as $key => $value)
                <label for="contract_{{$key}}"><input type="checkbox" value="{{$key}}" name="contract[]" id="contract_{{$key}}" {{in_array($key,$selected_contract)?'checked="checked"':''}}  />{{$value}}</label>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-sm-4 select-container">
          {!! Form::Label('filter', 'Filtre par:') !!}
          {!! Form::select('filter', [0 => '', 1 =>'Filtre 1', 2 => 'Filtre 2'], null, ['class' => 'form-control']) !!}
        </div>
        <div class="btn btn-dark-gray" id="btn-filtres">APPLIQUER LES FILTRES</div>
      </div>

    </form>

    <div class="offers-list" id="search-results">

        @foreach($offers as $offer)
          <div class="col-md-4">
            <div class="offer-box">
                <div class="title">
                  {{ $offer->title }}
                </div>
                <p>Réf: BOU - Posté le 16/11/2018</p>
                @php
                  $string = substr(strip_tags($offer->description), 0, 250);
                  if(strlen($string) < strlen(strip_tags($offer->description))){
                    $string = substr($string, 0, strrpos($string, ' ')) . " ...";
                  }
                @endphp
                <p class="description">{!! $string !!}</p>
                @php
                 $otags = $offer->tags()->limit(2)->get();
                @endphp
                <div class="buttons">
                  @foreach($otags as $otag)
                    <a href="#" class="btn btn-soft-gray tag">{{$otag->name}}</a>
                  @endforeach
                </div>
                <a href="{{ route('offer.show', [
                                      'job_1' => str_slug(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_1, 'jobs1'), '-'),
                                      'id' => $offer->id
                                  ]) }}" class="detail" >DÉTAIL DE L'OFFRE</a>
            </div>
          </div>
        @endforeach
      <br clear="all">
      <div class="pagination-container">
        @if($page > 0)
          <a href="{{$pagination_url.($page - 1)}}" class="round"><div class="round"><i class="fa fa-angle-left" aria-hidden="true"></i></div></a>
        @endif
        @if($page > 2)
          <a href="{{$pagination_url.($page-3)}}">...</a>
        @endif
        @if($page > 1)
          <a href="{{$pagination_url.($page-2)}}">{{$page - 1}}</a>
        @endif
        @if($page > 0)
          <a href="{{$pagination_url.($page-1)}}">{{$page}}</a>
        @endif
        <a href="javascript:void(0)" class="active">{{$page + 1}}</a>
        @if(($page+1)*$items_per_page < $num_offers)
          <a href="{{$pagination_url.($page +1)}}">{{$page +2}}</a>
        @endif
        @if(($page+2)*$items_per_page < $num_offers)
          <a href="{{$pagination_url.($page + 2)}}">{{$page +3}}</a>
        @endif
        @if(($page+3)*$items_per_page < $num_offers)
          <a href="{{$pagination_url.($page + 3)}}">...</a>
        @endif
        @if(($page+1)*$items_per_page < $num_offers)
          <a href="{{$pagination_url.($page + 1)}}" class="round"><div class="round"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a>
        @endif
      </div>

    </div>
  </div>
</div>

@endsection



@push('javascripts')
  <script>

    $(document).ready(function() {

       $(document).on("click","#btn-more",function() {
         $(this).hide();
         $('#btn-less').show();
         $('.light-gray-search-container').show();
       });

       $(document).on("click","#btn-less",function() {
         $(this).hide();
         $('#btn-more').show();
         $('.light-gray-search-container').hide();
       });
       $(document).ready(function() {
           $(document).on("click",".btn-search",function() {
             $(this).closest('form').submit();
           });
       });
       $(document).ready(function() {
           $(document).on("click","#btn-filtres",function() {
             $(this).closest('form').submit();
           });
       });

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': "{{csrf_token()}}"
          }
      });
      var offset = {{$items_per_page}};
      var total = {{$num_offers}};
      var page = 1;

      function getMoreResults(btn){
        $('#'+btn.id).hide();
        $params = 'page='+(page);
        $('#btn-more-posts').hide();

        @if(isset($search))
          $params += '&search={{$search}}';
        @endif

        @if(isset($contract_selected))
          @foreach($contract_selected as $c)
            $params += '&contract%5B%5D={{$c}}';
          @endforeach
        @endif

        @if(isset($job_selected))
          @foreach($job_selected as $j)
            $params+= '&job%5B%5D={{$j}}';
          @endforeach
        @endif

        @if(isset($agence_selected))
          @foreach($agence_selected as $a)
            $params += '&agence%5B%5D={{$a}}';
          @endforeach
        @endif

        var route = "{{ route('search') }}?"+$params;


        $.ajax( {
          type: "GET",
          url: route,
          dataType : 'html',
          data: {
            },
          success: function(result) {
              $('#search-results').append($(result).find('#search-results').html());
              page = page + 1;

              $(".application-btn")
                  .off('click')
                  .on('click',function(e){
                      app.offerapplications.init("{{ Auth::check() ? Auth::user()->id : 0 }}", this.id, "{{ Auth::check() && (Auth::user()->candidate) ? Auth::user()->candidate->resume_file : '' }}");
                      app.offerapplications.open();
                  });
          },
          error: function () {
              alert('error')
          }
        });
      }

      $(".btn-more-posts").on('click',function(e){
        getMoreResults(this);
      });

      $(".selectBox").on('click',function(e){
        showCheckboxes(this.getAttribute('checkbox'));
      });
    });
    var expanded = false;
    function showCheckboxes(num_select) {
      var checkboxes = document.getElementById("checkboxes_"+num_select);
      if (!expanded) {
        checkboxes.style.display = "block";
        expanded = true;
      } else {
        checkboxes.style.display = "none";
        expanded = false;
      }
    }
  </script>
@endpush
