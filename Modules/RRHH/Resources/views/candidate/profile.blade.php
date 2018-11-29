@php
	$title = 'Bonjour '.Auth::user()->firstname;
@endphp
@extends('layouts.frontend',[ 	'pageTitle' => $title,
 								'htmlTitle' => 'Menco Intérim | Espace candidat'
  							 ])

@section('content')


<div class="candidate">
	<div class="bk-candidate-menu">
		<div class="horizontal-inner-container horizontal-inner-container-candidate-profile" >

			@include('candidate.partials.candmenu')

			<div class="candidate-page-content">

				@if(Session::has('notify_success'))
					<div class="alert alert-success">
						{{ Session::get('notify_success') }}
					</div>
				@endif
				@if($errors)
            <p class="has-error" align="center">{{$errors->first()}}</p>
        @endif

				<h2>Modifier vos informations</h2>
				{!!
			        Form::open([
			            'url' => route('candidate.edit.profile'),
			            'method' => 'POST'
			        ])
			    !!}
					<div class="col-md-6 {{ (isset($errors)) && $errors->has('firstname') ? 'has-error' : null }}">
					 	{!!Form::label('firstname', 'Prénom*')!!}
						{!!
							Form::text('firstname', Auth::user()->firstname, [
								'class' => 'form-control'
							])
						!!}
					</div>
					<div class="col-md-6 {{ (isset($errors)) && $errors->has('lastname') ? 'has-error' : null }}">
					 	{!!Form::label('lastname', 'Nom*')!!}
						{!!
							Form::text('lastname',  Auth::user()->lastname, [
								'class' => 'form-control'
							])
						!!}

					</div>
					<div class="col-md-6 {{ (isset($errors)) && $errors->has('telephone') ? 'has-error' : null }}">
					 	{!!Form::label('telephone', 'Téléphone*')!!}
						{!!
							Form::text('telephone',  Auth::user()->telephone, [
								'class' => 'form-control'
							])
						!!}
					</div>
					<div class="col-md-6 {{ (isset($errors)) && $errors->has('email') ? 'has-error' : null }}">
						{!!Form::label('email', 'E-mail*')!!}
						{!!
							Form::text('email',  Auth::user()->email, [
								'class' => 'form-control'
							])
						!!}
					</div>
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
					 	@include('front.partials.countries', ['default' => null !== Auth::user()? Auth::user()->candidate->country:null])
					</div>

					<div class="col-md-6  {{ (isset($errors)) && $errors->has('birthday') ? 'has-error' : null }}">
						{!!Form::label('birthday', 'Date de naissance (dd/mm/aaaa)')!!}
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
							<br clear="all">
				<h2>Modifier votre mot de passe</h2>
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
					<div class="col-md-12">
						{!!
							Form::submit('ENREGISTRER', [
								'class' => 'btn'
							])
						!!}
					</div>
			    {{ Form::close()}}
					<br clear="all">
					<br clear="all">

			    <h2>Modifier votre C.V</h2>
				<div class="col-md-6">
					{!!
						Form::open([
							'url' => route('candidate.profile.storecv'),
							'method' => 'POST',
							'id' => 'resume_file-form',
							'enctype' => 'multipart/form-data'
						])
					!!}
					{!! Form::label('resume_file', 'Ajouter CV (pdf,doc,docx)') !!}
					{!!
						Form::file('resume_file', null, [
							'class' => 'form-control',
							'required' => true,
							'id' => 'resume_file'
						])
					!!}
					<br />
					<input type="submit" value="Envoyer" class="btn" style="float: none;"/>
					{{ Form::close()}}
				</div>
				<div class="col-md-6 text-right">
					@if(Auth::user()->candidate->resume_file != '')
						<a href="{{route('candidate.profile.downloadcv', Auth::user()->candidate)}}">Télécharger mon C.V.</a>
					@endif
				</div>

				<div class="clear" style="clear:both; height: 20px;"></div>

				<h2>Modifier ma lettre de motivation</h2>
				<div class="col-md-6">
					{!!
				        Form::open([
				            'url' => route('candidate.profile.storeletter'),
				            'method' => 'POST',
				            'id' => 'recommendation_letter-form',
				            'enctype' => 'multipart/form-data'
				        ])
				    !!}
					{!!Form::label('recommendation_letter', 'Lettre de recommandation (pdf,doc,docx)')!!}
					{!!
						Form::file('recommendation_letter', null, [
							'class' => 'form-control',
							'required' => true,
							'id' => 'recommendation_letter'
						])
					!!}
					<br />
					<input type="submit" value="Envoyer" class="btn" style="float: none;"/>
					{{ Form::close()}}
				</div>
				<div class="col-md-6 text-right">
					@if(Auth::user()->candidate->recommendation_letter != '')
						<a href="{{route('candidate.profile.downloadletter')}}">Télécharger ma lettre de motivation</a>
					@endif
				</div>


<<<<<<< HEAD

=======
>>>>>>> fix-seeder
			</div>

		</div>




	</div>



	@include('candidate.partials.related')

</div>

@endsection

@push('stylesheets')
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
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
