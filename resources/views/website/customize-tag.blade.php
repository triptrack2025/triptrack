@include('website.header')


<section>
    <div class="container mt-5">
        <div class="section-header align-center">
            <h2 class="section-title">Make Your Own Tag</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form id="customizationForm" method="post" action="{{ url('/generate-tag-pdf') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="accordion accordion-flush" id="accordionFlushExample">

                       
                        <!-- Front Page Settings -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Front Page Settings
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body"> 
                                    <div class="mb-3">
                                        <label for="select_default_or_custom_page" class="form-label">Select Default/Custom page</label>
                                        <select class="form-control" id="select_default_or_custom_page" name="select_default_or_custom_page">
                                            <option>Default</option>
                                            <option>Custom Background</option>
                                        </select>
                                    </div>
                                    <div class="front-backgrond-section-for-custom">
                                        <div class="mb-3">
                                            <label for="front_custom_bg_image" class="form-label">Select Background Image</label>
                                            <input type="file" class="form-control" id="front_custom_bg_image" name="front_custom_bg_image" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label for="front_custom_bg_image_width" class="form-label">Enter Background Image (width) Size (px)</label>
                                            <input type="number" class="form-control" id="front_custom_bg_image_width" name="front_custom_bg_image_width" min="1" value="300">
                                        </div>
                                        <div class="mb-3">
                                            <label for="front_custom_bg_image_height" class="form-label">Enter Background Image (height) Size (px)</label>
                                            <input type="number" class="form-control" id="front_custom_bg_image_height" name="front_custom_bg_image_height" min="1" value="550">
                                        </div>

                                    </div>
                                    <div class="front-backgrond-section-for-default">

                                        <div class="mb-3">
                                            <label for="front_bg_color" class="form-label">Background Color</label>
                                            <input type="color" class="form-control" id="front_bg_color" name="front_bg_color" value="#343434">
                                        </div>
                                    
                                        <div class="mb-3">
                                            <label for="front_logo" class="form-label">Logo</label>
                                            <input type="file" class="form-control" id="front_logo" name="front_logo" accept="image/*">
                                        </div>
                                        <div class="mb-3">
                                            <label for="front_company_name" class="form-label">Company Name</label>
                                            <input type="text" class="form-control" id="front_company_name" name="front_company_name" value="TripTrack" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="front_company_name_color" class="form-label">Company Name Color</label>
                                            <input type="color" class="form-control" id="front_company_name_color" name="front_company_name_color" value="#eec7af">
                                        </div>
                                        <div class="mb-3">
                                            <label for="front_company_name_size" class="form-label">Company Name Font Size (px)</label>
                                            <input type="number" class="form-control" id="front_company_name_size" name="front_company_name_size" min="10" max="50" value="24">
                                        </div>
                                        <div class="mb-3">
                                            <label for="front_slogan" class="form-label">Slogan</label>
                                            <input type="text" class="form-control" id="front_slogan" name="front_slogan" value="S C A N - T R A C K - E X P L O R E">
                                        </div>
                                        <div class="mb-3">
                                            <label for="front_slogan_color" class="form-label">Slogan Color</label>
                                            <input type="color" class="form-control" id="front_slogan_color" name="front_slogan_color" value="#eec7af">
                                        </div>
                                        <div class="mb-3">
                                            <label for="front_slogan_size" class="form-label">Slogan Font Size (px)</label>
                                            <input type="number" class="form-control" id="front_slogan_size" name="front_slogan_size" min="10" max="30" value="10">
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Back Page Settings -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Back Page Settings
                            </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label for="back_bg_color" class="form-label">Background Color</label>
                                        <input type="color" class="form-control" id="back_bg_color" name="back_bg_color" value="#f0e0d3">
                                    </div>
                                    <div class="mb-3">
                                        <label for="back_logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control" id="back_logo" name="back_logo" accept="image/*">
                                    </div>

                                    <div class="mb-3">
                                        <label for="back_company_name" class="form-label">Company Name</label>
                                        <input type="text" class="form-control back_company_name" id="back_company_name" name="back_company_name" value="TripTrack" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="back_company_name_color" class="form-label">Company Name Color</label>
                                        <input type="color" class="form-control" id="back_company_name_color" name="back_company_name_color" value="#383434">
                                    </div>
                                    <div class="mb-3">
                                        <label for="back_company_name_size" class="form-label">Company Name Font Size (px)</label>
                                        <input type="number" class="form-control" id="back_company_name_size" name="back_company_name_size" min="10" max="50" value="24">
                                    </div>
                                    <div class="mb-3">
                                        <label for="back_slogan" class="form-label">Slogan</label>
                                        <input type="text" class="form-control" id="back_slogan" name="back_slogan" value="S C A N - T R A C K - E X P L O R E">
                                    </div>
                                    <div class="mb-3">
                                        <label for="back_slogan_color" class="form-label">Slogan Color</label>
                                        <input type="color" class="form-control" id="back_slogan_color" name="back_slogan_color" value="#383434">
                                    </div>
                                    <div class="mb-3">
                                        <label for="back_slogan_size" class="form-label">Slogan Font Size (px)</label>
                                        <input type="number" class="form-control" id="back_slogan_size" name="back_slogan_size" min="10" max="30" value="10">
                                    </div>
                        
                                    <div class="mb-3">
                                        <label for="back_middle_content_color" class="form-label">Middle Content Color</label>
                                        <input type="color" class="form-control" id="back_middle_content_color" name="back_middle_content_color" value="#383434">
                                    </div>
                                

                                    <!-- <div class="mb-3">
                                        <label for="footer" class="form-label">Footer (Powered by, etc.)</label>
                                        <input type="text" class="form-control" id="footer" name="footer" value="Powered by TripTrack">
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary" id="updatePreview">Update Preview</button>

                    </div>
                    <button type="submit" class="btn btn-success">Download PDF</button>
                </form>
            </div>

            <div class="col-md-8 back-side" >
                <div class="row">
                    <!-- Front Side Preview -->
                    <div class="col-md-6">
                        <div class="preview-container text-center" id="previewFront" style="background-color: #343434; width: 300px; height: 550px;border-radius:60px;">
                            <div class="front-content front-backgrond-section-for-default">
                                <img src="/assets/images/triptrack-logo-front.png" id="previewFrontLogo" class="preview-logo-front">
                                <h3 id="previewFrontCompanyName" style="color: #eec7af; font-size: 24px; margin-top:5px;margin-bottom:1px;">TripTrack</h3>
                                <p id="previewFrontSlogan" style="color: #eec7af; font-size: 10px;">S C A N - T R A C K - E X P L O R E</p>
                            </div>
                        </div>
                    </div>

                    <!-- Back Side Preview -->
                    <div class="col-md-6">
                        <div class="preview-container text-center" id="previewBack" style="background-color: #f0e0d3; width: 300px; height: 300px;border-radius:60px;">
                            <div class="back-content back-backgrond-section-for-default">
                                <div class="logo-content" style="padding-top:20%;">
                                    <img src="/assets/images/triptrack-logo-back.png" id="previewBackLogo" class="preview-logo-back">
                                    <h3 id="previewBackCompanyName" style="color: #383434; font-size: 24px; margin-top:0px;margin-bottom:0px;">TripTrack</h3>
                                    <p id="previewBackSlogan" style="color: #383434; font-size: 10px; margin-bottom:1px;">S C A N - T R A C K - E X P L O R E</p>
                                </div>
                                <h1 id="previewMiddleContent" 
                                    style="color: #383434; 
                                        font-size: 200%;
                                        margin-top: 30px;
                                        margin-bottom: 20px;
                                        text-align: left;
                                        font-family: 'Old English Text MT', 'Garamond', serif;
                                        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);">
                                    FOUND ME?<br>SCAN QR<br>TO RETURN
                                </h1>

                                
                                <!-- <h1 id="previewMiddleContent" style="color: #383434; font-size: 200%;margin-top:30px;margin-bottom:20px;text-align:left;">FOUND ME?<br>SCAN QR<br>TO RETURN</h1> -->

                                <p id="previewQrCodepTag" style="margin-bottom:1px;"><img src="/assets/images/triptrack-sample-qr.png" id="previewQrCodeimg" class="previewQrCodeimg"  width="90" height="90"></p>
                                <b style="margin-bottom:25px;letter-spacing:2px;color:black;font-size:13px;">SELIYO2</b>
                                <!-- <p id="previewFooter">Powered by TripTrack</p> -->
                                <p id="previewFooter"></p>

                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
