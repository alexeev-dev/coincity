<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>E-mail address verification</h2>

<div>
    Dear User,<br/>
    Please, follow the <a href="{{ env('APP_URL').'/register/verify/'.$confirmation_code }}">link</a>
    to verify your e-mail address and activate your account.
</div>
</body>
</html>