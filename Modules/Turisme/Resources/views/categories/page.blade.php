
@extends('turisme::layouts.app',[
  'name' => isset($category) ? $category->getFieldValue('name') : '',
  'mainClass' => 'blog category'
])

@section('content')


<!-- ARTICLE -->
<article class="content">
   <!-- Col 12 -->
  <div class="grey-intro no-margin">
       <div class="container">
        <div class="row">
        <div class="claim">
        <h1>{{$category->getFieldValue('name')}}</h1>
        <p>
            {!!$category->getFieldValue('description')!!}
        </p>
        </div>
      </div>
    </div>

  </div>

  <div id="blog" showTags="0"  showTags ="0" showFilter="0" categoryId="{{$category->id}}" ></div>

</div>
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
