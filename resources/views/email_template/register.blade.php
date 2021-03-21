<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table cellpadding="0" cellspacing="0" style="border: 2px solid #ddd; padding: 15px; max-width: 400px; font-family: Verdana; text-align: center; margin: auto; border-radius: 5px;">
        <tr>
            <td>
                <img src="{{ url('front/header-logo.png') }}" alt="">
            </td>
        </tr>
        <tr>
            <td>
                <hr>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-top: 0; margin-bottom: 5px;">Your Password</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin-top: 0; margin-bottom: 5px;">
                    {{ $user['password'] }}
                </p>
            </td>
        </tr>
        <tr style="margin-top: 15px; margin-bottom: 15px;">
            <td>
                <p style="margin-top: 0; margin-bottom: 5px;">Please keep this very secure.</p>
            </td>
        </tr>
        <tr style="margin-bottom: 15px;">
            <td>
                <a target="_blank" href="{{ url('/login') }}" style="padding: 8px 15px; border-radius: 5px; background-color: #333; color: #fff; display: inline-block;">For Login</a>
            </td>
        </tr>
    </table>








</body>
</html>