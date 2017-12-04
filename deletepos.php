<?php
//Удаление должности
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$stmt = $dbh->prepare("DELETE FROM positions WHERE position_id = :position_id");
$stmt->bindParam(':position_id', $_GET['id']);
$stmt->execute();
?>