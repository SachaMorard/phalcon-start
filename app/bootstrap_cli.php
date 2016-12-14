<?php

use Phalcon\Di\FactoryDefault\Cli as FactoryDefault;
use Phalcon\Cli\Console as ConsoleApp;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

/**
 * The FactoryDefault Dependency Injector automatically registers the services that
 * provide a full stack framework. These default services can be overidden with custom ones.
 */
$di = new FactoryDefault();

require BASE_PATH . '/vendor/autoload.php';

/**
 * Include general services
 */
include APP_PATH . '/config/services.php';

/**
 * Include cli environment specific services
 */
//include APP_PATH . '/config/services_cli.php';

/**
 * Include Autoloader
 */
include APP_PATH . '/config/loader_cli.php';

/**
 * Get config service for use in inline setup below
 */
$config = $di->getConfig();

