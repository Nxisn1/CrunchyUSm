<?php 
session_start(); //con esto incluimos todos los datos del usuario 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyUsm</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css" />

</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="Inicio.php">CrunchyUsm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Inicio.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Explorar.php">Explorar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="navbar.php">Barra de busqueda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Animes.php">Animes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Peliculas.php">Películas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Nosotros.php">Nosotros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Perfil.php">Mi Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Cerrar.php">Cerrar sesión</a>
            </li>

            <?php if($_SESSION['Suser'] == 1){ //solo para administradores ?> 
            <li class="nav-item">
                <a class="nav-link" href="Admin/Inicio.php">Administrar</a>
            </li>
            <?php } ?>
 

            <?php echo  $_SESSION['Nombre'];?>
            
        </ul>
    </nav>

    <div class="container">
    <br/>
        <div class="row">
