    @include('website.header')

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

            <form class="contact-form row mt-5" method="POST" action="{{ route('register.operation') }}">
                @csrf
                
                <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                    <input type="text" name="first_name" placeholder="First Name*" 
                        class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ old('first_name') }}">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                    <input type="text" name="last_name" placeholder="Last Name*" 
                        class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ old('last_name') }}">
                </div>

                <div class="col-sm-6 my-1">
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
                        <input type="number" class="w-100 border-0 ps-3 py-2 rounded-2" name="mobile" placeholder="Mobile*"  value="{{ old('mobile') }}" >
                    </div>
                </div>
              
                <div class="col-lg-6 col-md-6 col-sm-6 mb-4">
                    <input type="email" name="email" placeholder="Email*" 
                        class="w-100 border-0 ps-3 py-2 rounded-2" value="{{ old('email') }}">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                    <input type="password" name="password" placeholder="Password*" 
                        class="w-100 border-0 ps-3 py-2 rounded-2">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </section>

    @include('website.footer')
    