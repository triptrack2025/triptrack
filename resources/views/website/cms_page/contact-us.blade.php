@include('website.header')
<style>
    .cms-page-section{
        padding-top:5% !important;
    }
    #quotation{
        background:#EDEBE4 !important;
    }
    .content{
        text-align: left;
        padding-left: 15%;
        padding-right: 15%;
        /* display: flex; */
    }
    p{
        
        font-style:oblique;
    }
   
</style>

<section class="align-center pb-5 mb-5 cms-page-section" id="quotation">
    <div class="inner-content">
        <h2 class="section-title divider">Contact Us</h2>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6 content">
                        <div class="editPetDetails-user-img">
                            <img id="contactUsImage" name="contact_us_image" alt="contact-us image" src="{{ url('/assets/images/contact-us.webp') }}" class="editPetDetails-image" width="300" height="100">
                        </div>
                    <p>We value your feedback and inquiries. Reach out to us anytime, and our team will respond as soon as possible.</p>
                </div>
                <div class="col-md-6">
                    <form class="contact-form row mt-5" method="POST" action="{{ route('contact-us.operation') }}">
                        @csrf

                        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name*" class="w-100 border-0 ps-3 py-2 rounded-2" required>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                            <input type="number" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile*" class="w-100 border-0 ps-3 py-2 rounded-2" required>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email*" class="w-100 border-0 ps-3 py-2 rounded-2" required>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-4">
                            <textarea name="message" class="w-100 border-0 ps-3 py-2 rounded-2" placeholder="Enter your message..." required>{{ old('message') }}</textarea>
                        </div>
                    
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Send Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include('website.footer')
