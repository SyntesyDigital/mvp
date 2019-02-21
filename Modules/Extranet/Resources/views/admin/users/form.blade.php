@extends('architect::layouts.master')

@section('content')

<div class="row">
    {!!
        Form::open([
            'url' => isset($user)
                ? route('admin.users.update', $user)
                : route('admin.users.store'),
            'method' => 'POST',
            'class' => 'check-incative-user-form'
        ])
    !!}

        <input type="hidden" name="id" value="{{ $user->id or '' }}" />
        <input type="hidden" name="_method" value="{{ isset($user) ? 'PUT' : 'POST' }}">

        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Edition de l'utilisateur: {{ isset($user)?$user->getFullNameAttribute():'' }}</h3>

                    <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="{{ $user->lastname or old('lastname') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Prénom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" value="{{ $user->firstname or old('firstname') }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="" value="{{ $user->email or old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="name">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="6" placeholder="" value="{{ '' }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="" value="{{ $user->telephone or old('telephone') }}">
                    </div>
                    <div class="form-group">
                        <label for="status">Etat</label>
                        <select name="status" id="status" class="form-control" >
                            <option value="{{App\Models\User::STATUS_ACTIVE}}" @if(isset($user)) @if($user->status == App\Models\User::STATUS_ACTIVE) selected @endif @endif>Actif</option>
                            <option value="{{App\Models\User::STATUS_INACTIVE}}" @if(isset($user)) @if($user->status == App\Models\User::STATUS_INACTIVE) selected @endif @endif>Désactivé</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role_id">Droit d'utilisation</label>
                        <select name="role_id" id="rol" class="form-control">
                            <option value="2" @if(isset($user)) @if($user->getRoleId() == 2) selected @endif @endif>Admin</option>
                            <option value="3" @if(isset($user)) @if($user->getRoleId() == 3) selected @endif @endif>Recruteur</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="agence">Agence</label>
                         {!!
                            Form::select('agence',
                                App\Models\Agence::pluck('name', 'id'),
                                isset($user) && null !== $user->agences()->first() ? $user->agences()->first()->id : null,
                                [
                                    'class' => 'form-control',
                                    'placeholder' => 'Choissisez une agence'
                                ]
                            )
                        !!}
                    </div>

                    <input type="hidden" name="old_status" id="old_status" value="{{ isset( $user) && $user->status == App\Models\User::STATUS_ACTIVE ? App\Models\User::STATUS_ACTIVE:App\Models\User::STATUS_INACTIVE}}" />


                    <input value="Enregistrer" type="submit" class="btn btn-success pull-right" />


                </div>
            </div>
        </div>

    {{ Form::close()}}
</div>
@if(isset($user))
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            {!!
                Form::open([
                    'url' => route('admin.users.delete', $user->id),
                    'method' => 'POST',
                    'class' => 'delete-user-form'
                ])
            !!}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Supprimer cet utilisateur" class="btn btn-danger" />
            {{ Form::close() }}
        </div>
    </div>
@endif

@endsection
@push('javascripts')

    <script>
       var inactive_value = '{{App\Models\User::STATUS_INACTIVE}}';
    </script>
       {{ Html::script('/js/admin/users/usersform.js') }}

@endpush
