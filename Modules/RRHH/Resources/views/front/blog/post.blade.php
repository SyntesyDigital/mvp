
@php
	$title = $content->getFieldValue('title');
@endphp
@extends('layouts.frontend', [ 	'headerTitle' => $title,
 								'pageTitle' => $title,
								'htmlTitle' => $title,
								'socialImage' => $content->getFieldValue('summary_image') ? Config::get('app.url').Storage::url("medias/" . $content->getFieldValue("summary_image")) : null
  							 ])
 @php
	$category = $content->getCategories()->first();
@endphp

@section('content')
<div class="blog-post">
	<div class="horizontal-inner-container">
		<div class="row">
			<div class="col-md-12">
			<ol class="breadcrumb">
			    <li><a href="/"><i></i>Menco </a></li>
					<li><a href="{{route('blog.index')}}">Actualités</a></li>
			    <li><a href="{{ route('blog.category', $category->getFieldValue('slug')) }}">{{ $category->name }}</a></li>
					<li>{{ $title }}</li>
			</ol>
		</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="item">
					<div class="content">
						{!! $content->getFieldValue('content') !!}
						@if($content->getFieldValue('summary_image'))
							<div class="image">
								<img src="{{ Storage::url('/medias/' . $content->getFieldValue('summary_image')) }}" alt="{!! $content->getFieldValue('alt_img') !!}">
							</div>
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-4 categories">
				@if(sizeof($categories))
					<div class="horizontal-inner-container">
						<div class="row">
							<div class="col-md-12 categories-box">
								<h4>Catégories:</h4>
								<div class="categories-list">
									@foreach($categories as $category)
										<div class="category">
											<a href="{{ route('blog.category', $category->getFieldValue('slug')) }}">
												{{$category->getFieldValue('name')}}
											</a>
										</div>
									@endforeach()
								</div>
							</div>
						</div>
					</div>
				@endif

				@if($othersContents->count())
					<div class="horizontal-inner-container">
						<div class="row">
							<div class="col-md-12 categories-box">
								<h4>Dans la même catégorie:</h4>
								<div class="categories-list">
									@foreach($othersContents as $c)
										<div class="category">
												<a href="{{ route('blog.show',[$category_slug ,$c->getFieldValue('slug')]) }}">
												{{$c->getFieldValue('title')}}
											</a>
										</div>
									@endforeach()
								</div>
							</div>
						</div>
					</div>
				@endif
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
