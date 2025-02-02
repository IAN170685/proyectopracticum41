<!DOCTYPE html>
<html lang="es">
<head>
<<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net;">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <header class="text-center my-4">
            <h1>Sistema de Agendamiento de Citas Medicas</h1>
        </header>
        <main>
            @yield('content') <!-- Aquí se insertará el contenido de las vistas que extienden este layout -->
        </main>
        <footer class="text-center my-4">
            <p>&copy; {{ date('Y') }} Mi Sistema de Agendamiento. Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>