@extends('common.master')

@section('title')
    My Course
@endsection

@section('body')
    <div class="py-2 px-1" style="background:rgb(16, 113, 248);">
        <p class="mb-0 text-white fw-bold text-uppercase">Level {{ $id=1 }}</p>
    </div>
    <div class="container-fluid pt-3">
        @for ($i = 1; $i <= 3; $i++)
            <div class="accordion mb-3" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $i }}" aria-expanded="true" aria-controls="collapseOne">
                            Material {{ $i }}
                        </button>
                    </h2>
                    <div id="collapse{{ $i }}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Material Items
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
