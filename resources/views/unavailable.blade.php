<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="row">
        <div class="col-md-4 col-md-push-4">
            <div class="row">
                <div class="col-md-12" style="margin-top: 20vh;">
                     <p align="center">
                         L'extranet sera bientôt disponible pour vous.
                     </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
