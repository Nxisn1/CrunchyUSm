<?php

session_start();
  if(!isset($_SESSION['Rol_user'])){
    header("Location:../Index.php");
  }else{
    if($_SESSION['Rol_user']=="ok"){
      $nombreUsuario=$_SESSION['Nombre'];
    } 
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  
    <?php $url="http://".$_SERVER['HTTP_HOST']."/PHP" ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="#">Admin <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/Inicio.php">Inicio</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/Section/Animes.php">Animes</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/Section/Peliculas.php">Películas</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Admin/Section/Cerrar.php">Cerrar sesión</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/Inicio.php">Ver sitio web</a>   
        </div>
    </nav>
    <div class="container">
    <br/>
        <div class="row">
            