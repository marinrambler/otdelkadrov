<?php
switch($_GET["route"]) {
    case "info":
        $i = 1;
        break;
    case "facilities":
        $i = 2;
        break;
    case "positions":
        $i = 3;
        break;
    case "workers":
        $i = 4;
        break;
    default:
        $i = 1;
        break;
}
$aciveClass = " active";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Детский мир</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-dialog.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
      <div class="container">
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              <a class="navbar-brand" href="?route=info">
    <img src="assets/logo.svg" width="auto" height="45" alt="">
  </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
      <li class="nav-item<?php if ($i == 1) echo $aciveClass; ?>">
        <a class="nav-link" href="?route=info">Главная</a>
      </li>
      <li class="nav-item<?php if ($i == 2) echo $aciveClass; ?>">
        <a class="nav-link" href="?route=facilities">Магазины</a>
      </li>
      <li class="nav-item<?php if ($i == 3) echo $aciveClass; ?>">
        <a class="nav-link" href="?route=positions">Должности</a>
      </li>
      <li class="nav-item<?php if ($i == 4) echo $aciveClass; ?>">
        <a class="nav-link" href="?route=workers">Работники</a>
      </li>
    </ul>
</div>
</div>
</nav>