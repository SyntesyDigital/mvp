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


	<div class="candidate-container">
		<div class="horizontal-inner-container">

			@include('bwo::customer.partials.menu')

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
		            'url' => route('candidate.edit.profile'),
		            'method' => 'POST',
								'enctype' => 'multipart/form-data'
		        ])
		    !!}


						<h2>MODIFIER VOS INFORMATIONS</h2>

						<div class="row">

								{{--<div class="separator" style="height:40px;"></div>

								@include('bwo::components.dropzone-image',[
									'image' => isset(Auth::user()->image) ?
										Auth::user()->image : null,
									'size' => 'avatar',
									'id' => 'dropzone-1',
									'name' => 'image',
									'resizeWidth' => 500
								])--}}
								<div class="col-md-6">
									<div class="{{ (isset($errors)) && $errors->has('firstname') ? 'has-error' : null }}">
									 	{!!Form::label('firstname', 'Enterprise')!!}
										{!!
											Form::text('firstname', '', [
												'class' => 'form-control'
											])
										!!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="{{ (isset($errors)) && $errors->has('referent') ? 'has-error' : null }}">
									 	{!!Form::label('referent', 'Référent')!!}
										{!!
											Form::text('referent', '', [
												'class' => 'form-control'
											])
										!!}
									</div>
								</div>
								<div class="col-md-12">
									<div class="{{ (isset($errors)) && $errors->has('address') ? 'has-error' : null }}">
										{!!Form::label('address', 'Adresse')!!}
										{!!
											Form::text('address', null !== Auth::user()? Auth::user()->candidate->address:old('address'), [
												'class' => 'form-control'
											])
										!!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="{{ (isset($errors)) && $errors->has('postal_code') ? 'has-error' : null }}">
										{!!Form::label('postal_code', 'Code Postal*')!!}
										{!!
											Form::text('postal_code', null !== Auth::user()? Auth::user()->candidate->postal_code:old('postal_code'), [
												'class' => 'form-control'
											])
										!!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="{{ (isset($errors)) && $errors->has('location') ? 'has-error' : null }}">
										{!!Form::label('location', 'Localité*')!!}
										{!!
											Form::text('location', null !== Auth::user()? Auth::user()->candidate->location:old('location'), [
												'class' => 'form-control'
											])
										!!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="{{ (isset($errors)) && $errors->has('telephone') ? 'has-error' : null }}">
									 	{!!Form::label('telephone', 'Téléphone*')!!}
										{!!
											Form::text('telephone',  '', [
												'class' => 'form-control'
											])
										!!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="{{ (isset($errors)) && $errors->has('email') ? 'has-error' : null }}">
										{!!Form::label('email', 'E-mail*')!!}
										{!!
											Form::text('email',  '', [
												'class' => 'form-control'
											])
										!!}
									</div>
								</div>
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
		  $( "input[name='birthday']" ).datepicker({ dateFormat: "dd/mm/yy" });
		});
	</script>
@endpush
