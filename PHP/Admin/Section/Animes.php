<?php 
include("../Template/Header.php");
include("../Config/BD.php");

//todo lo del anime
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:""; 
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtCapitulos=(isset($_POST['txtCapitulos']))?$_POST['txtCapitulos']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){

    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO animes (Nombre,Capitulos, Descripcion, Imagen) VALUES (:Nombre, :Capitulos, :Descripcion, :Imagen);");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':Capitulos', $txtCapitulos);
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
        
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen,"../../Img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
        $sentenciaSQL-> execute();
        header("Location:Animes.php");
        break;

    case "Modificar": 
        $sentenciaSQL = $conexion->prepare("UPDATE animes SET Nombre=:Nombre,Capitulos=:Capitulos, Descripcion=:Descripcion WHERE Id_anime=:Id_anime");
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':Capitulos', $txtCapitulos);
        $sentenciaSQL->bindParam(':Descripcion', $txtDescripcion);
        $sentenciaSQL->bindParam(':Id_anime', $txtID);
        $sentenciaSQL-> execute();        

        if($txtImagen!=""){
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen,"../../Img/".$nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM animes WHERE Id_anime=:Id_anime");
            $sentenciaSQL->bindParam(':Id_anime', $txtID);
            $sentenciaSQL-> execute();
            $anime = $sentenciaSQL->fetch(PDO::FETCH_LAZY);        

            if(isset($anime["Imagen"]) &&($anime["Imagen"]!="imagen.jpg")  ){
                if(file_exists("../../Img/".$anime["Imagen"])){    
                    unlink("../../Img/".$anime["Imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE animes SET Imagen=:Imagen WHERE Id_anime=:Id_anime");
            $sentenciaSQL->bindParam(':Imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':Id_anime', $txtID);
            $sentenciaSQL-> execute();
        }

        header("Location:Animes.php");
        break;

    case "Cancelar":
        header("Location:Animes.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM animes WHERE Id_anime=:Id_anime");
        $sentenciaSQL->bindParam(':Id_anime', $txtID);
        $sentenciaSQL-> execute();
        $anime = $sentenciaSQL->fetch(PDO::FETCH_LAZY); 

        $txtNombre = $anime['Nombre'];
        $txtCapitulos = $anime['Capitulos'];
        $txtDescripcion = $anime['Descripcion'];
        $txtImagen = $anime['Imagen'];
        break;
        
    case "Borrar":

        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM animes WHERE Id_anime=:Id_anime");
        $sentenciaSQL->bindParam(':Id_anime', $txtID);
        $sentenciaSQL-> execute();
        $anime = $sentenciaSQL->fetch(PDO::FETCH_LAZY);        

        if(isset($anime["Imagen"]) &&($anime["Imagen"]!="imagen.jpg")  ){
            if(file_exists("../../Img/".$anime["Imagen"])){
                unlink("../../Img/".$anime["Imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM animes WHERE Id_anime=:Id_anime");
        $sentenciaSQL->bindParam(':Id_anime', $txtID);
        $sentenciaSQL-> execute();
        header("Location:Animes.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM animes");
$sentenciaSQL-> execute();
$listaAnimes = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 


?>

<!DOCTYPE html>
<html>
<body>
<div class="col-md-5">  
    
    <div class="card">
        <div class="card-header">
            Datos del Anime
        </div>

        <div class="card-body">
           
        <form method="POST" enctype="multipart/form-data" >

    <div class = "form-group">
    <label for="txtID">ID autogenerado</label>
    <input type="text" required readonly class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Nombre</label>
    <input type="text" required class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Nombre del anime">
    </div>

    <div class = "form-group">
    <label for="txtCapitulos">Capitulos</label>
    <input type="text" required class="form-control" value="<?php echo $txtCapitulos;?>" name="txtCapitulos" id="txtCapitulos" placeholder="Capítulos del anime">
    </div>

    <div class = "form-group">
    <label for="txtDescripcion">Descripcion</label>
    <input type="text" required class="form-control" value="<?php echo $txtDescripcion;?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripción del anime">
    </div>

    <div class = "form-group">
    <label for="txtNombre">Imagen:</label>
    <br/>
    <?php if($txtImagen!=""){ ?>
        <img class="img-thumbnail rounded" src="../../Img/<?php echo $txtImagen;?>" width="50" alt="" srcset="">
    <?php } ?>
    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre del anime">
    </div>
    <br/>
        <br/>
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
                <th>Capitulos</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th>Acciones</th>
                <th>Categorías</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaAnimes as $anime) { ?>
            <tr>
                <td> <?php echo $anime['Id_anime']; ?> </td>
                <td> <?php echo $anime['Nombre']; ?> </td>
                <td> <?php echo $anime['Capitulos']; ?> </td>
                <td> <?php echo $anime['Descripcion']; ?> </td>
                <td> 
                <img class="img-thumbnail rounded" src="../../Img/<?php echo $anime['Imagen']; ?>" width="50" alt="" srcset="">    
                </td>
                <td>
                    <form method="post">

                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $anime['Id_anime']; ?>"/>
                        
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>

                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                    </form>
                        <a name="" id="" class="btn btn-success" href="categoryA.php?id=<?php echo $anime['Id_anime']?>" role="button">Categorías</a> <!--en href le damos el id_anime por url para tenerlo en categoryA.php  -->
                </td>
                <td> 
                    <?php 
                        $sentenciaSQL2 = $conexion->prepare("SELECT Accion,Aventura,Comedia,Drama,Fantasia,Musical,Romance,Ciencia_ficcion,Seinen,Shoujo,Shounen,Recuentos_de_la_vida,Deportes,Sobrenatural,Thriller FROM generos_anime WHERE Id_anime=:Id_anime" );
                        $sentenciaSQL2->bindParam(':Id_anime', $anime['Id_anime']);
                        $sentenciaSQL2-> execute();
                        $genero = $sentenciaSQL2->fetch(); 
                        //lo de abajo esta asqueroso xd, SON 16 IF LOS CUALES TIENEN LA CONDICIÓN SI EL CAMPO ES 1 DAN EL NOMBRE DE LA COLUMNA, EL CUAL CORRESPONDE AL GENERO
                            if($genero[0] == 1){echo "Accion <br>";}if($genero[1] == 1){echo "Aventura <br>";}if($genero[2] == 1){echo "Comedia <br>";}if($genero[3] == 1){echo "Drama <br>";}if($genero[4] == 1){echo "Fantasia <br>";
                            }if($genero[5] == 1){echo "Musical <br>";}if($genero[6] == 1){echo "Romance <br>";}if($genero[7] == 1){echo "Ciencia ficción <br>";}if($genero[8] == 1){echo "Seinen <br>";}
                            if($genero[9] == 1){echo "Shoujo <br>";}if($genero[10] == 1){echo "Shounen <br>";}if($genero[11] == 1){ echo "Recuentos de la vida <br>";}if($genero[12] == 1){echo "Deportes <br>";}
                            if($genero[13] == 1){echo "Sobrenatural <br>";}if($genero[14] == 1){ echo "Thriller <br>";}if($genero[0]==0 && $genero[1]==0 && $genero[2]==0 && $genero[3]==0 && $genero[4]==0 && $genero[5]==0 && $genero[6]==0 && $genero[7]==0 && $genero[8]==0 && $genero[9]==0 && $genero[10]==0 && $genero[11]==0 && $genero[12]==0 && $genero[13]==0 && $genero[14]==0){ echo "No has ingresado ninguna categoría para este anime. ¡Agregale etiquetas!";}
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