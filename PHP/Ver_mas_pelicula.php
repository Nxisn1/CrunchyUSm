<?php 
include("template/header.php");
include("Admin/Config/BD.php");

$Id_pelicula = $_GET["id"]; //recuperamos el id de la pelicula proveniente del boton 'ver mas' en peliculas.php linea 23.
$txtvalo=(isset($_POST['txtvalo']))?$_POST['txtvalo']:""; //capturamos la valoración que da el usuario.
$ver=(isset($_POST['ver']))?$_POST['ver']:""; //capturamos si el user pulsa el botón ver.
$fav=(isset($_POST['fav']))?$_POST['fav']:""; //capturamos si el user pulsa el botón fav.
$rol = $_SESSION['Rol_user'];

$aux = $conexion->prepare("SELECT Id_historial_p FROM historial_pelicula WHERE Id_pelicula=:Id_pelicula AND Rol_user=:Rol_user"); //información si el usuario ha visto o no el anime.
$aux->bindParam(':Id_pelicula', $Id_pelicula);
$aux->bindParam(':Rol_user', $rol);
$aux-> execute();
$tmp = $aux->fetch(); 

$aux2 = $conexion->prepare("SELECT Id_favs_p FROM favs_pelicula WHERE Id_pelicula=:Id_pelicula AND Rol_user=:Rol_user"); //información si el anime ya esta en favs.
$aux2->bindParam(':Id_pelicula', $Id_pelicula);
$aux2->bindParam(':Rol_user', $rol);
$aux2-> execute();
$tmp2 = $aux2->fetch(); 

$aux3 = $conexion->prepare("SELECT Nombre FROM peliculas WHERE Id_pelicula=:Id_pelicula"); //obtener el nombre de la película.
$aux3->bindParam(':Id_pelicula', $Id_pelicula);
$aux3-> execute();
$Nombre = $aux3->fetch(); 

$sentenciaSQL = $conexion->prepare("SELECT * FROM peliculas WHERE Id_pelicula=:Id_pelicula"); //obtenemos toda la información de la pelicula.
$sentenciaSQL->bindParam(':Id_pelicula', $Id_pelicula);
$sentenciaSQL-> execute();
$listaPeliculas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 
foreach($listaPeliculas as $pelicula);

if($txtvalo){ //Valoración. 
        
    $query = $conexion->prepare("SELECT * FROM valo_pelicula WHERE Id_pelicula=:Id_pelicula AND Rol_user=:Rol_user");
    $query->bindParam(':Id_pelicula', $Id_pelicula);
    $query->bindParam(':Rol_user', $rol);
    $query-> execute();
    $valo = $query->fetch(); 

    if($valo){  //ya tiene valoración.

        $sentenciaSQL1 = $conexion->prepare("UPDATE valo_pelicula SET puntuacion=:puntuacion WHERE Id_pelicula=:Id_pelicula AND Rol_user=:Rol_user;");
        $sentenciaSQL1->bindParam(':Rol_user', $_SESSION["Rol_user"]);
        $sentenciaSQL1->bindParam(':Id_pelicula', $Id_pelicula);
        $sentenciaSQL1->bindParam(':puntuacion', $txtvalo);
        $sentenciaSQL1-> execute();

        $query = $conexion->prepare("SELECT puntuacion FROM valo_pelicula WHERE Id_pelicula=:Id_pelicula");
        $query->bindParam(':Id_pelicula', $Id_pelicula);
        $query-> execute();   
        $aux = $query->fetchAll(PDO::FETCH_ASSOC); ; //obtenemos las puntuaciones
        $tmp = 0;
        count($aux);
        foreach($aux as $aux2){
            $tmp = $tmp + $aux2["puntuacion"];
        }
        $aux3 = ($tmp/(count($aux)));
        $sentenciaSQL1 = $conexion->prepare("UPDATE peliculas SET puntuacion=:puntuacion WHERE Id_pelicula=:Id_pelicula");
        $sentenciaSQL1->bindParam(':Id_pelicula', $Id_pelicula);
        $sentenciaSQL1->bindParam(':puntuacion', $aux3);
        $sentenciaSQL1-> execute();   

        echo "¡Actualizaste tu valoración de esta pelicula!";
        header("Refresh:1");
        $valo = NULL;

    }else{ //no tiene valoración

        $sentenciaSQL3 = $conexion->prepare("INSERT INTO valo_pelicula (Rol_user, Id_pelicula, puntuacion) VALUES (:Rol_user, :Id_pelicula, :puntuacion);");
        $sentenciaSQL3->bindParam(':Rol_user', $_SESSION["Rol_user"]);
        $sentenciaSQL3->bindParam(':Id_pelicula', $Id_pelicula);
        $sentenciaSQL3->bindParam(':puntuacion', $txtvalo);
        $sentenciaSQL3-> execute();

        $sentenciaSQL1 = $conexion->prepare("UPDATE peliculas SET puntuacion=:puntuacion WHERE Id_pelicula=:Id_pelicula");
        $sentenciaSQL1->bindParam(':Id_pelicula', $Id_pelicula);
        $txtvalo = ($txtvalo+($pelicula['puntuacion']*$pelicula['aux']))/($pelicula['aux']+1); //cálculo del promedio de todas las valoraciones que ha tenido. aux parte en 0 por eso el +1
        $sentenciaSQL1->bindParam(':puntuacion', $txtvalo);
        $sentenciaSQL1-> execute();   

        $sentenciaSQL2 = $conexion->prepare("UPDATE peliculas SET aux=aux+1 WHERE Id_pelicula=:Id_pelicula");
        $sentenciaSQL2->bindParam(':Id_pelicula', $Id_pelicula);
        $sentenciaSQL2-> execute();

        echo "¡Valoraste con éxito esta pelicula!";
        header("Refresh:1");
        $valo = NULL;
    }
    $txtvalo = NULL;
    header("Refresh:1");
}

