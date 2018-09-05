
@extends('turisme::layouts.app',[
  'name => isset($category) ? $category->getFieldValue('name') : '',
])

@section('content')


<!-- ARTICLE -->
<article class="content">
   <!-- Col 12 -->
  <div class="grey-intro no-margin">    
       <div class="container">
        <div class="row">
        <div class="claim">
        <h1>{{$category->getFieldValue('name)}}</h1>
        <p>
            {!!$category->getFieldValue('description')!!}
        </p>
        </div>
      </div>
    </div>

  </div>

  <div id="blog" init="0" showTags="0"  showTags ="0" showFilter="0" categoryId="{{$category->category_id}}" ></div>
       
</div>
</article>
<!-- END ARTICLE -->
@endsection

@push('javascripts')
<script>
    $(function(){

    });
</script>
@endpush
