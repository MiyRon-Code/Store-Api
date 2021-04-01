<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;500;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="mail-header">
        <h1>Привет, {{$name}}! Вы были успешно зарегестрированны</h1>
        <h5>store-api</h5>
    </div>
    <style>
        *{
            font-family: 'Montserrat', sans-serif;
        }
        .mail-header{
            height: 300px;
            background: blue;
            color: white;
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }
    </style>
</body>
</html>