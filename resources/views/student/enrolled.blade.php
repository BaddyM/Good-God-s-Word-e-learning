@extends('common.master')

@section('title')
    My Course
@endsection

@section('body')
    <div class="py-2 px-1 d-none" style="background:rgb(16, 113, 248);">
        <p class="mb-0 text-white fw-bold text-uppercase">Level {{ $id=1 }}</p>
    </div>
    <div class="container-fluid pt-3 course_material">
        @foreach($courses as $course)
            <div class="accordion mb-3" id="accordionExample{{ $course->course_id }}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne{{ $course->course_id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $course->course_id }}" aria-expanded="true" aria-controls="collapseOne">
                            Material {{ $course->course_id }}
                        </button>
                    </h2>
                    <div id="collapse{{ $course->course_id }}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="course_description">
                                <p class="mb-1 h6">
                                    <span class="fw-bold">Tutor: </span>
                                    <span>
                                        {{ $course->lname." ".$course->fname }}
                                    </span>
                                </p>
                                <hr style="color:background:rgb(16, 113, 248);">
                                <p class="mb-1 h6">
                                    <span class="fw-bold">Description: </span>
                                    <span>
                                        {{ $course->course_description }}
                                    </span>
                                </p>
                            </div>
                            <div class="materials">
                                <video controls src="{{ asset("materials/$course->course_id/xyz.mp4") }}"></video>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
