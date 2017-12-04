<?php
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$stmt = $dbh->prepare("SELECT facility_name, facility_address, city_name FROM facilities JOIN cities ON facilities.city_id = cities.city_id WHERE facility_id = :facility_id");
$stmt->bindParam(':facility_id', $_GET['id']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_OBJ);
echo <<<EOT
    <h3>$row->facility_name</h3>
    <br>
    <h4>$row->city_name, $row->facility_address</h4>
EOT;
?>