@extends('common.master')

@section('title')
    Levels
@endsection

@section('body')
    <div class="container-fluid">
        <p class="h5 mt-2 fw-bold">Levels</p>
        <form id="save_levels_form" method="post">
            @csrf
            <div class="col-md-4 mb-3">
                <ul class="list-group">
                    @foreach ($levels as $l)
                        <li class="list-group-item d-flex align-items-center" style="gap:10px;">
                            <p class="mb-0 col-md-3">Level {{ $l->level }}</p> 
                            <div class="col-md-9">
                                <input type="number" class="form-control price_input" name="price[]"
                                value="{{ $l->price }}" placeholder="Add Level {{ $l->level }} Price">
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <button class="btn btn-success px-4 fw-bold bg-gradient shadow-sm" type="submit">Save</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#save_levels_form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('levels.save') }}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        $("#alert_modal").modal("show");
                        $("#alert_body").text(response);
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
                    },
                    error: function() {
                        $("#alert_modal").modal("show");
                        $("#alert_body").text("Failed, Try Again!");
                        setTimeout(() => {
                            $("#alert_modal").modal("hide");
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endpush
