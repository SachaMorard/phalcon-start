<?php

if (isset($_SERVER['ENV_TESTING']) && $_SERVER['ENV_TESTING'] === 'acceptance') {
    phpinfo();
} else {
    $error = 404;
    header("HTTP/1.0 404 Not Found");
    echo include 'error.php';
}