<?php
require_once __DIR__ . "/db_connection/db.php";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$connectionObj = new dbConnect('mysql', 'localhost', 'pabau');
$connectionObj->dbConnect();
$connection = $connectionObj->getConnection();
var_dump($connection);
