<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password change confirmation</title>
</head>
<body style="background-color:#ffffff; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin:0; padding:0;">
    <div style="max-width:600px; margin:0 auto; padding:40px 20px; text-align:center;">

        {{-- Logo --}}
        <div style="margin-bottom:24px;">
            <img src="{{ asset('images/logo.png') }}" alt="World on Moto Logo" style="width:60px; height:auto; margin:auto;">
        </div>

        {{-- Heading --}}
        <h1 style="font-size:20px; font-weight:600; color:#556b2f; margin-bottom:20px;">
            Hi {{ $user->name }},
        </h1>

        {{-- Message --}}
        <p style="font-size:16px; color:#333; margin-bottom:24px;">
            We received a request to change the password for your account.
        </p>
        <p style="font-size:16px; color:#333; margin-bottom:24px;">
            To confirm this change, please click the link below:
        </p>
        <p style="font-size:16px; color:#333; margin-bottom:24px;">
            👉 <a href="{{ route('password.change.confirm', $token) }}">[Confirm Password Change]</a> link is here
        </p>

        <p style="font-size:15px; color:#555; margin:24px 0;">
            <b>Important:</b> Your password will not be updated until you confirm this request.
        </p>

        <p style="font-size:15px; color:#555; margin:16px 0;">
            If you did not request this change, it may mean someone else is trying to access your account. For your security:
        </p>

        <ul style="text-align:left; display:inline-block; font-size:15px; color:#333; line-height:1.6;">
            <li>❌ Do not click the confirmation link.</li>
            <li>🔐 Log in immediately and change your password.</li>
            <li>🕵️‍♀️ Review your recent activity for anything unusual.</li>
        </ul>

        <p style="font-size:15px; color:#555; margin-top:24px;">
            Protecting your account is our top priority.  
            If you need help, contact our support team.
        </p>

        <p style="font-size:15px; color:#333; margin-top:32px;">
            Stay safe,<br>
            <b>WoM Team</b>
        </p>
    </div>
</body>
</html>