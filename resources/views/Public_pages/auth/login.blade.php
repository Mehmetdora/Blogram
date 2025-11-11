<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Minimal: sadece Bootstrap CSS (local) - eğer template'inizde yoksa CDN'ye geçin -->
    <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Küçük, sayfa-özgü stiller (hafif) -->
    <style>
        :root {
            --card-radius: 12px;
            --primary: #0d6efd;
            --muted: #6c757d;
        }

        /* sistem font stack - google fonts kaldırıldı */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #f6f9ff 0%, #ffffff 100%);
            min-height: 100vh;
            margin: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .center-row {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-card {
            border-radius: var(--card-radius);
            box-shadow: 0 6px 20px rgba(38, 57, 77, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.03);
            padding: 1.5rem;
            background: #fff;
        }

        .logo img {
            max-height: 56px;
            display: block;
            margin: 0 auto;
        }

        .subtitle {
            color: var(--muted);
            font-size: .95rem;
            margin-bottom: 1rem
        }

        .btn-social {
            display: block;
            width: 100%;
            text-align: left;
            gap: .75rem;
            align-items: center;
            padding: .5rem .75rem;
            border-radius: .5rem;
            border: 1px solid rgba(0, 0, 0, 0.06);
            background: transparent;
        }

        .btn-social .provider {
            display: inline-block;
            min-width: 36px;
            height: 36px;
            border-radius: 6px;
            background: rgba(0, 0, 0, 0.04);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: .9rem;
        }

        .small-link {
            font-size: .9rem;
            color: var(--muted)
        }

        .toggle-pass {
            cursor: pointer;
            user-select: none;
            font-size: .9rem;
            color: var(--muted);
        }

        /* responsive card width similar to col-lg-4 col-md-6 */
        .card-wrapper {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }



        @media (max-width:420px) {
            .card-top {
                flex-direction: column;
                gap: 8px;
            }
        }



        /* inline validation */
        .invalid-feedback {
            display: none;
            color: #d63384;
            font-size: .875rem;
        }

        input.is-invalid+.invalid-feedback {
            display: block;
        }
    </style>

    <!-- Kısa açıklama: REPLACE alanlarını backend'e göre düzenleyin -->
    <!-- REPLACE: LOGO_SRC -> örn: asset('site_settings/site_logo/'.$site_setting->logo_url) -->
    <!-- REPLACE: LOGIN_ACTION -> form action e.g. route('login.post') -->
    <!-- REPLACE: GOOGLE_REDIRECT, GITHUB_REDIRECT -> sosyal giriş rotaları -->
</head>

<body>
    <main class="center-row">
        <div class="card-wrapper">
            <div class="auth-card">
                <a href="{{ route('welcome') }}" class="back-btn" aria-label="Back to homepage"
                    style="
                        position: absolute;
                        top: 16px;
                        left: 16px;
                        display: inline-flex;
                        align-items: center;
                        gap: 6px;
                        padding: 6px 12px;
                        border-radius: 8px;
                        border: 1px solid rgba(0,0,0,0.06);
                        background:#fff;
                        color: inherit;
                        text-decoration: none;
                        font-size:.9rem;
                        box-shadow: 0 6px 18px rgba(13,110,253,0.08);
                        z-index: 10;
                    ">
                    <span aria-hidden="true">←</span>
                    <span>Back</span>
                </a>

                <!-- Logo ortada -->
                <div class="text-center logo" style="flex:1;">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}"
                            alt="Site logo" />
                    </a>
                </div>

                <!-- Başlık ve alt yazı -->
                <div class="text-center mb-3">
                    <h5 class="mb-0">Login to Your Account</h5>
                    <p class="subtitle mb-0">Enter your email and password to login</p>
                </div>

                <!-- Server messages (blade include kept) -->
                @include('Public_pages.layouts._message')
                @if (!empty(request('success')))
                    <div class="alert alert-success" role="alert">{{ request('success') }}</div>
                @endif

                <!-- Form: method/action değiştirilebilir -->
                <form id="loginForm" action="{{ route('auth_login') }}" method="post" novalidate>
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="yourEmail" class="form-label">Email</label>
                        <input type="email" name="email" id="yourEmail" class="form-control" required
                            aria-describedby="emailHelp" />
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <div class="mb-2">
                        <label for="yourPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="yourPassword" class="form-control" required
                                aria-describedby="passwordHelp" />
                            <button type="button" id="togglePass" class="btn btn-light"
                                aria-label="Show password">Show</button>
                        </div>
                        <div class="invalid-feedback">Please enter your password (min 6 characters).</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="true"
                                id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <div class="text-end"><a href="{{ url('forgot-password') }}" class="small-link">I Forgot My
                                Password</a></div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>

                    <div class="mb-2">
                        <a href="{{ route('auth_google_redirect') }}" class="btn-social d-flex align-items-center">
                            <span class="provider">G</span>
                            <span>Continue with Google</span>
                        </a>
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('auth_github_redirect') }}" class="btn-social d-flex align-items-center">
                            <span class="provider">GH</span>
                            <span>Continue with Github</span>
                        </a>
                    </div>

                    <p class="text-center small mb-0">Don't have an account? <a href="{{ url('register') }}">Create
                            an account</a></p>
                </form>
            </div>
        </div>
    </main>

    <script>
        (function() {
            // Elements
            const form = document.getElementById('loginForm');
            const email = document.getElementById('yourEmail');
            const pass = document.getElementById('yourPassword');
            const toggleBtn = document.getElementById('togglePass');
            const MIN_PASS = 6;

            // simple email regex (client-side only)
            function validEmail(v) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
            }

            // toggle password visibility
            toggleBtn.addEventListener('click', function(e) {
                const t = pass.type === 'password' ? 'text' : 'password';
                pass.type = t;
                this.textContent = t === 'password' ? 'Show' : 'Hide';
            });

            // client-side validation and inline error toggling
            form.addEventListener('submit', function(e) {
                let valid = true;

                // email
                if (!validEmail(email.value.trim())) {
                    email.classList.add('is-invalid');
                    valid = false;
                } else {
                    email.classList.remove('is-invalid');
                }

                // password
                if (pass.value.trim().length < MIN_PASS) {
                    pass.classList.add('is-invalid');
                    valid = false;
                } else {
                    pass.classList.remove('is-invalid');
                }

                if (!valid) {
                    e.preventDefault();
                    // focus first invalid
                    const firstInvalid = form.querySelector('.is-invalid');
                    if (firstInvalid) firstInvalid.focus();
                } else {
                    // allow submit; if you want AJAX, replace this block with fetch/XHR
                }
            });

            // remove invalid state on input
            [email, pass].forEach(function(el) {
                el.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                });
            });

        })();
    </script>
</body>

</html>
