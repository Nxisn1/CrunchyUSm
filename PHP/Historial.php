<?php 
include("Template/header.php");
include("Admin/Config/BD.php");

$Query_anime = $conexion->prepare("SELECT * FROM historial_anime WHERE Rol_user=:Rol_user");
$Query_anime->bindParam(':Rol_user', $_SESSION['Rol_user']);
$Query_anime-> execute();
$listaAnimes = $Query_anime->fetchAll(PDO::FETCH_ASSOC); 

$Query_pelicula = $conexion->prepare("SELECT * FROM historial_pelicula WHERE Rol_user=:Rol_user");
$Query_pelicula->bindParam(':Rol_user', $_SESSION['Rol_user']);
$Query_pelicula-> execute();
$listaPeliculas = $Query_pelicula->fetchAll(PDO::FETCH_ASSOC); 
?>




<div class="card text-left">

  <div class="card-body">
    <h4 class="card-title">Tu historial:</h4>
    <?php foreach($listaAnimes as $anime){ ?>
    <p class="card-text"><?php echo $anime["Nombre"];?></p>
    <?php } ?>
    <?php foreach($listaPeliculas as $pelicula){ ?>
    <p class="card-text"><?php echo $pelicula["Nombre"];?></p>
    <?php } ?>
  </div>

</div>

<a name="" id="" class="btn btn-primary" href="Perfil.php" role="button">Volver</a>
