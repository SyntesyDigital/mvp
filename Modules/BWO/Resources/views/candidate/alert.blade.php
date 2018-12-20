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
</div>

<div class="candidate-container">
	<div class="horizontal-inner-container">

		@include('bwo::candidate.partials.menu')

		<div class="candidate-list">
			<ol class="breadcrumb">
				<li><a href="{{route('home')}}">ACCUEIL</a></li>
				<li><a href="{{route('candidate.index')}}">ESPACE CANDIDAT</a></li>
				<li>ALERTES</li>
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

			<div class="candidate-page-content">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="row">
							<div class="col-md-6">
								<h2>Alertes</h2>
							</div>
							<div class="col-md-6">
								 <input type="text" name="filters" id="tags-filters" value="" placeholder="Recherche rapide" class="form-control" />
							</div>
						</div>
					</div>
					<div class="separator" style="height:20px;"></div>
					<div class="col-md-10 col-md-offset-1">
					{!!
				        Form::open([
				            'url' => route('candidate.alert.send'),
				            'method' => 'POST'
				        ])
				    !!}

						@foreach(\Modules\RRHH\Entities\Tag::get()->all() as $tag)
							<div class="col-md-3 col-sm-6 tag">
								{{ Form::checkbox('tags[]', $tag->name, in_array($tag->id, $user_tags), array('id' => $tag->id)) }}
								<label class="text" for="{{$tag->id}}">{{$tag->name}} ({{$tag->offers()->count()}})
								</label>
							</div>
						@endforeach

					</div>
				</div>

				<div class="btn-red-container">

					{!!
						Form::submit('MODIFIER', [
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
      @include('bwo::partials.three-offers')
  </div>

@endsection

@push('stylesheets')

@endpush

@push('javascripts-libs')

@endpush

@push('javascripts')
	<script>
		$('input[name="filters"]').keyup(function(){
			var valThis = $(this).val().toLowerCase();
			if(valThis == ""){
				$('.tag').show();
			} else {
				$('.tag').each(function(){
					var text = $(this).find('.text').text().toLowerCase();
					(text.indexOf(valThis) >= 0) ? $(this).show() : $(this).hide();
				});
			};
		});
	</script>
@endpush
