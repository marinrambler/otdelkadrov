<?php
//Добавление должности
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);

$stmt = $dbh->prepare("INSERT INTO positions (position_name, salary) VALUES(:position_name, :salary)");
$stmt->bindParam(':position_name', $_POST['position_name']);
$stmt->bindParam(':salary', $_POST['salary']);
$stmt->execute();
?>