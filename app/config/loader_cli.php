<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'PhalconStart\Models' => APP_PATH . '/common/models/',
    'PhalconStart'        => APP_PATH . '/common/library/',
    'Phalcon'             => BASE_PATH . '/cli/Phalcon/'
]);

$loader->registerDirs([BASE_PATH . '/cli/']);

/**
 * Register module classes
 */
$loader->registerClasses([
    'PhalconStart\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php'
]);

$loader->register();

