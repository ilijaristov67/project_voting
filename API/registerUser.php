<?php
require_once __DIR__ . "/../autoload.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['errors' => 'Invalid Request Method']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$errors = [];

if (empty($data['first_name'])) {
    $errors[] = ['error' => true, 'message' => 'Missing first name parameter'];
}

if (empty($data['last_name'])) {
    $errors[] = ['error' => true, 'message' => 'Missing surname parameter'];
}


if (empty($data['email'])) {
    $errors[] = ['error' => true, 'message' => 'Missing email parameter'];
}

if (empty($data['password'])) {
    $errors[] = ['error' => true, 'message' => 'Missing password parameter'];
}

if (!empty($errors)) {

    echo json_encode(['errors' => $errors]);
    exit;
}

$user = new Employee($connection, trim(ucfirst($data['first_name'])), trim(ucfirst($data['last_name'])), trim($data['email']), $data['password']);

if ($user->saveUser()) {
    echo json_encode(['success' => true, 'message' => 'Account created']);
    exit;
}

echo json_encode(['errors' => true, 'message' => 'Account was not created']);
