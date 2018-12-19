@php
	$metaDescription = strip_tags(str_replace('&#39;', '\'', $offer->description));
	$metaDescription = str_replace(array("\r\n", "\r", "\n"), "", $metaDescription);
	$metaDescription = trim(substr(strip_tags($metaDescription), 0, 180));
	$metaDescription = mb_substr($metaDescription, 0, strrpos($metaDescription, ' ')) . " ...";
@endphp

@extends('bwo::layouts.master', [
	'socialTitle' => $offer->title,
	'htmlTitle' => $offer->title,
	'pageTitle' => $offer->title,
	'headerDescription' => $offer->address,
	'metaDescription' => $metaDescription,
	'socialDescription' => $metaDescription,
	'headerDate' => $offer->start_at
])

@section('content')
    <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/offer-banner.jpg')}}')">
    </div>
    <div class="offers-container">
      <div class="horizontal-inner-container offer-container">
          <ol class="breadcrumb">
            <li><a href="{{route('home')}}">ACCUEIL</a></li>
            <li><a href="{{route('search')}}">OFFERS</a></li>
            <li><a href="{{route('search')}}?job[]={{$offer->job_1}}">{{ strtoupper(Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_1, 'jobs1')) }}</a></li>
            <li>{{$offer->title}}</li>
          </ol>
          <h1>{{$offer->title}}</h1>
          <div class="separator"></div>
          <p class="first-info">{{$offer->address}}, Contrat {{ Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->contract, 'contracts') }} - Publié le {{$offer->created_at}} </p>
          <div class="col-sm-4 col-md-3 information">
            <h2 class="gray-square-text">DÉTAILS</h2>
            <div class="block-info">
              <p><b>Lieu:</b></p>
              <p>{{$offer->address}}</p>
            </div>
            <div class="block-info">
              <p><b>Contrat:</b></p>
              <p>{{ Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->contract, 'contracts') }}</p>
            </div>
            <div class="block-info">
              <p><b>À partir du:</b></p>
              <p>{{$offer->start_at}}</p>
            </div>
            <div class="block-info">
              <p><b>Secteur:</b></p>
              <p>{{ Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_1, 'jobs1') }} / {{ Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->job_2, 'jobs2') }}</p>
            </div>
            <div class="block-info">
              <p><b>Salaire:</b></p>
              <p>{{ Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->salary, 'salaries') }}</p>
            </div>
            <div class="reference">REF : {{$offer->id}} | {{$offer->created_at}}</div>
            <div class="share-container">
              @php
      					$shareUrl = urlencode(Request::url());
      					$title = isset( $offer->title ) ?  $offer->title : '';
      					$description = isset( $offer->description ) ?  $offer->description : '';
      				@endphp

               Partager:
               <a href="https://www.facebook.com/sharer/sharer.php?u={{$shareUrl}}&t={{$title}}"
        					class="share-button first-share-btn"
        					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
        					 target="_blank" title="Share on Facebook">
        					<img src="{{asset('modules/bwo/images/fb_icon.jpg')}}" class="social-icon">
        				</a>

                <a href="https://twitter.com/share?url={{$shareUrl}}&text={{$title}}"
        					class="share-button"
        					 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
        					 target="_blank" title="Share on Twitter">
        					<img src="{{asset('modules/bwo/images/tw_icon.jpg')}}" class="social-icon">
        				</a>

                <a href="mailto:?subject={{$title}}&body={{$shareUrl}}"
        					class="mail-button">
        					<img src="{{asset('modules/bwo/images/mail_icon.jpg')}}" class="social-icon">
        				</a>

            </div>
          </div>
          <div class="col-sm-8 col-md-9 description">
            {!! $offer->description !!}
            <p class="title">PROFIL RECHERCHÉ</p>
						{!! $offer->perfil !!}
            <p><b>Diplôme: </b> bac + 2</p>
            <p><b>Expérience requise: </b> Expérience similaire de 5 ans</p>
            <p><b>Langue: </b>anglis opérationnel</p>
            <p><b>Logiciel: </b>PACK OFFICE</p>
						<p><b>Horaries: </b>
							@php
								$values = Modules\RRHH\Entities\Tools\SiteList::getListValue($offer->schedule, 'schedule');
							@endphp

							@if(is_array($values))
								@foreach($values as $k => $v)
									{{$v}} ,
								@endforeach
							@else
								{{$values}}
							@endif
						</p>

          </div>
          <br clear="all">
          <div class="btn-red-container">

            @if(Auth::check() && !Auth::user()->hasRole(['admin', 'recruiter']))
                @if($offer->hasAlreadyCandidate())
                  <a id="{{$offer->id}}"  class="btn btn-red unactivated">
                    <i class="fa fa-check"></i> Déjà postulé
                  </a>
                @else
                  <a id="{{$offer->id}}"  class="btn btn-red application-btn">
                    <i class="fa fa-file-text-o"></i> POSTULER
                  </a>
                @endif
            @else
                <a id="{{$offer->id}}"  class="btn btn-red application-btn">
                  <i class="fa fa-file-text-o"></i> POSTULER
                </a>
            @endif
          </div>
      </div>
    </div>
    <div class="offers-3-container">
        @include('bwo::partials.three-offers')
    </div>

@endsection

@push('javascripts')
	<script>

    $(document).ready(function() {

    });

  </script>

@endpush
