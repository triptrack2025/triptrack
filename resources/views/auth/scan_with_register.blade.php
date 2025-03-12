@include('website.header')

<style>
    .editPetDetails-user-qr {
        padding-bottom;: 10px;
    }
    .editImage {
        margin-top: 0px !important;
    }
</style>

<section id="quote" class="bg-gray padding-small">
    <div class="container text-center">
        <h3 class="display-5 text-center">Create New Account.</h3>
        <p>Thank you for choosing to secure your valuable with us! You are just a few clicks away from securing your valuable</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 text-start">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="contact-form row mt-5" method="POST" action="{{ route('scan_with_register.operation') }}">
            @csrf

            <input type="hidden" name="tag_id" value="{{$tag_id}}">
            <input type="hidden" name="tag_image_file_name" id="tag_image_file_name" value="luggage.png">

            <div class="editPetDetails-user-img text-center pb-4">
                <img id="valuableImage" name="tag_image" alt="valuable image" 
                    src="{{ url('/assets/images/luggage.png') }}" class="editPetDetails-image img-fluid">

                <div class="editPetDetails-user-qr mt-1 d-flex align-items-center justify-content-center" style="gap: 6px;">
                    <img alt="qr" src="https://storage.googleapis.com/pettag/qr/assets/qrcode.png" style="width: 30px; height: 30px;">
                    <p class="mt-0 pb-0 mb-0"><b>{{$tag_id}}</b></p>

                    <!-- Hidden File Input -->
                    <input type="file" id="imageUpload" name="imageUpload" style="display: none;" accept="image/*" onchange="previewImage(event)">

                    <!-- Edit Icon that Triggers File Input -->
                    <a class="btn btn-sm btn-primary editImage" onclick="document.getElementById('imageUpload').click();">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
            </div>


            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <select class="w-100 border-0 ps-3 py-2 rounded-2" name="valuable_type" id="valuableTypeSelect" required>
                    <option value="">Select Valuable Type</option>
                    <option value="laptop_bag">Laptop Bag</option>
                    <option value="briefcase">Briefcase</option>
                    <option value="camera_bag">Camera Bag</option>
                    <option value="gym_bag">Gym Bag</option>
                    <option value="trolley_bag">Trolley Bag</option>
                    <option value="suitcase">Suitcase</option>
                    <option value="ladies_purse">Ladies Purse</option>
                    <option value="sports_kit_bag">Sports Kit Bag</option>
                    <option value="duffel_bag">Duffel Bag</option>
                    <option value="other_bags">Other Bags</option>
                    <option value="school_bag">School Bag</option>
                    <option value="luggage">Luggage</option>
                </select>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <input type="text" name="display_name" placeholder="Display Name*" 
                    class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ old('display_name') }}" required>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <input type="text" name="bag_brand" placeholder="Bag Brand*" 
                    class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ old('bag_brand') }}"  required>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <input type="email" name="email" placeholder="Email*" class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ old('email') }}" required>
            </div>
            <div class="col-sm-12 my-1">
                <div class="input-group" style="flex-wrap:unset;">
                    <div class="input-group-prepend">
                        <select name="country_code" class="w-100 border-0 ps-3 py-2 rounded-2" style="margin-bottom: 0px;height: 48px;">
                            <option value="+91">🇮🇳 +91 (India)</option>
                            <option value="+93">🇦🇫 +93 (Afghanistan)</option>
                            <option value="+355">🇦🇱 +355 (Albania)</option>
                            <option value="+213">🇩🇿 +213 (Algeria)</option>
                            <option value="+376">🇦🇩 +376 (Andorra)</option>
                            <option value="+244">🇦🇴 +244 (Angola)</option>
                            <option value="+54">🇦🇷 +54 (Argentina)</option>
                            <option value="+374">🇦🇲 +374 (Armenia)</option>
                            <option value="+61">🇦🇺 +61 (Australia)</option>
                            <option value="+43">🇦🇹 +43 (Austria)</option>
                            <option value="+994">🇦🇿 +994 (Azerbaijan)</option>
                            <option value="+973">🇧🇭 +973 (Bahrain)</option>
                            <option value="+880">🇧🇩 +880 (Bangladesh)</option>
                            <option value="+375">🇧🇾 +375 (Belarus)</option>
                            <option value="+32">🇧🇪 +32 (Belgium)</option>
                            <option value="+501">🇧🇿 +501 (Belize)</option>
                            <option value="+229">🇧🇯 +229 (Benin)</option>
                            <option value="+591">🇧🇴 +591 (Bolivia)</option>
                            <option value="+387">🇧🇦 +387 (Bosnia & Herzegovina)</option>
                            <option value="+55">🇧🇷 +55 (Brazil)</option>
                            <option value="+359">🇧🇬 +359 (Bulgaria)</option>
                            <option value="+855">🇰🇭 +855 (Cambodia)</option>
                            <option value="+237">🇨🇲 +237 (Cameroon)</option>
                            <option value="+1">🇨🇦 +1 (Canada)</option>
                            <option value="+56">🇨🇱 +56 (Chile)</option>
                            <option value="+86">🇨🇳 +86 (China)</option>
                            <option value="+57">🇨🇴 +57 (Colombia)</option>
                            <option value="+506">🇨🇷 +506 (Costa Rica)</option>
                            <option value="+385">🇭🇷 +385 (Croatia)</option>
                            <option value="+53">🇨🇺 +53 (Cuba)</option>
                            <option value="+357">🇨🇾 +357 (Cyprus)</option>
                            <option value="+420">🇨🇿 +420 (Czech Republic)</option>
                            <option value="+45">🇩🇰 +45 (Denmark)</option>
                            <option value="+20">🇪🇬 +20 (Egypt)</option>
                            <option value="+358">🇫🇮 +358 (Finland)</option>
                            <option value="+33">🇫🇷 +33 (France)</option>
                            <option value="+49">🇩🇪 +49 (Germany)</option>
                            <option value="+233">🇬🇭 +233 (Ghana)</option>
                            <option value="+30">🇬🇷 +30 (Greece)</option>
                            <option value="+502">🇬🇹 +502 (Guatemala)</option>
                            <option value="+852">🇭🇰 +852 (Hong Kong)</option>
                            <option value="+36">🇭🇺 +36 (Hungary)</option>
                            <option value="+354">🇮🇸 +354 (Iceland)</option>
                            <option value="+62">🇮🇩 +62 (Indonesia)</option>
                            <option value="+98">🇮🇷 +98 (Iran)</option>
                            <option value="+964">🇮🇶 +964 (Iraq)</option>
                            <option value="+353">🇮🇪 +353 (Ireland)</option>
                            <option value="+972">🇮🇱 +972 (Israel)</option>
                            <option value="+39">🇮🇹 +39 (Italy)</option>
                            <option value="+1">🇯🇲 +1 (Jamaica)</option>
                            <option value="+81">🇯🇵 +81 (Japan)</option>
                            <option value="+962">🇯🇴 +962 (Jordan)</option>
                            <option value="+7">🇰🇿 +7 (Kazakhstan)</option>
                            <option value="+254">🇰🇪 +254 (Kenya)</option>
                            <option value="+82">🇰🇷 +82 (South Korea)</option>
                            <option value="+965">🇰🇼 +965 (Kuwait)</option>
                            <option value="+961">🇱🇧 +961 (Lebanon)</option>
                            <option value="+60">🇲🇾 +60 (Malaysia)</option>
                            <option value="+52">🇲🇽 +52 (Mexico)</option>
                            <option value="+212">🇲🇦 +212 (Morocco)</option>
                            <option value="+31">🇳🇱 +31 (Netherlands)</option>
                            <option value="+64">🇳🇿 +64 (New Zealand)</option>
                            <option value="+234">🇳🇬 +234 (Nigeria)</option>
                            <option value="+47">🇳🇴 +47 (Norway)</option>
                            <option value="+92">🇵🇰 +92 (Pakistan)</option>
                            <option value="+63">🇵🇭 +63 (Philippines)</option>
                            <option value="+48">🇵🇱 +48 (Poland)</option>
                            <option value="+351">🇵🇹 +351 (Portugal)</option>
                            <option value="+974">🇶🇦 +974 (Qatar)</option>
                            <option value="+40">🇷🇴 +40 (Romania)</option>
                            <option value="+7">🇷🇺 +7 (Russia)</option>
                            <option value="+966">🇸🇦 +966 (Saudi Arabia)</option>
                            <option value="+65">🇸🇬 +65 (Singapore)</option>
                            <option value="+27">🇿🇦 +27 (South Africa)</option>
                            <option value="+34">🇪🇸 +34 (Spain)</option>
                            <option value="+94">🇱🇰 +94 (Sri Lanka)</option>
                            <option value="+46">🇸🇪 +46 (Sweden)</option>
                            <option value="+41">🇨🇭 +41 (Switzerland)</option>
                            <option value="+66">🇹🇭 +66 (Thailand)</option>
                            <option value="+90">🇹🇷 +90 (Turkey)</option>
                            <option value="+380">🇺🇦 +380 (Ukraine)</option>
                            <option value="+971">🇦🇪 +971 (United Arab Emirates)</option>
                            <option value="+44">🇬🇧 +44 (United Kingdom)</option>
                            <option value="+1">🇺🇸 +1 (United States)</option>
                            <option value="+84">🇻🇳 +84 (Vietnam)</option>
                            <option value="+263">🇿🇼 +263 (Zimbabwe)</option>
                        </select>
                    </div>
                    <input type="number" class="w-100 border-0 ps-3 py-2 rounded-2" name="mobile" placeholder="Mobile*"  value="{{ old('mobile') }}" required>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <input type="password" name="password" placeholder="Password*" class="w-100 border-0 ps-3 py-2 rounded-2">
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</section>

