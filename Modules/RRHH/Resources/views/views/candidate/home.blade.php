@php
	$title = 'Bonjour '.Auth::user()->firstname;
@endphp
@extends('layouts.frontend',[ 	'pageTitle' => $title,
 								'htmlTitle' => 'Menco Intérim | Espace candidat'
  							 ])

@section('content')

<div class="home-candidate ">

	<div class="horizontal-inner-container">
		<div class="row">
			<div class="col-md-8 candidates-container">
				<div class="candidates-box candidatures">
					<div class="col-sm-6">
						<div class="icon" style="background-image:url('{{asset('images/candidate-application-icon.jpg')}}')"></div>
					</div>
					<div class="col-sm-6">
						<h4>Vos candidatures</h4>
						<a href="{{ route('candidate.application') }}" class="btn">VOIR</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 candidates-container">
				<div class="candidates-box alertes">
					<div class="icon" style="background-image:url('{{asset('images/candidate-alerts-icon.jpg')}}')">
					</div>
					<h4>Vos alertes</h4>
					<a href="{{ route('candidate.alert') }}" class="btn btn-secondary">GÉRER</a>

				</div>
			</div>
			<div class="col-md-8 candidates-container">
				<div class="candidates-box profile">
					<div class="col-sm-6">
						<div class="icon" style="background-image:url('{{asset('images/candidate-profile-icon.jpg')}}')"></div>
					</div>
					<div class="col-sm-6">
						<h4>{{Auth::user()->firstname.', '.Auth::user()->lastname}}</h4>
						<p>{{ Auth::user()->candidate->address}}</p>
						<p>{{ Auth::user()->email}}</p>
						<a href="{{ route('candidate.profile') }}" class="btn">MODIFIER</a>
					</div>
				</div>
			</div>
			<div class="col-md-4 candidates-container">
				<div class="candidates-box contact">
					<div class="icon" style="background-image:url('{{asset('images/candidate-contact-icon.jpg')}}')">
					</div>
					<h4>Contactez-nous</h4>
					<a href="{{ route('candidate.contact')}}" class="btn">CONTACTER</a>
				</div>
			</div>
		</div>

		@include('candidate.partials.related')
	</div>
</div>

@endsection

@push('stylesheets')

@endpush

@push('javascripts-libs')
    <script src="{{ asset('/plugins/datatables/datatables.min.js') }}"></script>

@endpush

@push('javascripts')

@endpush
