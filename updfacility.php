<?php
//Редактирование магазина
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$sql = $dbh->prepare('SELECT city_id FROM cities WHERE city_name = :city_name');
$sql->bindParam(':city_name', $_POST['city_id']);
$sql->execute();
$facility=$sql->fetch(PDO::FETCH_OBJ);

$stmt = $dbh->prepare("UPDATE facilities SET facility_name = :facility_name, facility_address = :facility_address, city_id = :city_id WHERE facility_id = :facility_id");
$stmt->bindParam(':facility_id', $_POST['id']);
$stmt->bindParam(':facility_name', $_POST['facility_name']);
$stmt->bindParam(':facility_address', $_POST['facility_address']);
$stmt->bindParam(':city_id', $facility->city_id);
$stmt->execute();
?>