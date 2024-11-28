<?php
require_once __DIR__ . "/../autoload.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['errors' => 'Invalid Request Method']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$errors = [];

if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(['errors' => 'Email and password are required']);
    exit;
}

$email = $data['email'];
$password = $data['password'];

$user = new Employee($connection, '', '', $email, $password);

$authenticatedUser = $user->authenticateUser();

if ($authenticatedUser) {
    $_SESSION['email'] = $authenticatedUser['email'];
    $_SESSION['id'] = $authenticatedUser['id'];
    echo json_encode(['success' => true, 'message' => 'Login successful', 'user' => $authenticatedUser]);
} else {
    echo json_encode(['success' => false, 'errors' => ['message' => 'Invalid email or password']]);
}
