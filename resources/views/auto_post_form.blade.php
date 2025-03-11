<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body onload="document.getElementById('autoForm').submit();">
    <form id="autoForm" action="{{ route('found.item') }}" method="POST">
        @csrf
        @foreach($decryptedData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <noscript>
            <p>JavaScript is required for automatic submission. Click below if it doesn’t redirect.</p>
            <button type="submit">Submit</button>
        </noscript>
    </form>
</body>
</html>
