<?php

define('YAPIM_MODU', true);
////////////////////////////////
if (YAPIM_MODU == true) {
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');
} else {
    error_reporting(0);
    ini_set('display_errors', 'Off');
    ini_set('log_errors', 'Off');
}

try {
    $db = new PDO("mysql:host=localhost;dbname=cs353_accomme;charset=utf8", "cs353", "dbproject");
} catch (PDOException $e) {
    print $e->getMessage();
}