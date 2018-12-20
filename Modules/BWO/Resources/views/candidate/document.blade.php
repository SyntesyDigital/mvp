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
					<li>DOCUMENTS</li>
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

				<h2>Documents</h2>

				<div class="row">
					<div class="col-md-6">

						<div class="doc-col">
							<h3>Modifier votre C.V</h3>

							<br/>

							@if(Auth::user()->candidate->resume_file != '')
								<a href="{{route('candidate.profile.downloadcv', Auth::user()->candidate)}}" class="btn btn-dark-gray"><i class="fa fa-download"></i> Télécharger mon C.V.</a>
							@endif

							<div class="separator" style="height:20px;"></div>

							<hr/>

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
							<br clear="all">
							<div class="btn-red-container">
								<input type="submit" value="Envoyer" class="btn btn-soft-gray" style="float: none;"/>
							</div>


						{{ Form::close()}}
					</div>
				</div>

				<div class="col-md-6">
					<div class="doc-col">
						<h3>Modifier ma lettre de motivation</h3>

						<br/>

						@if(Auth::user()->candidate->recommendation_letter != '')
							<a href="{{route('candidate.profile.downloadletter')}}" class="btn btn-dark-gray"><i class="fa fa-download"></i> Télécharger ma lettre de motivation</a>
						@endif

						<div class="separator" style="height:20px;"></div>

						<hr/>

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
						<div class="btn-red-container">
							<input type="submit" value="Envoyer" class="btn btn-soft-gray" style="float: none;"/>
						</div>
						{{ Form::close()}}
					</div>
			</div>
		</div> <!-- end files -->

		<br/>

		<hr/>

		<br/>

		<div class="row">
			<div class="col-xs-12">


				@if(Auth::user()->candidate->type != \Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM)
					<h3>Autre documents</h3>
					<br />
					<p>Seuls nos intérimaires ont accès aux documents</p>
				@else

					@php
						$list = Modules\RRHH\Entities\Tools\SiteList::where('identifier', 'doclist')->first();
						$documents = isset($list) ? json_decode($list->value) : null;
					@endphp

					<h3>Autre documents</h3>

					@if($documents)
					<table class="table">
						<thead>
							<tr>
								<th>Nom</th>
								<th>Type</th>
								<th></th>
							</tr>
						</thead>

						<tbody>
							@foreach($documents as $document)
								@if($document->visible == 1)
								<tr>
									<td>{{$document->filename}}</td>
									<td>{{$document->filetype}}</td>
									<td class="text-right">
										<a href="/storage/filelist/{{$document->fileurl}}" class="btn" target="_blank">Télécharger</a>
									</td>
								</tr>
								@endif
							@endforeach()

						</tbody>


					</table>
					@endif
				@endif
			</div>
		</div><!-- end datatable -->


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
	$(document).ready(function() {
		$(document ).on('change','#resume_file' , function(){ $('#resume_file-form').submit(); });
		$(document ).on('change','#recommendation_letter' , function(){ $('#recommendation_letter-form').submit();
		});
	});
	</script>
@endpush
