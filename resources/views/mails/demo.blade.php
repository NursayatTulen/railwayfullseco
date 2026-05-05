<!DOCTYPE html>
<html>
<head>
    <title>Laravel Demo Email</title>
</head>
<body style="font-family: sans-serif; background-color: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h1 style="color: #2d3748;">{{ $mailData['title'] }}</h1>
        <p style="color: #4a5568; line-height: 1.6;">{{ $mailData['body'] }}</p>
        
        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">
        
        <p style="font-size: 12px; color: #a0aec0;">Бұл хат Laravel қолданбасынан автоматты түрде жіберілді.</p>
    </div>
</body>
</html>
