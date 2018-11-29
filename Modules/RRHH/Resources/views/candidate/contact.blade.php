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



				<h2>Contatez-nous</h2>
				 	@if(Session::has('notify_error'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        {{ Session::get('notify_error') }}
                                    </div>
                                </div>
                            </div>
                    @endif

                    @if(Session::has('notify_success'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success">
                                        {{ Session::get('notify_success') }}
                                    </div>
                                </div>
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

							<div class="col-md-6">
								{!!Form::label('email', 'E-mail')!!}
								{!!
									Form::text('email', Auth::user()->email, [
										'class' => 'form-control',
										'required' => true,
									])
								!!}
							</div>

							<div class="col-md-6">
								{!!Form::label('subject', 'Sujet')!!}
								{!!
                                  Form::siteList('contact_questions', 'subject', null, [
                                      'class' => 'form-control',
                                      'required' => true,
                                  ])
                                !!}

							</div>
						</div>
						<div class="row">
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
						<div class="col-md-12">
							{!!
								Form::submit('ENVOYER', [
									'class' => 'btn'
								])
							!!}
						</div>

				    {{ Form::close()}}
			</div>


		</div>
	</div>

	<div class="offers-separator"></div>
	@include('candidate.partials.related')
</div>

@endsection

@push('stylesheets')

@endpush

@push('javascripts-libs')

@endpush

@push('javascripts')

@endpush
