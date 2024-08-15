@extends('common.master')

@section('title')
    Password
@endsection

@section('body')
    <div class="container-fluid pt-3">
        <p class="fw-bold h6">Update Password <i class="fa fa-key"></i></p>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form id="update_password_form" method="post">
                        @csrf
                        <div class="mb-2">
                            <label class="form-contro h6 fw-bol">Old Password</label>
                            <input type="password" class="form-control rounded-0" placeholder="Enter Old Password" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-contro h6 fw-bol">New Password</label>
                            <input type="password" class="form-control rounded-0" placeholder="Enter New Password" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-contro h6 fw-bol">Confirm New Password</label>
                            <input type="password" class="form-control rounded-0" placeholder="Confirm New Password" required>
                        </div>
                        <button class="submit-btn" type="submit">Update</button>
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
