@extends('common.master')

@section('title')
    My Profile
@endsection

@section('body')
    <div class="container-fluid pt-3">
        <p class="fw-bold h6">My Profile <i class="bi bi-person-fill"></i></p>

        <div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form id="update_profile_form" method="post">
                        @csrf
                        <div class="mb-2 row">
                            <div class="col-md-3 shadow mb-2" style="width:200px; height:200px; background:grey;">

                            </div>
                            <div class="col-md-9">
                                <div class="mb-2">
                                    <label class="form-label h6 fw-bold">Full Name</label>
                                    <input type="text" placeholder="Enter Full Name" class="form-control rounded-0" value="Arnold Henry" disabled>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label h6 fw-bold">Email</label>
                                    <input type="email" placeholder="Enter Email" class="form-control rounded-0" value="arnoldhenry958@gmail.com" disabled>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label h6 fw-bold">Payment Completed</label>
                                    <input type="text" class="form-control rounded-0" value="45%" disabled>
                                </div>
                            </div>
                        </div>
                        <button class="submit-btn d-none" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        
    </script>
@endpush
