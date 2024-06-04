<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Визначте, чи програма перебуває в режимі обслуговування...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Зареєструйте автозавантажувач Composer...
require __DIR__.'/../vendor/autoload.php';

// Завантажте Laravel і обробіть запит...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
