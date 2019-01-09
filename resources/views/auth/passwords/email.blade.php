@extends('bwo::layouts.master')

@section('content')

<div class="banner banner-small offer-banner" style="background-image:url('{{asset('modules/bwo/images/blog-banner.jpg')}}')">
  <div class="horizontal-inner-container">
      <h1 class="title-up">Réinitialiser votre mot de passe</h1>
    </div>
  </div>
</div>
<div class="posts-container">
  <div class="horizontal-inner-container post-container">
    <br clear="all">
    <br clear="all">

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group row">

            <div class=" col-md-offset-3 col-md-6">
                <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('Veuillez indiquer votre adresse email') }}</label>
                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <br>
                <button type="submit" class="btn btn-red">
                    Envoyer
                </button>
            </div>
        </div>
    </form>
    <br clear="all">
    <br clear="all">
  </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
