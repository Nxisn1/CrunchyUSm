<?php 
session_start();
require 'Admin/Config/BD.php';

if (!empty($_POST['Rol_user']) && !empty($_POST['Pass'])) {
    $records =  $conexion->prepare('SELECT Rol_user, Nombre, Correo, F_nacimiento, Pass, Cant_Seguidores, Suser FROM usuarios WHERE Rol_user=:Rol_user');
    $records->bindParam(':Rol_user',$_POST['Rol_user']);
    $records->execute();

    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if( is_countable($results) && $_POST['Pass'] == $results['Pass']){
        $_SESSION['Rol_user'] = $results['Rol_user']; //se pone todas las variables para poder ocuparlas en distintos archivos
        $_SESSION['Nombre'] = $results['Nombre']; 
        $_SESSION['Correo'] = $results['Correo']; 
        $_SESSION['F_nacimiento'] = $results['F_nacimiento']; 
        $_SESSION['Pass'] = $results['Pass']; 
        $_SESSION['Cant_Seguidores'] = $results['Cant_Seguidores']; 
        $_SESSION['Suser'] = $results['Suser'];

        header('Location:Inicio.php');
    }else{ 
        $message = 'Rol o Contraseña incorrectos.';
        
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
            <br/><br/><br/><br/><br/>      
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                        <?php if(isset($message)){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php }?>

                        <form method="POST">

                        <div class = "form-group">
                        <label >Rol</label>
                        <input type="text" class="form-control" name="Rol_user" placeholder="Escribe tu rol">
                        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos tus datos.</small>
                        </div>
                        <div class="form-group">
                        <label >Contraseña</label>
                        <input type="password" class="form-control" name="Pass" placeholder="Escribe tu contraseña">
                        </div> 
                        <br/> 
                        <button type="submit" class="btn btn-success">Entrar</button>
                        <a class="btn btn-info" href="Registro.php" role="button">Registrarse</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>