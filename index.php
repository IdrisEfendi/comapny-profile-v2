<?php

// --------------------------------------------------------------
// Catat timer awal (untuk benchmark)
// --------------------------------------------------------------
define('RAKIT_START', microtime(true));

// Rakit targets older PHP versions; suppress PHP 8.4 deprecation output
// before framework files are loaded so headers and responses remain valid.
error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

// --------------------------------------------------------------
// Definisikan konstanta untuk directory separator.
// --------------------------------------------------------------
define('DS', DIRECTORY_SEPARATOR);

// --------------------------------------------------------------
// Include konstanta path milik framework.
// --------------------------------------------------------------
require 'paths.php';

// --------------------------------------------------------------
// Muat Composer Autoload + Dotenv sebelum framework membaca config.
// --------------------------------------------------------------
if (is_file($autoload = __DIR__.'/vendor/autoload.php')) {
    require_once $autoload;

    if (class_exists('Dotenv\\Dotenv')) {
        Dotenv\Dotenv::createImmutable(__DIR__)->safeLoad();
    }

    unset($autoload);
}

// --------------------------------------------------------------
// Jalankan frameworknya.
// --------------------------------------------------------------
require path('system').'boot.php';
