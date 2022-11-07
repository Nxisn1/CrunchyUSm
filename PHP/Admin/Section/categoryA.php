<?php 
include("../Template/Header.php");
include("../Config/BD.php");


$Id_anime = $_GET["id"]; //recuperamos el id_anime desde la linea 295 de Admin/Section/Animes.php
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

//lo de las categorías
$A_ccion=(isset($_POST['A_ccion']))?$_POST['A_ccion']:""; 
$Aventura=(isset($_POST['Aventura']))?$_POST['Aventura']:""; 
$Comedia=(isset($_POST['Comedia']))?$_POST['Comedia']:""; 
$Drama=(isset($_POST['Drama']))?$_POST['Drama']:""; 
$Fantasia=(isset($_POST['Fantasia']))?$_POST['Fantasia']:""; 
$Musical=(isset($_POST['Musical']))?$_POST['Musical']:""; 
$Romance=(isset($_POST['Romance']))?$_POST['Romance']:""; 
$Ciencia_ficcion=(isset($_POST['Ciencia_ficcion']))?$_POST['Ciencia_ficcion']:""; 
$Seinen=(isset($_POST['Seinen']))?$_POST['Seinen']:""; 
$Shoujo=(isset($_POST['Shoujo']))?$_POST['Shoujo']:""; 
$Shounen=(isset($_POST['Shounen']))?$_POST['Shounen']:""; 
$Recuentos=(isset($_POST['Recuentos']))?$_POST['Recuentos']:""; 
$Deportes=(isset($_POST['Deportes']))?$_POST['Deportes']:""; 
$Sobrenatural=(isset($_POST['Sobrenatural']))?$_POST['Sobrenatural']:""; 
$Thriller=(isset($_POST['Thriller']))?$_POST['Thriller']:""; 

$sentenciaSQL = $conexion->prepare("SELECT * FROM animes WHERE Id_anime=:Id_anime");
$sentenciaSQL->bindParam(':Id_anime', $Id_anime);
$sentenciaSQL-> execute();
$anime = $sentenciaSQL->fetch(); 


switch($accion){

    case "Agregar":
        $sentenciaSQL2 = $conexion->prepare("UPDATE generos_anime SET Accion=:A_ccion,Aventura=:Aventura,Comedia=:Comedia,Drama=:Drama,Fantasia=:Fantasia,Musical=:Musical,Romance=:Romance,Ciencia_ficcion=:Ciencia_ficcion,Seinen=:Seinen,Shoujo=:Shoujo,Shounen=:Shounen,Recuentos_de_la_vida=:Recuentos,Deportes=:Deportes,Sobrenatural=:Sobrenatural,Thriller=:Thriller WHERE Id_anime=:Id_anime"); 
        $sentenciaSQL2->bindParam(':Id_anime', $Id_anime);
        $sentenciaSQL2->bindParam(':A_ccion', $A_ccion);
        $sentenciaSQL2->bindParam(':Aventura', $Aventura);
        $sentenciaSQL2->bindParam(':Comedia', $Comedia);
        $sentenciaSQL2->bindParam(':Drama', $Drama);
        $sentenciaSQL2->bindParam(':Fantasia', $Fantasia);
        $sentenciaSQL2->bindParam(':Musical', $Musical);
        $sentenciaSQL2->bindParam(':Romance', $Romance);
        $sentenciaSQL2->bindParam(':Ciencia_ficcion', $Ciencia_ficcion);
        $sentenciaSQL2->bindParam(':Seinen', $Seinen);
        $sentenciaSQL2->bindParam(':Shoujo', $Shoujo);
        $sentenciaSQL2->bindParam(':Shounen', $Shounen);
        $sentenciaSQL2->bindParam(':Recuentos', $Recuentos);
        $sentenciaSQL2->bindParam(':Deportes', $Deportes);
        $sentenciaSQL2->bindParam(':Sobrenatural', $Sobrenatural);
        $sentenciaSQL2->bindParam(':Thriller', $Thriller);


        $sentenciaSQL2-> execute();
        header("Location:Animes.php");
    }

?>

<!DOCTYPE html>
<html>
<body>
<div class="col-md-5">
    
    <div class="card">
        <div class="card-header">
            Etiquetas de genero
        </div>

        <div class="card-body">
           
        <form method="POST" enctype="multipart/form-data" >
        
        <p>Etiquetas de genero:</p>

        <input type="checkbox" id="A_ccion" name="A_ccion" value="1">
        <label for="A_ccion"> Accion </label>

        <input type="checkbox" id="Aventura" name="Aventura" value=1>
        <label for="Aventura"> Aventura </label>

        <input type="checkbox" id="Comedia" name="Comedia" value=1>
        <label for="Comedia"> Comedia </label>

        <input type="checkbox" id="Drama" name="Drama" value=1>
        <label for="Drama"> Drama </label><br>

        <input type="checkbox" id="Fantasia" name="Fantasia" value=1>
        <label for="Fantasia"> Fantasia </label>

        <input type="checkbox" id="Musical" name="Musical" value=1>
        <label for="Musical"> Musical </label>

        <input type="checkbox" id="Romance" name="Romance" value=1>
        <label for="Romance"> Romance </label>

        <input type="checkbox" id="Ciencia_ficcion" name="Ciencia_ficcion" value=1>
        <label for="Ciencia_ficcion"> Ciencia ficción </label><br>

        <input type="checkbox" id="Seinen" name="Seinen" value=1>
        <label for="Seinen"> Seinen </label>

        <input type="checkbox" id="Shoujo" name="Shoujo" value=1>
        <label for="Shoujo"> Shoujo </label>

        <input type="checkbox" id="Shounen" name="Shounen" value=1>
        <label for="Shounen"> Shounen </label>

        <input type="checkbox" id="Recuentos" name="Recuentos" value=1>
        <label for="Recuentos"> Recuentos de la vida </label><br>

        <input type="checkbox" id="Deportes" name="Deportes" value=1>
        <label for="Deportes"> Deportes </label>

        <input type="checkbox" id="Sobrenatural" name="Sobrenatural" value=1>
        <label for="Sobrenatural"> Sobrenatural </label>

        <input type="checkbox" id="Thriller" name="Thriller" value=1>
        <label for="Thriller"> Thriller </label>

        <br>
        <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
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
                <th>Categorías</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> <?php echo $anime['Id_anime']; ?> </td>
                <td> <?php echo $anime['Nombre']; ?> </td>
                <td> <?php echo $anime['Capitulos']; ?> </td>
                <td> <?php echo $anime['Descripcion']; ?> </td>
                <td> 
                <img class="img-thumbnail rounded" src="../../Img/<?php echo $anime['Imagen']; ?>" width="50" alt="" srcset="">    
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
                            if($genero[13] == 1){echo "Sobrenatural <br>";}if($genero[14] == 1){ echo "Thriller <br>";}if($genero[0]==0 && $genero[1]==0 && $genero[2]==0 && $genero[3]==0 && $genero[4]==0 && $genero[5]==0 && $genero[6]==0 && $genero[7]==0 && $genero[8]==0 && $genero[9]==0 && $genero[10]==0 && $genero[11]==0 && $genero[12]==0 && $genero[13]==0 && $genero[14]==0){ echo "Ingresa las etiquetas de este anime.";}
                    ?> 
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>