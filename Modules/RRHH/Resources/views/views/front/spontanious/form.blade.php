@extends('layouts.frontend',[
    'pageTitle' => 'Envoyer votre candidature',
    'htmlTitle' => 'Envoyer votre candidature',
    'metaDescription' => 'Envoyer votre candidature'
])

@section('content')
<div class="spontanious">
	<div class="bk-candidate-menu" style="background-image:url('{{asset('images/candidate-bk-hexagons.jpg')}}')">
		<div class="horizontal-inner-container horizontal-inner-container-candidate-profile" >

			<div class="candidate-page-content">

				<h2>Modifier vos informations</h2>

                @if(Session::has('notify_error'))
                    <p class="has-error" align="center">{{Session::get('notify_error')}}</p>
                @endif

                {!!
                    Form::open([
                        'url' => route('spontanious.store'),
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data'
                    ])
                !!}
					<div class="col-md-offset-3 col-md-6">
						@php
							$agences = Modules\RRHH\Entities\Agence::get();
					        $options_array[0] = 'Toutes';
					        foreach ($agences as $agence){
					        	$options_array[$agence->id] = $agence->name;
					        }
	        			@endphp

						{!!Form::label('agence', 'Agence')!!}
						{!!
                          Form::select('agence', $options_array, null,[
                              'class' => 'form-control',
                              'placeholder' => '---',
                              'required' => true,
                          ]);
                        !!}
					</div>
					<div class="col-md-offset-3 col-md-6 radio-div {{ (isset($errors)) && $errors->has('civility') ? 'has-error' : null }}">
					 	{!! Form::label('civility', 'Madame') !!}
					 	{!!
					 		Form::radio('civility', Modules\RRHH\Entities\Offers\Candidate::CIVILITY_FEMALE , null !== Auth::user() && Auth::user()->candidate->civility == Modules\RRHH\Entities\Offers\Candidate::CIVILITY_FEMALE  ?true:false )
					 	!!}
					 	{!! Form::label('civility', 'Monsieur') !!}
					 	{!!
					 		Form::radio('civility', Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE, null !== Auth::user() && Auth::user()->candidate->civility == Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE  ?true:false )
					 	!!}
					</div>

                    <div class="col-md-offset-3 col-md-6  {{ (isset($errors)) && $errors->has('email') ? 'has-error' : null }}">
                        {!!Form::label('email', 'E-mail*')!!}
                        {!!
                            Form::text('email',  null !== Auth::user()? Auth::user()->email:old('email'), [
                                'class' => 'form-control'
                            ])
                        !!}
                        @if((isset($errors)) && $errors->has('email'))
                            <p>{{ $errors->first('email') }}</p>
                        @endif
                    </div>

					<div class="col-md-offset-3 col-md-6  {{ (isset($errors)) && $errors->has('lastname') ? 'has-error' : null }}">
					 	{!!Form::label('lastname', 'Nom*')!!}
						{!!
							Form::text('lastname',  null !== Auth::user() ? Auth::user()->lastname: old('lastname'), [
								'class' => 'form-control'
							])
						!!}

					</div>
					<div class="col-md-offset-3 col-md-6  {{ (isset($errors)) && $errors->has('firstname') ? 'has-error' : null }}">
					 	{!!Form::label('firstname', 'Prénom*')!!}
						{!!
							Form::text('firstname', null !== Auth::user()? Auth::user()->firstname:old('firstname'), [
								'class' => 'form-control'
							])
						!!}
					</div>
					<div class="col-md-offset-3 col-md-6">
					 	{!!Form::label('address', 'Adresse')!!}
						{!!
							Form::text('address', null !== Auth::user()? Auth::user()->candidate->address:old('address'), [
								'class' => 'form-control'
							])
						!!}
					</div>
					<div class="col-md-offset-3 col-md-6 {{ (isset($errors)) && $errors->has('location') ? 'has-error' : null }}">
					 	{!!Form::label('location', 'Ville*')!!}
						{!!
							Form::text('location', null !== Auth::user()? Auth::user()->candidate->location:old('location'), [
								'class' => 'form-control'
							])
						!!}
					</div>
					<div class="col-md-offset-3 col-md-6  {{ (isset($errors)) && $errors->has('postal_code') ? 'has-error' : null }}">
					 	{!!Form::label('postal_code', 'Code Postale*')!!}
						{!!
							Form::text('postal_code', null !== Auth::user()? Auth::user()->candidate->postal_code:old('postal_code'), [
								'class' => 'form-control'
							])
						!!}
					</div>
					<div class="col-md-offset-3 col-md-6">
					 	{!!Form::label('country', 'Pays')!!}

					 	@include('front.partials.countries', ['default' => null !== Auth::user()? Auth::user()->candidate->country:'France'])

					</div>
					{{-- <div class="col-md-offset-3 col-md-6">
					 	{!!Form::label('birthday', 'Date de naissance')!!}

                        @if(Auth::user())
					 		@php
					 			$date = explode('-', Auth::user()->candidate->birthday);
                                $date_formated = null;

                                if(isset($date[2]) && isset($date[1]) && isset($date[0])) {
                                    $date_formated = sprintf(
                                        '%d-%d-%d',
                                        $date[2],
                                        $date[1],
                                        $date[0]
                                    );
                                }
					 		@endphp
					 	@endif

						{!!
							Form::text('birthday', null !== Auth::user() ? $date_formated : '', [
								'class' => 'form-control'
							])
						!!}
					</div>
					<div class="col-md-offset-3 col-md-6">
					 	{!!Form::label('birthplace', 'Ĺieu de naissance')!!}
						{!!
							Form::text('birthplace', null !== Auth::user()? Auth::user()->candidate->birthplace:'', [
								'class' => 'form-control'
							])
						!!}
					</div> --}}
					<div class="col-md-offset-3 col-md-6  {{ (isset($errors)) && $errors->has('message') ? 'has-error' : null }}">
					 	{!!Form::label('message', 'Votre Message*')!!}
						{!!
							Form::textarea('message',  null !== Auth::user()? Auth::user()->candidate->message:old('message'), [
								'class' => 'form-control'
							])
						!!}
					</div>


					<div class="col-md-offset-3 col-md-6  {{ (isset($errors)) && $errors->has('telephone') ? 'has-error' : null }}">
					 	{!!Form::label('telephone', 'Tel. Mobile*')!!}
						{!!
							Form::text('telephone',  null !== Auth::user()? Auth::user()->telephone:old('telephone'), [
								'class' => 'form-control'
							])
						!!}
					</div>

					{{-- <div class="col-md-offset-3 col-md-6">
						@if(Auth::check() && Auth::user()->candidate->resume_file != '')
						<br clear="all">
					    	{!!Form::label('resume_file', 'Actual Resume File')!!}
				    		<a href="{{route('candidate.profile.downloadcv', Auth::user()->candidate)}}" class="download">Télécharger CV</a>

				    	@endif
					</div> --}}

					<div class="col-md-offset-3 col-md-6 {{ (isset($errors)) && $errors->has('resume_file') ? 'has-error' : null }}">
					    {!!Form::label('resume_file', 'Votre CV (pdf,doc,docx)')!!}
						{!!
							Form::file('resume_file', null, [
								'class' => 'form-control',
								'id' => 'resume_file'
							])
						!!}
					</div>

          {{--
					<div class="col-md-offset-3 col-md-6 {{ (isset($errors)) && $errors->has('job_1') ? 'has-error' : null }}">
					    {!!Form::label('jobs_1', 'Metier 1')!!}
				        {!!
		                    Form::siteList('jobs1', 'job_1', Auth::check() && Auth::user()->candidate->job_1?Auth::user()->candidate->job_1:null, [
		                        'class' => 'form-control',
		                        'placeholder' => '---'
		                    ], 'select')
	                  	!!}
					</div>



					<div class="col-md-offset-3 col-md-6">
					    {!!Form::label('jobs_2', 'Metier 2')!!}
				        {!!
		                    Form::siteList('jobs1', 'job_2', Auth::check() && Auth::user()->candidate->job_2?Auth::user()->candidate->job_2:null, [
		                        'class' => 'form-control',
		                        'placeholder' => '---'
		                    ], 'select')
	                  	!!}
					</div>
					<div class="col-md-offset-3 col-md-6">
					    {!!Form::label('jobs_3', 'Metier 3')!!}
				        {!!
		                    Form::siteList('jobs1', 'job_3', Auth::check() && Auth::user()->candidate->job_1?Auth::user()->candidate->job_3:null, [
		                        'class' => 'form-control',
		                        'placeholder' => '---'
		                    ], 'select')
	                  	!!}
					</div> --}}

					<div class="col-md-12 btn-div">
						{!!
							Form::submit('VALIDER', [
								'class' => 'btn'
							])
						!!}
					</div>
			    {{ Form::close()}}
			</div>


		</div>
	</div>

	<div class="offers-separator"></div>
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
