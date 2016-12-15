<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Models' => APP_PATH . '/common/models/',
    'Migrations' => APP_PATH . '/cli/migrations/',
    'Commands' => APP_PATH . '/cli/commands/',
    'PhalconStart'        => APP_PATH . '/common/library/'
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'PhalconStart\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php'
]);

$loader->register();

