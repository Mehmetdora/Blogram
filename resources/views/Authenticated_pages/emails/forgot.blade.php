<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        /* Şablonun stilini buraya yazabilirsiniz */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #3498db;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 style="text-align: center;">Password Reset Request</h1>
        </div>
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            <p>We received a request to reset your password. If you didn't make this request, you can safely ignore this
                email.</p>
            <p>To reset your password, click the button below:</p>
            <p style="text-align: center;">
                <a href="{{ route('reset-password', $user->remember_token) }}" class="button">
                    Reset Your Password
                </a>
            </p>
            <p>This link will expire in 1 hour for security reasons.</p>
            <p>If you're having trouble clicking the button, copy and paste the following URL into your web browser:</p>
            <p><a href="{{ route('reset-password', $user->remember_token) }}"
                    style="color: #3498db; text-decoration: underline;">{{ route('reset-password', $user->remember_token) }}</a>
            </p>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
