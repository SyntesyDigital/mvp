@extends('architect::layouts.master')

@section('content')

@include('architect::contents.modal-new')

<div class="container leftbar-page">

  <div class="sidebar">
    <ul>
      <li class="active">
        <a href="" > <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
      <li>
        <a href=""> <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
    </ul>
    <hr />
    <ul>
      <li>
        <a href=""> <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
      <li>
        <a href=""> <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
    </ul>
    <hr/>
    <ul>
      <li>
        <a href=""> <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
      <li>
        <a href=""> <i class="fa fa-envelope"></i> <span class="text">Page</span> </a>
      </li>
    </ul>

  </div>

  <div class="col-xs-offset-2 col-xs-10 page-content">

    <h3 class="card-title">Continguts</h3>
    <a href="#" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir contingut</a>

  </div>

</div>

@stop

@push('javascripts')

<script>
$(function(){

  $(".btn-primary").click(function(e){
    e.preventDefault();
    TweenMax.to($("#new-content-modal"),0.5,{opacity:1,display:"block",ease:Power2.easeInOut});
  });

  $(document).on('click',"#new-content-modal .close-btn",function(e){
    e.preventDefault();
    TweenMax.to($("#new-content-modal"),0.5,{opacity:0,display:"none",ease:Power2.easeInOut});
  });

});
</script>

@endpush
