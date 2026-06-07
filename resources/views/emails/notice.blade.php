<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: linear-gradient(135deg, #1a472a, #2c3e50); padding: 30px; text-align: center; }
        .header h1 { color: white; margin: 0; font-size: 22px; }
        .header p { color: rgba(255,255,255,0.7); margin: 5px 0 0; font-size: 14px; }
        .body { padding: 30px; }
        .notice-title { font-size: 20px; font-weight: bold; color: #1a472a; margin-bottom: 15px; }
        .notice-body { color: #555; line-height: 1.7; font-size: 15px; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #999; font-size: 12px; }
        .badge { display: inline-block; background: #1a472a; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Khan Jahan Ali Hall</h1>
        <p>Khulna University of Engineering & Technology</p>
    </div>
    <div class="body">
        <span class="badge">New Notice</span>
        <div class="notice-title">{{ $notice->title }}</div>
        <div class="notice-body">{{ $notice->body }}</div>
        <p style="margin-top: 25px; color: #999; font-size: 13px;">
            Posted on: {{ $notice->created_at->format('d M Y, h:i A') }}
        </p>
    </div>
    <div class="footer">
        <p>This email was sent by Khan Jahan Ali Hall Administration.</p>
        <p>© {{ date('Y') }} Khan Jahan Ali Hall, KUET</p>
    </div>
</div>
</body>
</html>