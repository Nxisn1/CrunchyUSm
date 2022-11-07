<?php 
include("../Template/Header.php");
include("../Config/BD.php");

//todo de película
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtDuracion=(isset($_POST['txtDuracion']))?$_POST['txtDuracion']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO peliculas (Nombre, Duracion, Descripcion, Imagen) VALUES (:Nombre, :Duracion, :Descripcion, :Imagen);");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':Duracion', $txtDuracion);
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../Img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
        $sentenciaSQL-> execute();
        header("Location:Peliculas.php");
        break;

    case "Modificar": 
        $sentenciaSQL = $conexion->prepare("UPDATE peliculas SET Nombre=:Nombre,Duracion=:Duracion, Descripcion=:Descripcion WHERE Id_pelicula=:Id_pelicula");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':Duracion', $txtDuracion);
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':Id_pelicula', $txtID);
        $sentenciaSQL-> execute();        

        if($txtImagen!=""){
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../Img/".$nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM peliculas WHERE Id_pelicula=:Id_pelicula");
            $sentenciaSQL->bindParam(':Id_pelicula', $txtID);
            $sentenciaSQL-> execute();
            $pelicula = $sentenciaSQL->fetch(PDO::FETCH_LAZY);        

            if(isset($pelicula["Imagen"]) &&($pelicula["Imagen"]!="imagen.jpg")  ){
                if(file_exists("../../Img/".$pelicula["Imagen"])){    
                    unlink("../../Img/".$pelicula["Imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE peliculas SET Imagen=:Imagen WHERE Id_pelicula=:Id_pelicula");
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':Id_pelicula', $txtID);
            $sentenciaSQL-> execute();
        }

        header("Location:Peliculas.php");
        break;

    case "Cancelar":
        header("Location:Peliculas.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM peliculas WHERE Id_pelicula=:Id_pelicula");
        $sentenciaSQL->bindParam(':Id_pelicula', $txtID);
        $sentenciaSQL-> execute();
        $pelicula = $sentenciaSQL->fetch(PDO::FETCH_LAZY); 

        $txtNombre = $pelicula['Nombre'];
        $txtDuracion = $pelicula['Duracion'];
        $txtDescripcion = $pelicula['Descripcion'];
        $txtImagen = $pelicula['Imagen'];
        break;
        
    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM peliculas WHERE Id_pelicula=:Id_pelicula");
        $sentenciaSQL->bindParam(':Id_pelicula', $txtID);
        $sentenciaSQL-> execute();
        $pelicula = $sentenciaSQL->fetch(PDO::FETCH_LAZY);        

        if(isset($pelicula["Imagen"]) &&($pelicula["Imagen"]!="imagen.jpg")  ){
            if(file_exists("../../Img/".$pelicula["Imagen"])){
                unlink("../../Img/".$pelicula["Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM peliculas WHERE Id_pelicula=:Id_pelicula");
        $sentenciaSQL->bindParam(':Id_pelicula', $txtID);
        $sentenciaSQL-> execute();
        header("Location:Peliculas.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM peliculas");
$sentenciaSQL-> execute();
$listaPeliculas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 
?>

<!DOCTYPE html>
<html>
<body>
<div class="col-md-5">
    
    <div class="card">
        <div class="card-header">
            Datos de la Película
        </div>

        <div class="card-body">
           
        <form method="POST" enctype="multipart/form-data" >

    <div class = "form-group">
    <label for="txtID">ID autogenerado</label>
    <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre</label>
    <input type="text" required class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Nombre de la Película">
    </div>

    <div class = "form-group">
    <label for="txtDuracion">Duración</label>
    <input type="text" required class="form-control" value="<?php echo $txtDuracion;?>" name="txtDuracion" id="txtDuracion" placeholder="Duración de la Película en minutos">
    </div>

    <div class = "form-group">
    <label for="txtDescripcion">Descripción</label>
    <input type="text" required class="form-control" value="<?php echo $txtDescripcion;?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripción de la Película">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Imagen:</label>
    <br/>
    <?php if($txtImagen!=""){ ?>
        <img class="img-thumbnail rounded" src="../../Img/<?php echo $txtImagen;?>" width="50" alt="" srcset="">
    <?php } ?>
    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre de la película">
    </div>
        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
            <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
            <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>
    </form>
        </div>
    </div>
</div>
<div class="col-md-7">
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Duración</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th>Acciones</th>
                <th>Categorias</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaPeliculas as $pelicula) { ?>
            <tr>
                <td> <?php echo $pelicula['Id_pelicula']; ?> </td>
                <td> <?php echo $pelicula['Nombre']; ?> </td>
                <td> <?php echo $pelicula['Duracion']; ?> </td>
                <td> <?php echo $pelicula['Descripcion']; ?> </td>
                <td> 
                <img class="img-thumbnail rounded" src="../../Img/<?php echo $pelicula['Imagen']; ?>" width="50" alt="" srcset="">
                </td>
                <td>
                    <form method="post">

                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $pelicula['Id_pelicula']; ?>"/>
                        
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>

                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                    </form>
                        <a name="" id="" class="btn btn-success" href="categoryP.php?id=<?php echo $pelicula['Id_pelicula']?>" role="button">Categorias</a> <!--en href le damos el id_anime por url para tenerlo en categoryA.php  -->
                </td>
                <td> 
                    <?php 
                        $sentenciaSQL2 = $conexion->prepare("SELECT Accion,Aventura,Comedia,Drama,Fantasia,Musical,Romance,Ciencia_ficcion,Seinen,Shoujo,Shounen,Recuentos_de_la_vida,Deportes,Sobrenatural,Thriller FROM generos_pelicula WHERE Id_pelicula=:Id_pelicula" );
                        $sentenciaSQL2->bindParam(':Id_pelicula', $pelicula['Id_pelicula']);
                        $sentenciaSQL2-> execute();
                        $genero = $sentenciaSQL2->fetch(); 
                        //lo de abajo esta asqueroso xd, SON 16 IF LOS CUALES TIENEN LA CONDICIÓN SI EL CAMPO ES 1 DAN EL NOMBRE DE LA COLUMNA, EL CUAL CORRESPONDE AL GENERO
                            if($genero[0] == 1){echo "Accion <br>";}if($genero[1] == 1){echo "Aventura <br>";}if($genero[2] == 1){echo "Comedia <br>";}if($genero[3] == 1){echo "Drama <br>";}if($genero[4] == 1){echo "Fantasia <br>";
                            }if($genero[5] == 1){echo "Musical <br>";}if($genero[6] == 1){echo "Romance <br>";}if($genero[7] == 1){echo "Ciencia ficción <br>";}if($genero[8] == 1){echo "Seinen <br>";}
                            if($genero[9] == 1){echo "Shoujo <br>";}if($genero[10] == 1){echo "Shounen <br>";}if($genero[11] == 1){ echo "Recuentos de la vida <br>";}if($genero[12] == 1){echo "Deportes <br>";}
                            if($genero[13] == 1){echo "Sobrenatural <br>";}if($genero[14] == 1){ echo "Thriller <br>";}if($genero[0]==0 && $genero[1]==0 && $genero[2]==0 && $genero[3]==0 && $genero[4]==0 && $genero[5]==0 && $genero[6]==0 && $genero[7]==0 && $genero[8]==0 && $genero[9]==0 && $genero[10]==0 && $genero[11]==0 && $genero[12]==0 && $genero[13]==0 && $genero[14]==0){ echo "No has ingresado ninguna categoría para esta película. ¡Agregale etiquetas!";}
                    ?> 
                </td>
            </tr>
          <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php include("../Template/pie.php");?> 