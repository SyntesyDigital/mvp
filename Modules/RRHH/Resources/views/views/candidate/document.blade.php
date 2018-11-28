@php
	$title = 'BONJOUR '.Auth::user()->firstname;
@endphp
@extends('layouts.frontend',[ 	'header' => 'white-bar',
 								'search_bar_style' => 'display:none',
 								'headerTitle' => $title,
 								'htmlTitle' => 'Documents'
  							 ])

@section('content')


<div class="candidate">
	<div class="bk-candidate-menu" style="background-image:url('{{asset('images/candidate-bk-hexagons.jpg')}}')">
		<div class="horizontal-inner-container horizontal-inner-container-candidate-profile" >

			@include('candidate.partials.hexmenu')


			<div class="candidate-page-content">

				@if(Auth::user()->candidate->type != \Modules\RRHH\Entities\Offers\Candidate::TYPE_INTERIM)
					<h2>Document</h2>
					<br />
					<p>Seuls nos intérimaires ont accès aux documents</p>
				@else

					@php
						$list = Modules\RRHH\Entities\Tools\SiteList::where('identifier', 'doclist')->first();
						$documents = json_decode($list->value);
					@endphp


					<h2>Documents</h2>

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
	<script>
	$(document).ready(function() {
		$(document ).on('change','#resume_file' , function(){ $('#resume_file-form').submit(); });
		$(document ).on('change','#recommendation_letter' , function(){ $('#recommendation_letter-form').submit();
		});
	});
	</script>
@endpush
