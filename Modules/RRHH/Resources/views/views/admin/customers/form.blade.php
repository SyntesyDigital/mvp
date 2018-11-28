@extends('layouts.app')

@section('content')

<div class="row">
    {!!
        Form::open([
            'url' => isset($customer)
                ? route('admin.customers.update', $customer)
                : route('admin.customers.store'),
            'method' => 'POST',
            'class' => 'check-inactive-customer-form'
        ])
    !!}

        <input type="hidden" name="id" value="{{ $customer->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($customer) ? 'PUT' : 'POST' }}">

        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">{{ isset($customer) ? 'Edition du client : '.$customer->name : 'Ajouter un client' }}</h3>

                    <div class="form-group">
                        {!!Form::label('name', 'Nom')!!}
                        {!!
                            Form::text('name', isset($customer->name)? $customer->name:'', [
                                'class' => 'form-control',
                                'id' => 'name'
                            ])
                        !!}
                    </div>


                    <div class="form-group">
                        {!!Form::label('contact_lastname', 'Contact Nom')!!}
                        {!!
                            Form::text('contact_lastname', isset($customer->contact_lastname)? $customer->contact_lastname:'', [
                                'class' => 'form-control',
                                'id' => 'contact_lastname'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('contact_firstname', 'Contact Prénom')!!}
                        {!!
                            Form::text('contact_firstname', isset($customer->contact_firstname)? $customer->contact_firstname:'', [
                                'class' => 'form-control',
                                'id' => 'contact_firstname'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('phone', 'Telephone')!!}
                        {!!
                            Form::text('phone', isset($customer->phone)? $customer->phone:'', [
                                'class' => 'form-control',
                                'id' => 'phone'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('email', 'E-mail')!!}
                        {!!
                            Form::text('email', isset($customer->email)? $customer->email:'', [
                                'class' => 'form-control',
                                'id' => 'email'
                            ])
                        !!}
                    </div>


                    <div class="form-group">
                        {!!Form::label('address', 'Adresse')!!}
                        {!!
                            Form::text('address', isset($customer->address)? $customer->address:'', [
                                'class' => 'form-control',
                                'id' => 'address'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('postal_code', 'Code Postal')!!}
                        {!!
                            Form::text('postal_code', isset($customer->postal_code) ?$customer->postal_code:'', [
                                'class' => 'form-control',
                                'id' => 'postal_code'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('location', 'Localité')!!}
                        {!!
                            Form::text('location', isset($customer->location) ? $customer->location:'', [
                                'class' => 'form-control',
                                'id' => 'location'
                            ])
                        !!}
                    </div>

                    <input value="Sauvegarder" type="submit" class="btn btn-success pull-right" />
                </div>
            </div>
        </div>

    {{ Form::close()}}

</div>
@if(isset($customer))
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            {!!
                Form::open([
                    'url' => route('admin.customers.delete', $customer->id),
                    'method' => 'POST',
                    'class' => 'delete-customer-form'
                ])
            !!}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Supprimer ce client" class="btn btn-danger" />
            {{ Form::close() }}
        </div>
    </div>


<div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-body">
                   <h3 class="card-title">Liste des contacts
                        <a href="{{route('admin.customer_contacts.create', $customer->id )}}" class="pull-right btn btn-primary">
                            Ajouter un contact
                        </a>
                    </h3>
                    <h6 class="card-subtitle mb-2 text-muted">Tous les contacts</h6>

                    <table class="table" id="table-customer_contacts">
                        <thead>
                           <tr>
                               <th>#</th>
                               <th>Nom</th>
                               <th>Fonction</th>
                               <th>Email</th>
                               <th>Phone</th>
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
        </div>


</div>

@endif
@endsection

@push('javascripts-libs')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></link>

@endpush


@push('javascripts')

    <script>
    var csrf_token = "{{csrf_token()}}";
     </script>


    {{ Html::script('js/libs/datatabletools.js')}}

     @if(isset($customer))
        <script>
            var routes = {
                data : '{{ route("admin.customer_contacts.data", $customer->id) }}',
            };
        </script>
        {{ Html::script('/js/admin/customer_contacts/customer_contactslist.js') }}
    @endif


    {{ Html::script('/js/admin/customers/customersform.js') }}
@endpush
