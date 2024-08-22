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
    <title>Forgot Password</title>
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
    <link rel="shortcut icon" href="{{ asset("images/logo.png") }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/toasttui.css') }}">
</head>
<body>
    <div class="" style="background: rgb(16, 113, 248);">
        <p class="mb-0 text-center text-white fw-bold h4 py-2">Reset Password</p>
    </div>     

    <div class="login_container">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="mb-2">
                        <label class="fw-bold h6">Email <i style="color:red;">*</i></label>
                        <input type="email" name="email" class="form-control rounded-2" placeholder="Enter Email" required>
                    </div>
                    <button class="submit-btn mb-2">Reset</button>
                    <div class="mb-2 login_or">
                        <div></div>
                        <div><p class="mb-0">or</p></div>
                        <div></div>
                    </div>
                    <div class="row login_links">
                        <div class="col-md-6 mb-2"><a href="{{route("login")}}">Login</a></div>
                        <div class="col-md-6 mb-2"><a href="{{ route("register") }}">Register</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
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
    @stack("scripts")
</body>
</html>