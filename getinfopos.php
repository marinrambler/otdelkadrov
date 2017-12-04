<?php
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$stmt = $dbh->prepare("SELECT position_name, salary FROM positions WHERE position_id = :position_id");
$stmt->bindParam(':position_id', $_GET['id']);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_OBJ);
echo <<<EOT
    <h3>$row->position_name</h3>
    <br>
    <h4>$row->salary<span class="glyphicon glyphicon-ruble" aria-hidden="true"></span></h4>
EOT;
?>