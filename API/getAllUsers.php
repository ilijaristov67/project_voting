<?php
require_once __DIR__ . "/../autoload.php";

$employee = new Employee($connection, '', '', '', '');

$employees = $employee->getAllUsers();
header('Content-Type: application/json');
echo json_encode($employees);
