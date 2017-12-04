<?php
//Удаление сотрудника
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$stmt = $dbh->prepare("DELETE FROM workers WHERE worker_id = :worker_id");
$stmt->bindParam(':worker_id', $_GET['id']);
$stmt->execute();
?>