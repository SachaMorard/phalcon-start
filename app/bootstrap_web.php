<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');


try {

    /**
     * The FactoryDefault Dependency Injector automatically registers the services that
     * provide a full stack framework. These default services can be overidden with custom ones.
     */
    $di = new FactoryDefault();

    require BASE_PATH . '/vendor/autoload.php';

    /**
     * Include general services
     */
    require APP_PATH . '/config/services.php';

    /**
     * Include web environment specific services
     */
    require APP_PATH . '/config/services_web.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Register application modules
     */
    $application->registerModules([
        'frontend' => ['className' => 'PhalconStart\Modules\Frontend\Module'],
    ]);

    /**
     * Include routes
     */
    require APP_PATH . '/config/routes.php';

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    /** @var \Phalcon\Logger\Adapter\File $logger */
    $logger = $di->getErrorLogger();
    $logger->error($e->getMessage());

    /** Log the exception **/
    if ($config->application->debug) {
        header("HTTP/1.0 500 Internal Server Error");
        if(isset($e->xdebug_message)) {
            print_r('<pre>');
            print_r('<table>'.$e->xdebug_message.'</table>');
            print_r('</pre>');
        }else{
            print_r('<pre>');
            print_r('Message: ' . $e->getMessage() . PHP_EOL);
            print_r('File: ' . $e->getFile() . PHP_EOL);
            print_r('Line: ' . $e->getLine() . PHP_EOL);
            print_r('Trace: ' . PHP_EOL . $e->getTraceAsString() . PHP_EOL);
            print_r('</pre>');
        }
    } else {
        $error = 500;
        header("HTTP/1.0 500 Internal Server Error");
        echo include 'error.php';

    }
}
