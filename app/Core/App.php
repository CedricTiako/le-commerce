<?php

namespace App\Core;

/**
 * Bootstrap de l'application
 */
class App
{
    public static function boot(): void
    {
        self::loadEnv();

        $appConfig = require dirname(__DIR__, 2) . '/config/app.php';

        date_default_timezone_set($appConfig['timezone']);

        if ($appConfig['debug']) {
            ini_set('display_errors', '1');
            error_reporting(E_ALL);
        } else {
            ini_set('display_errors', '0');
        }

        session_start();
    }

    /**
     * Charge les variables du fichier .env dans l'environnement (getenv/$_ENV),
     * car aucune dépendance externe (phpdotenv) n'est utilisée.
     */
    private static function loadEnv(): void
    {
        $envFile = dirname(__DIR__, 2) . '/.env';

        if (!file_exists($envFile)) {
            error_log("[App::loadEnv] Fichier .env introuvable : $envFile");
            return;
        }

        $vars = parse_ini_file($envFile);

        if ($vars === false) {
            error_log("[App::loadEnv] Échec du parsing de .env (syntaxe INI invalide) : $envFile");
            return;
        }

        foreach ($vars as $key => $value) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }

        error_log('[App::loadEnv] .env chargé (' . count($vars) . ' variables) : ' . implode(', ', array_keys($vars)));
    }

    /**
     * Autoloader maison (aucune dépendance à Composer) : mappe le namespace
     * App\... vers le dossier /app en respectant l'arborescence PSR-4.
     */
    public static function registerAutoloader(): void
    {
        spl_autoload_register(function (string $class) {
            $prefix  = 'App\\';
            $baseDir = dirname(__DIR__) . '/';

            if (!str_starts_with($class, $prefix)) {
                return;
            }

            $relative = substr($class, strlen($prefix));
            $file = $baseDir . str_replace('\\', '/', $relative) . '.php';

            if (file_exists($file)) {
                require $file;
            }
        });
    }
}
