<?php
include("config.php");
$dbh = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $user, $pass);
include("template/header.php"); //Панель навигации
if (isset($_GET["route"])){
    include("pages/".$_GET["route"].".php");
} else {
    include("pages/info.php"); //Открывать страницу информации в случае, если страница не выбрана
}
include("template/footer.php");
?>