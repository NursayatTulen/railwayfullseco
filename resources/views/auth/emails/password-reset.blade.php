<!DOCTYPE html>
<html>
<head>
    <title>Құпия сөзді қалпына келтіру</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <h2>Сәлеметсіз бе!</h2>
    <p>Сіз құпия сөзді қалпына келтіру туралы сұраныс жолдадыңыз.</p>
    <p>Төмендегі түймені басу арқылы құпия сөзіңізді өзгерте аласыз:</p>
    <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" 
       style="display: inline-block; padding: 10px 20px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 5px;">
       Құпия сөзді қалпына келтіру
    </a>
    <p>Егер сіз бұл сұранысты жолдамасаңыз, бұл хатты елемей-ақ қойсаңыз болады.</p>
</body>
</html>
