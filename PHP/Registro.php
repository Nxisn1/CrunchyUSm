<?php 
    require 'Admin/Config/BD.php';

$message = '';

if(!empty($_POST['Rol_user']) && !empty($_POST['Pass']) && !empty($_POST['Nombre']) && !empty($_POST['F_nacimiento']) && !empty($_POST['Correo'])){
    $sql = 'INSERT INTO usuarios (Rol_user,Nombre,Correo,F_nacimiento,Pass,Cant_Seguidores,Suser) VALUES(:Rol_user,:Nombre,:Correo,:F_nacimiento,:Pass,:Cant_Seguidores,:Suser)';
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':Rol_user', $_POST['Rol_user']);
    $stmt->bindParam(':Pass', $_POST['Pass']);
    $stmt->bindParam(':Nombre', $_POST['Nombre']);
    $stmt->bindParam(':Correo', $_POST['Correo']);
    $stmt->bindParam(':F_nacimiento', $_POST['F_nacimiento']);
    $stmt->bindParam(':Cant_Seguidores', $_POST['Cant_Seguidores']);
    $stmt->bindParam(':Suser', $_POST['Suser']);
    //$stmt->execute();
    $aux = 'SELECT Rol_user FROM usuarios WHERE Rol_user=:Rol_user'; //comprobar que no exista ya el usuario
    $temp = $conexion->prepare($aux);
    $temp->bindParam(':Rol_user', $_POST['Rol_user']);
    $temp->execute();
    $rol = $temp->fetch(PDO::FETCH_LAZY); 
    if( (!empty($_POST['Rol_user'])) && ($rol <> '') ){
        echo 'Ingrese rol o intente con otro.';
    }elseif($_POST['Confirm_Contra'] <> $_POST['Pass']){
        echo 'Las contraseñas no coinciden';
    }else{
        echo 'Registado con éxito';
        header("Location:Index.php");
        $stmt->execute();
    }
}
?>


<!DOCTYPE html> <?php //esto es lo del header?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrunchyUsm</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css" />

</head>
<body>


<div class="container">
        <div class="row">
        <div class="col-md-4">
        </div>
            <div class="col-md-4">
            <br/>
                <div class="card">

                <div class="card-header">
                    Registro
                </div>
                <div class="card-body">
                    
                    <form action="registro.php" method="POST">
                    <div class = "form-group">
                    <label>Rol</label>
                    <input type="text" class="form-control" name="Rol_user"  placeholder="Ingrese su Rol">
                    </div>
                    <br/>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Nombre</label>
                    <input type="text" class="form-control" name="Nombre" placeholder="Ingrese su nombre">
                    </div>
                    <br/>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="F_nacimiento">
                    </div>
                    <br/>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Correo</label>
                    <input type="email" class="form-control" name="Correo" placeholder="Ingrese su correo">
                    </div>
                    <br/>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" name="Pass" placeholder="Ingrese su contraseña">
                    </div>
                    <br/>
                    <div class="form-group">
                    <input type="password" class="form-control" name="Confirm_Contra" placeholder="Confirme su contraseña">
                    </div>
                    
                    
                    <div class="form-group">
                    <label for="exampleInputPassword1"></label>
                    <input type="hidden" class="form-control" name="Cant_Seguidores" placeholder="" value=0>
                    </div>
                    <br/>
                    <input type="checkbox" name="Suser" value="1"> Admin
                    <br/><br/> 
                    <button type="submit" class="btn btn-success">Registrarse</button>
                    <a class="btn btn-danger" href="index.php">Volver</a>
                    </form>
                    <?php if(!empty($message)):?>
                    <p> <?=$message ?></p>
                    <?php endif;?>


        </div>
    </div>
    
</div>





<?php include("template/pie.php");?>