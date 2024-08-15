@extends('common.master')

@section('title')
    Courses
@endsection

@section('body')
    <div class="container-fluid pt-3">
        <div class="row justify-content-between">
            @php
                //$course = ['Java', 'Web Development', 'English', 'Video Editing', 'IELTS', 'Accounting'];
                $lecturer = ['Mr. John', 'Ms. Barbara', 'Mr. Peter', 'Ms. Jeniffer'];
                $action = ['active', 'inactive'];
                $completion = [0, 25, 50, 100];
                $level = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            @endphp
            @for ($i = 0; $i < count($level); $i++)
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div>
                                <p class="mb-0 fw-bold h5 mb-2">Level {{ $level[$i] }}</p>
                                <p class="mb-0 h6 mb-2">Tutor: <span class="text-muted fw-bold">{{ $lecturer[array_rand($lecturer)] }}</span></p>
                                <p class="mb-0 h6 mb-2 d-none">Level: <span class="text-muted fw-bold">{{ $level[array_rand($level)] }}</span></p>
                                <p class="mb-0 h6 mb-2 text-white px-2 py-1 bg-secondary">Completed</p>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                        role="progressbar" style="width: {{ $completion[array_rand($completion)] }}%;">
                                    </div>
                                </div>
                                <div class="mb-0 h6 d-flex justify-content-between py-2">
                                    <div>0%</div>
                                    <div>100%</div>
                                </div>
                                <hr style="color:blue; margin-top:0; margin-bottom:10px;">
                                <div class="d-flex justify-content-between">
                                    @if($action[array_rand($action)] == 'inactive')
                                    <div><a href="{{ route("course.enroll",1) }}">
                                        <button type="button" class="btn btn-success btn-sm rounded-5 px-3 shadow-sm">Enroll</button>    
                                    </a></div>
                                    @else
                                    <div><a href="{{ route('courses.enrolled', 1) }}"><button type="button" class="btn btn-primary btn-sm rounded-5 px-3 shadow-sm">Continue
                                        Learning</button></a></div>
                                    <div><button type="button" class="btn btn-danger btn-sm rounded-5 px-3 shadow-sm">Cancel</button></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>{{-- cards --}}
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
