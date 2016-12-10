<?php

if (isset($_SERVER['ENV_TESTING']) && $_SERVER['ENV_TESTING'] === 'acceptance') {
    require __DIR__ . '/../c3.php';
    if (isset($_COOKIE['APP_NAME'])) {
        $_SERVER['APP_NAME'] = $_COOKIE['APP_NAME'];
    }
    function errHandle($errNo, $errStr, $errFile, $errLine)
    {
        $msg = "$errStr in $errFile on line $errLine";
        if ($errNo == E_NOTICE) {
            if ($errNo == E_NOTICE && strpos($errStr, 'geoip_record_by_name') === 0) {
                return;
            } else {
                die('E_NOTICE: ' . $msg);
            }

        } elseif ($errNo == E_WARNING) {
            die('E_WARNING: ' . $msg);
        }
    }
} else {
    function errHandle($errNo, $errStr, $errFile, $errLine)
    {
        if ($errNo == E_NOTICE && strpos($errStr, 'geoip_record_by_name') === 0) {
            return;
        }
    }
}

set_error_handler('errHandle');

require '../app/bootstrap_web.php';
