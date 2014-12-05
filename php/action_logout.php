<?php
include_once("templates/secureSessionStart.php");

$session = session_destroy();

echo "Session: $session <br>";
$user =  $_SESSION['username'];
echo "user: $user <br>";

header('Location: pollsListPage.php');
?>
