@extends('layouts.frontend', [ 'htmlTitle' => 'Agence pour l\'emploi Menco | Recrutement intérim, CDD et CDI',
								'metaDescription' => 'Menco est une société de travail temporaire et de recrutement en intérim, CDD et CDI indépendante à taille humaine dont les agences sont implantées à Bordeaux, Libourne, Nantes, Pau, Rennes, Saint-Herblain, Saint-Nazaire et Tours.',
								'headerDiv' => 'home-header' ])

@section('content')
@php
	$offers = Modules\RRHH\Entities\Offers\Offer::where('status', Modules\RRHH\Entities\Offers\Offer::STATUS_ACTIVE)->orderBy('created_at', 'desc')->limit(6)->get();
@endphp
<div class="home">
	<div class="home-block">
		<div class="horizontal-inner-container">
			<h1>Agence d'emploi Menco : recrutement intérim, CDD et CDI</h1>
			<p>
				Fondée en 2013, Menco est une société de travail temporaire et de recrutement indépendante à taille humaine dont les agences sont implantées à Bordeaux, Libourne, Nantes, Pau, Rennes, Saint-Herblain, Saint-Nazaire et Tours. Notre rayonnement nous permet de proposer des offres d'emploi sur les régions Bretagne, Pays de Loire, Centre Val de Loire et Nouvelle Aquitaine. Nous intervenons dans le recrutement en intérim, CDD et CDI dans tous les domaines d’activité.	</p>

		</div>
		<div class="offers">
			@foreach($offers as $offer)
				<div class="col-md-4 offer-container">
					<div class="offer-box" style="background-image:url('{{asset('images/offer-bk.jpg')}}')">
						<h4>{{ $offer->title }}</h4>
						@if($offer->visibility == 1)
						<p><i class="fa fa-map-marker"></i>{{ $offer->address }}</p>
						@endif
						@if($offer->job_1 && App\Models\Tools\SiteList::getListValue($offer->job_1, 'jobs1') )
							<p><i class="fa fa-star"></i>{{ App\Models\Tools\SiteList::getListValue($offer->job_1, 'jobs1') }}</p>
						@endif
						<p><i class="fa fa-file-o"></i>{{ App\Models\Tools\SiteList::getListValue($offer->contract, 'contracts') }}</p>

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
			@endforeach
			<div class="col-md-12">
		        <a  class="btn btn-more" href="{{route('search')}}" >Toutes les offres</a>
		      </div>
	     	 <br clear="all">
		</div>
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
    var civility_default = "{{ Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE }}"

    $(document).ready(function() {
      $(".application-btn").on('click',function(e){
          app.offerapplications.init(
            "{{ Auth::check() ? Auth::user()->id : 0 }}",
            this.id,
            "{{ Auth::check() && (Auth::user()->candidate) ? Auth::user()->candidate->resume_file : '' }}"
          );
          app.offerapplications.open();

      });
    });
  </script>
@endpush
@push('modals')
  @include('front.partials.modals')
@endpush
