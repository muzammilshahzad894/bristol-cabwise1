<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Booking Confirmation</h2>

    <p>Dear {{ $bookingDetails['name'] }},</p>

    <p>{{ $notify }}</p>

    <ul>
        <li><strong>Payment Type:</strong> {{ $bookingDetails['payment_type'] }}</li>
        <li><strong>Pick Up Address:</strong> {{ $bookingDetails['pickup_address'] }}</li>
        <li><strong>Destination Address:</strong> {{ $bookingDetails['destination_address'] }}</li>
        <li><strong>Pick Up Date:</strong> {{ $bookingDetails['pickup_date_time'] }}</li>
        <li><strong>Amount:</strong> ${{ $bookingDetails['payment_amount'] }}</li>
        <li><strong>Payment Status:</strong> {{ $bookingDetails['payment_status'] }}</li>
        <li><strong>Booking Status:</strong> {{ $bookingDetails['booking_status'] }}</li>
    </ul>

    <p>Thank you for choosing our service. If you have any questions, feel free to contact us.</p>

    <p>Regards,<br>
    Your Booking Team</p>
</body>
</html>
