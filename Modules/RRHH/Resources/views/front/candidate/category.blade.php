@extends('layouts.frontend')

@php
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }
@endphp

@section('content')

<div class="categories-bar">
	<div class="horizontal-inner-container">
		<div class="row">
			<div class="col-md-12 ">
				<h4>Candidat :</h4>
                @foreach($categories as $category)
					<a href="{{ route('candidate.category', $category->getFieldValue('slug')) }}">
						<div class="label-box">
							{{$category->getFieldValue('name')}}
						</div>
					</a>
				@endforeach()
			</div>
		</div>
	</div>
</div>

<div class="blog-results">
	<div class="horizontal-inner-container">
		<div class="row">
			<?php $side_class = 'left'; ?>

			@foreach ($contents as $content)

				<div class="item {{ $side_class }}">

					@if($content->getFieldValue('summary_image'))
					@php
						$color =  random_color();
					@endphp

					<div class="image">
						<div class="hexagon"   style="background-image:url('{{ Storage::url('/medias/' . $content->getFieldValue('summary_image')) }}');border-color:#<?php echo $color; ?>" >
							<div class="hexTop" style="border-color:#<?php echo $color; ?>"></div>
							<div class="hexBottom" style="border-color:#<?php echo $color; ?>"></div>
						</div>
					</div>
					@endif


					<div class="content">
						<div class="item-header">
							{{--<p class="date">{{ date("d/m/Y", strtotime($content->created_at)) }}</p>--}}
							@if($category)
								<p class="categorie">{{ $category->name }}</p>
							@endif
						</div>
						<h3>{{ $content->getFieldValue('title') }}</h3>
						<p>
							{{ $content->getFieldValue('excerpt') }}
						</p>
						<a href="{{ route('candidate.page', [
                            'slug' => $content->getFieldValue('slug')
                        ]) }}" class="btn btn-secondary">LIRE LA SUITE</a>
					</div>
				</div>


				@if($side_class == 'left')
					<?php $side_class = 'right'; ?>
				@else
					<?php $side_class = 'left'; ?>
				@endif
			@endforeach

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
