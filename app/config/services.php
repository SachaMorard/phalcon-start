<?php

use Phalcon\Mvc\View\Engine\Volt as VoltEngine;


/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('dbMysql', function () {
    $config = $this->getConfig();
    $params = [
        'host'     => $config->mysql->host,
        'username' => $config->mysql->username,
        'password' => $config->mysql->password,
        'dbname'   => $config->mysql->dbname,
        'charset'  => $config->mysql->charset
    ];
    try{
        $connection = new \Phalcon\Db\Adapter\Pdo\Mysql($params);
    }catch(\Exception $e){
        $connection = new \Phalcon\Db\Adapter\Pdo\Mysql($params);
    }
    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsManager', function () {
    $eventsManager = new Phalcon\Events\Manager();
    $modelsManager = new Phalcon\Mvc\Model\Manager();
    $modelsManager->setEventsManager($eventsManager);

    //Attach a listener to models-manager
    $eventsManager->attach('modelsManager', new Phalcon\Annotations\ModelListener());
    return $modelsManager;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    $config = $this->getConfig();
    if ($config->application->debug) {
        $metaData = new Phalcon\Mvc\Model\Metadata\Memory();
    } else {
        $metaData = new Phalcon\Mvc\Model\Metadata\Files(array(
            'metaDataDir' => $config->application->cacheDir . '/metaData/'
        ));
    }

    //Set a custom meta-data database introspection
    $metaData->setStrategy(new Phalcon\Annotations\ModelStrategy());

    return $metaData;
});

$di->setShared('annotations', function () {
    $config = $this->getConfig();
    if ($config->application->debug) {
        return new Phalcon\Annotations\Adapter\Memory();
    }

    return new Phalcon\Annotations\Adapter\Files(array(
        'annotationsDir' => $config->application->cacheDir . '/annotations/'
    ));
});

/**
 * Configure the Volt service for rendering .volt templates
 */
$di->setShared('voltShared', function ($view) {
    $config = $this->getConfig();

    $volt = new VoltEngine($view, $this);
    $volt->setOptions([
        'compiledPath' => function($templatePath) use ($config) {

            // Makes the view path into a portable fragment
            $templateFrag = str_replace($config->application->appDir, '', $templatePath);

            // Replace '/' with a safe '%%'
            $templateFrag = str_replace('/', '%%', $templateFrag);

            return $config->application->cacheDir . 'volt/' . $templateFrag . '.php';
        }
    ]);

    return $volt;
});


$di->setShared('errorLogger', function ()  {
    $config =  $this->getConfig();
    $logger = new Phalcon\Logger\Adapter\File($config->application->logsDir.'errors.log');
    $logger->setLogLevel($config->errorLogger->level);
    return $logger;
});
