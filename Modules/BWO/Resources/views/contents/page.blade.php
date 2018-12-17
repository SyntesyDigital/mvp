@php
  $htmlClass = isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '';
  $pageType = isset($contentSettings) && isset($contentSettings['pageType']) ? $contentSettings['pageType'] : '';
  $idClass = isset($content) ? "id_".$content->id : '';
@endphp

@extends('bwo::layouts.master',[
  'title' => isset($content) ? $content->getFieldValue('title') : '',
  'mainClass' => $pageType.' '.$htmlClass.' '.$idClass,
  'routeAttributes' => $content->getFullSlug()
])

@section('content')

@if(isset($content))

<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/blog-banner.jpg')}}')">
  <div class="horizontal-inner-container">
      <h1>{{$content->getFieldValue('title')}}</h1>
    </div>
  </div>
</div>

<div class="posts-container">
  <div class="horizontal-inner-container post-container">
    {!! breadcrumb($content) !!}
@endif
<!-- ARTICLE -->
<article class="page-builder">

    @if($page)
      @foreach($page as $node)
          @include('bwo::partials.node', [
              'node' => $node
          ])
      @endforeach
    @endif
</article>

@if(isset($content))
  </div>
</div>
@endif

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
