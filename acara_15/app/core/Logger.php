<?php

class Logger
{
    public static function error(string $message, ?Throwable $e = null): void
    {
        $dir = __DIR__ . '/../../storage/logs';
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }

        $line = '[' . date('Y-m-d H:i:s') . '] ERROR: ' . $message;

        if ($e !== null) {
            $line .= ' | ' . get_class($e) . ': ' . $e->getMessage()
                   . ' (' . basename($e->getFile()) . ':' . $e->getLine() . ')';
        }

        @file_put_contents($dir . '/app.log', $line . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}