@php
	$title = 'Bonjour '.Auth::user()->firstname;
@endphp
@extends('bwo::layouts.master',[
	'pageTitle' => $title,
	'htmlTitle' => 'Espace candidat'
])

@section('content')
    <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/offer-banner.jpg')}}')">
      <div class="horizontal-inner-container">
          <h1>BONJOUR {{Auth::user()->firstname}}</h1>
        </div>
      </div>
    </div>
    <div class="candidate-container">
      <div class="horizontal-inner-container">

        <div class="candidate-list">
          <ol class="breadcrumb">
            <li><a href="{{route('home')}}">ACCUEIL</a></li>
            <li>ESPACE CANDIDAT</li>
          </ol>
          <div class="col-md-8 information-container">
            <div class="col-md-4">
							@if(!isset(Auth::user()->image))
              	<div class="image" style="background-image:url('{{asset('modules/bwo/images/no_picture.jpg')}}')"></div>
							@else
								<div class="image" style="background-image:url('{{ Storage::url(Auth::user()->image)}}')"></div>
							@endif
            </div>
            <div class="col-md-8">
              <div class="information">
                <p class="name">{{Auth::user()->firstname.', '.Auth::user()->lastname}}</p>
                <p>{{ Auth::user()->candidate->address}}</p>
                <p>{{ Auth::user()->email}}</p>
                <a href="{{ route('candidate.profile') }}" class="btn btn-soft-gray"><i class="fa fa-pencil"></i> GÉRER VOS INFORMATIONS</a>
              </div>
            </div>
          </div>
			<br clear="all">
          <div class="col-md-4">
            <div class="candidate-box">
              <i class="fa fa-bell"></i>
              <div class="btn-container">
                <a href="{{ route('candidate.alert') }}" class="btn btn-dark-gray">GÉRER VOS ALERTS</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="candidate-box">
              <i class="fa fa-user-circle-o"></i>
              <div class="btn-container">
                <a href="{{ route('candidate.profile') }}" class="btn btn-dark-gray">GÉRER VOS INFORMATIONS</a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="candidate-box">
              <i class="fa fa-briefcase"></i>
              <div class="btn-container">
                <a href="{{ route('candidate.document') }}" class="btn btn-dark-gray">VOS DOCUMENTS</a>
              </div>
            </div>
          </div>
          <br clear="all">

        </div>
      </div>
    </div>
    <div class="three-colors-separator">
      <div class="separator-piece dark-gray"></div>
      <div class="separator-piece soft-gray"></div>
      <div class="separator-piece red"></div>
    </div>
    <div class="offers-3-container candidate-page">
        @include('bwo::partials.three-offers')
    </div>
@endsection

@push('javascripts-libs')
    <script src="{{ asset('/plugins/datatables/datatables.min.js') }}"></script>

@endpush
