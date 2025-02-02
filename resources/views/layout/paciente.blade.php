<!-- resources/views/layouts/paciente.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
<<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net;">

    <title>@yield('title', 'Área del Paciente')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <ro class="navbar-brand" href="#">Hospital Isidro Ayora</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('paciente.index') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('paciente.agendar_cita') }}">Agendar Cita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pacientes.historialMedico', ['paciente' => Auth::id()]) }}">Historial Médico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pacientes.facturas') }}">Facturas</a>
                    </li>
                </ul>
            </div>
        </div>
        @if (Auth::check())
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>
            @endif
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="bg-light text-center text-lg-start mt-4 py-3">
        <div class="text-center text-muted">
            &copy; {{ date('Y') }} Hospital Management System. Todos los derechos reservados.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
