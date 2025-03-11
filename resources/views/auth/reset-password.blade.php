@include('website.header')

<section id="quote" class="bg-gray padding-small">
    <div class="container text-center">
        <h3 class="display-5 text-center">Reset Your Password</h3>
        <p>Enter your new password below.</p>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form class="contact-form row mt-5" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="col-md-12 col-sm-12 mb-4 text-start">
                <input type="email" name="email" placeholder="Email*" class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ old('email') }}" required>
                @error('email')
                    <span class="text-danger d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 col-sm-12 mb-4 text-start">
                <input type="password" name="password" placeholder="New Password*" class="w-100 border-0 ps-3 py-2 rounded-2" required>
                @error('password')
                    <span class="text-danger d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-12 col-sm-12 mb-4 text-start">
                <input type="password" name="password_confirmation" placeholder="Confirm Password*" class="w-100 border-0 ps-3 py-2 rounded-2" required>
                @error('password_confirmation')
                    <span class="text-danger d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-12 mt-0">
                <button class="btn btn-primary w-100" type="submit">Reset Password</button>
            </div>

            <div class="col-12 text-center mt-3">
                <p>Back to <a href="{{ route('login') }}" class="text-primary">Login</a></p>
            </div>
        </form>
    </div>
</section>

@include('website.footer')
