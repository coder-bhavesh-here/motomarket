<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Notification – World on Moto</title>
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
            color: #333;
        }

        .content h2, .content h3 {
            color: #555;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .content table td {
            padding: 8px 0;
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
            <h1>New Booking Notification</h1>
        </div>

        <div class="content">
            <h2>Dear Agency,</h2>

            <p>A new booking has been made. Please find the details below:</p>

            <table>
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
                <tr>
                    <td><strong>Add-ons:</strong></td>
                    <td>{{ $booking->addons }}</td>
                </tr>
            </table>

            <h3>Customer Details:</h3>

            <table>
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>{{ $booking->name }}</td>
                </tr>
                <tr>
                    <td><strong>Nationality:</strong></td>
                    <td>{{ $booking->nationality }}</td>
                </tr>
                <tr>
                    <td><strong>Mobile Number:</strong></td>
                    <td>{{ $booking->mobile_number }}</td>
                </tr>
                <tr>
                    <td><strong>Address:</strong></td>
                    <td>{{ $booking->address }}</td>
                </tr>
                <tr>
                    <td><strong>Country:</strong></td>
                    <td>{{ $booking->country }}</td>
                </tr>
                <tr>
                    <td><strong>Postcode:</strong></td>
                    <td>{{ $booking->postcode }}</td>
                </tr>
            </table>

            <p style="margin-top:20px;">
                Please review the booking and make the necessary preparations for the customer’s tour.  
                Thank you for your attention and support.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} World on Moto. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
