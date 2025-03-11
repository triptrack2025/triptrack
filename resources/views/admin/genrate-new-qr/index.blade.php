<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated QR Codes</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
            margin: auto;
        }
        .qr-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            padding: 5px;
        }
        .qr-box {
            padding: 12px;
            border: 1px solid #ddd;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background: #fff;
            text-align: center;
            max-width: 100px;
            min-width: 100px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .data-list {
            text-align: left;
            font-size: 14px;
            margin-bottom: 10px;
        }
        .data-list p {
            margin: 5px 0;
        }
        .print-btn {
            margin-top: 20px;
            padding: 10px 15px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-btn:hover {
            background-color: #0056b3;
        }
        /* Hide the button when printing */
        @media print {
            .print-btn {
                display: none;
            }
           
                .card-title-div, .left-sidebar, .app-header{
                    display: none;
                }
        }
        @media print {
            @page {
                margin: 0; /* Removes extra margins */
            }
            body {
                margin: 0;
                padding: 0;
            }
        }

        .data-list p {
            margin: 5px 0;
            font-size: 12px; /* Adjust font size as needed */
        }
        .tag {
                padding-top : 10px;
        }
        .tag b{
            letter-spacing:3px;
            color:black;
        }

    </style>
    <script>
        function printScreen() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="qr-container">
        @foreach($tags as $qr)
                <div class="qr-box">
                    
                    {!! $qr['qr_code'] !!}
                    <div class="tag"> <b class="tag-id">{{ $qr['tag_id'] }}</b></div>
                </div>
            @endforeach
        </div>
        
        <!-- Print Button -->
        <button class="print-btn" onclick="printScreen()">Print Screen</button>
    </div>
</body>
</html>
