<?php

$settings['defaultLocale'] = "en-US";

/** 
 * If your application is hosted behind a reverse proxy at address $ip, 
 * and you want to trust the X-Forwarded-For* headers,
 * you will need to specify a string list of ip addresses.
 */
$settings['trustedProxies'] = [];

/**
 * Database settings. 
 * By default this application uses sqlite, stored in the /data directory.
 * @see Refer to /src/TextDB/Entity/Database for all possible properties.
 */
$settings['dbProperties'] = [
	'driver' => 'sqlite',
	'database' => realpath(__DIR__ . '/../data/default.s3db')
];