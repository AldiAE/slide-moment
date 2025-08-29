<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Slide Moment CMS</title>
    <link rel="icon" type="image/png" href="#">

    <!-- Metronic Global Styles -->
    <link href="{{ asset('assets/metronic-8/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic-8/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    {!! RecaptchaV3::initJs() !!}
</head>
<body id="kt_body" class="app-blank bg-body">

    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">

            <!-- Left Section -->
        <div class="d-flex flex-column flex-lg-row-fluid w-100 w-lg-50 bgi-size-cover bgi-position-center p-10"
            style="background-image: url('{{ asset("assets/metronic-8/media/auth/bg10-dark.jpeg") }}'); min-height: 250px;">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid text-center text-lg-start">
                <div>
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-40px mb-3 mx-auto" />
                    <h1 class="fw-bold text-white fs-3 mb-2">Welcome to CMS!</h1>
                    <p class="fw-semibold fs-7 text-white opacity-75">SlideMoment CMS | Technopartner Indonesia</p>
                </div>
            </div>
        </div>

            <!-- Right Section -->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px bg-white rounded shadow-sm p-10">

                        <form class="form w-100" method="POST" action="{{ route('auth.login') }}">
                            @csrf

                            <!-- Title -->
                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-3">Sign In</h1>
                                <div class="text-gray-400 fw-semibold fs-4">Enter your email and password</div>
                            </div>

                            <!-- Error -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <!-- Email -->
                            <div class="fv-row mb-5">
                                <input type="email" name="email" placeholder="Email" autocomplete="off"
                                    class="form-control bg-transparent" required />
                            </div>

                            <!-- Password -->
                            <div class="fv-row mb-5">
                                <input type="password" name="password" placeholder="Password" autocomplete="off"
                                    class="form-control bg-transparent" required />
                            </div>

                            {{-- Recaptcha V3 --}}
                            {!! RecaptchaV3::field('login') !!}

                            <!-- Submit -->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Sign In</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Metronic Scripts -->
    <script src="{{ asset('assets/metronic-8/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/metronic-8/js/scripts.bundle.js') }}"></script>
    <script>
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', () => {
                setTimeout(() => {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            });
        });
    </script>
</body>
</html>
