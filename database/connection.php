<?php
try{
  $db = new PDO('sqlite:../database/database.db');
  } catch (PDOException $e) {
	  echo $e->getMessage();
  };
?>
