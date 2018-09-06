@php
  $htmlClass = isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '';
  $pageType = isset($contentSettings) && isset($contentSettings['pageType']) ? $contentSettings['pageType'] : '';
  $idClass = isset($content) ? "id_".$content->id : '';
@endphp

@extends('turisme::layouts.app',[
  'title' => isset($content) ? $content->getFieldValue('title') : '',
  'mainClass' => $pageType.' '.$htmlClass.' '.$idClass
])

@section('content')

@if(isset($content) && $content->parent_id != null)
<div class="single">
  <div class="grey no-margin">
       <div class="container">
        <div class="row">
          <div class="detalls-single">
      		  <div class="col-md-10  col-sm-9 col-xs-12">
      		  	<div class="ariadna">
                {!! breadcrumb($content) !!}
              </div>
      		  </div>

            <!--
      		  <div class="col-md-2  col-sm-3 col-xs-6">
      		  	<div class="navegacio">
      				<span class="back glyphicon glyphicon-menu-left"></span><a href="#" >Anterior</a>
      				<a href="#" >Següent</a><span class="next glyphicon glyphicon-menu-right"></span>
      		  	  </div>
      		  </div>
            -->
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
          @include('turisme::partials.node', [
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
