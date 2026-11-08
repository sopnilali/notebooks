<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run the application
|--------------------------------------------------------------------------
|
| Vercel passes the original request URL through the X-Vercel-Original-URL
| header. Laravel needs REQUEST_URI / PATH_INFO to route correctly, so we
| restore it from that header before handing the request to the kernel.
|
*/

$request = Request::capture();

$originalUrl = $_SERVER['HTTP_X_VERCEL_ORIGINAL_URL'] ?? null;

if ($originalUrl) {
    $parsed = parse_url($originalUrl);

    $request->server->set('REQUEST_URI', $originalUrl);
    $request->server->set('PATH_INFO', $parsed['path'] ?? '/');
    $request->server->set('SCRIPT_NAME', '');
    $request->server->set('QUERY_STRING', $parsed['query'] ?? '');
}

$kernel = $app->make(Kernel::class);

$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);
