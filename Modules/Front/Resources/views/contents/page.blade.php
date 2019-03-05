@php
  $htmlClass = isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '';
  $pageType = isset($contentSettings) && isset($contentSettings['pageType']) ? $contentSettings['pageType'] : '';
  $idClass = isset($content) ? "id_".$content->id : '';
@endphp

@extends('front::layouts.app',[
  'title' => isset($content) ? $content->getFieldValue('title') : '',
  'mainClass' => $pageType.' '.$htmlClass.' '.$idClass,
  'routeAttributes' => $content->getFullSlug()
])

@section('content')

@if(isset($content) && $content->parent_id != null)
<div class="single">
  <div class="breadcrumb">
       <div class="container">
        <div class="row">
          <div class="detalls-single">
      		  <div class="col-md-10  col-sm-9 col-xs-12">
      		  	<div class="ariadna">
                {!! breadcrumb($content) !!}
              </div>
      		  </div>

      		  <div class="col-md-2 col-sm-3 col-xs-6">
      		  	<div id="selected-items" class="seleccio" style="display:none;">
                <span id="number">0</span>
                <a href="#" id="selected-area">La meva sel.lecció</a>
              </div>
      		  </div>
    	   </div>
  		 </div>
  	</div>
  </div>
</div>
@endif



<!-- ARTICLE -->
<article class="page-builder">

    @if($page)
      @foreach($page as $node)
          @include('front::partials.node', [
              'node' => $node
          ])
      @endforeach
    @endif
</article>
<!-- END ARTICLE -->
@endsection

@push('javascripts')
<script>
    routes = {"categoryNews" : "{{route('blog.category.index' ,['slug' => ':slug'])}}",
              "tagNews"      : "{{route('blog.tag.index' ,['slug' => ':slug'])}}" };
    $(function(){

    });
</script>
@endpush
