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
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success px-4 fw-bold bg-gradient" type="button"
                                id="edit_profile_btn">Edit</button>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-3 p-3 shadow mb-2" style="">
                                @if ($data->image == 'blank.png')
                                    @if ($data->gender == 'male')
                                        <img id="user_image" class="img-fluid img-thumbnail"
                                            src="{{ asset('users/empty-male.jpg') }}" alt="">
                                    @elseif($data->gender == 'female')
                                        <img id="user_image" class="img-fluid img-thumbnail"
                                            src="{{ asset('users/empty-female.jpg') }}" alt="">
                                    @endif
                                @else
                                    <img id="user_image" class="img-fluid img-thumbnail"
                                        src="{{ asset('users/' . $data->image . '') }}" alt="">
                                @endif
                                <div class="mt-3 d-none" id="img_section">
                                    <label class="form-label h6 fw-bold">Add new image</label>
                                    <input type="file" name="user_img" accept=".jpg, .jpeg, .png" class="form-control rounded-0">
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label h6 fw-bold">Last Name</label>
                                    <input type="text" placeholder="Enter Last Name" name="lname"
                                        class="form-control rounded-0 text-capitalize fw-bold text-primary"
                                        value="{{ $data->lname }}" disabled>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label h6 fw-bold">First Name</label>
                                    <input type="text" placeholder="Enter First Name" name="fname"
                                        class="form-control rounded-0 text-capitalize fw-bold text-primary"
                                        value="{{ $data->fname }}" disabled>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label h6 fw-bold">Email</label>
                                    <input type="email" placeholder="Enter Email" name="email"
                                        class="form-control rounded-0 fw-bold text-primary" value="{{ $data->email }}"
                                        disabled>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label h6 fw-bold">Current Gender</label>
                                    <input type="text" placeholder="Enter Gender"
                                        class="form-control rounded-0 fw-bold text-primary mb-3 text-capitalize" value="{{ $data->gender }}"
                                        disabled>
                                    <label class="form-label h6 fw-bold">Select New Gender</label>
                                    <select name="gender" class="form-select text-primary fw-bold rounded-0" disabled>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label h6 fw-bold">Account Type</label>
                                    @if ($data->is_student == 1)
                                        <span class="badge bg-warning text-dark">student</span>
                                    @elseif($data->is_tutor == 1)
                                        <span class="badge" style="background:purple;color:whitesmoke;">tutor</span>
                                    @elseif($data->is_admin == 1)
                                        <span class="badge bg-primary text-white">admin</span>
                                    @endif
                                </div>
                                <div class="mb-2 d-none">
                                    <label class="form-label h6 fw-bold">Payment Completed</label>
                                    <input type="text" class="form-control rounded-0 fw-bold text-primary" value="45%"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <button class="submit-btn d-flex align-items-center d-none" style="gap:5px;" type="submit"
                            id="update_profile_btn">
                            <div class="d-flex justify-content-center align-items-center d-none" id="spinner">
                                <div class="spinner-border text-white spinner-border-sm" role="status">
                                </div>
                            </div>
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('common.alert')

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#edit_profile_btn").on("click", function(e) {
                e.preventDefault();
                $("input, select").prop("disabled", false);
                $("#update_profile_btn, #img_section").removeClass("d-none");
                $("#edit_profile_btn").addClass("d-none");
            });

            $("#update_profile_form").on("submit", function(e) {
                e.preventDefault();
                $("#update_profile_btn").removeClass("submit-btn").addClass("submit-btn-disabled");
                $("#spinner").removeClass("d-none");
                $.ajax({
                    type: "POST",
                    url: "{{ route('profile.update') }}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        $("#alertId").modal("show");
                        $("#alert_body").text(response.message);
                        setTimeout(() => {
                            $("#alertId").modal("hide");
                        }, 2000);

                        //Set new image
                        if(response.image != null){
                            $("#user_image").attr("src",`/users/${response.image}`);
                        }

                        //Reset Inputs
                        $("input,select").prop("disabled", true);
                        $("#edit_profile_btn").removeClass("d-none");
                        $("#update_profile_btn").addClass("submit-btn d-none").removeClass(
                            "submit-btn-disabled");
                        $("#img_section").addClass("d-none");
                        $("#spinner").addClass("d-none");

                        //Reset Form
                        $("#update_profile_form")[0].reset();

                        setTimeout(() => {
                            location.reload();
                        }, 2500);
                    },
                    error: function() {
                        $("#alertId").modal("show");
                        $("#alert_body").text("Failed, Try Again!");
                        setTimeout(() => {
                            $("#alertId").modal("hide");
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endpush
