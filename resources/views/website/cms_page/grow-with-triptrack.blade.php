@include('website.header')

<section id="quote" class="bg-gray padding-small">
    <div class="container text-center">
        <h3 class="display-5 text-center">Join With Us.</h3>
        <p>You will get a 15% commission on total referral sales when a customer makes a purchase through your affiliate link or uses your coupon code.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0" style="text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="contact-form row mt-5" method="POST" action="{{ route('/grow-with-triptrack-register.operation') }}">
            @csrf

             <div class="col-md-12 col-sm-12 mb-4">
                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name*" class="w-100 border-0 ps-3 py-2 rounded-2">
            </div>
             <div class="col-md-12 col-sm-12 mb-4">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email*" class="w-100 border-0 ps-3 py-2 rounded-2">
            </div>
             <div class="col-md-12 col-sm-12 mb-4">
                <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile*" class="w-100 border-0 ps-3 py-2 rounded-2">
            </div>
            <div class="col-md-12 col-sm-12 mb-4">
                <input type="password" name="password" placeholder="Password*" class="w-100 border-0 ps-3 py-2 rounded-2">
            </div>
        
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Join With Us</button><br>
            </div>
        </form>
    </div>
</section>

@include('website.footer')
