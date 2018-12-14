<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=11" />
        <meta http-equiv="Content-Language" content="en"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{!! $htmlTitle or 'BWO Interim' !!}</title>
        <meta name="description" content="{!! $metaDescription or '' !!}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:title" content="{!! $htmlTitle or 'Menco RH' !!}"/>
        <meta property="og:description" content="{!! $socialDescription or '' !!}"/>
        <meta property="og:image" content="{!! $socialImage or asset('images/header-logo.jpg') !!}"/>
        <meta property="og:type" content="website"/>
        <meta name="robots" content="noindex,nofollow">

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image"/>
    		<meta name="twitter:site" content=""/>
    		<meta name="twitter:creator" content=""/>
    		<meta name="twitter:title" content=""/>
    		<meta name="twitter:description" content=""/>


        <link href="{{asset('modules/bwo/css/app.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" media="all" href="{{ asset('modules/bwo/css/font-awesome/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" media="all" href="{{ asset('modules/bwo/fonts/iconmoon/iconmoon.css')}}" />


        @stack('styles')

    </head>

    <body class="{{$mainClass or ''}}">


        @include('bwo::partials.modals')

        @stack('modal')

        @include ('bwo::partials.header')

        @yield('content')

        <!-- Footer blade important to add JavasCript variables from Controller -->
        @include ('bwo::partials.footer')
        <script>
          const WEBROOT = '{{route("home")}}';
          const ASSETS = '{{asset('')}}';
          const LOCALE = '{{App::getLocale()}}';
          const app = {};
          var csrf_token = "{{csrf_token()}}";
          var civility_default = "{{ Modules\RRHH\Entities\Offers\Candidate::CIVILITY_MALE }}"
          var routes = {'login':"{{route('candidate.login')}}"}
        </script>


        <!-- Select2 -->

        @stack('javascripts-libs')

        <script type="text/javascript" src="{{asset('modules/bwo/js/app.js')}}" ></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <script>

          $(document).ready(function() {
              $(document).on("click","#btn-user-menu",function() {
                $('#main-menu').removeClass('in');
              });

              $(document).on("click","#btn-main-menu",function() {
                $('#user-menu').removeClass('in');
              });

              $(".application-btn").on('click',function(e){
                  app.offerapplications.init(
                    "{{ Auth::check() ? Auth::user()->id : 0 }}",
                    this.id,
                    "{{ Auth::check() && (Auth::user()->candidate) ? Auth::user()->candidate->resume_file : '' }}"
                  );
                  app.offerapplications.open();

              });

          });

        </script>


        @stack('javascripts')
    </body>
</html>