if($ver){ //historial
    if($tmp){
        echo "Ya viste esta película.";
    }else{
        $sentenciaSQL2 = $conexion->prepare("INSERT INTO historial_pelicula(Rol_user, Id_pelicula, Nombre) VALUES (:Rol_user, :Id_pelicula, :Nombre);");
        $sentenciaSQL2->bindParam(':Id_pelicula', $Id_pelicula);
        $sentenciaSQL2->bindParam(':Rol_user', $rol);
        $sentenciaSQL2->bindParam(':Nombre', $Nombre[0]);
        $sentenciaSQL2-> execute();
        header("Refresh:0");
    }
}

if($fav){ //favoritos
    if($tmp2){
        echo "Esta película ya está en tus favoritos.";
    }else{
        $sentenciaSQL2 = $conexion->prepare("INSERT INTO favs_pelicula(Rol_user, Id_pelicula, Nombre) VALUES (:Rol_user, :Id_pelicula, :Nombre);");
        $sentenciaSQL2->bindParam(':Id_pelicula', $Id_pelicula);
        $sentenciaSQL2->bindParam(':Rol_user', $rol);
        $sentenciaSQL2->bindParam(':Nombre', $Nombre[0]);
        $sentenciaSQL2-> execute();
        header("Refresh:0");
    }
}

?>

<!DOCTYPE html>
<html> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/w3.css">
    <body>
        <div class="w3-container w3-orange">
            <h1><?php echo $pelicula['Nombre']?></h1>
        </div>
            <br/>
        <div class="w3-row-padding">
            <br/>   
            <div class="w3-third">
                <img src="Img/<?php echo $pelicula['Imagen']?>" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}">
                <br/><br/><br/><br/><br/><br/><br/><br/>
            </div>

        <div class="w3-third">
            <br/><br/>
            <p>Duración: <?php echo $pelicula['Duracion']?> Minutos.</p>
            <p class="card-text">Valoración de la película: <?php echo $pelicula['puntuacion'];?></p>
            <p> 
                <?php 
                    $sentenciaSQL2 = $conexion->prepare("SELECT Accion,Aventura,Comedia,Drama,Fantasia,Musical,Romance,Ciencia_ficcion,Seinen,Shoujo,Shounen,Recuentos_de_la_vida,Deportes,Sobrenatural,Thriller FROM generos_pelicula WHERE Id_pelicula=:Id_pelicula" );
                    $sentenciaSQL2->bindParam(':Id_pelicula', $pelicula['Id_pelicula']);
                    $sentenciaSQL2-> execute();
                    $genero = $sentenciaSQL2->fetch(); 
                    //la misma asquerosidad de Admin/Section/Peliculas.php linea 203 xd, SON 16 IF LOS CUALES TIENEN LA CONDICIÓN SI EL CAMPO ES 1 DAN EL NOMBRE DE LA COLUMNA, EL CUAL CORRESPONDE AL GENERO
                    if($genero[0] == 1){echo "Accion <br>";}if($genero[1] == 1){echo "Aventura <br>";}if($genero[2] == 1){echo "Comedia <br>";}if($genero[3] == 1){echo "Drama <br>";}if($genero[4] == 1){echo "Fantasia <br>";
                    }if($genero[5] == 1){echo "Musical <br>";}if($genero[6] == 1){echo "Romance <br>";}if($genero[7] == 1){echo "Ciencia ficción <br>";}if($genero[8] == 1){echo "Seinen <br>";}
                    if($genero[9] == 1){echo "Shoujo <br>";}if($genero[10] == 1){echo "Shounen <br>";}if($genero[11] == 1){ echo "Recuentos de la vida <br>";}if($genero[12] == 1){echo "Deportes <br>";}
                    if($genero[13] == 1){echo "Sobrenatural <br>";}if($genero[14] == 1){ echo "Thriller <br>";}if($genero[0]==0 && $genero[1]==0 && $genero[2]==0 && $genero[3]==0 && $genero[4]==0 && $genero[5]==0 && $genero[6]==0 && $genero[7]==0 && $genero[8]==0 && $genero[9]==0 && $genero[10]==0 && $genero[11]==0 && $genero[12]==0 && $genero[13]==0 && $genero[14]==0){ echo "¡Lo sentimos! Esta película todavía no tiene etiquetas.";}
                ?>
            </p>
            <p><?php echo $pelicula['Descripcion']?></p>

            <form method="post">
                <label for="txtvalo">Valora esta película, Estrellas:</label>
                <select id="txtvalo" name="txtvalo">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                </select>

                <input type="submit" value="Dar" class="btn btn-success">
            </form>
        </div>
        </div>
        <form method="post">       
            <input type="submit" name="ver" value="<?php if($tmp){echo "Película vista";}else{echo "Ver película";}?>" class="btn btn-primary"/> <!-- Botón para ver-->
            <input type="submit" name="fav" value="<?php if($tmp2){echo "Película en favoritos";}else{echo "Agregar película a Favoritos";}?>" class="btn btn-warning"/> <!-- Botón para agregar a favs-->

            <br><br>
        </form>
        <br><br>
    </body>
        <a name="" id="" class="btn btn-primary" href="Peliculas.php" role="button">Volver</a>
</html>