@include('website.footer')

<script>
    
$(document).ready(function () {
    $(".contact-form").on("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        let formData = new FormData(this);
        let url = $(this).attr("action");
        let submitBtn = $(".btn-primary");

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                submitBtn.text("Submitting...").attr("disabled", true);
            },
            success: function (response) {
                submitBtn.text("Submit").attr("disabled", false);
                $(".contact-form")[0].reset();

                if (response.redirect) {
                    window.location.href = response.redirect;
                } else {
                    Swal.fire({
                        icon: "success",
                        title: response.message || "Form submitted successfully!",
                        showConfirmButton: true
                    });
                }
            },
            error: function (xhr) {
                submitBtn.text("Submit").attr("disabled", false);

                let errorMessages = "Something went wrong. Please try again.";
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessages = Object.values(xhr.responseJSON.errors).flat().join("<br>");
                }

                Swal.fire({
                    icon: "error",
                    title: "Form Submission Failed",
                    html: errorMessages,
                    showConfirmButton: true
                });
            },
        });
    });
});

let isCustomImage = false; // Flag to track user-uploaded image

// Handle image preview from file input
function previewImage(event) {
    const imageElement = document.getElementById("valuableImage");
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imageElement.src = e.target.result;
            imageElement.style.width = "256px";
            isCustomImage = true; // Prevent override by selection
        };
        reader.readAsDataURL(file);
    }
}

