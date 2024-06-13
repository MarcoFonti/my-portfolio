<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email di Contatto</title>
</head>

<body>
    {{-- MESSAGGIO CHE MI ARRIVA DAL FORM INVIATO DALL'UTENTE --}}
    <h1>Hai ricevuto un nuovo messaggio di contatto da</h1>
    <p><strong>Nome:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Messaggio:</strong></p>
    <p>{{ $body }}</p>
</body>

</html>
