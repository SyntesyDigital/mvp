@extends('architect::layouts.master')

@section('content')
  <div class="container grid-page">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">

        <div class="page-title">
          <h1>Tags</h1> <a href="{{route('tags.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Afegir tag</a>
        </div>

        <div class="grid-items">
          <div class="row">
              <table class="table" id="table-tags" data-url="{{route('tags.data')}}">
                  <thead>
                     <tr>
                         <th>Nom</th>
                         <th></th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                         <th></th>
                         <th></th>
                     </tr>
                  </tfoot>
              </table>
          </div>
        </div>

      </div>
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
    architect.tags.init({
        'table' : $('#table-tags'),
        'urls': {
            'index' : '{{ route('contents.data') }}',
            'show' : '{{ route('contents.show') }}',
            'delete' : '{{ route('contents.delete') }}',
        }
    })
</script>
@endpush
