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

$app->get('/', function () use ($app) {
	$app['viewService']->addData([
		'pageTitle' => 'Admin'
	]);

    return $app['viewService']->render('admin/admin_home');
});

$app->get('/catalogue', function() use ($app) {
	$app['viewService']->addData([
		'pageTitle' => 'Catalogue - Admin'
	]);

	return $app['viewService']->render('admin/catalogue_home');
});


$app->run();