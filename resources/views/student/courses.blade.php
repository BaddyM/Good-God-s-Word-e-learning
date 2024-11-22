@extends('common.master')

@section('title')
    Courses
@endsection

@section('body')
    <div class="container-fluid pt-3">
        @foreach ($levels as $level)
            <div class="accordion mb-4" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne{{ $level->level }}" aria-expanded="false"
                            aria-controls="collapseOne{{ $level->level }}">
                            Level {{ $level->level }}
                        </button>
                    </h2>
                    <div id="collapseOne{{ $level->level }}" class="accordion-collapse collapse"
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p class="mb-1">Below are all Materials for Level {{ $level->level }}</p>
                            <hr style="color:blue;">
                            @foreach ($courses as $course)
                                @if ($level->level == $course->level)
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body">
                                                <div>
                                                    <p class="mb-0 fw-bold h5 mb-2 text-uppercase">
                                                        {{ $course->course_title }}</p>
                                                    <p class="mb-0 h6 mb-2">Tutor: <span
                                                            class="text-muted fw-bold">{{ $course->lname . ' ' . $course->fname }}</span>
                                                    </p>
                                                    <p class="mb-0 h6 mb-2 d-none">Level: <span
                                                            class="text-muted fw-bold"></span></p>
                                                    <p class="mb-0 h6 mb-2 text-white px-2 py-1 bg-secondary">Progress</p>
                                                    <div class="progress">
                                                        @if (count($enrollment) > 0)
                                                            @foreach ($enrollment as $enroll)
                                                                @if ($enroll->course_id == $course->course_id)
                                                                    @if ($enroll->status == 'complete')
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                                            role="progressbar" style="width: 100%;">
                                                                        </div>
                                                                    @else
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                                                            role="progressbar" style="width: 0%;">
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="mb-0 h6 d-flex justify-content-between py-2">
                                                        <div>0%</div>
                                                        <div>100%</div>
                                                    </div>
                                                    <hr style="color:blue; margin-top:0; margin-bottom:10px;">
                                                    <div class="d-flex justify-content-between">
                                                        @if (count($enrollment) > 0)
                                                            @foreach ($enrollment as $enroll)
                                                                @if ($enroll->course_id == $course->course_id)
                                                                    @if ($enroll->status == 'complete')
                                                                        <div class="alert alert-success p-1 w-100">
                                                                            <i class="fa fa-circle-check text-success"></i>
                                                                            Complete
                                                                        </div>
                                                                    @else
                                                                        @if ($enroll->pay_status == 'confirmed' && $enroll->pay_code != null)
                                                                            <div><a
                                                                                    href="{{ route('courses.enrolled', $enroll->pay_code) }}"><button
                                                                                        type="button"
                                                                                        class="btn btn-primary btn-sm rounded-5 px-3 shadow-sm">Study</button></a>
                                                                            </div>
                                                                            <div><button type="button"
                                                                                    class="btn btn-danger btn-sm rounded-5 px-3 shadow-sm">Cancel</button>
                                                                            </div>
                                                                        @elseif($enroll->pay_status == 'pending')
                                                                            <div class="alert alert-danger p-1 w-100">
                                                                                Awaiting Verification
                                                                            </div>
                                                                        @else
                                                                            <div
                                                                                class="alert alert-danger fw-bold p-1 w-100">
                                                                                <i
                                                                                    class="bi bi-exclamation-triangle-fill"></i>
                                                                                Rejected
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                @else
                                                                    <div><a
                                                                            href="{{ route('course.enroll', $course->course_id) }}">
                                                                            <button type="button"
                                                                                class="btn btn-success btn-sm rounded-5 px-3 shadow-sm">Enroll</button>
                                                                        </a></div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <div><a href="{{ route('course.enroll', $course->course_id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-success btn-sm rounded-5 px-3 shadow-sm">Enroll</button>
                                                                </a></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
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
