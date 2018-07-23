@extends('architect::layouts.master')

@section('content')

    {!!
        Form::open([
            'url' => isset($user) ? route('users.update', $user) : route('users.store'),
            'method' => 'POST',
        ])
    !!}

    @if(isset($user))
        {!! Form::hidden('_method', 'PUT') !!}
    @endif

    <div class="container rightbar-page content">


      {{-- <div class="page-bar">
        <div class="container">
          <div class="row">

            <div class="col-md-12">
              <a href="{{route('users')}}" class="btn btn-default btn-close"> <i class="fa fa-angle-left"></i> </a>

              <div class="float-buttons pull-right">
              </div>

            </div>
          </div>
        </div>
      </div> --}}

    <div class="container rightbar-page content">
        <div class="col-xs-6 col-xs-offset-3 page-content">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    @if(isset($user))
                    <h1>{{ $user->full_name }}</h1>
                    @else
                    <h1>Crear usuari</h1>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label>Email</label>
                    {!!
                        Form::text(
                            'email',
                            isset($user) ? $user->email : old('email'),
                            [
                                'class' => 'form-control'
                            ]
                        )
                    !!}
                </div>
            </div>

            <div class="row">


                <div class="col-md-6">
                    <label>Firstname</label>
                    {!!
                        Form::text(
                            'firstname',
                            isset($user) ? $user->firstname : old('firstname'),
                            [
                                'class' => 'form-control'
                            ]
                        )
                    !!}
                </div>

                <div class="col-md-6">
                    <label>Lastname</label>
                    {!!
                        Form::text(
                            'lastname',
                            isset($user) ? $user->firstname : old('lastname'),
                            [
                                'class' => 'form-control'
                            ]
                        )
                    !!}
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Password</label>
                    {!!
                        Form::password(
                            'password',
                            [
                                'class' => 'form-control'
                            ]
                        )
                    !!}
                </div>
                <div class="col-md-6">
                    <label>Confirm password</label>
                    {!!
                        Form::password(
                            'password_confirmation',
                            [
                                'class' => 'form-control'
                            ]
                        )
                    !!}
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <label>Role</label>
                    {!!
                        Form::select(
                            'role_id',
                            App\Models\Role::pluck('display_name', 'id'),
                            isset($user) && $user->roles && $user->roles->count() > 1 ? $user->roles->first()->id : old('role'),
                            [
                                'class' => 'form-control',
                                'placeholder'=> '---'
                            ]
                        )
                    !!}
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 text-right">
                    {!!
                        Form::submit('Guardar', [
                            'class' => 'btn btn-primary'
                        ])
                    !!}
                </div>
            </div>




    </div>

      {!! Form::close() !!}

@stop

@push('javascripts-libs')

@endpush
