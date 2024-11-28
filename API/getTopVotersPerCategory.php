<?php
require_once __DIR__ . "/../autoload.php";



$voter = new Vote($connection, '', '', '', '');

$topVoters = $voter->getTopVotedPeopleByCategory();

header('Content-Type: application/json');

echo json_encode($topVoters);
