@extends('common.master')

@section('title')
    Home
@endsection

@section('body')
    @if(Auth::user()->is_student == 1)
    <div class="container-fluid pt-3 landing">
        <div class="row justify-content-between">
            <div class="col-md-3 mb-3">
                <div class="card border-0 rounded-4 shadow-sm blue-gradient">
                    <div class="card-body">
                        <div class="text-center text-white">
                            <p class="mb-0 fw-bold h5 mb-2">Active Courses</p>
                            <p class="mb-0 h5">2</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 rounded-4 shadow-sm blue-gradient">
                    <div class="card-body">
                        <div class="text-center text-white">
                            <p class="mb-0 fw-bold h5 mb-2">Completed Courses</p>
                            <p class="mb-0 h5">4</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 rounded-4 shadow-sm blue-gradient">
                    <div class="card-body">
                        <div class="text-center text-white">
                            <p class="mb-0 fw-bold h5 mb-2">Pending Tuition</p>
                            <p class="mb-0 h5">UGX 200,000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- cards --}}
    </div>

    <div class="container-fluid mt-3">
        <p class="my-2 fw-bold h6">My Planner</p>
        <div id="calendar" style="height: 300px"></div>
    </div>
    @elseif(Auth::user()->is_tutor == 1)
    <div class="container-fluid mt-3">
        <div class="col-md-4">
            <div class="alert alert-primary">
                <strong><i>Welcome</i></strong> to the <u>Tutor Dashboard</u>. <br>
                Please upload courses on this platform.
            </div>
        </div>
    </div>
    @elseif(Auth::user()->is_admin == 1)

    @else
    <div class="alert alert-danger">
        <strong>Error</strong> Invalid Credentials
    </div>
    @endif
@endsection

@push('scripts')
    <script>
        const Calendar = tui.Calendar;
        const calendar = new Calendar('#calendar', {
            defaultView: 'month',
            template: {
                time(event) {
                    const {
                        start,
                        end,
                        title
                    } = event;

                    return `<span style="color: white;">${formatTime(start)}~${formatTime(end)} ${title}</span>`;
                },
                allday(event) {
                    return `<span style="color: gray;">${event.title}</span>`;
                },
            },
            calendars: [{
                    id: 'cal1',
                    name: 'Personal',
                    backgroundColor: '#03bd9e',
                },
                {
                    id: 'cal2',
                    name: 'Work',
                    backgroundColor: '#00a9ff',
                },
            ],
        });
    </script>
@endpush
