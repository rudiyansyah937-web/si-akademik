<?php

return [
    'GET' => [
        '/'                      => ['HomeController', 'index'],
        '/mahasiswa'             => ['MahasiswaController', 'index'],
        '/mahasiswa/create'      => ['MahasiswaController', 'create'],
        '/mahasiswa/{id}'        => ['MahasiswaController', 'show'],
        '/mahasiswa/{id}/edit'   => ['MahasiswaController', 'edit'],
    ],
    'POST' => [
        '/mahasiswa'             => ['MahasiswaController', 'store'],
    ],
];