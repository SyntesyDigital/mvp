@php
	$metaDescription = strip_tags(str_replace('&#39;', '\'', $offer->perfil));
	$metaDescription = str_replace(array("\r\n", "\r", "\n"), "", $metaDescription);
	$metaDescription = trim(substr(strip_tags($metaDescription), 0, 180));
	$metaDescription = mb_substr($metaDescription, 0, strrpos($metaDescription, ' ')) . " ...";
@endphp
@extends('layouts.frontend', [
	'socialTitle' => $offer->title,
	'htmlTitle' => $offer->title.' - '.$offer->address,
	'pageTitle' => $offer->title,
	'headerDescription' => $offer->address,
	'metaDescription' => $metaDescription,
	'socialDescription' => $metaDescription,
	'headerDate' => $offer->start_at
])

@section('content')

<div class="offer-page">
	<div class="horizontal-inner-container">
		<div class="row">
		<div class="col-md-4 left-column">
			<div class= "social-icons-list">
				@php
					$shareUrl = urlencode(Request::url());
					$title = isset( $offer->title ) ?  $offer->title : '';
					$description = isset( $offer->description ) ?  $offer->description : '';
				@endphp

				<a href="https://www.facebook.com/sharer/sharer.php?u={{$shareUrl}}&t={{$title}}"
					class="share-button"
					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
					 target="_blank" title="Share on Facebook">
					<img src="{{asset('images/fb_icon.jpg')}}" class="social-icon">
				</a>

				<a href="https://twitter.com/share?url={{$shareUrl}}&text={{$title}}"
					class="share-button"
					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
					 target="_blank" title="Share on Twitter">
					<img src="{{asset('images/tw_icon.jpg')}}" class="social-icon">
				</a>

				<a href="https://plus.google.com/share?url={{$shareUrl}}"
					class="share-button"
					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
					 target="_blank" title="Share on Google Plus">
					<img src="{{asset('images/gl_icon.jpg')}}" class="social-icon">
				</a>
			</div>
				<div class="details-box">
					@if($coords && $offer->visibility == 1)
						<div class="location-box">
							<div id="map-container">
							</div>
						</div>
						<p>{{$offer->address}}</p>
					@endif
					<h4>Détails</h4>
					@if($offer->salary)
					<div class="detail-description">
						<p>Salaire:</p>
						<p>{{ App\Models\Tools\SiteList::getListValue($offer->salary, 'salaries') }}</p>
					</div>
					@endif

					@if($offer->schedule)
					<div class="detail-description" >
						<p>Horaires:</p>
						@php
							$values = App\Models\Tools\SiteList::getListValue($offer->schedule, 'schedule');
						@endphp

						@if(is_array($values))
							@foreach($values as $k => $v)
								<p>{{$v}}</p>
							@endforeach
						@else
							<p>{{$values}}</p>
						@endif

					</div>
					@endif
				</div>
			</div>
			<div class="col-md-8 right-column">
				<div class="offer-description-box">
					<h3>Profil recherché</h3>
					<p>{!! $offer->perfil !!}</p>
					<p>{!! $offer->description !!}</p>
				</div>
				<div class="buttons-sections">
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
				</div>
			</div>
		</div>
	</div>


	@if(count($related_offers)>0)

		<div class="horizontal-inner-container">
			<div class="offers-separator"></div>
		</div>

		<div class="horizontal-inner-container">
			<h4 class="related-offers-title">CES OFFRES POURRAIENT AUSSI VOUS INTÉRESSER, <span>AGENCE DE {{$offer->recipient->agences()->first()->name}}</span></h4>
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
			</div>
		</div>
	@endif


	@if(sizeof($related_offers_country->toArray()))

		<div class="horizontal-inner-container">
			<div class="offers-separator"></div>
		</div>

		<div class="horizontal-inner-container">
			<h4 class="related-offers-title">CES OFFRES POURRAIENT AUSSI VOUS INTÉRESSER, <span>TOUTE LA FRANCE</span></h4>
			<div class="offers">
				@foreach ($related_offers_country as $o)
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
			</div>
		</div>
	@endif
</div>


@if($coords)
<script>
	function initMap() {
		var uluru = {
			lat: {{ $coords['lat'] }},
			lng: {{ $coords['lng'] }}
		};

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
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap&language=fr">
</script>
@endif



@endsection

@push('stylesheets')
@endpush

@push('javascripts-libs')
@endpush

@push('javascripts')
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
    {{ Html::script('/js/admin/offers/app.js') }}
    {{ Html::script('/js/front/offers/offerapplications.js') }}
@endpush

@push('modals')
	@include('front.partials.modals')
@endpush
