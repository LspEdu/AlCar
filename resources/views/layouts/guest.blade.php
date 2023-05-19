<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{url('build/assets/img/favicon.ico')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.scss', 'resources/css/app.css', 'resources/js/app.js', 'resources/js/bootstrap.js'])
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
</head>

<body class=" text-gray-900 antialiased">


    <div class="min-h-screen flex flex-col sm:justify-center items-center  sm:pt-0 ">
        <div class="fondo"></div>
        <div class="container py-5 h-100">
            <div class="col d-flex justify-center mb-2 " >
                <a href="/" class="bg-light rounded shadow p-2" style="--bs-bg-opacity: .4;">
                    <img src="{{asset('build/assets/img/logotipo.svg')}}" alt=""> {{-- TODO:: LOGOTIPO CON BORDE BLANCO --}}
                </a>
            </div>
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body shadow p-5 text-center">
                        {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
