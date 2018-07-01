<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Password reset</h2>
<div>
    Please, follow the <a href="{{ env('APP_URL') . '/password/reset/' . $token }}">link</a>
    to reset your password.
</div>
</body>
</html>