<?php 
include("template/header.php");
include("Admin/Config/BD.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM peliculas");
$sentenciaSQL-> execute();
$listaPeliculas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 

foreach($listaPeliculas as $pelicula) { ?>


    <div class="col-md-3">    
        <div class="card">

        <img class="card-img-top" src="./Img/<?php echo $pelicula['Imagen']; ?>" alt="">

        <div class="card-body">
            <h4 class="card-title"><?php echo $pelicula['Nombre'];?></h4>
            <p class="card-text"><?php echo $pelicula['Duracion'];?> Minutos</p>
            <p class="card-text">Puntuacion: <?php echo $pelicula['puntuacion'];?></p>
            <p class="card-text"><?php echo $pelicula['Descripcion'];?></p>

            <a name="" id="" class="btn btn-primary" href="Ver_mas_pelicula.php?id=<?php echo $pelicula['Id_pelicula']?>" role="button">Ver más</a>  <?php //en el href damos el id del anime si poder usarlo en ver_mas_anime con la info de ese anime en particular?>
            
        </div>
    </div>
    </div>

<?php } ?>


<?php include("template/pie.php"); ?> 

