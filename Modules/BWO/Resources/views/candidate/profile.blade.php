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


	<div class="candidate-container">
		<div class="horizontal-inner-container">

			@include('bwo::candidate.partials.menu')

			<div class="candidate-list">
				<ol class="breadcrumb">
					<li><a href="{{route('home')}}">ACCUEIL</a></li>
					<li><a href="{{route('candidate.index')}}">ESPACE CANDIDAT</a></li>
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
		            'url' => route('candidate.edit.profile'),
		            'method' => 'POST',
								'enctype' => 'multipart/form-data'
		        ])
		    !!}


						<h2>MODIFIER VOS INFORMATIONS</h2>

						<div class="row">
							<div class="col-md-6 {{ (isset($errors)) && $errors->has('image') ? 'has-error' : null }}">

								<div class="separator" style="height:40px;"></div>

								@include('bwo::components.dropzone-image',[
									'image' => isset(Auth::user()->image) ?
										Auth::user()->image : null,
									'size' => 'avatar',
									'id' => 'dropzone-1',
									'name' => 'image',
									'resizeWidth' => 500
								])

							</div>
							<div class="col-md-6">

									<div class="{{ (isset($errors)) && $errors->has('firstname') ? 'has-error' : null }}">
									 	{!!Form::label('firstname', 'Prénom*')!!}
										{!!
											Form::text('firstname', Auth::user()->firstname, [
												'class' => 'form-control'
											])
										!!}
									</div>
									<div class="{{ (isset($errors)) && $errors->has('lastname') ? 'has-error' : null }}">
									 	{!!Form::label('lastname', 'Nom*')!!}
										{!!
											Form::text('lastname',  Auth::user()->lastname, [
												'class' => 'form-control'
											])
										!!}

									</div>
									<div class="{{ (isset($errors)) && $errors->has('email') ? 'has-error' : null }}">
										{!!Form::label('email', 'E-mail*')!!}
										{!!
											Form::text('email',  Auth::user()->email, [
												'class' => 'form-control'
											])
										!!}
									</div>
									<div class="{{ (isset($errors)) && $errors->has('telephone') ? 'has-error' : null }}">
									 	{!!Form::label('telephone', 'Téléphone*')!!}
										{!!
											Form::text('telephone',  Auth::user()->telephone, [
												'class' => 'form-control'
											])
										!!}
									</div>

								</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								{!!Form::label('address', 'Adresse')!!}
								{!!
									Form::text('address', null !== Auth::user()? Auth::user()->candidate->address:old('address'), [
										'class' => 'form-control'
									])
								!!}
							</div>
							<div class="col-md-6 {{ (isset($errors)) && $errors->has('postal_code') ? 'has-error' : null }}">
								{!!Form::label('postal_code', 'Code Postal*')!!}
								{!!
									Form::text('postal_code', null !== Auth::user()? Auth::user()->candidate->postal_code:old('postal_code'), [
										'class' => 'form-control'
									])
								!!}
							</div>
							<div class="col-md-6 {{ (isset($errors)) && $errors->has('location') ? 'has-error' : null }}">
								{!!Form::label('location', 'Localité*')!!}
								{!!
									Form::text('location', null !== Auth::user()? Auth::user()->candidate->location:old('location'), [
										'class' => 'form-control'
									])
								!!}
							</div>
							<div class="col-md-6">
								{!!Form::label('country', 'Pays')!!}
							 	@include('bwo::partials.countries', ['default' => null !== Auth::user()? Auth::user()->candidate->country:null])
							</div>

							<div class="col-md-6 {{ (isset($errors)) && $errors->has('birthday') ? 'has-error' : null }}" >
								{!!Form::label('birthday', 'Date de naissance')!!}
							 	@if( Auth::user() && Auth::user()->candidate->birthday != null)
							 		@php
							 			$date = explode('-',Auth::user()->candidate->birthday);
		            					$date_formated = $date[2].'/'.$date[1].'/'.$date[0];
							 		@endphp
							 	@endif
								{!!
									Form::text('birthday', null !== Auth::user() && Auth::user()->candidate->birthday != null? $date_formated:'', [
										'class' => 'form-control'
									])
								!!}
							</div>
							<div class="col-md-6">
								{!!Form::label('birthplace', 'Lieu de naissance')!!}
								{!!
									Form::text('birthplace', null !== Auth::user()? Auth::user()->candidate->birthplace:old('birthplace'), [
										'class' => 'form-control'
									])
								!!}
							</div>

					</div>

						<br clear="all">
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
					<br clear="all">

					<h3>VOTRE RECHERCHE</h3>

					<div class="col-md-6 checkbox-list">

							@php
								$list = Modules\RRHH\Entities\Tools\SiteList::where('identifier', 'contracts')->first();
								$contracts = collect(json_decode($list->value, true))->mapWithKeys(function ($item, $key) {
										return [$item['value'] => $item['name']];
								})->toArray();
							@endphp

						{!! Form::Label('contract_type', 'Vous cherchez un contrat : ') !!}
						<ul>

						@foreach($contracts as $k => $v)
								<li>
										<label>
												{!!
														Form::checkbox('contract_type[]', $k, Auth::user()->candidate->contract_type != "" && in_array($k,Auth::user()->candidate->contract_type))
												!!}
												{{ $v }}
										</label>
								</li>
						@endforeach()
						</ul>

						{!! Form::Label('salary', 'Votre rénumération souhaitée : ') !!}
						{!! Form::text('salary',
							 null !== Auth::user()? Auth::user()->candidate->salary:old('salary'),
							['class' => 'form-control']) !!}
					</div>

					<div class="col-md-6">
							{!! Form::Label('important_information', 'Informations importantes (contraintes horaires, géographiques...) : ') !!}
							{!!
									Form::textarea('important_information',
									null !== Auth::user()? Auth::user()->candidate->important_information : old('important_information'),
									[
											'class' => 'form-control fixed-height'
									])
							!!}
					</div>

					<br clear="all">
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



<div class="three-colors-separator">
	<div class="separator-piece dark-gray"></div>
	<div class="separator-piece soft-gray"></div>
	<div class="separator-piece red"></div>
</div>

<div class="offers-3-container candidate-page">
		@include('bwo::partials.three-offers')
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
		  $( "input[name='birthday']" ).datepicker({ dateFormat: "dd/mm/yy" });
		});
	</script>
@endpush