</section>

@include('website.footer')

<script>
    // by default hide this
    $('.front-backgrond-section-for-custom').hide();

    $('#select_default_or_custom_page').change(function(){
        if($('#select_default_or_custom_page').val() ==  'Custom Background'){
            $('.front-backgrond-section-for-default').hide();
            $('.front-backgrond-section-for-custom').show();

        }
        else{
            $('.front-backgrond-section-for-default').show();
            $('.front-backgrond-section-for-custom').hide();

        }
    });

    document.getElementById("updatePreview").addEventListener("click", function () {

        // Get Tag Size
        let tagHeightSize = 550;
        let tagWidthSize = 300;
        
        // Front Side Values
        if($('#select_default_or_custom_page').val() ==  'Custom Background'){

            let fileInput = document.getElementById("front_custom_bg_image");
            let file = fileInput.files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let previewDiv = document.getElementById("previewFront");
                    previewDiv.style.backgroundImage = `url(${e.target.result})`;
                let front_custom_bg_image_height = $('#front_custom_bg_image_height').val();
                let front_custom_bg_image_width = $('#front_custom_bg_image_width').val();
                previewDiv.style.backgroundSize = front_custom_bg_image_width + "px " + front_custom_bg_image_height + "px";
                previewDiv.style.backgroundRepeat = "no-repeat";
                    previewDiv.style.backgroundPosition = "center";
                };
                reader.readAsDataURL(file);
            } else {
                alert("Please select an image first!");
            }


            
        }else{

            // Front Side Values
            let frontBgColor = document.getElementById("front_bg_color").value;
            let frontLogo = document.getElementById("front_logo").files[0];
            let frontCompanyName = document.getElementById("front_company_name").value;
            let frontCompanyNameColor = document.getElementById("front_company_name_color").value;
            let frontCompanyNameSize = document.getElementById("front_company_name_size").value;
            let frontSlogan = document.getElementById("front_slogan").value;
            let frontSloganColor = document.getElementById("front_slogan_color").value;
            let frontSloganSize = document.getElementById("front_slogan_size").value;

            // Update Front Side Preview
            let previewFront = document.getElementById("previewFront");
            previewFront.style.backgroundColor = frontBgColor;
            previewFront.style.width = tagWidthSize + "px";
            previewFront.style.height = tagHeightSize + "px";

            document.getElementById("previewFrontCompanyName").innerText = frontCompanyName;
            document.getElementById("previewFrontCompanyName").style.color = frontCompanyNameColor;
            document.getElementById("previewFrontCompanyName").style.fontSize = frontCompanyNameSize + "px";
            
            document.getElementById("previewFrontSlogan").innerText = frontSlogan;
            document.getElementById("previewFrontSlogan").style.color = frontSloganColor;
            document.getElementById("previewFrontSlogan").style.fontSize = frontSloganSize + "px";

            // Update Front Logo Preview
            if (frontLogo) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("previewFrontLogo").src = e.target.result;

                };
                reader.readAsDataURL(frontLogo);
            }

        }

        // Back Side Values
        let backBgColor = document.getElementById("back_bg_color").value;
        let backLogo = document.getElementById("back_logo").files[0];
        let backCompanyName = document.getElementById("back_company_name").value;
        let backCompanyNameColor = document.getElementById("back_company_name_color").value;
        let backCompanyNameSize = document.getElementById("back_company_name_size").value;
        let backSlogan = document.getElementById("back_slogan").value;
        let backSloganColor = document.getElementById("back_slogan_color").value;
        let backSloganSize = document.getElementById("back_slogan_size").value;
        // let backMiddleContent = document.getElementById("back_middle_content_first").value + "<br>" + document.getElementById("back_middle_content_second").value + "<br>" + document.getElementById("back_middle_content_third").value ;
        let backMiddleContentColor = document.getElementById("back_middle_content_color").value;


        // let footer = document.getElementById("footer").value;

        // Update Back Side Preview
        let previewBack = document.getElementById("previewBack");
        previewBack.style.backgroundColor = backBgColor;
        previewBack.style.width = tagWidthSize + "px";
        previewBack.style.height = "300px"; // Fixed height for back side

        document.getElementById("previewBackCompanyName").innerText = backCompanyName;
        document.getElementById("previewBackCompanyName").style.color = backCompanyNameColor;
        document.getElementById("previewBackCompanyName").style.fontSize = backCompanyNameSize + "px";

        document.getElementById("previewBackSlogan").innerText = backSlogan;
        document.getElementById("previewBackSlogan").style.color = backSloganColor;
        document.getElementById("previewBackSlogan").style.fontSize = backSloganSize + "px";


        // document.getElementById("previewMiddleContent").innerHTML = backMiddleContent;
        document.getElementById("previewMiddleContent").style.color = backMiddleContentColor;
        document.getElementById("previewMiddleContent").style.textAlign = 'left';

        // document.getElementById("previewFooter").innerText = footer;

            // Update Back Logo Preview
        if (backLogo) {
            let reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("previewBackLogo").src = e.target.result;
            };
            reader.readAsDataURL(backLogo);
        }


    
    });

</script>
