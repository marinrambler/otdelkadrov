<?php
//Редактирование должности
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);

$stmt = $dbh->prepare("UPDATE positions SET position_name = :position_name, salary = :salary WHERE position_id = :position_id");
$stmt->bindParam(':position_id', $_POST['id']);
$stmt->bindParam(':position_name', $_POST['position_name']);
$stmt->bindParam(':salary', $_POST['salary']);
$stmt->execute();
?>