<?php 
include("Template/header.php");
include("Admin/Config/BD.php");

$txtRol_user= $_SESSION['Rol_user'];
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtF_nacimiento=(isset($_POST['txtF_nacimiento']))?$_POST['txtF_nacimiento']:"";
$txtPass=(isset($_POST['txtPass']))?$_POST['txtPass']:"";
$txtCant_Seguidores=(isset($_POST['txtCant_Seguidores']))?$_POST['txtCant_Seguidores']:"";
$txtSuser=(isset($_POST['txtSuser']))?$_POST['txtSuser']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

switch($accion){

    case "Modificar": 
        $sentenciaSQL = $conexion->prepare("UPDATE usuarios SET Rol_user=:Rol_user, Nombre=:Nombre, Correo=:Correo, F_nacimiento=:F_nacimiento, Pass=:Pass, Cant_Seguidores=:Cant_Seguidores, Suser=:Suser WHERE Rol_user=:Rol_user");
        $sentenciaSQL->bindParam(':Rol_user', $txtRol_user);
        $sentenciaSQL->bindParam(':Nombre', $txtNombre);
        $sentenciaSQL->bindParam(':Correo', $txtCorreo);
        $sentenciaSQL->bindParam(':F_nacimiento', $txtF_nacimiento);
        $sentenciaSQL->bindParam(':Pass', $txtPass);
        $sentenciaSQL->bindParam(':Cant_Seguidores', $txtCant_Seguidores);
        $sentenciaSQL->bindParam(':Suser', $txtSuser);
        $sentenciaSQL-> execute();        
        session_destroy();
        header("Location:Index.php");
        break;

    case "Cancelar":
        header("Location:Inicio.php");
        break;

    case "Editar Usuario":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE Rol_user=:Rol_user");
        $sentenciaSQL->bindParam(':Rol_user', $txtRol_user);
        $sentenciaSQL-> execute();
        $user = $sentenciaSQL->fetch(PDO::FETCH_LAZY); 

        $txtRol_user = $user['Rol_user'];
        $txtNombre = $user['Nombre'];
        $txtCorreo = $user['Correo'];
        $txtF_nacimiento = $user['F_nacimiento'];
        $txtPass = $user['Pass'];
        $txtCant_Seguidores = $user['Cant_Seguidores'];
        $txtSuser = $user['Suser'];
        break;
        
    case "Borrar Usuario":
        $sentenciaSQL = $conexion->prepare("DELETE FROM usuarios WHERE Rol_user=:Rol_user");
        $sentenciaSQL->bindParam(':Rol_user', $txtRol_user);
        $sentenciaSQL-> execute();
        session_destroy();
        header("Location:Index.php");
        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM usuarios WHERE Rol_user=:Rol_user");
$sentenciaSQL->bindParam(':Rol_user', $txtRol_user);
$sentenciaSQL-> execute();
$listaUsers = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC); 
?>

<div class="col-md-3">
    
    <div class="card">
        <div class="card-header">
            Modificar Datos
        </div>
        <div class="card-body">
    <form method="POST" enctype="multipart/form-data" >

        <div class = "form-group">
            <label for="txtRol_user">Rol Usuario</label>
            <input type="text" class="form-control" value="<?php echo $txtRol_user;?>" name="txtRol_user" id="txtRol_user" placeholder="XXXXXXXXX-X">
        </div>
        <br/>
        <div class = "form-group">
            <label for="txtNombre">Nombre</label>
            <input type="text" class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
        </div>
        <br/>
        <div class = "form-group">
            <label for="txtCorreo">Correo Electrónico</label>
            <input type="text" class="form-control" value="<?php echo $txtCorreo;?>" name="txtCorreo" id="txtCorreo" placeholder="Example@dom.com">
        </div>
        <br/>
        <div class = "form-group">
            <label for="txtF_nacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" value="<?php echo $txtF_nacimiento;?>" name="txtF_nacimiento" id="txtF_nacimiento" placeholder="txtF_nacimiento">
        </div>
        <br/>
        <div class = "form-group">
            <label for="txtPass">Contraseña</label>
            <input type="password" class="form-control" value="<?php echo $txtPass;?>" name="txtPass" id="txtPass" placeholder="***********">
        </div>
        <br/>
        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="accion" <?php echo ($accion!="Editar Usuario")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
            <button type="submit" name="accion" <?php echo ($accion!="Editar Usuario")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
        </div>
    </form>
        </div>
    </div>
</div>

<div class="col-md-9">
    
    <table class="table table-bordered" border=1 bordercolor="black">
        <thead>
            <h2>Tus Datos</h2>
            <tr>
                <th>Rol Usuario</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Fecha de Nacimiento</th>
                <th>Contraseña</th>
                <th>Cantidad de Seguidores</th>
                <th>Administrador</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaUsers as $user) { ?>
            <tr>
                <td> <?php echo $user['Rol_user']; ?> </td>
                <td> <?php echo $user['Nombre']; ?> </td>
                <td> <?php echo $user['Correo']; ?> </td>
                <td> <?php echo $user['F_nacimiento']; ?> </td>
                <td> <?php echo $user['Pass']; ?> </td>
                <td> <?php echo $user['Cant_Seguidores']; ?> </td>
                <td> 
                    <?php 
                    if($user['Suser']==1){
                        echo "Sí";
                    }else{
                        echo "No";
                    }
                    ?> 
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="txtRol_user" id="txtRol_user" value="<?php echo $user['Rol_user']; ?>"/>       
                        <input type="submit" name="accion" value="Editar Usuario" class="btn btn-primary"/>
                        <br/><br/>
                        <input type="submit" name="accion" value="Borrar Usuario" class="btn btn-danger"/>
                    </form>
                </td>
            </tr>
          <?php } ?>
        </tbody>
    </table>
</div>

<a name="" id="" class="btn btn-primary" href="Perfil.php" role="button">Volver</a>

<?php include("Template/pie.php");?>