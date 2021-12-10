<?php

namespace Medoo;

require 'Medoo.php';

//base de francis

// $database = new Medoo([
//     'database_type' => 'mysql',
//     'database_name' => 'fototop',
//     'server' => 'localhost',
//     'username' => 'root',
//     'password' => ''
// ]);

//base de audry

// $database = new Medoo([
//     'type' => 'mysql',
//     'host' => 'localhost',
//     'database' => 'fototop',
//     'username' => 'root',
//     'password' => '1609',
// ]);


//Base de datos Carlos
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'Carlexis2609'    
]);
//seleccionar las images donde el estado sea 0

$data_imgs = $database->select("images", "*", [
    "status" => 0
]);


$data_categories = $database->select("places_category", "*");
$amount_imgs = count($data_imgs);
$state = 0;
$img_idholder = "";
$img_holder = "";
$title_holder = "";
$user_holder = "";
$description_holder = "";
$category_holder = "";
$category_idholder = "";
$revision = "";

/*$revision =  '<section id="1" class="inner-grid inner-bg mt-3">
            <section class="inner-col">
                <div>
                    <img class="inner-img" src="../imgs/index-imgs/cocodrile.jpg" alt="cocodrilito">
                </div>
                <div class="center-right">
                    <h3 class="inner-check-title">Titulo</h3>
                    <p class="inner-check-content">Autor:<br><br>Categoria:<br><br>Descripción.
                    </p>
                    <div class="admin-btn-flex">
                    <button class="admin-inner-btn" onclick=<?php $state = 2; echo $state ?>>
                            Rechazar 
                    </button>
                        <button class="admin-inner-btn" onclick=<?php $state = 1; echo $state ?>>
                            Aceptar 
                        </button>
                    </div>
                    
                </div>
            </section>
        </section>';*/



/*
0 = en revision - Estado en el que llega a la pagina (permanece en la pagina mientras el valor de status sea 0)
1 = aprobado - Estado al presionar el boton de aceptar (la imagen podra aparecer en la galeria visible para los usuarios mientras el valor de status sea 1)
2 = rechazado - Estado al presionar el boton de rechazar (la imagen ya no se debera mostrar en ninguna interfaz, se mantendra el registro de esta imagen en la base de datos)
 */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://allfont.es/allfont.css?fonts=agency-fb" rel="stylesheet" type="text/css" />
    <link href="https://allfont.es/allfont.css?fonts=book-antiqua" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/index.css">
    <title>FotoTop</title>
</head>

<body>
    <section class="container">
        <!--HEADER-->
        <header class="admin-background-img">
            <section class="inner-grid">
                <nav class="top-menu">
                    <!--Menu de navegacion-->
                    <input id="menu" type="checkbox">
                    <label class="bars" for="menu">
                        <img src="../imgs/index-imgs/svg/bars.svg" alt="menu bar">
                    </label>
                    <a href="index.html">
                        <img src="../imgs/logo.png" alt="FotoTop" class="logo">
                    </a>
                    <!--<label>

            </label> -->

                </nav>

                <h1 class="header-txt"> Administración</h1>
                <a href="index.html" class="admin-inner-btn">Inicio</a>


            </section>
        </header>
        <!--HEADER-->
        <p id="alerta-control" class="alert"></p>
        <?php


        function button2()
        {
        }


        //recorre todas las imagenes y cambia de estado para que se muestren en la galeria


        for ($i = 0; $i < count($data_imgs); $i++) {

            $img_holder = $data_imgs[$i]["main_image"];
            $img_idholder = $data_imgs[$i]["id"];
            $title_holder = $data_imgs[$i]["title"];
            $user_holder = $data_imgs[$i]["autor"];
            $description_holder = $data_imgs[$i]["description"];
            $category_idholder =  $data_imgs[$i]["id_category"];
            for ($j = 0; $j < count($data_categories); $j++) {
                if ($data_categories[$j]["id_category"] == $category_idholder) {
                    $category_holder = $data_categories[$j]["name_category"];
                }
            }
            echo $revision = '<section id="1" class="inner-grid inner-bg mt-3">
        <section class="inner-col">
            <div>
                <img class="inner-img"  src= "../imgs/uploads/' . $img_holder . '" alt=' . $title_holder . '>
            </div>
            <div class="center-right">
                <h3 class="inner-check-title">Titulo: ' . $title_holder . ' </h3>
                <p class="inner-check-content">Autor:  ' . $user_holder . ' <br><br>Categoria: ' . $category_holder . ' <br><br>Descripción: ' . $description_holder . '
                </p>
                <div class="admin-btn-flex">
                    <form method="post">
                    <div class="admin-btn-flex">
                        <BUTTON type="submit" name="Aceptar"
                        class="admin-inner-btn" value=' .  $img_idholder . '> Aceptar</BUTTON>
                    
                        <BUTTON type="submit" name="Rechazar"
                        class="admin-inner-btn" value=' .  $img_idholder . '> Rechazar</BUTTON>
                    </div>
                    </form>
                ' . /*<button class="admin-inner-btn" onclick= '.$state = 2 .'>
                    Rechazar 
                </button>
                <button class="admin-inner-btn" onclick= '.$state = 1 .'>
                    Aceptar 
                </button>*/  '
                </div>
            </div>
        </section>
    </section>';

            /*elseif(!$data_imgs[$i]["status"] == 0){
        echo $revision = "ya no quedan imagenes por revisar";
    }*/
            if ($_POST) {
            }
        }



        if (array_key_exists('Aceptar', $_POST)) {

            $id = $_POST['Aceptar'];
            $database->update("images", [
                'status' => 1
            ], [
                'id' => $id
            ]);
        } else if (array_key_exists('Rechazar', $_POST)) {
            $id = $_POST['Aceptar'];
            $database->update("images", [
                'status' => 2
            ], [
                'id' => $id
            ]);
        }
        ?>


        <!--FOOTER-->
        <footer class="admin-footer mt-3">
            <img src="../imgs/social/logo.png" class="logo-footer" alt="logo">
        </footer>
        <!--FOOTER-->
    </section>
    <script src="../js/App.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/MotionPathPlugin.min.js"></script>
</body>

</html>