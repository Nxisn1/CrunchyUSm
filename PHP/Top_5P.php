<?php 
include("Template/header.php");
include("Admin/Config/BD.php");

$Query_peli = $conexion->prepare("SELECT Nombre, puntuacion FROM peliculas ORDER BY puntuacion DESC LIMIT 5;"); //top 5
$Query_peli-> execute();
$listaPelis = $Query_peli->fetchAll(PDO::FETCH_ASSOC); 
?>       


<div class="card text-left">

  <div class="card-body">
    <h4 class="card-title">Top 5 películas con mayor valoración:</h4><p></p>
    <?php foreach($listaPelis as $peli){ ?>
    <p class="card-text"><?php echo $peli["Nombre"];?> con <?php echo $peli["puntuacion"];?> Estrellas.</p>
    <?php } ?>

<a name="" id="" class="btn btn-primary" href="Explorar.php" role="button">Volver</a>