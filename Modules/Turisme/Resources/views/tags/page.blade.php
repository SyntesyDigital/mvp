
@extends('turisme::layouts.app',[
  'name => isset($tag) ? $tag->getFieldValue('name') : '',
])

@section('content')


<!-- ARTICLE -->
<article class="content">
   <!-- Col 12 -->
  <div class="grey-intro no-margin">    
       <div class="container">
        <div class="row">
        <div class="claim">
        <h1>{{$tag->getFieldValue('name)}}</h1>
        <p>
            {!!$tag->getFieldValue('description')!!}
        </p>
        </div>
      </div>
    </div>

  </div>


  <div id="blog" init="0" showTags="0"  showTags ="0" showFilter="0" tagId="{{$tag->tag_id}}" ></div>
    
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
