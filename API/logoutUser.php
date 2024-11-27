<?php
require_once __DIR__ . "/../autoload.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['errors' => 'Invalid Request Method']);
    exit;
} else {
    session_unset();
    session_destroy();
    echo json_encode(['success' => true]);
    exit;
}
