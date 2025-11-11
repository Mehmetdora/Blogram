<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Minimal: sadece Bootstrap CSS (local). Eğer yoksa CDN ile değiştirin -->
    <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --card-radius: 12px;
            --primary: #0d6efd;
            --muted: #6c757d;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #f6f9ff 0%, #fff 100%);
            margin: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
        }

        .center-row {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .card-wrapper {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
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
            margin-bottom: 1rem;
        }

        .toggle-pass {
            cursor: pointer;
            user-select: none;
            font-size: .9rem;
            color: var(--muted);
        }

        .invalid-feedback-custom {
            color: #d63384;
            font-size: .9rem;
            margin-top: .25rem;
            display: none;
        }

        input.is-invalid+.invalid-feedback-custom {
            display: block;
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
            text-decoration: none;
            color: inherit;
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
            margin-right: .5rem;
        }

        .small-link {
            font-size: .9rem;
            color: var(--muted);
        }
    </style>

    <!-- NOTE: REPLACE LOGO_SRC if needed -->
    <!-- LOGO_SRC used below: {{ asset('site_settings/site_logo/' . $site_setting->logo_url) }} -->
</head>

<body>
    <main class="center-row">
        <div class="card-wrapper">

            <div class="auth-card">
                <!-- Back button sol üst köşede -->
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
                <div class="text-center mb-3 logo" style="margin-top:32px;">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('site_settings/site_logo/' . $site_setting->logo_url) }}" alt="Site logo" />
                    </a>
                </div>

                <div class="text-center mb-3">
                    <h5 class="mb-0">Create an Account</h5>
                    <p class="subtitle mb-0">Enter your personal details to create account</p>
                </div>

                <!-- Server-side errors/messages -->
                <div style="color: red">{{ session('error') }}</div>

                <form id="registerForm" action="{{ route('register') }}" method="post" novalidate>
                    {{ csrf_field() }}

                    <div class="mb-3">
                        <label for="yourName" class="form-label">Your Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            id="yourName" required>
                        {{-- server validation --}}
                        @if ($errors->has('name'))
                            <div class="invalid-feedback-custom">{{ $errors->first('name') }}</div>
                        @endif
                        <div class="invalid-feedback-custom" id="nameError">Please enter your name.</div>
                    </div>

                    <div class="mb-3">
                        <label for="yourEmail" class="form-label">Your Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            id="yourEmail" required>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback-custom">{{ $errors->first('email') }}</div>
                        @endif
                        <div class="invalid-feedback-custom" id="emailError">Please enter a valid email.</div>
                    </div>

                    <div class="mb-3">
                        <label for="yourPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                            <button type="button" id="togglePass" class="btn btn-light"
                                aria-label="Show password">Show</button>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback-custom">{{ $errors->first('password') }}</div>
                        @endif
                        <div class="invalid-feedback-custom" id="passError">Password must be at least 6 characters.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" required>
                        <div class="invalid-feedback-custom" id="confirmError">Passwords do not match.</div>
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" name="terms" type="checkbox" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the
                            <a href="{{ route('terms-conditions') }}">terms and conditions</a></label>
                        <div class="invalid-feedback-custom" id="termsError">You must agree before submitting.</div>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>

                    <div class="mb-2">
                        <a href="{{ route('auth_google_redirect') }}" class="btn-social d-flex align-items-center"
                            data-provider="google">
                            <span class="provider">G</span>
                            <span>Continue with Google</span>
                        </a>
                    </div>

                    <div class="mb-3">
                        <a href="{{ route('auth_github_redirect') }}" class="btn-social d-flex align-items-center"
                            data-provider="github">
                            <span class="provider">GH</span>
                            <span>Continue with Github</span>
                        </a>
                    </div>

                    <p class="text-center small mb-0">Already have an account? <a href="{{ url('login') }}">Log
                            in</a>
                    </p>
                </form>
            </div>
        </div>
    </main>


    <script>
        (function() {
            const form = document.getElementById('registerForm');
            const nameEl = document.getElementById('yourName');
            const emailEl = document.getElementById('yourEmail');
            const passEl = document.getElementById('yourPassword');
            const confirmEl = document.getElementById('password_confirmation');
            const termsEl = document.getElementById('acceptTerms');
            const toggleBtn = document.getElementById('togglePass');
            const MIN_PASS = 6;

            function validEmail(v) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
            }

            toggleBtn.addEventListener('click', function() {
                const t = passEl.type === 'password' ? 'text' : 'password';
                passEl.type = t;
                confirmEl.type = t;
                this.textContent = t === 'password' ? 'Show' : 'Hide';
            });

            form.addEventListener('submit', function(e) {
                let valid = true;

                // name
                if (nameEl.value.trim() === '') {
                    nameEl.classList.add('is-invalid');
                    document.getElementById('nameError').style.display = 'block';
                    valid = false;
                } else {
                    nameEl.classList.remove('is-invalid');
                    document.getElementById('nameError').style.display = 'none';
                }

                // email
                if (!validEmail(emailEl.value.trim())) {
                    emailEl.classList.add('is-invalid');
                    document.getElementById('emailError').style.display = 'block';
                    valid = false;
                } else {
                    emailEl.classList.remove('is-invalid');
                    document.getElementById('emailError').style.display = 'none';
                }

                // password length
                if (passEl.value.trim().length < MIN_PASS) {
                    passEl.classList.add('is-invalid');
                    document.getElementById('passError').style.display = 'block';
                    valid = false;
                } else {
                    passEl.classList.remove('is-invalid');
                    document.getElementById('passError').style.display = 'none';
                }

                // confirm match
                if (passEl.value !== confirmEl.value) {
                    confirmEl.classList.add('is-invalid');
                    document.getElementById('confirmError').style.display = 'block';
                    valid = false;
                } else {
                    confirmEl.classList.remove('is-invalid');
                    document.getElementById('confirmError').style.display = 'none';
                }

                // terms checkbox
                if (!termsEl.checked) {
                    document.getElementById('termsError').style.display = 'block';
                    valid = false;
                } else {
                    document.getElementById('termsError').style.display = 'none';
                }

                if (!valid) {
                    e.preventDefault();
                    const firstInvalid = form.querySelector('.is-invalid') || nameEl;
                    if (firstInvalid) firstInvalid.focus();
                } else {
                    // submit allowed — backend will handle server-side validation
                    // if you prefer AJAX, replace default submit with fetch/post here.
                }
            });

            // clear invalid on input
            [nameEl, emailEl, passEl, confirmEl].forEach(el => el.addEventListener('input', () => {
                el.classList.remove('is-invalid');
                const idMap = {
                    yourName: 'nameError',
                    yourEmail: 'emailError',
                    yourPassword: 'passError',
                    password_confirmation: 'confirmError'
                };
                if (idMap[el.id]) document.getElementById(idMap[el.id]).style.display = 'none';
            }));

        })();
    </script>
</body>

</html>
