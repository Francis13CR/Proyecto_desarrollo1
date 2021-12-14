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

//hacer

//mostrar el top 10 de las fotos mas votadas mediante id_place repetido



$top10= $database->select("images_likes", "*", [
    "GROUP" => ["images_likes.id_place"],
    //ordenar mediante la repeticion de id_place
    "ORDER" => Medoo::raw("COUNT(images_likes.id_place) DESC"),
    
    "LIMIT" => 10
]);






?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://allfont.es/allfont.css?fonts=agency-fb" rel="stylesheet" type="text/css" />
    <link href="https://allfont.es/allfont.css?fonts=book-antiqua" rel="stylesheet" type="text/css" />
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <link rel="stylesheet" href="../css/topTen.css">
    <title>TopTen</title>
</head>

<body>
    <section class = "container">
        <!--HEADER-->
        <header class="top-square">
            <a href="index.php">
                <img src="../imgs/social/logo.png" alt="FotoTop" class="logo">
            </a>
        </header>
        <!--HEADER-->

        <!--ABOUT-->
        <section class="inner-grid">
            <section>

                <h1 class="title">
                    Top 10 lugares mas votados
                </h1>
                <div class = "mb-1">
                <?php
                //recorrer el array de top10
                foreach ($top10 as $image) {
                        //seleccionar la imagen
                        $image_path = $database->select("images", "*", ["id" => $image["id_place"]]);
                        //contar los votos que tiene la imagen
                         $votes = $database->count("images_likes", ["id_place" => $image['id_place']]);
                           $icon = '<i class="material-icons">thumb_up</i>';
                       //mostrar la imagen
                       foreach ($image_path as $image_path) {
                               echo "<img src='../imgs/uploads/".$image_path['main_image']."' alt='".$image_path['title']."' class='img-first'>";
                                //mostrar el titulo de la foto
                                echo "<h2 class='subtitle font-2 mb-1'>".$image_path['title']."</h2>";
                 
                                //mostrar el numero de likes
                                echo "<p class='subtitle font-2 mb-1'>".$votes.' '. $icon."</p>";
                                echo  '<form action="galleryDetails.php" method="post"> <button type="submit" name="ver"
                                                                class="centered button mb-3 btn-ver " value=' . $image_path['id'] . '>Ver mas </button>
                                                            </form>';
                        }
                
                }


                ?>
                 </div>
              

               

                <!--BUTTONS-->
                <div class="centered mt-6">
                    <a href="index.php" class="button btn-left">Volver</a>
                    <a href="index.php" class="button btn-rigth">Inicio</a>
                </div>

            </section>
        </section>
        <!--ABOUT-->

        <!--FOOTER-->
        <footer class="bottom-square">
            <img src="../imgs/social/logo.png" alt="FotoTop" class="logo">
        </footer>
        <!--FOOTER-->
    </section>
</body>

</html>