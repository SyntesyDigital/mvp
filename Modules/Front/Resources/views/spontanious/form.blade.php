@extends('front::layouts.master')

@section('content')
    <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/front/images/offer-banner.jpg')}}')">
      <div class="horizontal-inner-container">
          <h1>Déposez votre candidature spontanée</h1>
        </div>
      </div>
    </div>
    <div class="candidate-container">
      <div class="horizontal-inner-container">

        <div class="candidate-list">
          <ol class="breadcrumb">
            <li><a href="{{route('home')}}">ACCUEIL</a></li>
            <li>ENVOYER VOTRE CANDIDATURE</li>
          </ol>

          <div>
            <h2>ENVOYER VOTRE CANDIDATURE</h2>

            @if(Session::has('notify_success'))
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                    {{Session::get('notify_success')}}
                  </div>
                </div>
              </div>
            @endif
            @if(Session::has('notify_error'))
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-error">
                    {{Session::get('notify_error')}}
                  </div>
                </div>
              </div>
            @endif
            @if ($errors->any())
              <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
              </div>
            @endif


            {!!
                Form::open([
                    'url' => route('spontanious.store'),
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data'
                ])
            !!}

        {{--      <div class="col-md-12">
                @php
    							$agences = Modules\Extranet\Entities\Agence::get();
    					        $options_array[0] = 'Toutes';
    					        foreach ($agences as $agence){
    					        	$options_array[$agence->id] = $agence->name;
    					        }
          			@endphp

    						{!!Form::label('agence', 'Agence')!!}
    						{!!
                  Form::select('agence', $options_array, null,[
                      'class' => 'form-control input-round',
                      'placeholder' => '---'
                  ]);
                !!}
              </div>--}}
              <div class="col-md-12 radio-div {{ (isset($errors)) && $errors->has('civility') ? 'has-error' : null }}">
                {!! Form::label('civility', 'Madame') !!}
    					 	{!!
    					 		Form::radio('civility', Modules\Extranet\Entities\Offers\Candidate::CIVILITY_FEMALE , null !== Auth::user() && Auth::user()->candidate->civility == Modules\Extranet\Entities\Offers\Candidate::CIVILITY_FEMALE  ?true:false )
    					 	!!}
    					 	{!! Form::label('civility', 'Monsieur') !!}
    					 	{!!
    					 		Form::radio('civility', Modules\Extranet\Entities\Offers\Candidate::CIVILITY_MALE, null !== Auth::user() && Auth::user()->candidate->civility == Modules\Extranet\Entities\Offers\Candidate::CIVILITY_MALE  ?true:false )
    					 	!!}
              </div>
              <div class="col-md-6 {{ (isset($errors)) && $errors->has('email') ? 'has-error' : null }}">
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

              <div class="col-md-6 {{ (isset($errors)) && $errors->has('lastname') ? 'has-error' : null }}">
                {!!Form::label('lastname', 'Nom*')!!}
    						{!!
    							Form::text('lastname',  null !== Auth::user() ? Auth::user()->lastname: old('lastname'), [
    								'class' => 'form-control'
    							])
    						!!}
              </div>

              <div class="col-md-6 {{ (isset($errors)) && $errors->has('firstname') ? 'has-error' : null }}">
                {!!Form::label('firstname', 'Prénom*')!!}
                {!!
                  Form::text('firstname', null !== Auth::user()? Auth::user()->firstname:old('firstname'), [
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

              <div class="col-md-6 {{ (isset($errors)) && $errors->has('location') ? 'has-error' : null }}">
                {!!Form::label('location', 'Ville*')!!}
                {!!
                  Form::text('location', null !== Auth::user()? Auth::user()->candidate->location:old('location'), [
                    'class' => 'form-control'
                  ])
                !!}
              </div>

              <div class="col-md-6 {{ (isset($errors)) && $errors->has('postal_code') ? 'has-error' : null }}">
                {!!Form::label('postal_code', 'Code Postale*')!!}
    						{!!
    							Form::text('postal_code', null !== Auth::user()? Auth::user()->candidate->postal_code:old('postal_code'), [
    								'class' => 'form-control'
    							])
    						!!}
              </div>

              <div class="col-md-6">
                {!!Form::label('country', 'Pays')!!}

    					 	@include('front::partials.countries', ['default' => null !== Auth::user()? Auth::user()->candidate->country:'France'])
              </div>


              <div class="col-md-6 {{ (isset($errors)) && $errors->has('telephone') ? 'has-error' : null }}">
                {!!Form::label('telephone', 'Tel. Mobile*')!!}
    						{!!
    							Form::text('telephone',  null !== Auth::user()? Auth::user()->telephone:old('telephone'), [
    								'class' => 'form-control'
    							])
    						!!}
              </div>

              <div class="col-md-12 {{ (isset($errors)) && $errors->has('message') ? 'has-error' : null }}">
                {!!Form::label('message', 'Votre Message*')!!}
    						{!!
    							Form::textarea('message',  null !== Auth::user()? Auth::user()->candidate->message:old('message'), [
    								'class' => 'form-control'
    							])
    						!!}
              </div>


              <div class="col-md-6 {{ (isset($errors)) && $errors->has('resume_file') ? 'has-error' : null }}">
                {!!Form::label('resume_file', 'Votre CV (pdf,doc,docx)')!!}
    						{!!
    							Form::file('resume_file', null, [
    								'class' => 'form-control',
    								'id' => 'resume_file'
    							])
    						!!}
              </div>

              <br clear="all">
              <div class="btn-red-container">
                {!!
  								Form::submit('VALIDER', [
  									'class' => 'btn btn-red'
  								])
  							!!}
              </div>
            {{ Form::close()}}
          </div>

          <br clear="all">
        </div>
      </div>
    </div>
@endsection



@push('javascripts')
	<script>

    $(document).ready(function() {
        $(document).on("click","#btn-more",function() {
          $(this).hide();
          $('#btn-less').show();
          $('.light-gray-search-container').show();
        });

        $(document).on("click","#btn-less",function() {
          $(this).hide();
          $('#btn-more').show();
          $('.light-gray-search-container').hide();
        });
        $(document).ready(function() {
            $(document).on("click",".btn-search",function() {
              $(this).closest('form').submit();
            });
        });
        $(document).ready(function() {
            $(document).on("click","#btn-filtres",function() {
              $(this).closest('form').submit();
            });
        });


    });

  </script>

@endpush
