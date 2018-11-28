@extends('layouts.frontend', [ 	'headerTitle' => 'Retrouvez les actualités de l\'agence d\'emploi Menc',
'metaDescription' =>' Zoom sur nos agences de travail temporaire, nouvelles autour de l\'intérim, fiches métiers et conseils en recrutement… Retrouvez les actualités de l\'agence d\'emploi Menco.',
 								'pageTitle' => 'Le blog de l\'intérim'
  							 ])

@section('content')
<div class="blog-index">
	<div class="horizontal-inner-container">
    <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb">
              <li><a href="/"><i></i>Menco </a></li>
              <li><a href="{{route('blog.index')}}">Actualités</a></li>
              @if(isset($category_selected))
        		    	<li><a href="{{ route('blog.category', $category_selected->getFieldValue('slug'))}}">{{$category_selected->getFieldValue('name')}}</a></li>
        		  @endif
          </ol>
      </div>
    </div>
		<div class="row">

			<div class=" col-md-8 ">
				<div class="blog-results" id="results-content" >
        @if(sizeof($contents))
					@foreach ($contents as $content)
            @php
              $category = $content->getCategories()->first();
            @endphp
						<div class="item">
							<h3>{{ $content->getFieldValue('title') }}</h3>
							<div class="image" style="background-image:url('{{ Storage::url('/medias/' . $content->getFieldValue('summary_image')) }}');">
							</div>

							<div class="content">
								{!!$content->getFieldValue('excerpt') !!}
								<br /><br /><a href="{{ route('blog.show', [ $category->slug, $content->getFieldValue('slug')]) }}" class="btn btn-secondary-clear">LIRE LA SUITE</a>
								<div class="separator-red">
									<div class="right-separator" style="background-image:url('{{asset('images/red-arc-small.jpg')}}')">
									</div>
									<div class="left-separator">
										@if($category)
											<div class="category-red">{{ $category->name }}</div>
										@endif()
									</div>
								</div>
							</div>
						</div>
					@endforeach
        @else
          Pas de contenu dans cette section pour l'instant.
        @endif
				</div>
				@if($num_contents > $contents_per_page)
					<div class="more">
						<div class="btn btn-secondary-clear btn-more-posts" id="btn-more-posts">
							Voir plus d'articles
						</div>
					</div>
				@endif
			</div>

			<div class="col-md-4 categories">

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
	</div>
</div>


@endsection

@push('stylesheets')

@endpush

@push('javascripts-libs')

@endpush

@push('javascripts')
	<script>
		 $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': "{{csrf_token()}}"
	        }
	    });
	    var offset = {{$contents_per_page}};
	    var total = {{$num_contents}};
	    var page = 1;



	    function getMoreResults(btn){
			$params = 'offset='+(offset*page);
			$('#btn-more-posts').hide();
			@if(isset($category_selected))
		    	var route = "{{ route('blog.category', $category_selected->getFieldValue('slug'))}}/"+offset*page;
		  @else
		    	var route = "{{ route('blog.index')}}?"+$params;
		  @endif
			$.ajax( {
				type: "GET",
				url: route,
				dataType : 'html',
				data: {
				  },
				success: function(result) {
				 	$('#results-content').append($(result).find('#results-content').html());
				  	page = page + 1;
				  	if(total > (offset*page)){
				  		$('#btn-more-posts').show();
				  	}
				},
				error: function () {
				  	alert('error')
				}
			});
	    }

	    $(document).ready(function() {
			$(".btn-more-posts").on('click',function(e){
				getMoreResults(this);
			});
		});

	</script>
@endpush
