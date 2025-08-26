<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Question Notification</title>
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
            <h1>New Question Notification</h1>
        </div>
        <div class="content">
            <p>Hello!</p>
            <p>A user asked a question on one of your tours. Please check out the question here: </p>
            <a href="https://worldonmoto.com/tour/{{ $tourId }}">Link</a>
            <p>Thank you,</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} WorldOnMoto. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
