<?php

namespace Services;

/**
 * Service pour gérer la journalisation des opérations CRUD
 */
final class Logger
{
    // Nom des fichiers: MarioLog_MM_YYYY.log
    private const PREFIX = 'MarioLog';

    private static function logDir(): string
    {
        // Services/Logger.php -> Projet/logs
        return realpath(__DIR__ . '/..') . DIRECTORY_SEPARATOR . 'logs';
    }

    private static function ensureDir(): void
    {
        $dir = self::logDir();
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    private static function filePathForNow(): string
    {
        $mm = date('m');
        $yyyy = date('Y');
        return self::logDir() . DIRECTORY_SEPARATOR . self::PREFIX . "_{$mm}_{$yyyy}.log";
    }

    public static function write(string $crud, string $entity, bool $success, string $details = ''): void
    {
        self::ensureDir();

        $crud = strtoupper(trim($crud));
        $entity = strtoupper(trim($entity));
        $status = $success ? 'SUCCESS' : 'FAIL';

        $date = date('Y-m-d H:i:s');

        $details = trim($details);
        $details = $details !== '' ? " | {$details}" : '';

        $line = "[{$date}] {$crud} {$entity} {$status}{$details}\n";
        file_put_contents(self::filePathForNow(), $line, FILE_APPEND | LOCK_EX);
    }

    public static function listFiles(): array
    {
        self::ensureDir();
        $pattern = self::logDir() . DIRECTORY_SEPARATOR . self::PREFIX . "_??_????.log";
        $paths = glob($pattern) ?: [];
        rsort($paths);

        $out = [];
        foreach ($paths as $p) {
            $base = basename($p);
            if (preg_match('/^' . preg_quote(self::PREFIX, '/') . '_(\d{2})_(\d{4})\.log$/', $base, $m)) {
                $out[] = ['file' => $base, 'label' => $m[1] . '/' . $m[2]];
            }
        }
        return $out;
    }

    public static function read(string $file): string
    {
        self::ensureDir();
        $file = basename($file);

        if (!preg_match('/^' . preg_quote(self::PREFIX, '/') . '_\d{2}_\d{4}\.log$/', $file)) {
            return "Fichier de log invalide.";
        }

        $path = self::logDir() . DIRECTORY_SEPARATOR . $file;
        if (!file_exists($path)) {
            return "Ce fichier n'existe pas (encore).";
        }

        return (string)file_get_contents($path);
    }
}
