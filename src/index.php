<?php

require __DIR__ . '/../vendor/autoload.php';

use TextDB\Utils\Properties;
use TextDB\Entity\Database as DatabaseEntity;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Model\Catalogue as CatalogueModel;
use TextDB\Service\Catalogue as CatalogueService;

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
$dependencyContainer['catalogModel'] = $dependencyContainer->share(function($c) {
	return new CatalogueModel($c);
});

/**
 * @var CatalogueService
 */
$catalogueService = new CatalogueService($dependencyContainer);
$catalogueService->create($name="test1-catalogue");