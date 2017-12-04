<?php
//Отображение информации о сотруднике
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$stmt = $dbh->prepare("SELECT worker_sname, worker_name, worker_tname, position_name, salary, facility_name, address FROM workers JOIN positions ON workers.position_id = positions.position_id JOIN facilities ON workers.facility_id = facilities.facility_id WHERE worker_id = :worker_id");
$stmt->bindParam(':worker_id', $_GET['id']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_OBJ);
echo <<<EOT
    <h3>$row->worker_sname $row->worker_name $row->worker_tname</h3>
    <br>
    <h4>$row->facility_name</h4>
    <br>
    <h4>$row->position_name: оклад $row->salary<span class="glyphicon glyphicon-ruble" aria-hidden="true"></span></h4>
    <br>
    <h5>Адрес: $row->address</h5>
EOT;
?>