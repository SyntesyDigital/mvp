@php
	$title = 'Bonjour '.Auth::user()->firstname;
@endphp
@extends('front::layouts.master',[
	'pageTitle' => $title,
	'htmlTitle' => 'Espace candidat'
])

@section('content')

<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/front/images/offer-banner.jpg')}}')">
	<div class="horizontal-inner-container">
		<h1>BONJOUR {{Auth::user()->firstname}}</h1>
	</div>
</div>

<div class="candidate-container">
	<div class="horizontal-inner-container">

		@include('front::candidate.partials.menu')

		<div class="candidate-list">
			<ol class="breadcrumb">
				<li><a href="{{route('home')}}">ACCUEIL</a></li>
				<li><a href="{{route('candidate.index')}}">ESPACE CANDIDAT</a></li>
				<li>VOS INFORMATIONS</li>
			</ol>

			<div class="candidate-page-content">

				<h2>Contatez-nous</h2>

						@if($errors->any())
								<ul class="alert alert-danger">
										@foreach ($errors->all() as $error)
												<li >{{ $error }}</li>
										@endforeach
								</ul>
						@endif

						@if (session('success'))
								<div class="alert alert-success">
										{{ session('success') }}
								</div>
						@endif

						@if (session('error'))
								<div class="alert alert-danger">
										{{ session('error') }}
								</div>
						@endif



					{!!
				        Form::open([
				            'url' => route('candidate.contact.send'),
				            'method' => 'POST'
				        ])
				    !!}
						<div class="row">
							<div class="col-md-6">
								{!!Form::label('name', 'Prénom')!!}
								{!!
									Form::text('name', Auth::user()->firstname, [
										'class' => 'form-control',
										'required' => true,
									])
								!!}
							</div>

							<div class="col-md-6">
								{!!Form::label('lastname', 'Nom')!!}
								{!!
									Form::text('lastname', Auth::user()->lastname, [
										'class' => 'form-control',
										'required' => true,
									])
								!!}
							</div>

							<div class="col-md-12">
								{!!Form::label('email', 'E-mail')!!}
								{!!
									Form::text('email', Auth::user()->email, [
										'class' => 'form-control',
										'required' => true,
									])
								!!}
							</div>


						</div>
						<div class="row">

							<div class="col-md-12">
								{!!Form::label('subject', 'Sujet')!!}
								{!!
                  Form::text('subject', null, [
                      'class' => 'form-control',
                      'required' => true,
                  ])
                !!}

							</div>

							<div class="col-md-12">
								{!!Form::label('message', 'Message')!!}
								{!!
									Form::textarea('message', null, [
										'class' => 'form-control',
										'required' => true,
										'rows' => 3
									])
								!!}
							</div>
						</div>
						<br clear="all">
						<div class="btn-red-container">
							{!!
								Form::submit('ENVOYER', [
									'class' => 'btn btn-red'
								])
							!!}
						</div>

				    {{ Form::close()}}
			</div>


		</div>
	</div>
</div>


<div class="three-colors-separator">
	<div class="separator-piece dark-gray"></div>
	<div class="separator-piece soft-gray"></div>
	<div class="separator-piece red"></div>
</div>

<div class="offers-3-container candidate-page">
		@include('front::partials.three-offers')
</div>

@endsection

@push('stylesheets')

@endpush

@push('javascripts-libs')

@endpush

@push('javascripts')

@endpush
