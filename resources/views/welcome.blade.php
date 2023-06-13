<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-screen">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('build/assets/img/favicon.ico') }}" type="image/x-icon">
    <!-- Styles -->

    @vite(['resources/js/app.js', 'resources/css/app.scss', 'resources/css/app.css'])
    <style>

    </style>
</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark  bg-dark text-end flex justify-end">
        <div class=" d-flex justify-around w-56">

            <a class="link link-light text-end" href="{{route('login')}}">Iniciar Sesión</a>
            <a class="link link-light text-end" href="{{route('register')}}">Registrarse</a>
        </div>
    </nav>
    <!-- Header - set the background image for the header in the line below-->
    <header class="py-5 bg-image-full" style="background-image: url({{asset('build/assets/img/marmol.jpg')}}); background-size: cover; filter: grayscale(100)">
        <div class="text-center my-5 ">
            <div class="col d-flex justify-center mb-2 " >
                <a href="/" class="bg-light rounded shadow p-2" style="--bs-bg-opacity: .5;">
                    <img src="{{asset('build/assets/img/logotipo.svg')}}" alt="">
                </a>
            </div>
            <h1 class="text-white fs-3 fw-bolder">AlCar</h1>
            <p class="text-white-50 mb-0">Tu portal de alquiler de coches</p>
        </div>
    </header>
    <!-- Content section-->
    <section class="py-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2 class="fs-2">Alquila el coche de tus sueños</h2>
                    <p class="lead">En AlCar ofrecemos la mejor experiencia para todo tipo de usuarios que deseen probar cualquier modelo de coche</p>
                    <p class="mb-0">Desde deportivos hasta el coche japonés que quieres para ti. Todo está al alcance de un click.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Image element - set the background image for the header in the line below-->
    <div class="py-3 bg-image-full" id="video-container">
        <video autoplay muted loop style="object-fit: cover">
            <source src="{{asset('build/assets/video/bugatti.mp4')}}" type="video/mp4">

        </video>
    </div>
    <!-- Content section-->
    <section class="py-5">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2 class="fs-2">Sacar provecho a tu coche</h2>
                    <p class="lead">Rentabiliza tu super coche ofreciéndolo a otros usuarios</p>
                    <p class="mb-0">Si te has gastado un buen dinero en tu coche pero te da pena que esté ahí parado, puedes sacarle beneficios poniéndolo a la disposición de más usuarios.</p>
                </div>
            </div>
        </div>
        <div class="py-3 bg-image-full " id="video-container">
            <img src="{{asset('build/assets/img/lambo.webp')}}" alt="" class="img-fluid" style="object-fit: contain">
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; AlCar.S.L. 2023</p></div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
