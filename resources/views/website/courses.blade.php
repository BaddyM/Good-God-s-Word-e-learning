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
    </div>
@endsection

@push("scripts")
    <script>
        $(document).ready(function(){

        });
    </script>
@endpush