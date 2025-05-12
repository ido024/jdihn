<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
            rel="stylesheet">
        <link rel="icon" href="{{asset('../../front-end/assets/images/tab-icon-01.png')}}" type="tab-icon-01">

        <title>JDIH PROVINSI JAMBI | Beranda</title>

        <!-- Bootstrap core CSS -->
        <link href="{{asset('../../front-end/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="{{asset('../../front-end/assets/css/fontawesome.css')}}">
        <link rel="stylesheet" href="{{asset('../../front-end/assets/css/templatemo-plot-listing.css')}}">
        <link rel="stylesheet" href="{{asset('../../front-end/assets/css/animated.css')}}">
        <link rel="stylesheet" href="{{asset('../../front-end/assets/css/owl.css')}}">
        <style>
            .bubble {
                padding: 8px 12px;
                margin: 5px 0;
                border-radius: 15px;
                max-width: 70%;
                clear: both;
                display: inline-block;
                word-wrap: break-word;
            }

            .bubble.user {
                background-color: #dcf8c6;
                float: right;
                text-align: right;
            }

            .bubble.admin {
                background-color: #f1f0f0;
                float: left;
                text-align: left;
            }

        </style>
    </head>

    <body>

        <!-- ***** Preloader Start ***** -->
        @include('components.frontend.loader')
        <!-- ***** Preloader End ***** -->

        <!-- ***** Header Area Start ***** -->
        @include('components.frontend.header')

        <!-- ***** Header Area End ***** -->

        @yield('frontend-page')
        @include('components.frontend.footer')

        @include('components.frontend.chat')


        <!-- Scripts -->
        <script src="{{asset('../../front-end/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('../../front-end/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('../../front-end/assets/js/owl-carousel.js')}}"></script>
        <script src="{{asset('../../front-end/assets/js/animation.js')}}"></script>
        <script src="{{asset('../../front-end/assets/js/imagesloaded.js')}}"></script>
        <script src="{{asset('../../front-end/assets/js/custom.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </body>

</html>