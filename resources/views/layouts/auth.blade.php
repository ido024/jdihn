<!DOCTYPE html>
<html dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('../../admin/assets/images/favicon.png')}}">
        <title>Sistem Informasi Kejaksaan Negeri Sungai Penuh</title>
        <!-- Custom CSS -->
        <link href="{{asset('../../admin/dist/css/style.min.css')}}" rel="stylesheet">


    </head>

    <body>
        <div class="main-wrapper">

            <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>

            @yield('auth-content')

        </div>

        <script src="{{asset('../../admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{asset('../../admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('../../admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>

        <script>
            $('[data-toggle="tooltip"]').tooltip();
                $(".preloader").fadeOut();
                // ============================================================== 
                // Login and Recover Password 
                // ============================================================== 
                $('#to-recover').on("click", function() {
                    $("#loginform").slideUp();
                    $("#recoverform").fadeIn();
            });
        </script>
        @include('sweetalert::alert')
    </body>

</html>