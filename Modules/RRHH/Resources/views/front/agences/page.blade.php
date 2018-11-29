@extends('layouts.frontend', [
	'htmlTitle' => $agence->meta_title,
	'metaDescription' => $agence->meta_description,
	'pageTitle' => $agence->name,
	'headerImg' => Storage::url('/agences/' . $agence->image)
])

@section('content')
<div class="offer-page">
	<div class="horizontal-inner-container">
		<div class="row">
			<div class="col-md-4 left-column">
				<div class="details-box">
					@if($coords)
						<div class="location-box">
							<div id="map-container">
							</div>
						</div>
					@endif

					<h4>Où trouver votre agence Menco Intérim {{$agence->name}}?</h4>
					<div class="detail-description">
						<p>Candidats ou chefs d'entreprise, retrouvez notre agence pour l'emploi Menco Intérim</p>
					</div>
					<div class="detail-description">
						<p>{{$agence->name}}</p>
						<p>{{$agence->address}}</p>
						<p>{{$agence->postal_code}}</p>
						@if($agence->phone != '')
							<p class="bold">Tél. : {{$agence->phone}}</p>
						@endif
						@if($agence->fax != '')
							<p class="bold">Fax : {{$agence->fax}}</p>
						@endif
						@if($agence->email != '')
							<p class="bold"><span>{{$agence->email}}</span><p>
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-8 right-column">
				<div class="offer-description-box">
					{!! $agence->content !!}
				</div>
			</div>
		{{--	@if($agence->image != '')
				<div class="col-md-12 agence-image-div">
					<img class="" src="{{ Storage::url('/agences/' . $agence->image) }}">
				</div>
			@endif
			--}}
		</div>
	</div>

	<br clear="all">
	<br clear="all">

	@if(count($related_offers)>0)

		<div class="horizontal-inner-container">
			<div class="offers-separator"></div>
		</div>

		<div class="horizontal-inner-container">
			<h4 class="related-offers-title">LES OFFRES DE L'<span>AGENCE DE {{$agence->name}}</span></h4>
			<div class="offers">
				@foreach ($related_offers as $o)
					<div class="col-md-4 offer-container">
						<div class="offer-box" style="background-image:url('{{asset('images/offer-bk.jpg')}}')">
							<h4>{{ $o->title }}</h4>
							<p><i class="fa fa-map-marker"></i>{{ $o->address }}</p>
							<p><i class="fa fa-star"></i> {{ App\Models\Tools\SiteList::getListValue($o->job_1, 'jobs1') }}</p>
							<p><i class="fa fa-file-o"></i> {{ App\Models\Tools\SiteList::getListValue($o->contract, 'contracts') }}</p>
							@if(Auth::check())
				                @if(!Auth::user()->hasRole(['admin', 'recruiter']))
				                  @if($offer->hasAlreadyCandidate())
				                    <button id="{{$o->id}}"  class="btn unactivated">Déjà postulé</button>
				                  @else
				                    <button id="{{$o->id}}"  class="btn application-btn">POSTULER</button>
				                  @endif
				                @endif
				            @else
				                <button id="{{$o->id}}"  class="btn application-btn">POSTULER</button>
				            @endif
							<a href="{{ route('offer.show', [
									'job_1' => str_slug(App\Models\Tools\SiteList::getListValue($o->job_1, 'jobs1'), '-'),
									'id' => $o->id
								]) }}"  class="btn btn-secondary">PLUS D'INFOS</a>
						</div>
					</div>
				@endforeach
				<div class="col-md-12">
		      		<a href="{{route('search')}}"  class="btn btn-more">Voir toutes les offres</a>
		      	</div>
			</div>

		</div>
	@endif
	<br clear="all">

</div>
<br clear="all">
@endsection




@push('stylesheets')

@endpush

@push('javascripts-libs')

@endpush


@push('javascripts')
	@if($coords)
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0CzJSBdXh-eWh6oFWMLFhIJaU2RSfZIw&language=fr"></script>
		<script>
			function initMap() {
				var uluru = {lat: <?php echo $coords['lat'] ?> , lng: <?php echo $coords['lng'] ?>};
				var map = new google.maps.Map(document.getElementById('map-container'), {
				  zoom: 10,
				  center: uluru
				});
				var marker = new google.maps.Marker({
				  position: uluru,
				  map: map
				});
			}
		</script>
	@endif

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
	     	initMap();
		    });

    </script>
    {{ Html::script('/js/admin/offers/app.js') }}
    {{ Html::script('/js/front/offers/offerapplications.js') }}
@endpush
@push('modals')
	@include('front.partials.modals')
@endpush