// Handle valuable type selection change
document.getElementById("valuableTypeSelect").addEventListener("change", function () {
    if (isCustomImage) return; // Don't override user-uploaded image

    const BASE_URL = "{{ url('/assets/images/') }}/";
    const imageMap = {
        laptop_bag: "laptopbag.png",
        briefcase: "briefcase.png",
        camera_bag: "camerabag.png",
        gym_bag: "GymBag.png",
        trolley_bag: "trolley-bag.png",
        suitcase: "suitcase.png",
        ladies_purse: "ladiespurse.png",
        sports_kit_bag: "sport-bag.png",
        duffel_bag: "duffelbag.png",
        other_bags: "other.png",
        school_bag: "schoolbag.png",
        luggage: "luggage.png"
    };

    const selectedValue = this.value;
    const imageElement = document.getElementById("valuableImage");
    const tagImageFileName = document.getElementById("tag_image_file_name");

    if (imageMap[selectedValue]) {
        imageElement.src = BASE_URL + imageMap[selectedValue];
        imageElement.style.width = selectedValue === "laptop_bag" ? "18%" : "256px";
        tagImageFileName.value = imageMap[selectedValue];
    } else {
        imageElement.src = "https://storage.googleapis.com/pettag/qr/assets/luggage.png";
    }
});

</script>

