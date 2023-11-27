<?php
if (basename($_SERVER['SCRIPT_FILENAME']) == basename(__FILE__)) exit("NOT ALLOWED");

define('DIRECT', TRUE);
require 'funcs.php';
$user = new user;


?>