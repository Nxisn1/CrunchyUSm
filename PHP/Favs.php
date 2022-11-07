<?php 
include("Template/header.php");
include("Admin/Config/BD.php");

$rol = $_SESSION['Rol_user'];
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:""; 


$Query_anime = $conexion->prepare("SELECT * FROM favs_anime WHERE Rol_user=:Rol_user");
$Query_anime->bindParam(':Rol_user', $rol);
$Query_anime-> execute();
$listaAnimes = $Query_anime->fetchAll(PDO::FETCH_ASSOC); 

$Query_pelicula = $conexion->prepare("SELECT * FROM favs_pelicula WHERE Rol_user=:Rol_user");
$Query_pelicula->bindParam(':Rol_user', $rol);
$Query_pelicula-> execute();
$listaPeliculas = $Query_pelicula->fetchAll(PDO::FETCH_ASSOC); 



switch($accion){

    case "Eliminar anime":
        $sentenciaSQL = $conexion->prepare("DELETE FROM favs_anime WHERE Id_anime=:Id_anime");
        $sentenciaSQL->bindParam(':Id_anime', $txtID);
        $sentenciaSQL-> execute();
        header("Refresh:0");
        break;

    case "Eliminar pelicula":
        $sentenciaSQL = $conexion->prepare("DELETE FROM favs_pelicula WHERE Id_pelicula=:Id_pelicula");
        $sentenciaSQL->bindParam(':Id_pelicula', $txtID);
        $sentenciaSQL-> execute();
        header("Refresh:0");
        break;
}



 ?>

    <!DOCTYPE html>
    <html>
    <body>
        <div class="col-md-6">
            <table class="table table-bordered">
                    <div class="table-header">
                        <h2>Tus Animes Favoritos:</h2>
                    </div>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($listaAnimes as $anime){ ?>
                    <tr>
                        <td> <?php echo $anime['Nombre']; ?> </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $anime['Id_anime']; ?>"/>
                                <input type="submit" name="accion" value="Eliminar anime" class="btn btn-danger"/>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php if(count($listaAnimes)==0){echo "¡Oops! Parece que todavía no tienes animes favoritos.";}  ?>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                    <div class="table-header">
                        <h2>Tus Películas Favoritas:</h2>
                    </div>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($listaPeliculas as $pelicula) { ?>
                    <tr>
                        <td> <?php echo $pelicula['Nombre']; ?> </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $pelicula['Id_pelicula']; ?>"/>
                                <input type="submit" name="accion" value="Eliminar pelicula" class="btn btn-danger"/>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php if(count($listaPeliculas)==0){echo "¡Oops! Parece que todavía no tienes películas favoritas.";}  ?>
            </table>
        </div>
        <a name="" id="" class="btn btn-primary" href="Perfil.php" role="button">Volver</a>
    </body>
    </html>




<?php  include("template/pie.php"); ?> 




