<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новое сообщение</title>
</head>
<body>
    <h1>Новое сообщение от {{ $name }}</h1>
    <p>Email: {{ $email }}</p>
    <p>Телефон: {{ $phone }}</p>
    <p>Сообщение:</p>
    <p>{{ $messageContent }}</p>
</body>
</html>
