<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Service</title>
    <style>
        body, h1, p {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            color: #333333;
            background-color: #f7f7f7;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h2 {
            margin: 3px 0px 10px;
            font-size: 21px;
        }
        .header img {
            max-width: 50px;
            margin-bottom: 10px;
        }
        .content {
            padding: 20px 20px 0px;
            text-align: center;
            max-width: 450px;
            margin: auto;
        }
        .content h1 {
            font-size: 21px;
            margin-bottom: 10px;
        }
        .content p {
            font-size: 16px;
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #4CAF50;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }
        .footer {
            font-size: 12px;
            color: #666666;
            text-align: center;
            padding: 20px;
        }
        .footer p:nth-child(1) {
            margin-bottom:5px;
        }
        
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('email.png') }}" alt="Service Logo">
            <h2>Welcome to Our Service!</h2>
        </div>

        <div class="content">
            <h1>Hello, {{ $subscriber->name }}!</h1>
            <p>Thank you for subscribing to our service. We’re excited to have you on board.</p>
            <p>If you wish to unsubscribe, simply click the button below:</p>
            <a href="{{ $unsubscribeUrl }}" class="button">Unsubscribe</a>
        </div>

        <div class="footer">
            <p>Thank you for being with us!</p>
            <p>&copy; {{ date('Y') }} Our Service. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
