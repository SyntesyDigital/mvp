@php
  $htmlClass = 'blog '.(isset($contentSettings) && isset($contentSettings['htmlClass']) ? $contentSettings['htmlClass'] : '');
  $pageType = isset($content->typology->name) ? $content->typology->name : '';
  $idClass = isset($content) ? "id_".$content->id : '';
@endphp

@extends('bwo::layouts.master',[
  'title' => isset($content) ? $content->getFieldValue('title') : '',
  'mainClass' => $pageType.' blog '.$htmlClass.' '.$idClass
])

@section('content')

<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/blog-banner.jpg')}}')">
  <div class="horizontal-inner-container">
      <h1>ACTUALITÉS</h1>
    </div>
  </div>
</div>

@if(isset($content))
<article class="posts-container">
  <div class="horizontal-inner-container post-container">
    {!! breadcrumb($content) !!}
    <h1 class="title-up">{{$content->getFieldValue('title')}}</h1>

      <div class="description">
        <div class="col-sm-6 first-line">
          <p class="first-info">
              @php  $categories = $content->categories->all(); $first_cat = true; @endphp
              @foreach($categories as $cat)
                <a href="{{route('blog.category.index' , $cat->getFieldValue('slug'))}}" class="btn btn-soft-gray">{{$cat->getFieldValue('name')}}</a>
              @endforeach
              @if(isset($fields['date']['value']))
                @php
    							$date = new Jenssegers\Date\Date(strtotime($fields['date']['value']));
    							$date->setlocale('fr');
  							@endphp
                Le {{ $date->format('d F Y') }} par
              @endif
             <span>{{$content->author->firstname.' '.$content->author->lastname }}</span>
          </p>
        </div>
        <div class="col-sm-6 first-line">
          <div class="share-container">
             Partager:
             <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}&t={{$content->getFieldValue('title')}}"
                class="share-button first-share-btn"
                 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                 target="_blank" title="Share on Facebook">
                <img src="{{asset('modules/bwo/images/fb_icon.jpg')}}" class="social-icon" alt="Partager sur Facebook">
              </a>
              <a href="http://www.linkedin.com/shareArticle?mini=true&title={{$content->getFieldValue('title')}}&url={{ Request::url() }}" target="_blank"	class="share-button" title="Partager sur Linkedin">
                <img src="{{asset('modules/bwo/images/linkedin.png')}}" class="social-icon" alt="Partager sur Linkedin">
              </a>
              <a href="https://twitter.com/share?url={{ Request::url() }}&text={{$content->getFieldValue('title')}}"
                class="share-button"
                 onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                 target="_blank" title="Share on Twitter">
                <img src="{{asset('modules/bwo/images/tw_icon.jpg')}}" class="social-icon" alt="Partager sur Twitter">
              </a>
              <a href="mailto:?subject={{$content->getFieldValue('title')}}&body={{ Request::url() }}"
                class="mail-button">
                <img src="{{asset('modules/bwo/images/mail_icon.jpg')}}" class="social-icon">
              </a>

          </div>
        </div>
        <br clear="all">

        {!!$content->getFieldValue('content')!!}

        @if($fields['image-body']['value'])
          <img
            src="{{ isset($fields['image-body']['value']['urls']['image_actu']) ? asset($fields['image-body']['value']['urls']['image_actu']) : null }}"
            alt="{{$fields['image-body']['value']->metadata['fields']['alt'][App::getLocale()]['value'] or ''}}"
            title="{{$fields['image-body']['value']->metadata['fields']['title'][App::getLocale()]['value'] or ''}}"
          />
        @endif

      <br clear="all">
    </div><!-- end description -->


    <div id="related-news" content="{{$content->id}}" category="{{null !== $content->categories->first()?$content->categories()->first()->id:null }}" ></div>

    <!--
    <div class="other-posts">
      <h3>SUR LE MÊME SUJET</h3>
      <div class="col-md-6">
        <div class="post-box">
            <div class="title">TITLE ACTUALITÉ</div>
            <p class="date">Le 16/11/2018 - CATÉGORIE</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vehicula at libero at ornare. Nunc at iaculis nisi, porta dapibus dolor...<a href="#" class="read-more">Lire la suite</a></p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="post-box">
            <div class="title">TITLE ACTUALITÉ</div>
            <p class="date">Le 16/11/2018 - CATÉGORIE</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vehicula at libero at ornare. Nunc at iaculis nisi, porta dapibus dolor...<a href="#" class="read-more">Lire la suite</a></p>
        </div>
      </div>
    </div><!-- other posts -->
    <br clear="all">
  </div>
</article>
<!-- END ARTICLE -->
@endif


@endsection

@push('javascripts')
<script>

    routes = $.extend(routes,{"categoryNews" : "{{route('blog.category.index' ,['slug' => ':slug'])}}",
          "tagNews"      : "{{route('blog.tag.index' ,['slug' => ':slug'])}}" });

    $(function(){

    });

</script>
@endpush
