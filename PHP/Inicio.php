<?php include("template/header.php"); ?> 
        

            <div class="jumbotron text-center">
                <h1 class="display-3">Bienvenido <?php echo  $_SESSION['Nombre'];?></h1>
                <p class="lead">Vea anime como todo un campeón</p>
                <hr class="my-2">
            <img width="790" src="Img/Crunchyusm.jpeg" class="img-thumbnail rounded mx-auto d-block" / >    
                <p class="lead">
                    <br/>
                    <a class="btn btn-success btn-lg" href="Animes.php" role="button">Ver Animes</a>
                    <a class="btn btn-warning btn-lg" href="Peliculas.php" role="button">Ver Películas</a>
                    <a class="btn btn-danger btn-lg" href="Explorar.php" role="button">Explorar</a>
                </p>
            </div>


<?php include("template/pie.php"); ?> 
