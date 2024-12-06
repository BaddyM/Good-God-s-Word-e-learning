@extends('common.master')

@section('title')
    Levels
@endsection

@section('body')
    <div class="container-fluid pt-3">
        <div class="alert alert-warning shadow-sm col-md-4">
            <p class="m-0">Please select a level</p>
        </div>

        <p class="fw-bold h6">Levels List</p>

        @php
            $levels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        @endphp
        <div class="col-md-4">
            <ul class="list-group shadow border-0">
                @foreach ($levels as $l)
                    <li class="list-group-item">
                        <a href="{{ route('course.materials.list',"".$l."") }}" class="btn btn-primary px-4 bg-gradient rounded-0 shadow-sm level_btn"
                            value="{{ $l }}">
                            Level {{ $l }}
                            </a>
                    </li>
                @endforeach
            </ul>
        </div>
        @include('common.alert')
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
