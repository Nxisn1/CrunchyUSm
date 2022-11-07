<?php 
include("Template/header.php");
include("Admin/Config/BD.php");

$Query_anime = $conexion->prepare("SELECT Nombre, puntuacion FROM animes ORDER BY puntuacion ASC LIMIT 5;"); //top 5
$Query_anime-> execute();
$listaAnimes = $Query_anime->fetchAll(PDO::FETCH_ASSOC); 
?>       


<div class="card text-left">

  <div class="card-body">
    <h4 class="card-title">Top 5 animes con menor valoración:</h4><p></p>
    <?php foreach($listaAnimes as $anime){ ?>
    <p class="card-text"><?php echo $anime["Nombre"];?> con <?php echo $anime["puntuacion"];?> Estrellas.</p>
    <?php } ?>

<a name="" id="" class="btn btn-primary" href="Explorar.php" role="button">Volver</a>
