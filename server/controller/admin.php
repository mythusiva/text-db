<?php

require __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../config/settings.php';
define("VIEW_DIR","../views");

use Symfony\Component\HttpFoundation\Request;

### APPLICATION ###
$app = new Silex\Application();

$app['debug'] = true;

$app['viewService'] = $app->share(function() use ($app) {
	return new League\Plates\Engine(VIEW_DIR);
});


Request::setTrustedProxies($settings['trustedProxies']);

$app->get('/', function () {
    $output = 'Hello Admin!';

    return $output;
});

$app->get('/admin', function () use ($app) {
	$app['viewService']->addData([
		'pageTitle' => 'Admin Homepage'
	]);

    return $app['viewService']->render('admin/admin_home');
});


$app->run();