<?php
//Удаление магазина
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$stmt = $dbh->prepare("DELETE FROM facilities WHERE facility_id = :facility_id");
$stmt->bindParam(':facility_id', $_GET['id']);
$stmt->execute();
?>