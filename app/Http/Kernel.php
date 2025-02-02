<?php

// En app/Http/Kernel.php
protected $routeMiddleware = [
    // Otros middlewares
    'redirect.auth' => \App\Http\Middleware\RedirectIfAuthenticated::class,
];
protected $middleware = [
    // Otras configuraciones de middleware
    \App\Http\Middleware\HandleCors::class,
    // Otras configuraciones de middleware
];
protected $middleware = [
    \App\Http\Middleware\TrustProxies::class,
    // otros middlewares
];
protected $middleware = [
    \App\Http\Middleware\TrustProxies::class,
    \Fruitcake\Cors\HandleCors::class,
    \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    // otros middlewares
];
