@extends("common.website")

@section("title")
    Courses
@endsection

@section("body")
    <div class="container-fluid">
        <nav class="breadcrumb my-3">
            <a class="breadcrumb-item" href="{{ route("home.index") }}">Home</a>
            <span class="breadcrumb-item active" aria-current="page">Courses</span>
        </nav>

        <div class="card shadow-sm border-0 my-4">
            <div class="card-body">
                <div class="col-md-4">
                    <p class="mb-2 fw-bold h6">Tailoring</p>
                </div>
                @php
                    $tailor_imgs = ["1.jpg","3.jpg","4.jpg","5.jpg","6.jpg","7.jpg","8.jpg","9.jpg"];
                @endphp
                <div class="row">
                    @for ($i=0; $i<count($tailor_imgs); $i++)
                    <div class="col-md-3 mb-3">
                        <img class="img-fluid" src="{{ asset("images/courses/tailoring/".$tailor_imgs[$i]."") }}" alt="">
                    </div>
                    @endfor
                </div>
            </div>
        </div>{{-- tailoring --}}

        <div class="card shadow-sm border-0 my-4">
            <div class="card-body">
                <div class="col-md-4">
                    <p class="mb-2 fw-bold h6">Videography</p>
                </div>
                @php
                    $videography_imgs = ["1.jpg","3.jpg","4.jpg","5.jpg","6.jpg"];
                @endphp
                <div class="row">
                    @for ($i=0; $i<count($videography_imgs); $i++)
                    <div class="col-md-3 mb-3">
                        <img class="img-fluid" src="{{ asset("images/courses/videography/".$videography_imgs[$i]."") }}" alt="">
                    </div>
                    @endfor
                </div>
            </div>
        </div>{{-- videoraphy --}}
    </div>
@endsection

@push("scripts")
    <script>
        $(document).ready(function(){

        });
    </script>
@endpush