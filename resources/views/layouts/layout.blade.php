
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 0.875rem; /* Tamaño de letra más pequeño */
        }
        .btn {
            margin-right: 0.5rem; /* Margen entre botones */
        }
        .table-responsive {
            max-height: 400px; /* Tamaño fijo para las tablas */
            overflow-y: auto; /* Overflow para ver todos los registros */
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            height:13%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgb(77, 104, 131); /* Color gris claro */
            padding: 1rem;
            border-radius: 0.25rem;
            z-index: 1000; /* Asegura que el header esté por encima de otros elementos */
           
        }
        .header img {
            height: 50px;
            margin-right: 1rem;
        }
        .header .title {
            flex-grow: 1;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .header .btn-dashboard {
            color: black;
            background-color: #d3d3d3; /* Color gris claro */
            border-color: #d3d3d3;
        }
        .content {
            margin-top: 150px; /* Espacio para el header fijo */
        }
    </style>
</head>

<body>
    <header class="header">
        <img src="{{ asset('images/QuestieIcon2.png') }}" alt="Logo">
        <div style="margin-left:50px" class="title">QUESTIE</div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-dashboard">Dashboard</a>
    </header>
    <div class="container content mt-5">
        @hasSection('header')
            <header class="my-4">
                <h1>@yield('header')</h1>
            </header>
        @endif
        <main>
            @yield('content')
        </main>
    </div>
    @yield('scripts')
</body>
</html>