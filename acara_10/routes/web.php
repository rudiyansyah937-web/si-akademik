
<?php

$routes = [
    'GET' => [

        '/' => [
            'controller' => 'HomeController',
            'action' => 'index'
        ],

        '/login' => [
            'controller' => 'AuthController',
            'action' => 'loginForm'
        ],

        '/logout' => [
            'controller' => 'AuthController',
            'action' => 'logout'
        ],


        '/mahasiswa' => [
            'controller' => 'MahasiswaController',
            'action' => 'index',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/mahasiswa/create' => [
            'controller' => 'MahasiswaController',
            'action' => 'create',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/mahasiswa/edit' => [
            'controller' => 'MahasiswaController',
            'action' => 'edit',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/mahasiswa/delete' => [
            'controller' => 'MahasiswaController',
            'action' => 'delete',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],


        '/prodi' => [
            'controller' => 'ProdiController',
            'action' => 'index',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/prodi/create' => [
            'controller' => 'ProdiController',
            'action' => 'create',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/prodi/edit' => [
            'controller' => 'ProdiController',
            'action' => 'edit',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],


        '/matkul' => [
            'controller' => 'MatkulController',
            'action' => 'index',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/matkul/create' => [
            'controller' => 'MatkulController',
            'action' => 'create',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/matkul/edit' => [
            'controller' => 'MatkulController',
            'action' => 'edit',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

    ],

    'POST' => [

        '/login' => [
            'controller' => 'AuthController',
            'action' => 'login'
        ],


        '/mahasiswa' => [
            'controller' => 'MahasiswaController',
            'action' => 'store',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],


        '/mahasiswa/update' => [
            'controller' => 'MahasiswaController',
            'action' => 'update',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/mahasiswa/delete' => [
            'controller' => 'MahasiswaController',
            'action' => 'delete',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],


        '/prodi' => [
            'controller' => 'ProdiController',
            'action' => 'store',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/prodi/update' => [
            'controller' => 'ProdiController',
            'action' => 'update',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/prodi/delete' => [
            'controller' => 'ProdiController',
            'action' => 'delete',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],


        '/matkul' => [
            'controller' => 'MatkulController',
            'action' => 'store',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/matkul/update' => [
            'controller' => 'MatkulController',
            'action' => 'update',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

        '/matkul/delete' => [
            'controller' => 'MatkulController',
            'action' => 'delete',
            'middleware' => ['App\Core\Middleware\AuthMiddleware']
        ],

    ]
];
