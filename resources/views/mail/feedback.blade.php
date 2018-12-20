<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Feedback message from cryptodales.com</h2>

<div>
    <p><strong>Message: </strong>{{ $feedback }}</p>
    @if (!empty($user))
        <p><strong>Email: </strong>{{ $user->email }}</p>
        @if (!empty($user->name))
            <p><strong>Name: </strong>{{ $user->name }}</p>
        @endif
    @endif
</div>
</body>
</html>