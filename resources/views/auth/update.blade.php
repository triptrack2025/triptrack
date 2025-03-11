@include('website.header')


<section id="quote" class="bg-gray padding-small">
    <div class="container text-center">
        <h3 class="display-5 text-center">Bag Details.</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 text-start">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       

        <form class="contact-form row mt-5" method="POST" action="{{ route('update_tag.operation') }}">
            @csrf

            <input type="hidden" name="tag_id" value="{{ $userTag->tag_id }}">
            <input type="hidden" name="tag_image_file_name" id="tag_image_file_name" value="{{ $userTag->tag_image }}">

            <div class="editPetDetails-user-img">
            <img id="valuableImage" name="tag_image" alt="valuable image" 
            src="{{ url('/assets/images/'.$userTag->tag_image) }}" 
            class="editPetDetails-image"
            style="width: {{ $userTag->tag_type == 'laptop_bag' ? '18%' : '256px' }};">


                <div class="editPetDetails-user-qr mt-1 d-flex align-items-center justify-content-center" style="gap: 6px;">
                    <img alt="qr" src="https://storage.googleapis.com/pettag/qr/assets/qrcode.png" style="width: 30px; height: 30px;">
                    <p class="mt-3"><b>TBFSRFV</b></p>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <select class="w-100 border-0 ps-3 py-2 rounded-2" name="valuable_type" id="valuableTypeSelect">
                    <option value="">Select Valuable Type</option>
                    <option value="laptop_bag" {{ $userTag->valuable_type == 'laptop_bag' ? 'selected' : '' }}>Laptop Bag</option>
                    <option value="briefcase" {{ $userTag->valuable_type == 'briefcase' ? 'selected' : '' }}>Briefcase</option>
                    <option value="camera_bag" {{ $userTag->valuable_type == 'camera_bag' ? 'selected' : '' }}>Camera Bag</option>
                    <option value="gym_bag" {{ $userTag->valuable_type == 'gym_bag' ? 'selected' : '' }}>Gym Bag</option>
                    <option value="trolley_bag" {{ $userTag->valuable_type == 'trolley_bag' ? 'selected' : '' }}>Trolley Bag</option>
                    <option value="suitcase" {{ $userTag->valuable_type == 'suitcase' ? 'selected' : '' }}>Suitcase</option>
                    <option value="ladies_purse" {{ $userTag->valuable_type == 'ladies_purse' ? 'selected' : '' }}>Ladies Purse</option>
                    <option value="sports_kit_bag" {{ $userTag->valuable_type == 'sports_kit_bag' ? 'selected' : '' }}>Sports Kit Bag</option>
                    <option value="duffel_bag" {{ $userTag->valuable_type == 'duffel_bag' ? 'selected' : '' }}>Duffel Bag</option>
                    <option value="other_bags" {{ $userTag->valuable_type == 'other_bags' ? 'selected' : '' }}>Other Bags</option>
                    <option value="school_bag" {{ $userTag->valuable_type == 'school_bag' ? 'selected' : '' }}>School Bag</option>
                    <option value="luggage" {{ $userTag->valuable_type == 'luggage' ? 'selected' : '' }}>Luggage</option>
                </select>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <input type="text" name="display_name" placeholder="Display Name*" 
                    class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ $userTag->display_name }}">
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                <input type="text" name="bag_brand" placeholder="Bag Brand*" 
                    class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ $userTag->bag_brand }}">
            </div>

            <div class="col-sm-12 my-1">
                <div class="input-group" style="flex-wrap:unset;">
                    <div class="input-group-prepend">
                        <select name="country_code" class="w-100 border-0 ps-3 py-2 rounded-2" style="margin-bottom: 0px;height: 48px;">
                            <option value="+91" @selected($userTag->user->country_code == '+91' )>🇮🇳 +91 (India)</option>
                            <option value="+93" @selected($userTag->user->country_code == '+93' )>🇦🇫 +93 (Afghanistan)</option>
                            <option value="+355" @selected($userTag->user->country_code == '+355')>🇦🇱 +355 (Albania)</option>
                            <option value="+213" @selected($userTag->user->country_code == '+213')>🇩🇿 +213 (Algeria)</option>
                            <option value="+376" @selected($userTag->user->country_code == '+376')>🇦🇩 +376 (Andorra)</option>
                            <option value="+244" @selected($userTag->user->country_code == '+244')>🇦🇴 +244 (Angola)</option>
                            <option value="+54" @selected($userTag->user->country_code == '+54' )>🇦🇷 +54 (Argentina)</option>
                            <option value="+374" @selected($userTag->user->country_code == '+374')>🇦🇲 +374 (Armenia)</option>
                            <option value="+61" @selected($userTag->user->country_code == '+61' )>🇦🇺 +61 (Australia)</option>
                            <option value="+43" @selected($userTag->user->country_code == '+43' )>🇦🇹 +43 (Austria)</option>
                            <option value="+994" @selected($userTag->user->country_code == '+994')>🇦🇿 +994 (Azerbaijan)</option>
                            <option value="+973" @selected($userTag->user->country_code == '+973')>🇧🇭 +973 (Bahrain)</option>
                            <option value="+880" @selected($userTag->user->country_code == '+880')>🇧🇩 +880 (Bangladesh)</option>
                            <option value="+375" @selected($userTag->user->country_code == '+375')>🇧🇾 +375 (Belarus)</option>
                            <option value="+32" @selected($userTag->user->country_code == '+32' )>🇧🇪 +32 (Belgium)</option>
                            <option value="+501" @selected($userTag->user->country_code == '+501')>🇧🇿 +501 (Belize)</option>
                            <option value="+229" @selected($userTag->user->country_code == '+229')>🇧🇯 +229 (Benin)</option>
                            <option value="+591" @selected($userTag->user->country_code == '+591')>🇧🇴 +591 (Bolivia)</option>
                            <option value="+387" @selected($userTag->user->country_code == '+387')>🇧🇦 +387 (Bosnia & Herzegovina)</option>
                            <option value="+55" @selected($userTag->user->country_code == '+55' )>🇧🇷 +55 (Brazil)</option>
                            <option value="+359" @selected($userTag->user->country_code == '+359')>🇧🇬 +359 (Bulgaria)</option>
                            <option value="+855" @selected($userTag->user->country_code == '+855')>🇰🇭 +855 (Cambodia)</option>
                            <option value="+237" @selected($userTag->user->country_code == '+237')>🇨🇲 +237 (Cameroon)</option>
                            <option value="+1" @selected($userTag->user->country_code == '+1')>🇨🇦 +1 (Canada)</option>
                            <option value="+56" @selected($userTag->user->country_code == '+56' )>🇨🇱 +56 (Chile)</option>
                            <option value="+86" @selected($userTag->user->country_code == '+86' )>🇨🇳 +86 (China)</option>
                            <option value="+57" @selected($userTag->user->country_code == '+57' )>🇨🇴 +57 (Colombia)</option>
                            <option value="+506" @selected($userTag->user->country_code == '+506')>🇨🇷 +506 (Costa Rica)</option>
                            <option value="+385" @selected($userTag->user->country_code == '+385')>🇭🇷 +385 (Croatia)</option>
                            <option value="+53" @selected($userTag->user->country_code == '+53' )>🇨🇺 +53 (Cuba)</option>
                            <option value="+357" @selected($userTag->user->country_code == '+357')>🇨🇾 +357 (Cyprus)</option>
                            <option value="+420" @selected($userTag->user->country_code == '+420')>🇨🇿 +420 (Czech Republic)</option>
                            <option value="+45" @selected($userTag->user->country_code == '+45' )>🇩🇰 +45 (Denmark)</option>
                            <option value="+20" @selected($userTag->user->country_code == '+20' )>🇪🇬 +20 (Egypt)</option>
                            <option value="+358" @selected($userTag->user->country_code == '+358')>🇫🇮 +358 (Finland)</option>
                            <option value="+33" @selected($userTag->user->country_code == '+33' )>🇫🇷 +33 (France)</option>
                            <option value="+49" @selected($userTag->user->country_code == '+49' )>🇩🇪 +49 (Germany)</option>
                            <option value="+233" @selected($userTag->user->country_code == '+233')>🇬🇭 +233 (Ghana)</option>
                            <option value="+30" @selected($userTag->user->country_code == '+30' )>🇬🇷 +30 (Greece)</option>
                            <option value="+502" @selected($userTag->user->country_code == '+502')>🇬🇹 +502 (Guatemala)</option>
                            <option value="+852" @selected($userTag->user->country_code == '+852')>🇭🇰 +852 (Hong Kong)</option>
                            <option value="+36" @selected($userTag->user->country_code == '+36' )>🇭🇺 +36 (Hungary)</option>
                            <option value="+354" @selected($userTag->user->country_code == '+354')>🇮🇸 +354 (Iceland)</option>
                            <option value="+62" @selected($userTag->user->country_code == '+62' )>🇮🇩 +62 (Indonesia)</option>
                            <option value="+98" @selected($userTag->user->country_code == '+98' )>🇮🇷 +98 (Iran)</option>
                            <option value="+964" @selected($userTag->user->country_code == '+964')>🇮🇶 +964 (Iraq)</option>
                            <option value="+353" @selected($userTag->user->country_code == '+353')>🇮🇪 +353 (Ireland)</option>
                            <option value="+972" @selected($userTag->user->country_code == '+972')>🇮🇱 +972 (Israel)</option>
                            <option value="+39" @selected($userTag->user->country_code == '+39' )>🇮🇹 +39 (Italy)</option>
                            <option value="+1" @selected($userTag->user->country_code == '+1')>🇯🇲 +1 (Jamaica)</option>
                            <option value="+81" @selected($userTag->user->country_code == '+81' )>🇯🇵 +81 (Japan)</option>
                            <option value="+962" @selected($userTag->user->country_code == '+962')>🇯🇴 +962 (Jordan)</option>
                            <option value="+7" @selected($userTag->user->country_code == '+7')>🇰🇿 +7 (Kazakhstan)</option>
                            <option value="+254" @selected($userTag->user->country_code == '+254')>🇰🇪 +254 (Kenya)</option>
                            <option value="+82" @selected($userTag->user->country_code == '+82' )>🇰🇷 +82 (South Korea)</option>
                            <option value="+965" @selected($userTag->user->country_code == '+965')>🇰🇼 +965 (Kuwait)</option>
                            <option value="+961" @selected($userTag->user->country_code == '+961')>🇱🇧 +961 (Lebanon)</option>
                            <option value="+60" @selected($userTag->user->country_code == '+60' )>🇲🇾 +60 (Malaysia)</option>
                            <option value="+52" @selected($userTag->user->country_code == '+52' )>🇲🇽 +52 (Mexico)</option>
                            <option value="+212" @selected($userTag->user->country_code == '+212')>🇲🇦 +212 (Morocco)</option>
                            <option value="+31" @selected($userTag->user->country_code == '+31' )>🇳🇱 +31 (Netherlands)</option>
                            <option value="+64" @selected($userTag->user->country_code == '+64' )>🇳🇿 +64 (New Zealand)</option>
                            <option value="+234" @selected($userTag->user->country_code == '+234')>🇳🇬 +234 (Nigeria)</option>
                            <option value="+47" @selected($userTag->user->country_code == '+47' )>🇳🇴 +47 (Norway)</option>
                            <option value="+92" @selected($userTag->user->country_code == '+92' )>🇵🇰 +92 (Pakistan)</option>
                            <option value="+63" @selected($userTag->user->country_code == '+63' )>🇵🇭 +63 (Philippines)</option>
                            <option value="+48" @selected($userTag->user->country_code == '+48' )>🇵🇱 +48 (Poland)</option>
                            <option value="+351" @selected($userTag->user->country_code == '+351')>🇵🇹 +351 (Portugal)</option>
                            <option value="+974" @selected($userTag->user->country_code == '+974')>🇶🇦 +974 (Qatar)</option>
                            <option value="+40" @selected($userTag->user->country_code == '+40' )>🇷🇴 +40 (Romania)</option>
                            <option value="+7" @selected($userTag->user->country_code == '+7')>🇷🇺 +7 (Russia)</option>
                            <option value="+966" @selected($userTag->user->country_code == '+966')>🇸🇦 +966 (Saudi Arabia)</option>
                            <option value="+65" @selected($userTag->user->country_code == '+65' )>🇸🇬 +65 (Singapore)</option>
                            <option value="+27" @selected($userTag->user->country_code == '+27' )>🇿🇦 +27 (South Africa)</option>
                            <option value="+34" @selected($userTag->user->country_code == '+34' )>🇪🇸 +34 (Spain)</option>
                            <option value="+94" @selected($userTag->user->country_code == '+94' )>🇱🇰 +94 (Sri Lanka)</option>
                            <option value="+46" @selected($userTag->user->country_code == '+46' )>🇸🇪 +46 (Sweden)</option>
                            <option value="+41" @selected($userTag->user->country_code == '+41' )>🇨🇭 +41 (Switzerland)</option>
                            <option value="+66" @selected($userTag->user->country_code == '+66' )>🇹🇭 +66 (Thailand)</option>
                            <option value="+90" @selected($userTag->user->country_code == '+90' )>🇹🇷 +90 (Turkey)</option>
                            <option value="+380" @selected($userTag->user->country_code == '+380')>🇺🇦 +380 (Ukraine)</option>
                            <option value="+971" @selected($userTag->user->country_code == '+971')>🇦🇪 +971 (United Arab Emirates)</option>
                            <option value="+44" @selected($userTag->user->country_code == '+44' )>🇬🇧 +44 (United Kingdom)</option>
                            <option value="+1" @selected($userTag->user->country_code == '+1')>🇺🇸 +1 (United States)</option>
                            <option value="+84" @selected($userTag->user->country_code == '+84' )>🇻🇳 +84 (Vietnam)</option>
                            <option value="+263" @selected($userTag->user->country_code == '+263')>🇿🇼 +263 (Zimbabwe)</option>
                        </select>
                    </div>
                    <input type="number" class="w-100 border-0 ps-3 py-2 rounded-2" name="mobile" placeholder="Mobile*" value="{{ $userTag->user->mobile }}" >
                </div>
            </div>
          
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</section>

@include('website.footer')

<script>
    document.getElementById("valuableTypeSelect").addEventListener("change", function() {
        const BASE_URL = "{{ url('/assets/images/') }}/";
        const imageMap = {
            laptop_bag: `laptopbag.png`,
            briefcase: `briefcase.png`,
            camera_bag: `camerabag.png`,
            gym_bag: `GymBag.png`,
            trolley_bag: `trolley-bag.png`,
            suitcase: `suitcase.png`,
            ladies_purse: `ladiespurse.png`,
            sports_kit_bag: `sport-bag.png`,
            duffel_bag: `duffelbag.png`,
            other_bags: `other.png`,
            school_bag: `schoolbag.png`,
            luggage: `luggage.png`
        };

        const selectedValue = this.value;
        const imageElement = document.getElementById("valuableImage");
        if (imageMap[selectedValue]) {
            imageElement.src = BASE_URL + imageMap[selectedValue];
            imageElement.style.width = selectedValue === 'laptop_bag' ? "18%" : "256px";
            document.getElementById("tag_image_file_name").value = imageMap[selectedValue];
        } else {
            imageElement.src = "https://storage.googleapis.com/pettag/qr/assets/luggage.png";
        }
    });
</script>
