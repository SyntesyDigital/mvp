
@extends('layouts.frontend', [
    'header' => 'white-bar',
    'search_bar_style' => 'display:none',
    'headerTitle' => $content ? $content->getFieldValue('title') : null,
    'htmlTitle' => $content ? $content->getFieldValue('meta_title') : null,
    'metaDescription' => $content ? $content->getFieldValue('meta_description') : null
])

@php

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    function random_color() {
        return random_color_part() . random_color_part() . random_color_part();
    }
@endphp

@section('content')
<div class="blog-post">
	<div class="horizontal-inner-container">
		<div class="row">
			<div class="col-md-12">
				<div class="item">
					<div class="content">

          {{--  <div class="item-header">
							@if($category)
								<p class="categorie">{{ $category->name }}</p>
							@endif()
						</div>--}}

						<p class="excerpt">
							{{ $content->getFieldValue('excerpt') }}
						</p>

                        @if($content->getFieldValue('summary_image'))
    						@php
                                $color =  random_color();
                            @endphp
    						<div class="image left-align">
    							<div class="hexagon" style="background-image:url('{{ Storage::url('/medias/' . $content->getFieldValue('summary_image')) }}');border-color:#<?php echo $color; ?>" >
    								<div class="hexTop" style="border-color:#<?php echo $color; ?>"></div>
    								<div class="hexBottom" style="border-color:#<?php echo $color; ?>"></div>
    							</div>
    						</div>
                        @endif

						{!! $content->getFieldValue('content') !!}
					</div>
				</div>
			</div>



	</div>
</div>
@endsection
