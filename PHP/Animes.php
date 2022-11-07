<?php 
include("template/header.php");
include("Admin/Config/BD.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM animes");
$sentenciaSQL-> execute();
$listaAnimes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 

foreach($listaAnimes as $anime) { ?>


    <div class="col-md-3">    
        <div class="card">

        <img class="card-img-top" src="./Img/<?php echo $anime['Imagen']; ?>" alt="">

        <div class="card-body">
            <h4 class="card-title"><?php echo $anime['Nombre']; ?> </h4>
            <p class="card-text"><?php echo $anime['Capitulos'];?> Capítulos</p>
            <p class="card-text">Puntuacion: <?php echo $anime['puntuacion'];?></p>
            <p class="card-text"><?php echo $anime['Descripcion'];?></p>

            <a name="" id="" class="btn btn-primary" href="Ver_mas_anime.php?id=<?php echo $anime['Id_anime']?>?nombre=<?php echo $anime['Nombre']?>" role="button">Ver más</a>  <?php //en el href damos el id del anime si poder usarlo en ver_mas_anime con la info de ese anime en particular?>

        </div>
    </div>
    </div>


<?php }
include("template/pie.php"); 
?> 
