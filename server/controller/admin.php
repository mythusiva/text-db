<?php

require __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../config/settings.php';
define("VIEW_DIR","../views");

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use TextDB\Utils\Properties;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Database as DatabaseEntity;
use TextDB\Model\Catalogue as CatalogueModel;
use TextDB\Service\Catalogue as CatalogueService;

### APPLICATION ###
$app = new Silex\Application();

$app['debug'] = true;

### DEPENDENCIES ###
$app['settings'] = function($c) use ($settings) {
  return $settings;
};
$app['databaseProperties'] = function($c) {
  return new Properties($c['settings']['dbProperties']);
};
$app['databaseEntity'] = function($c) {
  return new DatabaseEntity($c['databaseProperties']);
};
# StorageProvider is a shared resource.
$app['storageProvider'] = $app->share(function($c) {
  return new StorageProvider($c);
});
$app['catalogueModel'] = $app->share(function($c) {
  return new CatalogueModel($c);
});
$app['catalogueService'] = $app->share(function($c) {
  return new CatalogueService($c);
});
$app['viewService'] = $app->share(function() {
  return new League\Plates\Engine(VIEW_DIR);
});

Request::setTrustedProxies($settings['trustedProxies']);

$app->get('/', function () use ($app) {
	$app['viewService']->addData([
		'pageTitle' => 'Admin',
		'menuActive' => 'overview'
	]);

    return $app['viewService']->render('admin/admin_home');
});

$app->get('/catalogue', function() use ($app) {
	$app['viewService']->addData([
		'pageTitle' => 'Catalogue - Admin',
		'menuActive' => 'catalogue'
	]);

	return $app['viewService']->render('admin/catalogue_home');
});


$app->get('/message', function() use ($app) {

  $catalogueList = $app['catalogueService']->getList();

	$app['viewService']->addData([
		'pageTitle' => 'Message - Admin',
		'menuActive' => 'message',
    'catalogueList' => $catalogueList 
	]);

	return $app['viewService']->render('admin/message_home');
});


# AJAX calls
$app->post('/createCatalogue', function(Request $request) use ($app) {
	$catalogueName = $request->get('name');

  try {

    $app['catalogueService']->create($catalogueName);
    
    return JsonResponse::create([
      'catalogueName' => $catalogueName,
      'success' => true
    ], 200);

  } catch (Exception $e) {
    return JsonResponse::create([
      'catalogueName' => $catalogueName,
      'message' => $e->getMessage(),
      'success' => false
    ], 400);
  }
});

$app->post('/createMessage', function(Request $request) use ($app) {
  
  $catalogueName = $request->get('catalogue_name');
  $isPlural     = $request->get('is_plural_form');
  $messageKey   = $request->get('message_key');
  $messageText  = $request->get('message_text');

  var_dump($messageKey);

  return JsonResponse::create([
    'success' => true
  ], 200);

});


$app->run();