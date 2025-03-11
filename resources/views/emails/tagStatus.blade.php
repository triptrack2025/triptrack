<!DOCTYPE html>
<html>
<head>
    <title>Tag Status Update</title>
</head>
<body>
<h3>Dear {{ $name }},</h3>
<p>Your Tag <strong>{{ $tagId }}</strong> has been successfully {{ $status }}.</p>

@if($status == 'Lost')
    <p>If you found the item, please update your tag status from your profile.</p>
@endif

<p>Thank you for using TripTrack.</p>

<p>Best Regards,<br>TripTrack Support Team</p>
</body>
</html>
