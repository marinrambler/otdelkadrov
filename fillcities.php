<?php
//Заполнение городов значениями из словаря
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
$allcities = file_get_contents('cities.txt');
$cities = explode("|", $allcities);
foreach($cities as $city){
    $stmt = $dbh->prepare("INSERT INTO cities (city_id, city_name) VALUES (NULL, :name)");
    $stmt->bindParam(':name', $city);
    $stmt->execute();
}
echo "ok";
?>