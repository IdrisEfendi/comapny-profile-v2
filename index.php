<?php

// --------------------------------------------------------------
// Catat timer awal (untuk benchmark)
// --------------------------------------------------------------
define('RAKIT_START', microtime(true));

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
