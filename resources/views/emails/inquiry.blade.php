<!DOCTYPE html>
<html>
<head>
    <title>New Inquiry</title>
</head>
<body>
<h2>New Inquiry Received</h2>
<p><strong>Name:</strong> {{ $inquiry['first_name'] }}</p>
<p><strong>Mobile:</strong> {{ $inquiry['mobile'] }}</p>
<p><strong>Email:</strong> {{ $inquiry['email'] }}</p>
<p><strong>Message:</strong> {{ $inquiry['message'] }}</p>
<br>
<p>Thank you!</p>
</body>
</html>
