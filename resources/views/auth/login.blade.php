@include('website.header')

<section id="quote" class="bg-gray padding-small">
    <div class="container text-center">
        <h3 class="display-5 text-center">Login to Your Account</h3>
        <p>Welcome back! Please enter your credentials to continue.</p>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form class="contact-form row mt-5" method="POST" action="{{ route('login.operation') }}">
            @csrf

            <div class="col-md-12 col-sm-12 mb-4 text-start">
                <input type="email" name="email" placeholder="Email*" class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 col-sm-12 mb-0 text-start">
                <input type="password" name="password" placeholder="Password*" class="w-100 border-0 ps-3 py-2 rounded-2" required>
                @error('password')
                    <span class="text-danger d-block">{{ $message }}</span>
                @enderror
            </div>

            <!-- <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
            </div> -->

            <div class="col-12 text-right">
                <a href="{{ route('password.request') }}" class="text-primary">Forgot Password?</a>
            </div>

            <div class="col-12 mt-0">
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </div>

            <div class="col-12 text-center mt-3">
                <p>Don't have an account? <a href="{{ route('register.view') }}" class="text-primary">Sign Up</a></p>
            </div>
        </form>
    </div>
</section>

@include('website.footer')
