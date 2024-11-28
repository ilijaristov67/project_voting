<?php
require_once __DIR__ . "/../autoload.php";

$category = new Category($connection, '');

$categories = $category->getAllCategories();
header('Content-Type: application/json');
echo json_encode($categories);
