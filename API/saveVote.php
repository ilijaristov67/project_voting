<?php
require_once __DIR__ . "/../autoload.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['errors' => 'Invalid Request Method']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$errors = [];

if (empty($data['voter_id'])) {
    $errors[] = ['error' => true, 'message' => 'Missing voter parameter'];
}

if (empty($data['nominee_id'])) {
    $errors[] = ['error' => true, 'message' => 'Please select a colleague you like to vote for'];
}

if (empty($data['category_id'])) {
    $errors[] = ['error' => true, 'message' => 'Missing category parameter'];
}

if (empty($data['comment']) || trim($data['comment']) === '') {
    $errors[] = ['error' => true, 'message' => 'Comment cannot be empty.'];
}

if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    exit;
}

$vote = new Vote($connection, $data['voter_id'], $data['nominee_id'], $data['category_id'], $data['comment']);

if ($vote->saveVote()) {
    echo json_encode(['success' => true, 'message' => 'Vote saved successfully']);
    exit;
}

echo json_encode(['errors' => true, 'message' => 'Failed to save vote']);
