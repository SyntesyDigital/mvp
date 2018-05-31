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
      @foreach($typologies as $typology)
          <li>
            <a href="{{route('contents', ['typology_id' => $typology->id])}}"><i class="fa {{$typology->icon}}"></i><span class="text">{{$typology->name}}</span> </a>
          </li>
      @endforeach()
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

    <table class="table" id="table-contents" data-url="{{route('contents.data', Request('typology_id'))}}">
        <thead>
           <tr>
               <th>Nom</th>
               <th>Tipus</th>
               <th>Actualiztat</th>
               <th>Autor</th>
               <th>Estat</th>
               <th></th>
           </tr>
        </thead>
        <tfoot>
           <tr>
               <th></th>
               <th></th>
               <th></th>
               <th></th>
               <th></th>
               <th></th>
           </tr>
        </tfoot>
    </table>

  </div>

</div>
@stop


@push('plugins')
    {{ Html::script('/modules/architect/plugins/datatables/datatables.min.js') }}
    {{ HTML::style('/modules/architect/plugins/datatables/datatables.min.css') }}

    {{ Html::script('/modules/architect/plugins/bootbox/bootbox.min.js') }}
    {{ Html::script('/modules/architect/js/libs/datatabletools.js') }}
    {{ Html::script('/modules/architect/js/architect.js') }}
@endpush

@push('javascripts-libs')
<script>
    architect.contents.init({
        'table' : $('#table-contents'),
        'urls': {
            'index' : '{{ route('medias.index') }}',
            'store' : '{{ route('medias.store') }}',
            'show' : '{{ route('medias.show') }}',
            'delete' : '{{ route('medias.delete') }}',
            'update' : '{{ route('medias.update') }}'
        }
    })
</script>
@endpush


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
