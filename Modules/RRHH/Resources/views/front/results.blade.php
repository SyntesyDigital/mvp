@extends('layouts.frontend', [
    'htmlTitle' => 'Offres d\'emploi intérim, CDD et CDI ',
    'metaDescription' => 'Offres d\'emploi intérim, CDD et CDI proposées par l\'agence d\'intérim Menco sur les régions Bretagne Pays de Loire, Centre et Nouvelle Aquitaine. Offres d\'Emploi par catégorie, recherche d\'emploi, nouvelles annonces. ',
    'pageTitle' => 'Nos offres d\'emploi',
    'searchBar' => true
])

@section('content')


<div class="search-results">
	<div class="horizontal-inner-container" id="search-results">
		<div class="row">
      @php $i=0; @endphp
			@foreach($offers as $offer)
        <div class="col-md-6">
  				<div class="offer-box"  style="background-image:url('{{asset('images/offer-bk.jpg')}}')">

  				<div class="row">
					<h4>{{ $offer->title }}</h4>
					<p>
                        @if($offer->visibility == 1)
                            <i class="fa fa-map-marker"></i>{{ $offer->address }}
                        @endif

                        @if($offer->job_1 && App\Models\Tools\SiteList::getListValue($offer->job_1, 'jobs1') )
                          <i class="fa fa-star"></i>{{ App\Models\Tools\SiteList::getListValue($offer->job_1, 'jobs1') }}
                        @endif

                        <i class="fa fa-file-o"></i>{{ App\Models\Tools\SiteList::getListValue($offer->contract, 'contracts') }}
                    </p>
                  @php
                    $string = substr(strip_tags($offer->description), 0, 180);
                    $string = substr($string, 0, strrpos($string, ' ')) . " ...";
                  @endphp
                  <p class="description">{!! $string !!}</p>


              @if(Auth::check())
                @if(!Auth::user()->hasRole(['admin', 'recruiter']))
                  @if($offer->hasAlreadyCandidate())
                    <button id="{{$offer->id}}"  class="btn unactivated">Déjà postulé</button>
                  @else
                    <button id="{{$offer->id}}"  class="btn application-btn">POSTULER</button>
                  @endif
                @endif
              @else
                <button id="{{$offer->id}}"  class="btn application-btn">POSTULER</button>
              @endif
              <a  href="{{ route('offer.show', [
                                    'job_1' => str_slug(App\Models\Tools\SiteList::getListValue($offer->job_1, 'jobs1'), '-'),
                                    // 'job_2' => str_slug(App\Models\Tools\SiteList::getListValue($offer->job_2, 'jobs2'), '-'),
                                    'id' => $offer->id
                                ]) }}" class="btn btn-secondary">PLUS D'INFOS</a>
						</div>
					</div>
				</div>

        @if($i == 3  && $page == 0)
          <div class="col-md-12 values">
            <div class="text-values">
              <h3>Nos annonces actualisées en permanence</h3>
              <p>Découvrez toutes les nouvelles offres d'emploi proposées par l'ensemble du réseau de vos agences Menco travail temporaire en intérim, CDD et CDI, sur Bordeaux, Libourne, Nantes, Pau, Rennes, Saint-Herblain, Saint-Nazaire et Tours. Nos offres d'emploi en intérim sont actualisées de façon permanente pour un recrutement gagnant.</p>
            </div>

            <div class="img" style="background-image:url('{{asset('images/values.jpg')}}')"></div>

          </div>
        @endif
        @php $i++; @endphp

      @endforeach
      @if($i== 0)
        <div class="col-md-12 no-offers">
            <p>Aucune offres disponible</p>
          </div>

          <div class="img" style="background-image:url('{{asset('images/values.jpg')}}')"></div>

        </div>
      @elseif($i < 4  && $page == 0)
        <div class="col-md-12 values">
          <div class="text-values">
            <h4>Trouvez facilement votre secteur d'activité</h4>
            <p>Découvrez toutes les nouvelles offres d'emploi proposées par l'ensemble du réseau de vos agences Menco travail temporaire en intérim, CDD et CDI, sur Bordeaux, Libourne, Nantes, Pau, Rennes, Saint-Herblain, Saint-Nazaire et Tours. Nos offres d'emploi en intérim sont actualisées de façon permanente pour un recrutement gagnant.</p>
          </div>

          <div class="img" style="background-image:url('{{asset('images/values.jpg')}}')"></div>

        </div>
      @endif


    </div>
    <br clear="all">

    @if($num_offers > ($items_per_page * ($page +1) ))
      <div class="col-md-12">
        <button  class="btn btn-more" id="more_{{$page + 1}}">Voir plus d'offres</button>
      </div>
      <br clear="all">
    @endif
	</div>
</div>

@endsection

@push('stylesheets')

@endpush

@push('javascripts-libs')

@endpush

@push('javascripts')
  {{ Html::script('/js/admin/offers/app.js') }}
  {{ Html::script('/js/front/offers/offerapplications.js') }}
  <script>
    var csrf_token = "{{csrf_token()}}";
    var civility_default = "{{ App\Models\Offers\Candidate::CIVILITY_MALE }}"

    $(document).ready(function() {
      $(".application-btn").on('click',function(e){
          app.offerapplications.init(
            "{{ Auth::check() ? Auth::user()->id : 0 }}",
            this.id,
            "{{ Auth::check() && (Auth::user()->candidate) ? Auth::user()->candidate->resume_file : '' }}"
          );
          app.offerapplications.open();

      });

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

@push('modals')
  @include('front.partials.modals')
@endpush
