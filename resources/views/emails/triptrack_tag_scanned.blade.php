<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripTrack Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .title {
            font-size: 16px;
            color: #333;
            margin: 0 0 20px;
            font-weight: bold;
        }
        .content {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table td {
            padding: 10px;
            text-align: center;
        }
        .image {
            max-width: 100px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .map {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }
        .button {
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
<div class="container">
    <p class="title">Dear {{ $userTag['user']['first_name'] ?? 'Valued Customer' }},</p>

    <p class="content">
        This is an important alert to notify you that your 
        <strong>{{ config('constant.valuable_type.' . ($userTag['valuable_type'] ?? 'default')) ?? 'TripTrack Bag Security' }} Tag</strong> 
        has been scanned. The Finder may attempt to contact you for its return.
    </p>

    <table class="table">
        <tr>
            <td width="40%">
            <img src="{{ url($userTag['tag_image'] ?? 'default_image.png') }}" alt="Bag Security Tag Image" class="image">
                <p>{{ $userTag['tag_id'] ?? 'N/A' }}</p>
            </td>
           
        </tr>
        <tr>
            <td>
                <p><strong>Location Preview: </strong></p>
                <a href="{{ $googleMapUrl }}" target="_blank">
                    <img src="{{ $mapImage }}" alt="Location Map" class="map" >
                </a>
                <p>
                    <a href="{{ $googleMapUrl }}" target="_blank">View on Google Maps</a>
                </p>
                <a href="{{ route('login') }}" target="_blank" class="button">
                    Login for More Details
                </a>
            </td>
        </tr>
    </table>

    <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

    <p class="footer">
        &copy; 2025 TripTrack - 1Y Ventures LLP | All rights reserved | 
        <a href="#" style="color: #007bff; text-decoration: none;">Privacy Policy</a>
    </p>
</div>
</body>
</html>