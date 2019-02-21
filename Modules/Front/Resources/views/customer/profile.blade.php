@php
	$title = 'Bonjour [entreprise]';
@endphp
@extends('front::layouts.master',[
	'pageTitle' => $title,
	'htmlTitle' => 'Espace entreprise'
])

@section('content')

	<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/front/images/offer-banner.jpg')}}')">
		<div class="horizontal-inner-container">
			<h1>BONJOUR {{Auth::user()->firstname}}</h1>
		</div>
	</div>


	<div class="candidate-container">
		<div class="horizontal-inner-container">

			@include('front::customer.partials.menu')

			<div class="candidate-list">
				<ol class="breadcrumb">
					<li><a href="{{route('home')}}">ACCUEIL</a></li>
					<li><a href="{{route('customer.index')}}">ESPACE ENTREPRISE</a></li>
					<li>VOS INFORMATIONS</li>
				</ol>

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
		            'url' => route('customer.edit.profile'),
		            'method' => 'POST',
								'enctype' => 'multipart/form-data'
		        ])
		    !!}


						<h2>MODIFIER VOS INFORMATIONS</h2>

						<h3>ENTERPRISE INFORMATIONS</h3>

						<div class="row">

							<div class="col-md-6">
								<div class="{{ (isset($errors)) && $errors->has('name') ? 'has-error' : null }}">
									{!!Form::label('name', 'Enterprise')!!}
									{!!
										Form::text('name', Auth::user()->customer->first()->name, [
											'class' => 'form-control'
										])
									!!}
								</div>
							</div>

							<div class="col-md-6">
								<div class="{{ (isset($errors)) && $errors->has('email') ? 'has-error' : null }}">
									{!!Form::label('email', 'Email')!!}
									{!!
										Form::text('email', Auth::user()->customer->first()->email, [
											'class' => 'form-control',
										])
									!!}
								</div>
							</div>

							<div class="col-md-6">
								<div class="{{ (isset($errors)) && $errors->has('firstname') ? 'has-error' : null }}">
									{!!Form::label('firstname', 'Référent Prénom')!!}
									{!!
										Form::text('firstname', Auth::user()->customer->first()->firstname, [
											'class' => 'form-control',
										])
									!!}
								</div>
							</div>
							<div class="col-md-6">
								<div class="{{ (isset($errors)) && $errors->has('lastname') ? 'has-error' : null }}">
									{!!Form::label('lastname', 'Référent Nom')!!}
									{!!
										Form::text('lastname', Auth::user()->customer->first()->lastname, [
											'class' => 'form-control',
										])
									!!}
								</div>
							</div>

							<div class="col-md-6">
								<div class="{{ (isset($errors)) && $errors->has('phone_number') ? 'has-error' : null }}">
									{!!Form::label('phone_number', 'Téléphone')!!}
									{!!
										Form::text('phone_number', Auth::user()->customer->first()->phone_number, [
											'class' => 'form-control',
										])
									!!}
								</div>
							</div>


							<div class="col-md-6">
								<div class="{{ (isset($errors)) && $errors->has('address') ? 'has-error' : null }}">
									{!!Form::label('address', 'Adresse')!!}
									{!!
										Form::text('address', Auth::user()->customer->first()->address, [
											'class' => 'form-control',
										])
									!!}
								</div>
							</div>

							<div class="col-md-6">
								<div class="{{ (isset($errors)) && $errors->has('postcode') ? 'has-error' : null }}">
									{!!Form::label('postcode', 'Code postal')!!}
									{!!
										Form::text('postcode', Auth::user()->customer->first()->postcode, [
											'class' => 'form-control',
										])
									!!}
								</div>
							</div>

							<div class="col-md-6">
								<div class="{{ (isset($errors)) && $errors->has('city') ? 'has-error' : null }}">
									{!!Form::label('city', 'Ville')!!}
									{!!
										Form::text('city', Auth::user()->customer->first()->city, [
											'class' => 'form-control',
										])
									!!}
								</div>
							</div>


						</div>


						<h3>USER INFORMATIONS</h3>

						<div class="row">

								<div class="col-md-6 {{ (isset($errors)) && $errors->has('image') ? 'has-error' : null }}">

									<div class="separator" style="height:40px;"></div>

									@include('front::components.dropzone-image',[
										'image' => isset(Auth::user()->image) ?
											Auth::user()->image : null,
										'size' => 'avatar',
										'id' => 'dropzone-1',
										'name' => 'image',
										'resizeWidth' => 500
									])

								</div>

								<div class="col-md-6">

									<div class="{{ (isset($errors)) && $errors->has('user_firstname') ? 'has-error' : null }}">
									 	{!!Form::label('user_firstname', 'Prénom*')!!}
										{!!
											Form::text('user_firstname', Auth::user()->firstname, [
												'class' => 'form-control'
											])
										!!}
									</div>
									<div class="{{ (isset($errors)) && $errors->has('user_lastname') ? 'has-error' : null }}">
									 	{!!Form::label('user_lastname', 'Nom*')!!}
										{!!
											Form::text('user_lastname',  Auth::user()->lastname, [
												'class' => 'form-control'
											])
										!!}

									</div>
									<div class="{{ (isset($errors)) && $errors->has('user_email') ? 'has-error' : null }}">
										{!!Form::label('user_email', 'E-mail*')!!}
										{!!
											Form::text('user_email',  Auth::user()->email, [
												'class' => 'form-control'
											])
										!!}
									</div>
									<div class="{{ (isset($errors)) && $errors->has('user_telephone') ? 'has-error' : null }}">
									 	{!!Form::label('user_telephone', 'Téléphone*')!!}
										{!!
											Form::text('user_telephone',  Auth::user()->telephone, [
												'class' => 'form-control'
											])
										!!}
									</div>

								</div>

						</div>

						<br clear="all">

						<h3>Modifier votre mot de passe</h3>
						<div class="col-md-6">
							{!!Form::label('password', 'Mot de passe')!!}
							{!!
								Form::password('password',  [
									'class' => 'form-control'
								])
							!!}
						</div>
						<div class="col-md-6">
							{!!Form::label('password_confirmation', 'Répétez votre mot de passe')!!}
							{!!
								Form::password('password_confirmation',  [
									'class' => 'form-control'
								])
							!!}
						</div>



					<br clear="all">

					<div class="btn-red-container">

							{!!
								Form::submit('ENREGISTRER', [
									'class' => 'btn btn-red'
								])
							!!}

					</div>

			{{ Form::close()}}
					<br clear="all">

			</div>

		</div>




	</div>

@endsection

@push('styles')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="{{asset('modules/architect/plugins/dropzone/dropzone.min.css')}}">
@endpush

@push('javascripts-libs')
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
@endpush

@push('javascripts')
	<script>
		$(function() {

		});
	</script>
@endpush
