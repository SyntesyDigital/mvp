@extends('extranet::front.layouts.master')

@section('content')

<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/front/images/blog-banner.jpg')}}')">
  <div class="horizontal-inner-container">
      <h1 class="title-up">Réinitialiser le mot de passe</h1>
    </div>
  </div>
</div>

<div class="candidate-container">
  <div class="horizontal-inner-container post-container">
    <br clear="all">
    <br clear="all">

      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <form method="POST" action="{{ route('password.request') }}">
              @csrf

              <input type="hidden" name="token" value="{{ $token }}">

              <div class="form-group row">
                  <label for="email">Adresse email</label>
                  <div class="col-md-12">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                      @if ($errors->has('email'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row">
                  <label for="password" >Mot de passe</label>
                  <div class="col-md-12">
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                      @if ($errors->has('password'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row">
                  <label for="password-confirm" class="">Confirmez le mot de passe</label>

                  <div class="col-md-12">
                      <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                      @if ($errors->has('password_confirmation'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-red">
                          Réinitialiser le mot de passe
                      </button>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
