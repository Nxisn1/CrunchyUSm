    <?php 
    include('Template/Header.php');
    ?>


            <div class="col-md-12">
                <div class="jumbotron">
                    <h1 class="display-3">Bienvenido <?php echo  $_SESSION['Nombre']; ?></h1>
                    <p class="lead">Vamos a administrar</p>
                    <hr class="my-2">
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="Section/Animes.php" role="button">Administrar Animes</a>
                        <a class="btn btn-primary btn-lg" href="Section/Peliculas.php" role="button">Administrar Películas</a>
                    </p>
                </div>     
            </div>
            

<?php include('Template/pie.php') ?>