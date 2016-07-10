<?
include_once __DIR__ . '/../config/settings.php';

define("VIEW_DIR","../views");

use TextDB\Utils\Properties;
use TextDB\Enum\PluralForms as PluralFormsEnum;
use TextDB\Provider\Storage as StorageProvider;
use TextDB\Entity\Database as DatabaseEntity;
use TextDB\Component\Catalogue\Model as CatalogueModel;
use TextDB\Component\Catalogue\Service as CatalogueService;
use TextDB\Component\Message\Entity as MessageEntity;
use TextDB\Component\Message\Service as MessageService;
use TextDB\Component\Message\Model as MessageModel;

# System settings file
$app['settings'] = function($c) use ($settings) {
  return $settings;
};

# Database services
define('MYSQL_DATETIME_FORMAT','Y-m-d H:i:s');
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

# Catalogue component
$app['catalogueModel'] = $app->share(function($c) {
  return new CatalogueModel($c);
});
$app['catalogueService'] = $app->share(function($c) {
  return new CatalogueService($c);
});

# Message cvomponent
$app['messageService'] = $app->share(function($c) {
  return new MessageService($c);
});
$app['messageModel'] = $app->share(function($c) {
  return new MessageModel($c);
});

# View templating component
$app['viewService'] = $app->share(function() {
  return new League\Plates\Engine(VIEW_DIR);
});