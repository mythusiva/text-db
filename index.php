<?php

require(__DIR__ . '/src/TextDB/Entity/Database.php');
require(__DIR__ . '/src/TextDB/Providers/Storage.php');

use TextDB\Entity\Database as Database;
use TextDB\Providers\Storage as StorageProvider;

$databaseConfig = new Database();
$databaseConfig->driver = 'sqlite';
$databaseConfig->database = 'data/default.s3db';
$newStorage = new StorageProvider($databaseConfig);
