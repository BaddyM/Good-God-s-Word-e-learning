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
    <title>Register</title>
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
        <p class="mb-0 text-center text-white fw-bold h4 py-2">Register Account <i class="fa fa-key"></i></p>
    </div>     

    <div class="login_container">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body">
                <form id="register_user" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="fw-bold h6">Last Name <i style="color:red;">*</i></label>
                            <input type="text" name="lname" class="form-control rounded-2" placeholder="Enter Last Name" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="fw-bold h6">First Name <i style="color:red;">*</i></label>
                            <input type="text" name="fname" class="form-control rounded-2" placeholder="Enter First Name" required>
                        </div>
                    </div>
                    <div class=" mb-2">
                        <label class="fw-bold h6">Email <i style="color:red;">*</i></label>
                        <input type="email" name="email" class="form-control rounded-2" placeholder="Enter Email" required>
                    </div>
                    <div class=" mb-2">
                        <label class="fw-bold h6">Gender <i style="color:red;">*</i></label>
                        <select name="gender" class="form-select rounded-2" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class=" mb-2">
                        <label class="fw-bold h6">Password <i style="color:red;">*</i></label>
                        <input type="password" name="password" class="form-control rounded-2" placeholder="Enter Password" required>
                    </div>
                    <div class=" mb-2">
                        <label class="fw-bold h6">Confirm Password <i style="color:red;">*</i></label>
                        <input type="password" name="confirm_password" class="form-control rounded-2" placeholder="Confirm Password" required>
                    </div>
                    <button class="submit-btn mb-2 d-flex align-items-center" style="gap:5px;" type="submit">
                        <div class="d-flex justify-content-center align-items-center d-none" id="spinner">
                            <div class="spinner-border text-white spinner-border-sm" role="status">
                            </div>
                        </div>
                        Register
                    </button>
                    <div class="mb-2 login_or">
                        <div></div>
                        <div><p class="mb-0">or</p></div>
                        <div></div>
                    </div>
                    <div class="row login_links">
                        <div class="col-md-6 mb-2"><a href="{{ route("login") }}">Login</a></div>
                    </div>
                </form>
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
            $("#register_user").on("submit",function(e){
            e.preventDefault();
                $("#spinner").removeClass("d-none");
                e.preventDefault();
                $.ajax({
                    type:"POST",
                    url:"{{ route('register.user') }}",
                    data: new FormData(this),
                    processData:false,
                    contentType:false,
                    cache:false,
                    success:function(response){
                        $("#spinner").addClass("d-none");
                        $("#alert_modal").modal("show");
                        $("#alert_body").text(response);
                        $("#register_user")[0].reset();
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
                    },
                    error:function(){
                        alert("Failed to Register, Try Again!");
                    }
                });
            });
        });
    </script>
    @stack("scripts")
</body>
</html>