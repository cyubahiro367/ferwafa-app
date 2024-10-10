<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #4285f4;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-body {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #f4f4f4;
            color: #777;
            padding: 20px;
            text-align: center;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            background-color: #4285f4;
            color: #ffffff;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #3367d6;
        }
        .content-block {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="email-container">

        <!-- Email Body -->
        <div class="email-body">
            <p class="content-block">Hello {{ $title }},</p>

            <div class="content-block">
                <p>{{ $messageBody }}</p>
            </div>

            <p class="content-block">Contact details:</p>
            <ul>
                <li><strong>Email:</strong> {{ $email }}</li>
                <li><strong>Phone:</strong> {{ $phone }}</li>
            </ul>

            <p class="content-block">Thank you for your attention.</p>

        </div>
    </div>
</body>
</html>
