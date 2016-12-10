<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'PhalconStart\Models' => APP_PATH . '/common/models/',
    'PhalconStart'        => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'PhalconStart\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'PhalconStart\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
