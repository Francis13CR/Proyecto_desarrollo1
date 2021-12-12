<?php
    namespace Medoo;
    require 'Medoo.php';
    //base de francis
  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''    
]);
if($_POST){
   $id = $_POST['ver'];
    $data = $database->select("images", "*", ["id" => $id]);

}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://allfont.es/allfont.css?fonts=agency-fb" rel="stylesheet" type="text/css" />
    <link href="https://allfont.es/allfont.css?fonts=book-antiqua" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/galeryDetails.css">
    <title>Galery Details</title>
</head>

<body>
    <section class = "container">
        <!--HEADER-->
        <header class="top-section">
            <section class = " inner-grid">
                <a href="index.html">
                    <img src="../imgs/social/logo.png" alt="FotoTop" class="logo">
                </a>
            </section>
        </header>
        <!--HEADER-->

        <!--ABOUT-->
        <?php
            foreach ($data as $image) {
                //pasar la fecha de creacion a una fecha legible
                $date = date_create($image['pub_date']);
                $date = date_format($date, 'd-m-Y');

                //contar los votos que tiene la imagen
                $votes = $database->count("images_likes", ["id_place" => $image['id']]);




                        echo ' <section class = "inner-grid">
                              <h1 class="title">'.$image['title'].'</h1>
                                 <h2 class="votes">Votos: '.$votes.' </h2>
                                  <img src="../imgs/uploads/'.$image['main_image'].'" alt="'.$image['title'].'" class="img">
                                  <h3 class="subtitle mt-2 mb-1">
                                        Descripción: <br>
                                        <span class="text">'.$image['description'].'</span>
                                    </h3>
                                     <h2 class="subtitle">
                                            Autor: <br><span>'.$image['autor'].'</span>
                                        </h2>

                                        <h2 class="subtitle">
                                            Categoria: <br> <span>Montaña</span>
                                        </h2>

                                        <h4 class="subtitle mb-2">
                                            Fecha de publicación: '.$date.'
                                        </h4>

                                        <!--BUTTONS-->
                                        <div class= "mt-3">
                                            <a href="gallery.php" class="button btn-left">Volver</a>
                                            <a href="index.php" class="button btn-rigth">Inicio</a>
                                        </div>

                                                        
                            </section>';
                    }
        ?>


        <!--ABOUT-->

        <!--FOOTER-->
        
        <footer class="bottom-section">
            <img src="../imgs/social/logo.png" alt="FotoTop" class="logo">
        </footer>
        <!--FOOTER-->
    </section>
</body>

</html>