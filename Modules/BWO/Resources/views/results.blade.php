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
          {!! Form::select('job', [0 => '', 1 =>'Metier 1', 2 => 'Metier 2'], null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-sm-4 select-container">
          {!! Form::Label('contract', 'Choisissez votre type de contrat:') !!}
          {!! Form::select('contract', [0 => '', 1 =>'Contrat 1', 2 => 'Contrat 2'], null, ['class' => 'form-control']) !!}
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
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                <div class="buttons">
                  <a href="#" class="btn btn-soft-gray tag">COMPTABILITÉ</a>
                  <a href="#" class="btn btn-soft-gray tag">INTERIM</a>
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
        <!--a href="#" class="round"><div class="round"><i class="fa fa-angle-left" aria-hidden="true"></i></div></a-->
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">...</a>
        <a href="#" class="round"><div class="round"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a>
      </div>

    </div>
  </div>
</div>

@endsection



@push('javascripts')
  <script>

    $(document).ready(function() {

      $('body').on('click', '.btn-more', function() {
          getMoreResults(this);
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

      $(document).ready(function() {
      $(".btn-more-posts").on('click',function(e){
        getMoreResults(this);
      });
    });
    });
  </script>
@endpush
