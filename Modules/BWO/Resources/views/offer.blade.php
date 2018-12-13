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
            <li><a href="{{route('search')}}">MÉTIER 1</a></li>
            <li>ASSISTANT COMPTABLE H/F</li>
          </ol>
          <h1>ASSISTANT COMPTABLE H/F</h1>
          <div class="separator"></div>
          <p class="first-info">Mérignac, Gironde, 33, Bâtiment, Contrat intérimaire - Publié le 14 mai 2018</p>
          <div class="col-sm-4 col-md-3 information">
            <h2 class="gray-square-text">DÉTAILS</h2>
            <div class="block-info">
              <p><b>Lieu:</b></p>
              <p>La Défense</p>
            </div>
            <div class="block-info">
              <p><b>Contrat:</b></p>
              <p>CDI</p>
            </div>
            <div class="block-info">
              <p><b>À partir du:</b></p>
              <p>02/01/2019</p>
            </div>
            <div class="block-info">
              <p><b>Secteur:</b></p>
              <p>Assistant / Secrétariat</p>
            </div>
            <div class="block-info">
              <p><b>Salaire:</b></p>
              <p>30/34 K€ selon profil</p>
            </div>
            <div class="reference">REF : LEG1 | 20/11/2018</div>
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

        				<a href="#"	class="share-button" title="Share on Instagram">
        					<img src="{{asset('modules/bwo/images/instagram_icon.jpg')}}" class="social-icon">
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
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus. Aenean vitae justo sed nibh rhoncus semper id ut urna. Proin sodales risus in lacinia ultricies. Quisque consequat purus egesta</p>
            <p class="title">PRINCIPALES MISIONS</p>
            <ul>
              <li>Saise et suivi des comandes jusqu'à la facturation,</li>
              <li>Suivi des expéditions en liaison avec la Supply Chain et l'entrepôt,</li>
              <li>Préparation, contrôle et soumission des documents nécessaires aux expéditions (certificats d'origine, documents de transport...),</li>
              <li>Suivi des reclamations clients et retours éventuels.</li>
            </ul>
            <p>Vous avez une expérience sur un poste similaire de 5 ans et votre anglais est usuel</p>
            <ul>
              <li>Maitrise du Pack Office et ERP sur AS400</li>
            </ul>
            <p class="title">PROFIL RECHERCHÉ</p>
            <p><b>Diplôme: </b> bac + 2</p>
            <p><b>Expérience requise: </b> Expérience similaire de 5 ans</p>
            <p><b>Langue: </b>anglis opérationnel</p>
            <p><b>Logiciel: </b>PACK OFFICE</p>
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
