<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\JsonResponse as APIResponse;
use Symfony\Component\HttpFoundation\Request;
use TextDB\Component\Catalogue\Entity as CatalogueEntity;
use TextDB\Component\Message\Entity as MessageEntity;
use TextDB\Utils\Properties;

### APPLICATION ###
$app = new Silex\Application();

$app['debug'] = true;

### DEPENDENCIES ###
require_once '../config/dependenciesBootstrap.php';

Request::setTrustedProxies($settings['trustedProxies']);

$app->get('/', function () use ($app) {
    $app['viewService']->addData([
        'pageTitle' => 'Admin',
        'menuActive' => 'overview',
    ]);

    return $app['viewService']->render('admin/admin_home');
});

$app->get('/catalogue', function () use ($app) {
    $catalogueListItems = $app['adminService']->getCatalogueList();
    $app['viewService']->addData([
        'pageTitle' => 'Catalogue - Admin',
        'menuActive' => 'catalogue-add',
        'catalogueListItems' => $catalogueListItems,
    ]);

    return $app['viewService']->render('admin/catalogue_home');
});

$app->get('/message', function () use ($app) {

    $catalogueList = $app['adminService']->getCatalogueList();
    $messageListItems = $app['messageService']->getLastModifiedMessages();

    $app['viewService']->addData([
        'pageTitle' => 'Message - Admin',
        'menuActive' => 'message-add',
        'catalogueList' => $catalogueList,
        'messageListItems' => $messageListItems,
    ]);

    return $app['viewService']->render('admin/message_home');
});

# AJAX calls
$app->post('/createCatalogue', function (Request $request) use ($app) {
    $catalogueName = $request->get('name');

    try {
        $catalogueProperty = new Properties([
            'catalogueName' => $catalogueName,
        ]);

        $catalogueEntity = new CatalogueEntity($catalogueProperty);

        $app['catalogueService']->create($catalogueEntity);

        return APIResponse::create([
            'success' => true,
        ], APIResponse::HTTP_OK);

    } catch (Exception $e) {
        return APIResponse::create([
            'message' => $e->getMessage(),
            'success' => false,
        ], APIResponse::HTTP_BAD_REQUEST);
    }
});

$app->post('/createMessage', function (Request $request) use ($app) {

    $catalogueName = $request->get('catalogue_name');
    $isPlural = $request->get('is_plural_form');
    $messagesArray = $request->get('messages');

    try {

        foreach ($messagesArray as $msgKey => $msgText) {
            $messageProperty = new Properties([
                'identifier' => $msgKey,
                'text' => $msgText,
                'locale' => $app['settings']['defaultLocale'],
                'catalogueName' => $catalogueName,
                'isPluralForm' => ($isPlural === 'true') ? MessageEntity::PLURAL_FORM_ON : MessageEntity::PLURAL_FORM_OFF,
            ]);

            $messageEntity = new MessageEntity($messageProperty);

            $app['messageService']->create($messageEntity);
        }

    } catch (Exception $e) {
        return APIResponse::create([
            'message' => $e->getMessage(),
            'success' => false,
        ], APIResponse::HTTP_BAD_REQUEST);
    }

    return APIResponse::create([
        'success' => true,
    ], APIResponse::HTTP_OK);

});

$app->run();
