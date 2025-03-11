

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File for QR Codes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-square-buttons/1.0.0/bootstrap-square-buttons.min.css" integrity="sha512-Dzi0zz9zCe2olZNhq+wnzGjO5ILOv8f/yD6j8srW+XGnnv9dUN04eEoIdVHxQqiy8uBn21niIWQpiCzYJEH3yg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { text-align: center; font-family: Arial, sans-serif; margin-top: 50px; }
        .container { width: 50%; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        input, button { margin-top: 10px; padding: 10px; width: 100%; }
        .error { color: red; font-size: 14px; margin-top: 1px;}
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload CSV or Excel File</h2>
        
        <form action="{{ route('generate.qrcodes') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".csv,.xlsx,.xls" >
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="btn btn-primary ">Generate QR Codes</button>
          
        </form>
        <br>
        <p>Download Sample <a href='sample.csv'>.csv</a> <a href='sample.xlsx'>.xlsx</a></p>
    </div>
</body>
</html>

