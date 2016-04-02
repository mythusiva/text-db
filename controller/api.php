<?php

require __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../config/settings.php';


use Symfony\Component\HttpFoundation\Request;
use TextDB\Utils\Properties;
use TextDB\Entity\Database as DatabaseEntity;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Message as MessageEntity;
use TextDB\Service\CatalogueMessage as CatalogueMessageService;
use TextDB\Model\CatalogueMessage as CatalogueMessageModel;
use TextDB\Model\Catalogue as CatalogueModel;
use TextDB\Model\Message as MessageModel;
use Symfony\Component\HttpFoundation\JsonResponse as APIResponse;

### DEPENDENCIES ###
$dependencyContainer = new Pimple();
$dependencyContainer['settings'] = function($c) use ($settings) {
	return $settings;
};
$dependencyContainer['databaseProperties'] = function($c) {
	return new Properties($c['settings']['dbProperties']);
};
$dependencyContainer['databaseEntity'] = function($c) {
	return new DatabaseEntity($c['databaseProperties']);
};
# StorageProvider is a shared resource.
$dependencyContainer['storageProvider'] = $dependencyContainer->share(function($c) {
	return new StorageProvider($c);
});

$dependencyContainer['catalogueModel'] = $dependencyContainer->share(function($c) {
	return new CatalogueModel($c);
});
$dependencyContainer['messageModel'] = $dependencyContainer->share(function($c) {
	return new MessageModel($c);
});
$dependencyContainer['catalogueMessageModel'] = $dependencyContainer->share(function($c) {
	return new CatalogueMessageModel($c);
});


### APPLICATION ###
$app = new Silex\Application();

$app['debug'] = true;

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
$app->get('/getCatalogue/{catalogueName}', function(Silex\Application $app, $catalogueName) use ($dependencyContainer) {
	$catalogueMessageService = new CatalogueMessageService($dependencyContainer);
	$listOfMessages = $catalogueMessageService->getCatalogueMessages($catalogueName);

	$responseCode = APIResponse::HTTP_OK;
	if(empty($listOfMessages)) {
		$responseCode = APIResponse::HTTP_NOT_FOUND;
	}
	return APIResponse::create(
		$listOfMessages, $responseCode
	); 
});

$app->get('/listCatalogues', function() use ($dependencyContainer) {

});

$app->run();






// use TextDB\Utils\Properties;
// use TextDB\Entity\Database as DatabaseEntity;
// use TextDB\Provider\Storage as StorageProvider;
// use TextDB\Model\Catalogue as CatalogueModel;
// use TextDB\Model\Message as MessageModel;
// use TextDB\Service\Catalogue as CatalogueService;
// use TextDB\Service\CatalogueMessage as CatalogueMessageService;
// use TextDB\Model\CatalogueMessage as CatalogueMessageModel;

// $databasePath = realpath(__DIR__ . '/../data/default.s3db');

// $dependencyContainer = new Pimple();
// $dependencyContainer['databaseProperties'] = function($c) use ($databasePath) {
// 	return new Properties([
// 		'driver' => 'sqlite',
// 		'database' => $databasePath
// 	]);
// };
// $dependencyContainer['databaseEntity'] = $dependencyContainer->share(function($c) {
// 	return new DatabaseEntity($c['databaseProperties']);
// });
// $dependencyContainer['storageProvider'] = $dependencyContainer->share(function($c) {
// 	return new StorageProvider($c);
// });
// $dependencyContainer['catalogueModel'] = $dependencyContainer->share(function($c) {
// 	return new CatalogueModel($c);
// });
// $dependencyContainer['messageModel'] = $dependencyContainer->share(function($c) {
// 	return new MessageModel($c);
// });




// $catalogueModel = new CatalogueModel($dependencyContainer);
// $catalogues = $catalogueModel->getCatalogueList();

// $catalogue = array_pop($catalogues);

// $catalogueMessages = new CatalogueMessageModel($dependencyContainer);

// var_dump($catalogueMessages->getCatalogueMessages($catalogue));