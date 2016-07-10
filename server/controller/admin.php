<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use TextDB\Utils\Properties;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Database as DatabaseEntity;
use TextDB\Model\Catalogue as CatalogueModel;
use TextDB\Service\Catalogue as CatalogueService;
use TextDB\Entity\Message as MessageEntity;
use TextDB\Enum\PluralForms as PluralFormsEnum;
use TextDB\Service\Message as MessageService;
use TextDB\Model\Message as MessageModel;

### APPLICATION ###
$app = new Silex\Application();

$app['debug'] = true;

### DEPENDENCIES ###
require_once('../config/dependenciesBootstrap.php');

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
  
  $catalogueName  = $request->get('catalogue_name');
  $isPlural       = $request->get('is_plural_form');
  $messagesArray  = $request->get('messages');

  try {

    foreach ($messagesArray as $msgKey => $msgText) {
      $messageProperty = new Properties([
        'identifier' => $msgKey,
        'text' => $msgText,
        'locale' => $app['settings']['defaultLocale'],
        'catalogueName' => $catalogueName,
        'isPluralForm' => ($isPlural === 'true') ? 1 : 0
      ]);

      $messageEntity = new MessageEntity($messageProperty);

      var_dump($messageEntity);

      $app['messageService']->create($messageEntity);
    }

  } catch (Exception $e) {
    return JsonResponse::create([
      'message' => $e->getMessage(),
      'success' => false
    ], 400);
  }

  return JsonResponse::create([
    'success' => true
  ], 200);

});


$app->run();