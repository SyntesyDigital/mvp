@extends('architect::layouts.master')

@section('content')

{!!
    Form::open([
        'url' => isset($customer)
            ? route('rrhh.admin.customers.update', $customer)
            : route('rrhh.admin.customers.store'),
        'method' => 'POST',
        'class' => 'check-inactive-customer-form'
    ])
!!}

{{ Form::hidden('_method', isset($customer) ? 'PUT' : 'POST') }}
{{ Form::hidden('id', isset($customer) ? $customer->id : '') }}

<div class="page-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('rrhh.admin.customers.index')}}" class="btn btn-default"> <i class="fa fa-angle-left"></i> </a>
        <h1><i class="fa fa-newspaper-o"></i>&nbsp;Clients</h1>
        <div class="float-buttons pull-right">

            @if(isset($customer))
                {{-- <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        {!!
                            Form::open([
                                'url' => route('rrhh.admin.customers.delete', $customer->id),
                                'method' => 'POST',
                                'class' => 'delete-customer-form'
                            ])
                        !!}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" value="Supprimer ce client" class="btn btn-danger" />
                        {{ Form::close() }}
                    </div>
                </div> --}}
            @endif

          <a href="" class="btn btn-primary btn-submit-primary"> <i class="fa fa-cloud-upload"></i> &nbsp; Sauvegarder </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container rightbar-page">
    <div class="col-md-9 page-content">
        @foreach(config('customers.form.left') as $node)
            @include('rrhh::admin.partials.form.node', [
              'node' => $node,
              'item' => isset($customer) ? $customer : null
            ])
        @endforeach
    </div>
    <div class="sidebar" style="z-index:1000">
        @foreach(config('customers.form.right') as $node)
            @include('rrhh::admin.partials.form.node', [
              'node' => $node,
              'item' => isset($customer) ? $customer : null
            ])
        @endforeach
    </div>
</div>

{{ Form::close()}}

@endsection

@push('javascripts-libs')
    {{ Html::script('/modules/architect/plugins/dropzone/dropzone.min.js') }}
    {{ HTML::style('/modules/architect/plugins/dropzone/dropzone.min.css') }}

    <!-- Datatables -->
    {{ Html::style('/modules/rrhh/plugins/datatables/datatables.min.css') }}
    {{ Html::script('/modules/rrhh/plugins/datatables/datatables.min.js') }}
    {{ Html::script('/modules/rrhh/js/libs/datatabletools.js')}}

    <script>
      var csrf_token = "{{csrf_token()}}";
      var routes = {
          uploadPost : '{{route("upload-post")}}'
      };
    </script>

@endpush


@push('javascripts')
{{ Html::script('modules/rrhh/js/admin/customer_contacts/customer_contactslist.js') }}
{{ Html::script('modules/rrhh/js/admin/customers/customersform.js') }}
<script>
    $(document).on('click', ".btn-submit-primary", function(e){
        e.preventDefault();
        this.closest('form').submit()
    });
</script>
@endpush
