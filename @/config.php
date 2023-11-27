<?php
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'vulnshop');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('ERROR_MESSAGE', 'MYSQL Error.');

try {
    $odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $odb->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $odb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $Exception) {
    error_log('ERROR: '.$Exception->getMessage().' - '.$_SERVER['REQUEST_URI'].' at '.date('l jS \of F, Y, h:i:s A')."\n", 3, 'error.log');
    die(ERROR_MESSAGE);
}


?>