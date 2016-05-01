<?php

require __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../config/settings.php';

use Symfony\Component\HttpFoundation\Request;

### APPLICATION ###
$app = new Silex\Application();

$app['debug'] = true;

Request::setTrustedProxies($settings['trustedProxies']);

$app->get('/', function () {
    $output = 'Hello Admin!';

    return $output;
});

$app->run();