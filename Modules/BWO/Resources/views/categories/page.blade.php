
@extends('bwo::layouts.master',[
  'name' => isset($category) ? $category->getFieldValue('name') : '',
  'mainClass' => 'blog category',
  'routeAttributes' => ["slug" => $category->getFieldValue('slug')],
])

@section('content')

@if(isset($category))

<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/blog-banner.jpg')}}')">
  <div class="horizontal-inner-container">
      <h1>ACTUALITÉ</h1>
    </div>
  </div>
</div>


<div class="posts-container">
  <div class="horizontal-inner-container post-container">
    {!! breadcrumb_category($category) !!}


    <!-- ARTICLE -->
    <article class="page-builder">

      <div class="widget-blog offers-container">

        <div id="blog"  class="blog blog-container" categoryId="{{$category->id}}" ></div>

      </div>

    </article>

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
