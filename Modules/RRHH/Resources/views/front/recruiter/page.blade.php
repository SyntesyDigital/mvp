
@extends('layouts.frontend', [
    'header' => 'white-bar',
    'search_bar_style' => 'display:none',
    'headerTitle' => $content ? $content->getFieldValue('title') : null,
    'htmlTitle' => $content ? $content->getFieldValue('meta_title') : null,
    'metaDescription' => $content ? $content->getFieldValue('meta_description') : null
])

@php
	$category = $content->getCategories()->first();

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
			<div class="col-md-9">
				<div class="item">
					<div class="content">

						<div class="item-header">
							{{--<p class="date">{{ date("d/m/Y", strtotime($content->created_at)) }}</p>--}}
							@if($category)
								<p class="categorie">{{ $category->name }}</p>
							@endif()
						</div>

						<p class="excerpt">
							{{ $content->getFieldValue('excerpt') }}
						</p>

                        @if($content->getFieldValue('summary_image'))
    						@php
                                $color =  random_color();
                            @endphp
    						<div class="image left-align">
    							<div class="hexagon"   style="background-image:url('{{ Storage::url('/medias/' . $content->getFieldValue('summary_image')) }}');border-color:#<?php echo $color; ?>" >
    								<div class="hexTop" style="border-color:#<?php echo $color; ?>"></div>
    								<div class="hexBottom" style="border-color:#<?php echo $color; ?>"></div>
    							</div>
    						</div>
                        @endif

						{!! $content->getFieldValue('content') !!}
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="categories-box">
					@if($othersContents->count())
						<h4>Dans la même catégorie :</h4>
						<div class="related-posts">
                            <ul>
							@foreach($othersContents as $c)
								<li>
									<a href="{{route('recruiter.page', [
                                        'category' => $c->getCategories()->first()->getFieldValue('slug'),
                                        'slug' => $c->getFieldValue('slug')
                                    ])}}">{{$c->getFieldValue('title')}}</a>
								</li>
							@endforeach()
                            </ul>
						</div>
					@endif

					@if(sizeof($categories))
						<h4>Catégories :</h4>
						@foreach($categories as $category)
							<div class="block-tag">
                                <a href="{{route('recruiter.category', [
                                    'category' => $category->getFieldValue('slug')
                                ])}}">
    								<div class="label-box">
                                        {{$category->name}}
    								</div>
                                </a>
							</div>
						@endforeach()
					@endif

					{{-- <h4>Recherche dans les actualités :</h4>
	                <form role="form" method="GET" action="{{ route('blog.search') }}" id="blog-search-form">
						<input type="text" name="search" placeholder="Rechercher..."><div class="search-btn" onclick="$('#blog-search-form').submit()"><i class="fa fa-search white-btn"></i></div>
					</form>
				</div> --}}
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
