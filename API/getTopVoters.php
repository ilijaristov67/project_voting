<?php
require_once __DIR__ . "/../autoload.php";

$voter = new Vote($connection, '', '', '', '');

$topVoter = $voter->getTopVoter();
header('Content-Type: application/json');
echo json_encode($topVoter);
