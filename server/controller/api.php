<?php

require __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../config/settings.php';


use Symfony\Component\HttpFoundation\Request;
use TextDB\Utils\Properties;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Database as DatabaseEntity;
use TextDB\Model\CatalogueMessage as CatalogueMessageModel;
use TextDB\Service\CatalogueMessage as CatalogueMessageService;
use TextDB\Entity\Message as MessageEntity;
use TextDB\Model\Message as MessageModel;
use TextDB\Service\Message as MessageService;
use TextDB\Entity\Catalogue as CatalogueEntity;
use TextDB\Model\Catalogue as CatalogueModel;
use TextDB\Service\Catalogue as CatalogueService;
use Symfony\Component\HttpFoundation\JsonResponse as APIResponse;

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
$app['messageModel'] = $app->share(function($c) {
	return new MessageModel($c);
});
$app['messageService'] = $app->share(function($c) {
	return new MessageService($c);
});
$app['catalogueMessageModel'] = $app->share(function($c) {
	return new CatalogueMessageModel($c);
});
$app['catalogueMessageService'] = $app->share(function($c) {
	return new CatalogueMessageService($c);
});



Request::setTrustedProxies($settings['trustedProxies']);

$app->get('/', function () {
    $output = 'Hello World!';

    return $output;
});

### ENDPOINTS ###
/**
 * API Endpoint
 * @param 	string 	$catalogueName Provide a defined catalogue name.
 * @return  MessageEntity[]	Returns a list of messageEntities.
 */
$app->get('/fetchTextsByCatalogue/{catalogueName}', function(Silex\Application $app, $catalogueName) {
	$listOfMessages = $app['catalogueMessageService']->getCatalogueMessages($catalogueName);

	$responseCode = APIResponse::HTTP_OK;
	if(empty($listOfMessages)) {
		$responseCode = APIResponse::HTTP_NOT_FOUND;
	}
	return APIResponse::create(
		$listOfMessages, $responseCode
	); 
});

/**
 * API Endpoint
 * @return  CatalogueEntity[]	Returns a list of catalogueEntities.
 */
$app->get('/fetchListOfCatalogues', function() use ($app) {
	$listOfCatalogues = $app['catalogueService']->getList();

	$responseCode = APIResponse::HTTP_OK;
	if(empty($listOfCatalogues)) {
		$responseCode = APIResponse::HTTP_NOT_FOUND;
	}
	return APIResponse::create(
		$listOfCatalogues, $responseCode
	); 
});


/**
 * API Endpoint
 * @return  MessageEntity[]	Returns a list of catalogueEntities.
 */
$app->get('/fetchAllMessages', function() use ($app) {
	$listOfMessages = $app['messageService']->getList();

	$responseCode = APIResponse::HTTP_OK;
	if(empty($listOfMessages)) {
		$responseCode = APIResponse::HTTP_NOT_FOUND;
	}
	return APIResponse::create(
		$listOfMessages, $responseCode
	); 
});

$app->run();