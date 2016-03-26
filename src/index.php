<?php

require __DIR__ . '/../vendor/autoload.php';

use TextDB\Utils\Properties;
use TextDB\Entity\Database as DatabaseEntity;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Model\Catalogue as CatalogueModel;
use TextDB\Model\Message as MessageModel;
use TextDB\Service\Catalogue as CatalogueService;
use TextDB\Service\CatalogueMessage as CatalogueMessageService;

$databasePath = realpath(__DIR__ . '/../data/default.s3db');

$dependencyContainer = new Pimple();
$dependencyContainer['databaseProperties'] = function($c) use ($databasePath) {
	return new Properties([
		'driver' => 'sqlite',
		'database' => $databasePath
	]);
};
$dependencyContainer['databaseEntity'] = $dependencyContainer->share(function($c) {
	return new DatabaseEntity($c['databaseProperties']);
});
$dependencyContainer['storageProvider'] = $dependencyContainer->share(function($c) {
	return new StorageProvider($c);
});
$dependencyContainer['catalogueModel'] = $dependencyContainer->share(function($c) {
	return new CatalogueModel($c);
});
$dependencyContainer['messageModel'] = $dependencyContainer->share(function($c) {
	return new MessageModel($c);
});


/**
 * @var CatalogueMessageService
 */
$catalogueMessageService = new CatalogueMessageService($dependencyContainer);
$catalogueMessageService->createCatalogueMessage(
  	$catalogueName = 'test1-catalogue',
  	'homepage-text',
  	'welcome to the homepage',
  	'en-US'
);
