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
    <h4 class="card-title">Tus datos son:</h4>
    <p class="card-text">Rol: <?php echo $_SESSION['Rol_user'];?></p>
    <p class="card-text">Nombre: <?php echo $_SESSION['Nombre'];?></p>
    <p class="card-text">Correo: <?php echo $_SESSION['Correo'];?></p>
    <p class="card-text">Fecha de Nacimiento: <?php echo $_SESSION['F_nacimiento'];?></p>
    <p class="card-text">Constraseña: <?php echo $_SESSION['Pass'];?></p>
    <p class="card-text">Cantidad de seguidores: <?php echo $_SESSION['Cant_Seguidores'];?></p>
    <p class="card-text">Administrador: <?php if($_SESSION['Suser']==1){echo 'Sí';}else{echo 'No';};?></p>
    <p class="card-text">Número de animes vistos: <?php echo count($listaAnimes);?></p>
    <p class="card-text">Número de películas vistas: <?php echo count($listaPeliculas);?></p>
  </div>

</div>

<a name="" id="" class="btn btn-primary" href="Favs.php" role="button" style="background-color:green">Lista de Favoritos</a>

<p>
</p>

<a name="" id="" class="btn btn-primary" href="Editar_perfil.php" role="button" style="background-color:blue">Editar Perfil</a>

<p>
</p>

<a name="" id="" class="btn btn-primary" href="Historial.php" role="button" style="background-color:red">Historial</a>

<p>
</p>

<a name="" id="" class="btn btn-primary" href="Inicio.php" role="button">Volver</a>
