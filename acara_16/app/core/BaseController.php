<?php

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
        header('Location: ' . BASE_URL . $path);
        exit;
    }

    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    protected function rememberInput(array $input): void
    {
        $_SESSION['old'] = $input;
    }

    protected function pullOldInput(): array
    {
        $old = $_SESSION['old'] ?? [];
        unset($_SESSION['old']);
        return $old;
    }
}