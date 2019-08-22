<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{App::getLocale()}}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=11" />
        <meta http-equiv="Content-Language" content="{{App::getLocale()}}"/>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{$title or Lang::get("front::messages.seo.title")}}</title>
        <meta name="keywords" lang="{{App::getLocale()}}" content="" />
        <meta name="description" lang="{{App::getLocale()}}" content="" />
        <meta name="abstract" content="" />
  	    <meta name="author" content="" />
        <meta name="robots" content="noindex,nofollow">

        <!-- twitter -->
        <meta name="twitter:card" content="summary_large_image"/>
    		<meta name="twitter:site" content=""/>
    		<meta name="twitter:creator" content=""/>
    		<meta name="twitter:title" content=""/>
    		<meta name="twitter:description" content=""/>

        <!-- facebook -->
    		<meta property="og:url" content="" />
    		<meta property="og:image" content="" />
    		<meta property="og:title" content=""/>
    		<meta property="og:description" content=""/>
    		<meta property="og:type" content="website"/>

        <link href="{{asset('modules/front/css/app.css')}}" rel="stylesheet" type="text/css" />

        <!-- Fonts -->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">-->
        <link rel="stylesheet" media="all" href="{{ asset('/front/css/font-awesome.min.css')}}" />


        @stack('styles')


    </head>
    <body class="{{$mainClass or ''}}">

        @stack('modal')

        @include ('front::partials.header')
        <div>

          @if(null !== Auth::user())
            @include ('front::partials.sidebar')
            <div class="content-wrapper">
              @yield('content')
            </div>
          @else
            @yield('content')

          @endif

        </div>
        <!-- Footer blade important to add JavasCript variables from Controller -->
        @include ('front::partials.footer')
        <script>
          const WEBROOT = '{{route("home")}}';
          const ASSETS = '{{asset('')}}';
          const LOCALE = '{{App::getLocale()}}';

          @if(isset(Auth::user()->id))
            const ID_PER_ASS = '{{Auth::user()->id}}';
            const ID_PER_USER = '{{Auth::user()->id}}';
          @endif

        </script>
        {{-- <script type="text/javascript" src="{{route('messages', App::getLocale())}}" ></script> --}}
        <script type="text/javascript" src="{{route('localization.js', App::getLocale())}}" ></script>

        @stack('javascripts-libs')

        <!-- Language -->
        <script type="text/javascript" src="{{asset('modules/front/js/lang.dist.js')}}" ></script>
        <script>
            Lang.setLocale('{{App::getLocale()}}');
        </script>

        <script type="text/javascript" src="{{asset('modules/front/js/app.js')}}" ></script>
        <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


        @stack('javascripts')
    </body>
</html>
