@extends('bwo::layouts.master')

@section('content')
    <div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/blog-banner.jpg')}}')">
      <div class="horizontal-inner-container">
          <h1>ACTUALITÉS</h1>
        </div>
      </div>
    </div>

    <div class="offers-container">
      <div class="horizontal-inner-container blog-container">
        <ol class="breadcrumb">
          <li><a href="{{route('home')}}">ACCUEIL</a></li>
          <li>ACTUALITÉS</li>
        </ol>
        <div class="categories-container">
          <h3>CATÉGORIES</h3>
          <a class="btn btn-soft-gray">CATÉGORIE</a>
          <a class="btn btn-soft-gray">CATÉGORIE</a>
          <a class="btn btn-soft-gray">CATÉGORIE</a>
          <a class="btn btn-soft-gray">CATÉGORIE</a>
        </div>



        <div class="posts-list">
          <div class="col-md-6">
            <div class="post-box">
                <div class="image" style="background-image:url('{{asset('modules/bwo/images/post.jpg')}}')"></div>
                <div class="title">
                  TITRE ACTUALITÉ
                </div>
                <p>Le 16/11/2018 - CATÉGORIE</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...<a href="#" class="detail" >Lire la suite</a></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="post-box">
                <div class="image" style="background-image:url('{{asset('modules/bwo/images/post.jpg')}}')"></div>
                <div class="title">
                  TITRE ACTUALITÉ
                </div>
                <p>Le 16/11/2018 - CATÉGORIE</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...<a href="#" class="detail" >Lire la suite</a></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="post-box">
                <div class="image" style="background-image:url('{{asset('modules/bwo/images/post.jpg')}}')"></div>
                <div class="title">
                  TITRE ACTUALITÉ
                </div>
                <p>Le 16/11/2018 - CATÉGORIE</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...<a href="#" class="detail" >Lire la suite</a></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="post-box">
                <div class="image" style="background-image:url('{{asset('modules/bwo/images/post.jpg')}}')"></div>
                <div class="title">
                  TITRE ACTUALITÉ
                </div>
                <p>Le 16/11/2018 - CATÉGORIE</p>
                <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras placerat egestas fringilla. Donec quis convallis metus.Lorem ipsum dolor sit amet, consectetur adipiscing elit...<a href="#" class="detail" >Lire la suite</a></p>
            </div>
          </div>
          <br clear="all">
          <div class="pagination-container">
            <!--a href="#" class="round"><div class="round"><i class="fa fa-angle-left" aria-hidden="true"></i></div></a-->
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">...</a>
            <a href="#" class="round"><div class="round"><i class="fa fa-angle-right" aria-hidden="true"></i></div></a>
          </div>

        </div>
      </div>
    </div>

@endsection

@push('javascripts')
	<script>

    $(document).ready(function() {
        $(document).on("click","#btn-more",function() {
          $(this).hide();
          $('#btn-less').show();
          $('.light-gray-search-container').show();
        });

        $(document).on("click","#btn-less",function() {
          $(this).hide();
          $('#btn-more').show();
          $('.light-gray-search-container').hide();
        });
        $(document).ready(function() {
            $(document).on("click",".btn-search",function() {
              $(this).closest('form').submit();
            });
        });
        $(document).ready(function() {
            $(document).on("click","#btn-filtres",function() {
              $(this).closest('form').submit();
            });
        });


    });

  </script>

@endpush
