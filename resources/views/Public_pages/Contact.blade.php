@extends('Public_pages/layouts.app')
@section('style')
@endsection
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class=" px-5">
                    <span class="px-2">Get In Touch</span>
                </p>
                <h1 class="mb-4">Contact Me For Any Query</h1>
                @include('Public_pages.layouts._message')
            </div>
            <div class="row">
                <div class="col-lg-7 mb-5">
                    <div class="contact-form">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" method="post" action="{{ route('contact-email') }}"
                            novalidate="novalidate">
                            @csrf
                            <div class="control-group">
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Your Name" required
                                    data-validation-required-message="Please enter your name" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required
                                    data-validation-required-message="Please enter your email" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required
                                    data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control" rows="6" name="message" id="message" placeholder="Message" required
                                    data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-5">
                    <p>
                        If you encounter any errors while using the site, have complaints about the content, or have
                        suggestions, please feel free to share your thoughts with us.
                    </p>
                    <div class="d-flex">
                        <div class="pl-3">
                            <h5>Address</h5>
                            <p>Mersin, Türkiye 🇹🇷</p>
                        </div>
                    </div>
                    <hr style="margin: 0" class="mb-2">
                    <div class="d-flex">
                        <div class="pl-3">
                            <h5>Email</h5>
                            <p>{{ $site_setting->contact_email }}</p>
                        </div>
                    </div>

                    <hr style="margin: 0" class="mb-2">


                    <div class="d-flex">
                        <div class="pl-3">
                            <h5>Opening Hours</h5>
                            <strong>7 Days, 24 Hours</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
@section('script')
@endsection
