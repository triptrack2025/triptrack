<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Custom Tag PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #eee;
        }
        .container{
            background-color: #eee;
        }
        .tag-container {
            display: flex;
            justify-content: space-around;
            /* margin-left:25%; */

        }
        .tag-side {
            width: {{ $tagData['tag_width_size'] }}px;
            height: {{ $tagData['tag_height_size'] }}px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* border: 2px solid #000; */
        }
        .front {
            /* margin-bottom:60%; */
            margin-bottom:60%;
            background-color: {{ $tagData['front_bg_color'] }};
            color: {{ $tagData['front_company_name_color'] }};
            border-radius:60px;
        }
        .back {
            background-color: {{ $tagData['back_bg_color'] }};
            color: {{ $tagData['back_company_name_color'] }};
            border-radius:60px;
            border-color:white;
        }
        h2 {
            font-size: {{ $tagData['front_company_name_size'] }}px;
        }
        h3 {
            font-size: {{ $tagData['back_company_name_size'] }}px;
        }
        .front_slogan {
            font-size: {{ $tagData['front_slogan_size'] }}px;
            color: {{ $tagData['front_slogan_color'] }};
        }
        .back_slogan {
            font-size: {{ $tagData['back_slogan_size'] }}px;
            color: {{ $tagData['back_slogan_color'] }};
        }
        .back_middle_content {
            text-align:left;
            font-size: 200%;
            margin-top:30px;
            margin-bottom:20px;
            margin-left:20%;
            font-family: 'Old English Text MT', 'Garamond', serif;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            color: {{ $tagData['back_middle_content_color'] }};
        }
        .front-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding-top:60%;
            
        }
        .back-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .logo-content {
            padding-top:20%;
        }
        .previewQrCodepTag{
            padding-bottom:0%;
            margin-bottom:0%;
            padding-top:4%;
        }
        .previewQrCodepTag .footer {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .back_middle_content_div{
            display: flex;
                        text-align:center;
                        align-items: center;

        }
        .col-front{
            margin-left:30%;    
            margin-top:7%; 
        }
        .col-back{
            margin-left:30%;    
            padding-top:20%; 
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-front">
                @if($tagData["select_default_or_custom_page"] == "Custom Background")
                    <div class="tag-side front" 
                        style="background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path($tagData['front_custom_bg_image']))) }}'); 
                                background-size: cover; 
                                background-repeat: no-repeat; 
                                background-position: center; 
                                width: {{ $tagData['front_custom_bg_image_width'] ?? 300 }}px;
                                height: {{ $tagData['front_custom_bg_image_height'] ?? 550 }}px;"></diV>
                @else
                    <div class="tag-side front">
                        <div class="front-content">
                            @if($tagData['front_logo'])
                                <img src="{{ public_path($tagData['front_logo']) }}" width="100px">
                            @endif
                            <h2 style="margin-top:5px;margin-bottom:0px;">{{ $tagData['front_company_name'] }}</h2>
                            <p style="margin-top:5px;margin-bottom:0px;" class="front_slogan">{{ $tagData['front_slogan'] }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-sm-6 col-back">
                <div class="tag-side back">
                    <div class="back-content">
                        <div class="logo-content">
                            @if($tagData['back_logo'])
                                    <img src="{{ public_path($tagData['back_logo']) }}" style="margin-top:0px;margin-bottom:0px;" width="100px">
                            @endif
                            <h3 style="margin-top:0px;margin-bottom:0px;">{{ $tagData['back_company_name'] }}</h3>
                            <p class="back_slogan" style="margin-top:0px;margin-bottom:1px;">{{ $tagData['back_slogan'] }}</p>
                        </div>
                        <div class="back_middle_content_div">
                            <h1 class="back_middle_content">FOUND ME?<br>SCAN QR<br>TO RETURN</h1>
                        </div>
                        <p class="previewQrCodepTag"><img src="{{ public_path('assets/images/triptrack-sample-qr.png') }}" id="previewQrCodeimg" class="previewQrCodeimg"  width="90" height="90"></p>                

                        <b style="margin-bottom:25px;letter-spacing:2px;color:black;font-size:13px;">ADSFVFD</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
