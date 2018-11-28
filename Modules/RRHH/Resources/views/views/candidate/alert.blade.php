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
				<h2>Alertes</h2>
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							 <input type="text" name="filters" id="tags-filters" value="" placeholder="Recherche rapide" class="form-control" />
						</div>
					</div>
				</div>
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

					<div class="col-md-12" style="margin-top: 40px;">
						{!!
							Form::submit('MODIFIER', [
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
