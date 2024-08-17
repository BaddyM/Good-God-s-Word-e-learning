@php
    $brand_name = "Good God's Word Ministries International";
    $motto = "Deepen your understanding of the bible with $brand_name";
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Email</title>
    <link rel="shortcut icon" href="jubra_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toasttui.css') }}">
    <link rel="shortcut icon" href="{{ asset("images/logo.png") }}" type="image/x-icon">
</head>
<body>  
    <div class="login_container">
        <div class="">
            <div class="card border-0 shadow-sm rounded-0">
                <div class="card-body">
                    <p>Email <strong>{{ $email }}</strong> Verified Successfully. You can now login here. <a href="{{ route("login") }}" class="submit-btn" style="text-decoration: none;">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    @include("common.alert")

    <div class="bg-light p-3 text-center mt-4">
        <p class="mb-0"><i class="bi bi-c-circle"></i> Copyright {{ date("Y", strtotime(now())) }}</p>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/datatable.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/flatpickr.js') }}"></script>
    <script src="{{ asset('js/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('js/toasttui.js') }}"></script>
    <script>
        $(document).ready(function(){

        });
    </script>
    @stack("scripts")
</body>
</html>