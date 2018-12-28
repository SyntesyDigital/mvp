@php
	$title = 'Bonjour [entreprise]';
@endphp
@extends('bwo::layouts.master',[
	'pageTitle' => $title,
	'htmlTitle' => 'Espace candidat'
])

@section('content')
    <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/offer-banner.jpg')}}')">
      <div class="horizontal-inner-container">
          <h1>BONJOUR [ENTREPRISE]</h1>
        </div>
      </div>
    </div>
    <div class="candidate-container">
      <div class="horizontal-inner-container">

        <div class="candidate-list">
          <ol class="breadcrumb m-b-0">
            <li><a href="{{route('home')}}">ACCUEIL</a></li>
            <li>ESPACE ENTREPRISE</li>
          </ol>
          <div class="col-md-4 information-container">
						@if(!isset(Auth::user()->image))
            	<div class="image" style="background-image:url('{{asset('modules/bwo/images/no_picture.jpg')}}')"></div>
						@else
							<div class="image" style="background-image:url('{{ Storage::url(Auth::user()->image)}}')"></div>
						@endif
						<div class="information center">
              <p class="name">ENTERPRISE</p>
              <p>Adresse, 2ème ligne adresse</p>
              <p>e-mail</p>
              <a href="" class="btn btn-soft-gray">CHANGER LA PHOTO DE PROFIL</a>
            </div>
          </div>
          <div class="col-md-4 bottom">
            <div class="candidate-box">
              <i class="fa fa-address-card"></i>
              <div class="btn-container">
                <a href="{{ route('customer.profile') }}" class="btn btn-dark-gray">GÉRER VOS INFORMATIONS</a>
              </div>
            </div>
          </div>
          <div class="col-md-4 bottom">
            <div class="candidate-box">
              <i class="fa fa-briefcase"></i>
              <div class="btn-container">
                <a href="" class="btn btn-dark-gray">VOS DOCUMENTS</a>
              </div>
            </div>
          </div>
          <br clear="all">

        </div>
      </div>
    </div>

@endsection

@push('javascripts-libs')
    <script src="{{ asset('/plugins/datatables/datatables.min.js') }}"></script>

@endpush
