<?php

return [
    'GET' => [
        '/'                    => ['HomeController', 'index'],
        '/login'               => ['AuthController', 'loginForm'],
        '/logout'              => ['AuthController', 'logout'],

        '/dashboard'           => ['HomeController', 'dashboard', ['AuthMiddleware']],
        '/mahasiswa'           => ['MahasiswaController', 'index', ['AuthMiddleware']],
        '/mahasiswa/create'    => ['MahasiswaController', 'create', ['AuthMiddleware']],
        '/mahasiswa/{id}'      => ['MahasiswaController', 'show', ['AuthMiddleware']],
        '/mahasiswa/{id}/edit' => ['MahasiswaController', 'edit', ['AuthMiddleware']],
    ],
    'POST' => [
        '/login'               => ['AuthController', 'login'],
        '/mahasiswa'           => ['MahasiswaController', 'store', ['AuthMiddleware']],
    ],
];