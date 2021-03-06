<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\JsonResponse as APIResponse;
use Symfony\Component\HttpFoundation\Request;

### APPLICATION ###
$app = new Silex\Application();

$app['debug'] = true;

### DEPENDENCIES ###
require_once '../config/dependenciesBootstrap.php';

Request::setTrustedProxies($settings['trustedProxies']);

$app->get('/', function () {
    $output = 'Hello World!';

    return $output;
});

### ENDPOINTS ###
/**
 * API Endpoint
 * @param     string     $catalogueName Provide a defined catalogue name.
 * @return  MessageEntity[]    Returns a list of messageEntities.
 */
$app->get('/fetchTextsByCatalogue/{catalogueName}', function (Silex\Application $app, $catalogueName) {
    $listOfMessages = $app['messageService']->getByCatalogue($catalogueName);

    $responseCode = APIResponse::HTTP_OK;
    if (empty($listOfMessages)) {
        $responseCode = APIResponse::HTTP_NOT_FOUND;
    }
    return APIResponse::create(
        $listOfMessages, $responseCode
    );
});

/**
 * API Endpoint
 * @return  CatalogueEntity[]    Returns a list of catalogueEntities.
 */
$app->get('/fetchListOfCatalogues', function () use ($app) {
    $catalogueList = $app['adminService']->getCatalogueList();

    $responseCode = APIResponse::HTTP_OK;
    if (empty($catalogueList)) {
        $responseCode = APIResponse::HTTP_NOT_FOUND;
    }
    return APIResponse::create(
        $catalogueList, $responseCode
    );
});

/**
 * API Endpoint
 * @return  MessageEntity[]    Returns a list of catalogueEntities.
 */
$app->get('/fetchAllMessages', function () use ($app) {
    $listOfMessages = $app['messageService']->getList();

    $responseCode = APIResponse::HTTP_OK;
    if (empty($listOfMessages)) {
        $responseCode = APIResponse::HTTP_NOT_FOUND;
    }
    return APIResponse::create(
        $listOfMessages, $responseCode
    );
});

$app->run();
