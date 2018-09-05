@php
  $htmlClass = isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '';
  $pageType = isset($content->typology->name) ? $content->typology->name : '';
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
    	   </div>
  		 </div>
  	</div>
  </div>
</div>
@endif

<!-- ARTICLE -->
<article class="content">
   <!-- Col 12 -->
  <div class="grey-intro no-margin">    
       <div class="container">
        <div class="row">
        <div class="claim">
        <h1>{{$content->getFieldValue('title')}}</h1>
        <p>
            {!!$content->getFieldValue('descripcio')!!}
        </p>
        </div>
      </div>
    </div>

  </div>

  <!-- POt ser vairies coses -->

   <div class="white">
      <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-10 col-xs-12 centered">
              
            @if( null !== $content->getFieldValue('rotatorio'))
              @php $i=0; $images = $content->getFieldValues('rotatorio','images',[]) @endphp

              <div id="carousel-single" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-full" data-slide-to="0" class=""></li>
                  <li data-target="#carousel-full" data-slide-to="1" class="active"></li>
                  <li data-target="#carousel-full" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                <div class="item"><img src="images/img-big.png" alt="First slide image" class="center-block">
                  <div class="carousel-caption">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut dapibus est.tetur adipiscing elit. Donec ut dapibus est. </p>
                  </div>
                </div>
                <div class="item active"><img src="images/img-big.png" alt="Second slide image" class="center-block">
                  <div class="carousel-caption">
                    <p>Second slide Caption</p>
                  </div>
                </div>
                <div class="item"><img src="images/img-big.png" alt="Third slide image" class="center-block">
                  <div class="carousel-caption">
                    <p>Third slide Caption</p>
                  </div>
                </div>
              </div>
              <a class="left carousel-control" href="#carousel-full" role="button" data-slide="prev"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control" href="#carousel-full" role="button" data-slide="next"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>

            @endif

            @if( null !== $content->getFieldValue('video'))
               @php
                  $link = $content->getFieldValue('video.url');

                  $youtube_id = explode('/',$link);
                  $youtube_id = $youtube_id[sizeof($youtube_id)-1];

                @endphp
                <div id="{{$field['settings']['htmlId'] or ''}}" class="{{$field['settings']['htmlClass'] or ''}}">
                  <iframe  src="https://www.youtube.com/embed/{{$youtube_id}}?rel=0" frameborder="0" allowfullscreen></iframe>
                </div> 
            @endif


            </div>
        </div>
      </div>
    </div>
  </div>

    <div class="white">
      <div class="row">
        <div class="container">
          <div class="col-md-9 col-sm-10 col-xs-12 centered">
            @php  $categories = $content->categories->all(); $first_cat = true; @endphp
            <p class="details">
              {{null !== $content->getFieldValue('data')? date('d-m-Y',$content->getFieldValue('data')):""}} 
              @foreach($categories as $cat)
                @if($first_cat)
                  | 
                  @php $first_cat = false; @endphp
                @else
                   · 
                @endif
                <a href="/category/{{$cat->getFieldValue('slug')}}">{{$cat->getFieldValue('name')}}</a>
              @endforeach

               | <span>{{$content->author->firstname.' '.$content->author->lastname }}</span>
              </p>
              {!! $content->getFieldValue('contingut') !!}
    
          <ul class="tags_blog">
            @php  $tags = $content->tags->all(); @endphp
              @foreach($tags as $tag)
                <li  href="{{$tag->getFieldValue('slug')}}"><a href="/tags/{{$tag->getFieldValue('slug')}}" >{{$tag->getFieldValue('name')}}</a></li>
              @endforeach
          </ul>    
    
        </div>
      </div>
    </div>

    <div id="related-news" content="{{$content->id}}" tags="{{$content->tags->pluck('id')}}" category="{{$content->categories()->first()->id }}" ></div>


    <div id="blog" init="0" showTags="0" ></div>


    <!--div class="grey">
      <div class="row">
        <div class="container">
          <form class="blog-search">
          
        <div class="row">
          <label class="col-md-3 col-sm-4 col-xs-12">Selecciona una categoria </label>
          <select name="select" class="col-md-9 col-sm-8 col-xs-12">
            <option disabled="" selected="" value="">Selecciona una categoria </option>
            <option>Opción 2</option>
            <option>Opción 3</option>
                </select>
            </div>
        <div class="row">
          <label class="col-md-3 col-sm-4 col-xs-12">Any</label>
          <select name="select" class="col-md-9 col-sm-8 col-xs-12">
            <option disabled="" selected="" value="">Any</option>
            <option>Opción 2</option>
            <option>Opción 3</option>
                </select>
            </div>
        <div class="row">
          <label class="col-md-3 col-sm-4 col-xs-12">Mes</label>
          <select name="select" class="col-md-9 col-sm-8 col-xs-12">
            <option disabled="" selected="" value="">Mes</option>
            <option>Opción 2</option>
            <option>Opción 3</option>
                </select>
            </div>
             <div class="row">
          <label class="col-md-3 col-sm-4 col-xs-12">Escribe texto</label>
          <input class="col-md-9 col-sm-8 col-xs-12" placeholder="Escribe texto" type="text">
            </div> 
              <div class="row">
          <input value="Submit" class="btn" type="submit">
        </div>
            
          </form>
        </div>
    </div-->
  </div>
     
    
    
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
