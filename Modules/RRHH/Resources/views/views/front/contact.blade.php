@extends('layouts.frontend', [
	'htmlTitle' => 'Toutes les agences d\'intérim Menco',
	'metaDescription' =>'Présentation des agences d\'intérim Menco de Bordeaux, Libourne, Nantes, Pau, Rennes, Saint-Herblain, Saint-Nazaire et Tours. Coordonnées et contact, zoom sur les profils recherchés par secteur et par ville. Professionnels et candidats, venez nous rencontrer pour un recrutement gagnant !',
	'pageTitle' => 'Contacter' ])

@section('content')
<div class="contact-container">
	<div class="horizontal-inner-container">
		<div class="row">
			<div class="col-md-12">

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

				<div class="row">
					<div class="col-md-12">
						<h2>CONTACTEZ-NOUS</h2>
					</div>
				</div>
				{!!
			        Form::open([
			            'url' => route('contact.send'),
			            'method' => 'POST'
			        ])
			    !!}
					<div class="row">

						<div class="col-md-6">
							{!!
								Form::text('name', null, [
									'class' => 'form-control',
									'required' => true,
									'placeholder' => 'Nom'
								])
							!!}
						</div>

						<div class="col-md-6">
							{!!
								Form::text('lastname', null, [
									'class' => 'form-control',
									'required' => true,
									'placeholder' => 'Prénom'
								])
							!!}
						</div>

						<div class="col-md-6">
							{!!
								Form::text('email', null, [
									'class' => 'form-control',
									'required' => true,
									'placeholder' => 'E-mail'
								])
							!!}
						</div>

						<div class="col-md-6">
							{!!
								Form::text('subject', null, [
									'class' => 'form-control',
									'required' => true,
									'placeholder' => 'Sujet'
								])
							!!}
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							{!!
								Form::textarea('message', null, [
									'class' => 'form-control',
									'required' => true,
									'placeholder' => 'Message...'
								])
							!!}
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							{!!
								Form::submit('ENVOYER', [
									'class' => 'btn'
								])
							!!}
						</div>
					</div>


			    {{ Form::close()}}
			</div>
		</div>
	</div>
</div>
@endsection

@push('stylesheets')

@endpush

@push('javascripts-libs')

@endpush

@push('javascripts')

@endpush
