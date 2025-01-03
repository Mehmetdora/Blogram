@extends('Management_pages.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Website Settings</h1>
    </div><!-- End Page Title -->

    <div class="section">
        <div class="row">

            <div class="col-lg-12">
                @include('Public_pages.layouts._message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All In Use Settings</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('save_site_settings') }}" method="post">
                            @csrf

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Site Name</label>
                                <input type="text" value="{{ $site_setting->site_name }}" class="form-control"
                                    name="site_name" required id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Logo Name</label>
                                <select name="logo_url" id="logo_url" aria-label="Default select example"
                                    class="form-control " required>
                                    <option value="{{ $site_setting->logo_url }}" selected>{{ $site_setting->logo_url }}
                                    </option>
                                    <hr>
                                    @foreach ($site_logos as $name)
                                        <option value="{{ $name }}">{{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Editor's Pick Blog</label>
                                <select name="editors_pick" id="logo_url" required aria-label="Default select example"
                                    class="form-control " required>

                                    @if (isset($site_setting->editors_pick_blog_id))
                                        <option value="{{ $site_setting->editors_pick_blog_id }}" selected>
                                            {{ $site_setting->editors_blog($site_setting->editors_pick_blog_id) }}
                                        </option>
                                    @else
                                        <option value="" selected>
                                            ---
                                        </option>
                                    @endif

                                    <hr>
                                    @foreach ($blogs as $blog)
                                        <option value="{{ $blog->id }}">{{ $blog->title }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Favicon Url</label>
                                <select name="favicon_url" id="logo_url" aria-label="Default select example"
                                    class="form-control " required>
                                    <option value="{{ $site_setting->favicon_url }}" selected>
                                        {{ $site_setting->favicon_url }}
                                    </option>
                                    <hr>
                                    @foreach ($favicons as $name)
                                        <option value="{{ $name }}">{{ $name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Theme Color</label>
                                <input type="text" value="{{ $site_setting->theme_color }}" class="form-control"
                                    name="theme_color" required id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Background Color</label>
                                <input type="text" value="{{ $site_setting->background_color }}" class="form-control"
                                    name="background_color" required id="inputEmail4">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Font Family</label>
                                <input type="text" value="{{ $site_setting->font_family }}" name="font_family" required
                                    class="form-control" id="inputPassword4">
                            </div>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Font Size</label>
                                <input type="text" value="{{ $site_setting->font_size }}" class="form-control"
                                    name="font_size" required id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Header Image Url</label>
                                <input type="text" value="{{ $site_setting->header_image_url }}" class="form-control"
                                    name="header_image_url" id="inputEmail4">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Footer Text</label>
                                <input type="text" value="{{ $site_setting->footer_text }}" name="footer_text"
                                    class="form-control" id="inputPassword4">
                            </div>
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Is Dark Mode Enable(0 or 1)</label>
                                <input type="text" value="{{ $site_setting->is_dark_mode_enabled }}"
                                    class="form-control" name="is_dark_mode_enabled" required id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Default Language</label>
                                <input type="text" value="{{ $site_setting->default_language }}" class="form-control"
                                    name="default_language" required id="inputEmail4">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Maintenance Mode</label>
                                <input type="text" value="{{ $site_setting->maintenance_mode }}"
                                    name="maintenance_mode" required class="form-control" id="inputPassword4">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Maintenance Message</label>
                                <input type="text" value="{{ $site_setting->maintenance_message }}"
                                    name="maintenance_message" class="form-control" id="inputPassword4">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Settings</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
