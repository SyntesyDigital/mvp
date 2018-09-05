@php
  $htmlClass = isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '';
  $pageType = isset($content->typology->name) ? $content->typology->name : '';
  $idClass = isset($content) ? "id_".$content->id : '';
@endphp

@extends('turisme::layouts.app',[
  'title' => isset($fields) ? $fields->get('title')['fr'] : '',
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
    	   </div>
  		 </div>
  	</div>
  </div>
</div>
@endif

<!-- ARTICLE -->
<article class="content">
  {{ $fields->get('title')->value[App::getLocale()] }}
</article>
<!-- END ARTICLE -->

@endsection

@push('javascripts')
<script>
    $(function(){

    });
</script>
@endpush
