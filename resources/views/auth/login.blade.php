@extends('architect::layouts.master', [
    'hideTopbar' => true
])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">Utilisateur</label>

                            <div class="col-md-6">
                                <input id="uid" type="text" class="form-control{{ $errors->has('uid') ? ' is-invalid' : '' }}" name="uid" value="{{ old('uid') }}" placeholder="" required autofocus>

                                @if ($errors->has('uid'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('uid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="passwd" class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="passwd" type="password" class="form-control{{ $errors->has('passwd') ? ' is-invalid' : '' }}" name="passwd"  placeholder="" required>

                                @if ($errors->has('passwd'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('passwd') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
