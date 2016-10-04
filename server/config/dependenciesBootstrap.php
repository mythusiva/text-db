<?
# Include system settings file
include_once __DIR__ . '/../config/settings.php';

# Global constants
define("VIEW_DIR", "../views");
define('MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

use TextDB\AdminService;
use TextDB\Component\Catalogue\Model as CatalogueModel;
use TextDB\Component\Catalogue\Service as CatalogueService;
use TextDB\Component\Database\Entity as DatabaseEntity;
use TextDB\Component\Database\Provider as DatabaseProvider;
use TextDB\Component\Message\Model as MessageModel;
use TextDB\Component\Message\Service as MessageService;
use TextDB\Utils\Properties;

# System settings file
$app['settings'] = function ($c) use ($settings) {
    return $settings;
};

# Database services
$app['databaseProperties'] = function ($c) {
    return new Properties($c['settings']['dbProperties']);
};
$app['databaseEntity'] = function ($c) {
    return new DatabaseEntity($c['databaseProperties']);
};

# DatabaseProvider is a shared resource.
$app['databaseProvider'] = $app->share(function ($c) {
    return new DatabaseProvider($c);
});

# Catalogue component
$app['catalogueModel'] = $app->share(function ($c) {
    return new CatalogueModel($c);
});
$app['catalogueService'] = $app->share(function ($c) {
    return new CatalogueService($c);
});

# Message cvomponent
$app['messageService'] = $app->share(function ($c) {
    return new MessageService($c);
});
$app['messageModel'] = $app->share(function ($c) {
    return new MessageModel($c);
});

#Services
$app['adminService'] = $app->share(function ($c) {
    $dbConnection = $c['databaseProvider']->getDB();
    return new AdminService($dbConnection);
});

# View templating component
$app['viewService'] = $app->share(function () {
    return new League\Plates\Engine(VIEW_DIR);
});
