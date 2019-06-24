@extends('front::layouts.app')

@section('content')
<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-7 icons">
          <div class="col-md-4 icon-box">
            <div class="icon">
              <i class="fa fa-lock"></i>
            </div>
            <div class="title">
              Espace client
            </div>
            <div class="separator"></div>
            <p>En un clic, accédez à votre dossier</p>
          </div>
          <div class="col-md-4 icon-box">
            <div class="icon">
              <i class="fa fa-phone"></i>
            </div>
            <div class="title">
              Web call back
            </div>
            <div class="separator"></div>
            <p>En un clic, accédez à votre dossier</p>
          </div>
          <div class="col-md-4 icon-box">
            <div class="icon">
              <i class="fa fa-laptop"></i>
            </div>
            <div class="title">
              Déclaration en ligne
            </div>
            <div class="separator"></div>
            <p>En un clic, accédez à votre dossier</p>
          </div>
          <div class="separator"></div>
          <p>Nous mettons à la disposition de nos clients de nombreux outils numériques permettant de faciliter leurs démarches</p>

        </div>

        <div class="col-md-5 login-box-container">
          <div class="login-box">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <h2>Connexion</h2>
              <div class="form-group row">
                  <label for="email" class="col-sm-12 col-form-label text-md-right">Utilisateur</label>

                  <div class="col-md-12">
                      <input id="uid" type="text" class="form-control{{ $errors->has('uid') ? ' is-invalid' : '' }}" name="uid" value="{{ old('uid') }}" placeholder="" required autofocus>

                      @if ($errors->has('uid'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('uid') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row">
                  <label for="passwd" class="col-md-12 col-form-label text-md-right">Mot de passe</label>

                  <div class="col-md-12">
                      <input id="passwd" type="password" class="form-control{{ $errors->has('passwd') ? ' is-invalid' : '' }}" name="passwd"  placeholder="" required>

                      @if ($errors->has('passwd'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('passwd') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-12 buttons-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-sign-out"></i>Connexion
                    </button>
                    <!--<p class="forgot"><a hre="">Mot de pass obluié ?</a></p>-->
                </div>
              </div>
          </form>
          </div>
        </div>

    </div>
</div>
@endsection
