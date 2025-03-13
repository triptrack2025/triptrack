@include('website.header')
<head>
    <style>
        body {
            background-color: #fdf9fa;
            color: white;
            text-align: center;
            overflow-x: hidden;
        }
        .container-box {
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            margin-top: 0px;
            padding-top: 0px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        .contact-options {
            display: none;
            width: 100%;
        }
        .container {
            background-color: #fdf9fa;
            height: 85vh;

        }
        h1 {
            font-size: calc(1.375rem + 1.5vw);
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
            color: var(--bs-heading-color);
        }
        .contact-btn-container {
            width: 100%;
            height: 100px;
            background: #f6fbff;
            padding: 15px;
            border-radius: 15px 15px 0px 0px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .contact-btn-container:hover {
            background: #e0f7ff;
        }
        .contact-btn {
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            color: black;
            cursor: pointer;
            margin-top:0px !important;
            padding-top:0px !important;
        }
        .contact-btn-container i {
            font-size: 20px;
            margin-bottom: 5px;
            color: black;
        }
        .contact-options-container {
            background: #f6fbff;
            padding: 20px;
            border-radius: 0 0 15px 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-outline-light {
            text-transform: none !important;
            border: 1px solid black;
            color: black;
        }
        .btn-outline-light:hover {
            background: black;
            color: white !important;
        }
        .reportfound-vector {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center">
    <div class="container-box w-100 text-center">
        <h1>Thank You for Finding Me</h1>
        <img src="{{asset($userTag->tag_image)}}" alt="Bag Image" class="my-3" width="100" height="100">
        <p><img src="https://storage.googleapis.com/pettag/qr/assets/qrcode.png" alt="qr" class="reportfound-vector me-2"><b>{{$userTag->tag_id}}</b></p>
        <p class="fw-bold">This <span class="text-warning">{{ config('constant.valuable_type.' . $userTag->valuable_type) }}</span> belongs to <br><span class="text-warning">{{$userTag->display_name}}</span></p>
        <div class="contact-btn-container" id="contact-btn">
            <div class="aero"><i class="fa fa-angle-double-up"></i></div>
            <button class="contact-btn">Contact Owner</button>
        </div>
        <div class="contact-options" id="contact-options">
            <div class="contact-options-container">
                <div class="row">
                    <div class="col">
                        <a href="tel:{{$userTag->user->mobile}}" class="btn btn-sm btn-outline-light w-100 my-2">
                            <img src="https://storage.googleapis.com/pettag/qr/assets/phone-call.png" class="reportfound-vector"> Call
                        </a>
                    </div>
                    <div class="col">
                        <a href="sms:{{$userTag->user->mobile}}" class="btn btn-sm btn-outline-light w-100 my-2">
                            <img src="https://storage.googleapis.com/pettag/qr/assets/message.png" class="reportfound-vector"> SMS
                        </a>
                    </div>
                    <div class="col">
                        <a href="https://wa.me/{{$userTag->user->mobile}}" class="btn btn-sm btn-outline-light w-100 my-2">
                            <img src="https://pettag.storage.googleapis.com/qr-bag/WhatsAppImage2024-03-20at2.25.34PM.jpeg1710925717209" class="reportfound-vector"> WhatsApp
                        </a>
                    </div>
                    <div class="col">
                        <a href="mailto:{{$userTag->user->email}}" class="btn btn-sm btn-outline-light w-100 my-2">
                            <img src="https://storage.googleapis.com/pettag/qr/assets/email.png" class="reportfound-vector"> Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#contact-btn").on("click", function () {
            let aero = $(".aero");
            let contactOptions = $("#contact-options");
            let body = $("html, body");

            if (aero.hasClass("down")) {
                contactOptions.stop().slideUp(400, function () {
                    body.css("overflow", "auto");
                });
                aero.html('<i class="fa fa-angle-double-up"></i>').removeClass("down");
            } else {
                // body.css("overflow", "hidden");
                contactOptions.stop().slideDown(400);
                body.animate({ scrollTop: contactOptions.offset().top }, 400);
                aero.html('<i class="fa fa-angle-double-down"></i>').addClass("down");
            }
        });

        let userTag = {!! json_encode($userTag) !!};
        function sendData() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    $.post("/send-location-email", {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude,
                        userTag: userTag,
                        _token: "{{ csrf_token() }}"
                    }, function (response) {
                        console.log("Email sent successfully!", response);
                    }).fail(function (error) {
                        console.error("Error sending email:", error);
                    });
                });
            } else {
                console.error("Geolocation not supported.");
            }
        }
        sendData();
    });
</script>
</body>
</html>
