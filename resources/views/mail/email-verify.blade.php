<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Verification Code</title>
</head>
<body style="background-color:#ffffff; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin:0; padding:0;">
    <div style="max-width:600px; margin:0 auto; padding:40px 20px; text-align:center;">

        {{-- Logo --}}
        <div style="margin-bottom:24px;">
            <img src="{{ asset('images/logo.png') }}" alt="World on Moto Logo" style="width:60px; height:auto; margin:auto;">
        </div>

        {{-- Heading --}}
        <h1 style="font-size:20px; font-weight:600; color:#556b2f; margin-bottom:20px;">
            World on Moto Says Hello!
        </h1>

        {{-- Message --}}
        <p style="font-size:16px; color:#333; margin-bottom:24px;">
            We are thrilled that you want to join us!<br>
            Here is your email confirmation code:
        </p>

        {{-- Code --}}
        <div style="font-size:36px; font-weight:700; letter-spacing:6px; color:#556b2f; margin:32px 0;">
            {{ $otp }}
        </div>

        {{-- Footer text --}}
        <p style="font-size:16px; color:#333; margin-top:24px;">
            Let’s get this adventure started!
        </p>

    </div>
</body>
</html>