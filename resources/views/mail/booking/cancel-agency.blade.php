<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Cancellation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333;
        }

        .content {
            margin-bottom: 20px;
        }

        .content h2 {
            color: #555;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Booking Cancelled</h1>
        </div>
        <div class="content">
            <h2>Hello,</h2>
            {{-- <p>Thank you for booking your tour with us! Here are your booking details:</p> --}}
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <tr>
                    <td><strong>Booking ID:</strong></td>
                    <td>{{ $booking->id }}</td>
                </tr>
                <tr>
                    <td><strong>Tour Date:</strong></td>
                    <td>{{ $booking->date }}</td>
                </tr>
                <tr>
                    <td><strong>Amount Paid:</strong></td>
                    <td>€{{ $booking->amount }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} WorldOnMoto. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
