<?php
namespace App\Controllers;

abstract class BaseController
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        $content = __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layouts/main.php';
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . $this->baseUrl() . $path);
        exit;
    }

    protected function baseUrl(): string
    {
        return rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
    }
}