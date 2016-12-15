<?php

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'mysql' => [
        'adapter'  => 'Mysql',
        'host'     => 'mysql',
        'username' => 'phalcon-start',
        'password' => 'phalcon-start',
        'dbname'   => 'phalcon-start',
        'charset'  => 'utf8',
    ],

    'cassandra' => [
        'adapter' => 'Cassandra',
        'hosts' => [ 'cassandra'],
        'keyspace' => 'test',
        'consistency' => 'ONE', // Infos here \cassandra\ConsistencyLevel
        'retryPolicies' => 'DefaultPolicy',
    ],

    'application' => [
        'appDir'         => APP_PATH . '/',
        'modelsDir'      => APP_PATH . '/common/models/',
        'migrationsDir'  => APP_PATH . '/cli/migrations/',
        'cacheDir'       => BASE_PATH . '/var/cache/',
        'logsDir'        => BASE_PATH . '/var/logs/',

        // This allows the baseUri to be understand project paths that are not in the root directory
        // of the webpspace.  This will break if the public/index.php entry point is moved or
        // possibly if the web server rewrite rules are changed. This can also be set to a static path.
        'baseUri'        => preg_replace('/web([\/\\\\])index.php$/', '', $_SERVER["PHP_SELF"]),

        'debug' => true
    ],

    /**
     * if true, then we print a new line at the end of each CLI execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    'printNewLine' => true,

    /**
     * SPECIAL = 9
     * CUSTOM = 8
     * DEBUG = 7
     * INFO = 6
     * NOTICE = 5
     * WARNING = 4
     * ERROR = 3
     * ALERT = 2
     * CRITICAL = 1
     * EMERGENCY = 0
     */
    'errorLogger' => [
        'level' => 9
    ],
]);
