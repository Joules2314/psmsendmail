<!-- resources/views/emails/send.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $subjectText ?? 'Email' }}</title>
</head>
<body>
    <h3>Sistema: {{ $systemName }}</h3>
    <p>Usuário: {{ $userName }}</p>
    <hr>
    <p>{{ $bodyText }}</p>
</body>
</html>