<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .otp-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .otp-code {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
            text-align: center;
            margin: 15px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <h2>OTP Verification</h2>
    <p>Hello,</p>
    <p>Your One Time Password (OTP) for payment verification is:</p>
    
    <div class="otp-container">
        <div class="otp-code">{{ $msg}}</div>
    </div>
    
    <p>Please use this code to complete your transaction.</p>
    <p>This OTP is valid for a limited time only.</p>
    
    <div class="footer">
        <p>If you didn't request this OTP, please ignore this email.</p>
        <p>Thank you,<br>
       </p>
    </div>
</body>
</html>
