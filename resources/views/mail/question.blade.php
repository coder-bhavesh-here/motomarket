<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Question Notification – World on Moto</title>
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

        .content a {
            display: inline-block;
            margin-top: 10px;
            color: #556b2f;
            text-decoration: none;
            font-weight: 600;
        }

        .content a:hover {
            text-decoration: underline;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>New Question on Your Tour</h1>
        </div>

        <div class="content">
            <p>Dear Tour Operator,</p>

            <p>We wanted to let you know that a traveller has posted a new question on one of your tours.  
               You can view and respond to it by clicking the link below:</p>

            <a href="{{ route('tour.show', ['tourId' => $tourId]) }}#questionsList" target="_blank">
                View the Question
            </a>

            <p style="margin-top: 20px;">
                Thank you for being part of <strong>World on Moto</strong>.  
                We appreciate your continued support and engagement with our community of riders.
            </p>

            <p>Kind regards,<br>
                <strong>The World on Moto Team</strong>
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} World on Moto. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
