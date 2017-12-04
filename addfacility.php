<?php
//Добавление магазина
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$sql = $dbh->prepare('SELECT city_id FROM cities WHERE city_name = :city_name');
$sql->bindParam(':city_name', $_POST['city_id']);
$sql->execute();
$facility=$sql->fetch(PDO::FETCH_OBJ);

$stmt = $dbh->prepare("INSERT INTO facilities (facility_name, facility_address, city_id) VALUES(:facility_name, :facility_address, :city_id)");
$stmt->bindParam(':facility_name', $_POST['facility_name']);
$stmt->bindParam(':facility_address', $_POST['facility_address']);
$stmt->bindParam(':city_id', $facility->city_id);
$stmt->execute();
?>