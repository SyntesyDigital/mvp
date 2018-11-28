@extends('layouts.app')

@section('content')
<div class="row">
    {!!
        Form::open([
            'url' => isset($customer_contact)
                ? route('admin.customer_contacts.update', $customer_contact)
                : route('admin.customer_contacts.store'),
            'method' => 'POST',
            'class' => 'check-inactive-customer_contact-form'
        ])
    !!}

        <input type="hidden" name="id" value="{{ $customer_contact->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($customer_contact) ? 'PUT' : 'POST' }}">

        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-body">
                  @if(isset($customer_contact))
                  <h2><a href="{{ route('admin.customers.show', $customer_contact->customer->id) }}"> {{ $customer_contact->customer->name }}</a></h2>
                  @endif
                    <h3 class="card-title">{{ isset($customer_contact) ? 'Edition du contact: '.$customer_contact->name :'Ajouter un contact' }}</h3>


                    <div class="form-group">
                        <label for="title">Civilité</label>

                        <div class="radio" style="display: inline; margin-left:20px;">
                            <label style="font-size: .8em">
                                 <input type="radio"  name="title"  value="{{ Modules\RRHH\Entities\CustomerContact::TITLE_MALE }}" {{isset($customer_contact) && $customer_contact->title == Modules\RRHH\Entities\CustomerContact::TITLE_MALE  ?'checked':'' }}>Monsieur
                            </label>
                            <label style="font-size: .8em">
                                <input type="radio" name="title" value="{{ Modules\RRHH\Entities\CustomerContact::TITLE_FEMALE }}" {{isset($customer_contact) && $customer_contact->title == Modules\RRHH\Entities\CustomerContact::TITLE_FEMALE  ?'checked':'' }}>Madame
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        {!!Form::label('firstname', 'Prénom')!!}
                        {!!
                            Form::text('firstname', isset($customer_contact->firstname)? $customer_contact->firstname:'', [
                                'class' => 'form-control',
                                'id' => 'firstname'
                            ])
                        !!}
                    </div>


                    <div class="form-group">
                        {!!Form::label('lastname', 'Nom')!!}
                        {!!
                            Form::text('lastname', isset($customer_contact->lastname)? $customer_contact->lastname:'', [
                                'class' => 'form-control',
                                'id' => 'lastname'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('function', 'Fonction')!!}
                        {!!
                            Form::text('function', isset($customer_contact->function)? $customer_contact->function:'', [
                                'class' => 'form-control',
                                'id' => 'function'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('service', 'Service')!!}
                        {!!
                            Form::text('service', isset($customer_contact->service)? $customer_contact->service:'', [
                                'class' => 'form-control',
                                'id' => 'service'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('email', 'E-mail')!!}
                        {!!
                            Form::text('email', isset($customer_contact->email)? $customer_contact->email:'', [
                                'class' => 'form-control',
                                'id' => 'email'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('email_2', 'E-mail 2')!!}
                        {!!
                            Form::text('email_2', isset($customer_contact->email_2)? $customer_contact->email_2:'', [
                                'class' => 'form-control',
                                'id' => 'email_2'
                            ])
                        !!}
                    </div>



                    <div class="form-group">
                        {!!Form::label('phone_number_1', 'Téléphone')!!}
                        {!!
                            Form::text('phone_number_1', isset($customer_contact->phone_number_1)? $customer_contact->phone_number_1:'', [
                                'class' => 'form-control',
                                'id' => 'phone_number_1'
                            ])
                        !!}
                    </div>

                    <div class="form-group">
                        {!!Form::label('phone_number_2', 'Téléphone 2')!!}
                        {!!
                            Form::text('phone_number_2', isset($customer_contact->phone_number_2)? $customer_contact->phone_number_2:'', [
                                'class' => 'form-control',
                                'id' => 'phone_number_2'
                            ])
                        !!}
                    </div>


                    <div class="form-group">
                        {!!Form::label('fax', 'Fax')!!}
                        {!!
                            Form::text('fax', isset($customer_contact->fax)? $customer_contact->fax:'', [
                                'class' => 'form-control',
                                'id' => 'fax'
                            ])
                        !!}
                    </div>

                    {!! Form::hidden('customer_id', $customer->id) !!}


                    <input value="Sauvegarder" type="submit" class="btn btn-success pull-right" />
                </div>
            </div>
        </div>

    {{ Form::close()}}

</div>
@if(isset($customer_contact))
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            {!!
                Form::open([
                    'url' => route('admin.customer_contacts.delete', $customer_contact->id),
                    'method' => 'POST',
                    'class' => 'delete-customer_contact-form'
                ])
            !!}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Supprimer ce contact" class="btn btn-danger" />
            {{ Form::close() }}
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

    {{ Html::script('/js/admin/customer_contacts/customer_contactsform.js') }}
@endpush
