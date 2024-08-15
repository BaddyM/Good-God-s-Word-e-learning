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
    <title>Login</title>
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
</head>
<body>
    <div class="" style="background: rgb(16, 113, 248);">
        <p class="mb-0 text-center text-white fw-bold h4 py-2">Login <i class="fa fa-lock"></i></p>
    </div>     

    <div class="login_container">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body">
                <form action="" id="login_user" method="post">
                    @csrf
                    <div class="mb-2">
                        <label class="fw-bold h6">Email <i style="color:red;">*</i></label>
                        <input type="email" name="email" class="form-control rounded-2" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-2">
                        <label class="fw-bold h6">Password <i style="color:red;">*</i></label>
                        <input type="password" name="password" class="form-control rounded-2" placeholder="Enter Password" required>
                    </div>
                    <div class="mb-2 d-none" id="show_errors">
                        <div id="error_message" class="alert alert-danger p-1">
                        </div>
                    </div><div class="mb-2 d-none" id="show_success">
                        <div id="success_message" class="alert alert-success p-1">
                        </div>
                    </div>
                    <button class="submit-btn mb-2 d-flex align-items-center" style="gap:5px;" type="submit">
                        <div class="d-flex justify-content-center align-items-center d-none" id="spinner">
                            <div class="spinner-border text-white spinner-border-sm" role="status">
                            </div>
                        </div>                        
                        Login
                    </button>
                    <div class="mb-2 login_or">
                        <div></div>
                        <div><p class="mb-0">or</p></div>
                        <div></div>
                    </div>
                    <div class="row login_links">
                        <div class="col-md-6 mb-2"><a href="{{ route("forgot.password") }}">Forgot Password</a></div>
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
    <script>
        $(document).ready(function(){
            $("#login_user").on("submit",function(e){
                e.preventDefault();
                $("#spinner").removeClass("d-none");
                e.preventDefault();
                $.ajax({
                    type:"POST",
                    url:"{{ route('login.auth') }}",
                    data: new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    success:function(response){
                        $("#spinner").addClass("d-none");
                        var status = response.status;
                        var text = response.response;
                        var route = response.route;
                        if(status == 401){
                            $("input").addClass("is-invalid");
                            $("#show_errors").removeClass("d-none");
                            $("#error_message").text(text);
                        }else if(status == 200){
                            $("input").addClass("is-valid");
                            $("#show_success").removeClass("d-none");
                            $("#success_message").text(text);
                            setTimeout(() => {
                                location.replace(route);
                            }, 1500);
                        }
                    }
                });
            });
        });
    </script>
    @stack("scripts")
</body>
</html>