<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Cek mode maintenance
if (file_exists($maintenance = __DIR__.'/../sistem_presensi_dan_dashboard_kerja/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer autoload
require __DIR__.'/../sistem_presensi_dan_dashboard_kerja/vendor/autoload.php';

// Bootstrap Laravel dan handle request
/** @var Application $app */
$app = require_once __DIR__.'/../sistem_presensi_dan_dashboard_kerja/bootstrap/app.php';

$app->handleRequest(Request::capture());
