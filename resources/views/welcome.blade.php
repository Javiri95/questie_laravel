
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Questie</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background: url('{{ asset('images/quetied.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            color: black;
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombra para el contenedor */
        }

        .title {
            font-size: 84px;
            margin-bottom: 30px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .btn-custom {
            margin: 10px;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            color: black;
            text-decoration: none;
            background-color: transparent; /* Sin color de fondo */
            border: 2px solid black; /* Borde negro */
        }

        .btn-custom:hover {
            background-color: rgba(0, 0, 0, 0.1); /* Fondo negro semitransparente al pasar el ratón */
        }

        .logo {
            
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div style="font-weight:bold" class="title m-b-md">
                Administrador de Questie
            </div>

            <img src="{{ asset('images/QuestieIcon2.png') }}" alt="Questie Logo" class="logo">

            <div style="margin-top:50px ; font-weight:bold">
                <a href="{{ route('login') }}" class="btn-custom">Login</a>
                <a href="{{ route('register') }}" class="btn-custom">Register</a>
            </div>
        </div>
    </div>
</body>
</html>