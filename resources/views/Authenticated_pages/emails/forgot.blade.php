@component('mail::message')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Your Password</title>
    </head>

    <body
        style="font-family: Arial, sans-serif; line-height: 1.6; color: #333333; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
        <table role="presentation" style="width: 100%; border-collapse: collapse;">
            <tr>
                <td align="center" style="padding: 0;">
                    <table role="presentation"
                        style="width: 100%; max-width: 600px; border-collapse: collapse; background-color: #f9f9f9;">
                        <!-- Header -->
                        <tr>
                            <td style="padding: 20px; background-color: #3498db; text-align: center;">
                                <h1 style="color: white; margin: 0;">Password Reset Request</h1>
                            </td>
                        </tr>
                        <!-- Main Content -->
                        <tr>
                            <td style="padding: 20px; background-color: white;">
                                <p>Dear User,</p>
                                <p>We received a request to reset your password. If you didn't make this request, you can
                                    safely ignore this email.</p>
                                <p>To reset your password, click the button below:</p>
                                <p style="text-align: center;">
                                    <a href="{{ route('reset-password', $user->remember_token) }}"
                                        style="display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px;">
                                        @component('mail::button', ['url' => route('reset-password', $user->remember_token)])
                                            Reset Your Password
                                        @endcomponent
                                    </a>
                                </p>
                                <p>This link will expire in 1 hour for security reasons.</p>
                                <p>If you're having trouble clicking the button, copy and paste the following URL into your
                                    web browser:</p>
                                <p><a href="{{ route('reset-password', $user->remember_token) }}"
                                        style="color: #3498db; text-decoration: underline;">{{ route('reset-password', $user->remember_token) }}</a>
                                </p>
                                <p>If you didn't request a password reset, please contact our support team immediately.</p>
                            </td>
                        </tr>
                        <!-- Footer -->
                        <tr>
                            <td style="padding: 20px; text-align: center; font-size: 12px; color: #666666;">
                                <p>This is an automated message, please do not reply to this email.</p>
                                <p>&copy; 2025 {{ config('app.name') }}. All rights reserved.</p>
                                <p>
                                    <a href="{{ route('privacy-policy') }}"
                                        style="color: #3498db; text-decoration: underline;">Privacy Policy</a> |
                                    <a href="{{ route('terms-conditions') }}"
                                        style="color: #3498db; text-decoration: underline;">Terms of Service</a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>

    </html>

@endcomponent

