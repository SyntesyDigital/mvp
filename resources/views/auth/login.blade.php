@extends('extranet::front.layouts.app',[
  "isLogin" => true
])

@section('content')
<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-7 icons">
          <div class="col-md-4 icon-box">
            <div class="icon">
              <i class="fas fa-lock"></i>
            </div>
            <div class="title">
              Espace client
            </div>
            <div class="separator"></div>
            <p>En un clic, accédez à votre dossier</p>
          </div>
          <div class="col-md-4 icon-box">
            <div class="icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="title">
              Web call back
            </div>
            <div class="separator"></div>
            <p>En un clic, accédez à votre dossier</p>
          </div>
          <div class="col-md-4 icon-box">
            <div class="icon">
              <i class="fas fa-laptop"></i>
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
                          <div class="invalid-field">
                              <strong>{{ $errors->first('uid') }}</strong>
                          </div>
                      @endif
                  </div>
              </div>

              <div class="form-group row">
                  <label for="passwd" class="col-md-12 col-form-label text-md-right">Mot de passe</label>

                  <div class="col-md-12">
                      <input id="passwd" type="password" class="form-control{{ $errors->has('passwd') ? ' is-invalid' : '' }}" name="passwd"  placeholder="" required>

                      @if ($errors->has('passwd'))
                          <div class="invalid-field">
                              <strong>{{ $errors->first('passwd') }}</strong>
                          </div>
                      @endif
                  </div>
              </div>

              @if(Request::has('debug'))

                <hr/>

                <div class="form-group row">
                    <label for="passwd" class="col-md-12 col-form-label text-md-right">Environnement</label>

                    <div class="col-md-12">
                        <select id="env" class="form-control" name="env" >
                          @foreach(\Modules\Extranet\Extensions\VeosWsUrl::getEnvironmentOptions() as $env)
                            <option name="{{$env}}">{{$env}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="test_passwd" class="col-md-12 col-form-label text-md-right">Mot de passe du test</label>

                    <div class="col-md-12">
                        <input id="test_passwd" type="password" class="form-control{{ $errors->has('test_passwd') ? ' is-invalid' : '' }}" name="test_passwd"  placeholder="" required>

                        @if ($errors->has('test_passwd'))
                            <div class="invalid-field">
                                <strong>{{ $errors->first('test_passwd') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
              @endif



              <div class="form-group row mb-0">
                <div class="col-md-12 buttons-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </button>
                    <!--<p class="forgot"><a hre="">Mot de pass obluié ?</a></p>-->
                </div>
              </div>

              @if ($errors->has('server'))
                  <div class="invalid-feedback">
                      <strong>{{ $errors->first('server') }}</strong>
                  </div>
              @endif




          </form>
          </div>
        </div>

    </div>
</div>
@endsection
