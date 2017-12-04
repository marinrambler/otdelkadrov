<?php
//Добавление нового сотрудника
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$sql = $dbh->prepare('SELECT facility_id FROM facilities WHERE facility_name = :facility_name');
$sql->bindParam(':facility_name', $_POST['facility']);
$sql->execute();
$facility=$sql->fetch(PDO::FETCH_OBJ);

$sql = $dbh->prepare('SELECT position_id FROM positions WHERE position_name = :position_name');
$sql->bindParam(':position_name', $_POST['position']);
$sql->execute();
$position=$sql->fetch(PDO::FETCH_OBJ);

$stmt = $dbh->prepare("INSERT INTO workers (worker_id, worker_name, worker_sname, worker_tname, address, position_id, facility_id, on_vacation) VALUES (NULL, :worker_name, :worker_sname, :worker_tname, :address, :position_id, :facility_id, :on_vacation)");
$stmt->bindParam(':worker_name', $_POST['firstName']);
$stmt->bindParam(':worker_tname', $_POST['middleName']);
$stmt->bindParam(':worker_sname', $_POST['lastName']);
$stmt->bindParam(':address', $_POST['address']);
$stmt->bindParam(':position_id', $position->position_id);
$stmt->bindParam(':facility_id', $facility->facility_id);
if($_POST['on_vacation'] == "Да")
    $onVacation = 1;
else
    $onVacation = 0;
$stmt->bindParam(':on_vacation', $onVacation);
$stmt->execute();
?>