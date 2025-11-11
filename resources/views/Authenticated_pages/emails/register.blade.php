<!-- resources/views/emails/verify-email.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #4CAF50;
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
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666666;
        }

        a {
            color: #4CAF50;
            text-decoration: underline;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>

        <div class="content">
            <p>Dear {{ $user->name }},</p>
            <p>Thank you for signing up! To complete your registration, please verify your email address by clicking the button below:</p>
            <div class="button-container">
                <a href="{{ url('verify/' . $user->remember_token) }}" class="button">Verify Email</a>
            </div>
            <p>If you didn't create an account, you can safely ignore this email.</p>
            <p>This link will expire in 24 hours.</p>
            <p>If you're having trouble clicking the button, copy and paste the following URL into your web browser:</p>
            <a href="{{ url('verify/' . $user->remember_token) }}">{{ url('verify/' . $user->remember_token) }}</a>
        </div>

        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>

<!-- resources/views/emails/verify-email.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Adress Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;a
        }

        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .header h1{
            text-align:center;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }


        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666666;
        }




        p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>

        <div class="content">
            <p>Dear {{ $user->name }},</p>
            <p>Thank you for signing up! To complete your registration, please verify your email address by clicking the button below:</p>
            <a href="{{ route('verify',$user->remember_token) }}">Verify Email Now</a>
            <p>If you didn't create an account, you can safely ignore this email.</p>
            <p>This link will expire in 24 hours.</p>


        </div>

        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>

</html>

