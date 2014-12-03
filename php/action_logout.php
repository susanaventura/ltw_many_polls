<?php
session_start();

$session = session_destroy();

echo "Session: $session <br>";
$user =  $_SESSION['username'];
echo "user: $user <br>";

header('Location: editPollPage.php');
?>
