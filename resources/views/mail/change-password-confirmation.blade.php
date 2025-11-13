<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Change Confirmation – World on Moto</title>
</head>
<body style="background-color:#ffffff; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin:0; padding:0;">
    <div style="max-width:600px; margin:0 auto; padding:40px 20px; text-align:center;">

        {{-- Logo --}}
        <div style="margin-bottom:24px;">
            <img src="{{ asset('images/logo.png') }}" alt="World on Moto Logo" style="width:60px; height:auto; margin:auto;">
        </div>

        {{-- Heading --}}
        <h1 style="font-size:20px; font-weight:600; color:#556b2f; margin-bottom:20px;">
            Hello {{ $user->name }},
        </h1>

        {{-- Message --}}
        <p style="font-size:16px; color:#333; margin-bottom:24px; line-height:1.6;">
            We’ve received a request to change the password for your <strong>World on Moto</strong> account.
        </p>

        <p style="font-size:16px; color:#333; margin-bottom:24px; line-height:1.6;">
            To confirm this change, please click the link below:
        </p>

        <p style="font-size:16px; color:#333; margin-bottom:24px;">
            👉 <a href="{{ route('password.change.confirm', $token) }}" style="color:#556b2f; text-decoration:none; font-weight:600;">Confirm Password Change</a>
        </p>

        <p style="font-size:15px; color:#555; margin:24px 0; line-height:1.6;">
            <strong>Important:</strong> Your password will not be updated until this request is confirmed.
        </p>

        <p style="font-size:15px; color:#555; margin:16px 0; line-height:1.6;">
            If you did not request this change, it could mean someone else is attempting to access your account. For your security, please:
        </p>

        <ul style="text-align:left; display:inline-block; font-size:15px; color:#333; line-height:1.8; margin:0; padding-left:20px;">
            <li>❌ Do not click the confirmation link.</li>
            <li>🔐 Log in immediately and change your password.</li>
            <li>🕵️‍♀️ Review your recent account activity for anything unusual.</li>
        </ul>

        <p style="font-size:15px; color:#555; margin-top:24px; line-height:1.6;">
            Protecting your account is our highest priority.  
            If you require any assistance, please contact our support team.
        </p>

        <p style="font-size:15px; color:#333; margin-top:32px; line-height:1.6;">
            Stay safe,<br>
            <strong>The World on Moto Team</strong>
        </p>
    </div>
</body>
</html>
