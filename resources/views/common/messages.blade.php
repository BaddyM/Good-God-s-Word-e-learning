@extends('common.master')

@section('title')
    Emails
@endsection

@section('body')
    <div class="container-fluid my-3">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form id="send_message_form" method="post">
                        @csrf
                        <div class="mb-2">
                            <label class="form-label fw-bold h6">From</label>
                            <input type="email" class="form-control rounded-0" placeholder="Enter Email" name="from" value="{{ $from }}" readonly>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold h6">To</label>
                            <select name="to" class="form-select rounded-0">
                                @foreach ($to as $f)
                                    <option value="{{ $f->email }}">{{ $f->email }} - {{ ucfirst($f->lname) }} {{ ucfirst($f->fname) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold h6">Message</label>
                            <textarea name="message" id="message" class="form-control rounded-0" placeholder="Add Message" cols="30" rows="10"></textarea>
                        </div>
                        <button class="submit-btn-disabled" type="submit" id="submit_btn" disabled>Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table" id="messages_table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Message</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const modal = new bootstrap.Modal(document.getElementById('alert_modal'));
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        document.querySelector("#send_message_form").addEventListener("submit", function(e) {
            e.preventDefault();
            fetch("{{ route('message.send') }}", {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: new FormData(e.target)
                }).then((res) => res.json())
                .then((data) => document.getElementById("alert_body").innerText = data.response)
                .then(() => modal.show())
                .then(this.reset())
                .then($("#messages_table").DataTable().draw())
        });

        document.querySelector("#message").addEventListener("keyup", function() {
            var message = this.value;
            if (message.length > 0) {
                document.querySelector("#submit_btn").removeAttribute("disabled")
                document.querySelector("#submit_btn").classList.remove("submit-btn-disabled")
                document.querySelector("#submit_btn").classList.add("submit-btn")
            } else {
                document.querySelector("#submit_btn").setAttribute("disabled", true)
                document.querySelector("#submit_btn").classList.add("submit-btn-disabled")
                document.querySelector("#submit_btn").classList.remove("submit-btn")
            }
        });

        $("#messages_table").DataTable({
            serverSide: true,
            processing: true,
            autoWidth: false,
            ordering:false,
            ajax: {
                type: "POST",
                url: "{{ route('message.fetch') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [{
                    data: "created_at"
                },
                {
                    data: "from"
                },
                {
                    data: "to"
                },
                {
                    data: "message"
                },
                {
                    data: "action"
                },
            ],
            columnDefs: [
                {
                    target: [0],
                    width: "200px"
                },
                {
                    targets: [1,2],
                    width: "250px"
                },
                {
                    targets: [4],
                    width: "150px",
                    className:"dt-center"
                },
            ]
        });

        $(window).on("focus",function(){
            $("#messages_table").DataTable().draw()
        });

        $(document).on("click",".read_message",function(e){
            e.preventDefault()
            var id = $(this).data("id");
            fetch("{{ route('message.read') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type":"application/json",
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        "id":id
                    })
                }).then((res) => res.json())
                .then((data) => document.getElementById("alert_body").innerText = data.response)
                .then(() => {
                    modal.show();
                    setTimeout(() => {
                        modal.hide();
                    }, 2000);
                })
                .then($("#messages_table").DataTable().draw());
        })

        $(document).on("click",".delete_message",function(e){
            e.preventDefault()
            var id = $(this).data("id");
            fetch("{{ route('message.delete') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type":"application/json",
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        "id":id
                    })
                }).then((res) => res.json())
                .then((data) => document.getElementById("alert_body").innerText = data.response)
                .then(() => {
                    modal.show();
                    setTimeout(() => {
                        modal.hide();
                    }, 2000);
                })
                .then($("#messages_table").DataTable().draw());
        })
    </script>
@endpush
