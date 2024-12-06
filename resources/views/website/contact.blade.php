@extends('common.website')

@section('title')
    Contact Us
@endsection

@section('body')
    <nav class="breadcrumb my-3">
        <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
        <span class="breadcrumb-item active" aria-current="page">Contact Us</span>
    </nav>

    <!-- contact section -->
    <section class="contact_section mb-5">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6 px-0">
                    <div class="img-box ">
                        <img src="{{ asset('images/IMG-20241130-WA0004.jpg') }}" class="box_img img-fluid" alt="about img">
                    </div>
                </div>
                <div class="col-md-5 mx-auto">
                    <div class="form_container">
                        <div class="heading_container heading_center">
                            <h2>Get In Touch</h2>
                        </div>
                        <form id="contact_form">
                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="text" class="form-control" placeholder="Your Name" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <input type="number" class="form-control" placeholder="Phone Number" />
                                </div>
                                <div class="form-group col-lg-6 d-none">
                                    <select name="" id="" class="form-control wide">
                                        <option value="">Select Service</option>
                                        <option value="">Service 1</option>
                                        <option value="">Service 2</option>
                                        <option value="">Service 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="email" id="contact_email" class="form-control" placeholder="Email" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <input type="text" id="contact_msg" class="message-box form-control"
                                        placeholder="Message" />
                                </div>
                            </div>
                            <div class="btn_box">
                                <button type="submit">
                                    SEND
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end contact section -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
