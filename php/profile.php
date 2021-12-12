<?php

namespace Medoo;

require 'Medoo.php';

//Base de datos Carlos
// $database = new Medoo([
//     'database_type' => 'mysql',
//     'database_name' => 'fototop',
//     'server' => 'localhost',
//     'username' => 'root',
//     'password' => 'Carlexis2609'    
// ]);
//base de francis
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''    
]);
$data_img = $database->select("images", "*");
$img_holder = "";
$title_holder = "";
$description_holder = "";
$date_holder = "";
$user='';
session_start();
$user = $_SESSION['user'];

$profile_info = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://allfont.es/allfont.css?fonts=agency-fb" rel="stylesheet" type="text/css" />
    <link href="https://allfont.es/allfont.css?fonts=book-antiqua" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/profileStyle.css">
    <title>Profile</title>
</head>

<!--BODY-->

<body>
    <section class="container">
        <!--HEADER-->
        <header class="top-section">
            <section class="inner-grid">
                <a href = ./index.php>
                    <img class="ml-6-25 mt-6-25" src="../imgs/logo.png" alt="logo">
                </a>
                <h1 class="profile-name"> Bienvenido a tu perfil,  <?php echo $user ?> </h1>
            </section>
        </header>
        <!--HEADER-->

        <!--PROFILE INFO-->
        <section class="inner-grid">
            <h3 class="inner-title mb-2">Lugares enviados</h3>
            <section class="inner-row ">
                <?php

                for($i = 0; $i < count($data_img); $i++){
                    if($data_img[$i]["status"] == 1 && $user == $data_img[$i]["autor"]){
                        $img_holder = $data_img[$i]["main_image"];
                        $title_holder = $data_img[$i]["title"];
                        $description_holder = $data_img[$i]["description"];
                        $date_holder = $data_img[$i]["pub_date"];

                        echo $profile_info = '<div>
                        <img class="vertical-img" src="../imgs/uploads/'.$img_holder.'"alt="'.$title_holder.'">
                        <p class="inner-text">Titulo: '.$title_holder.' <br> Descripcion: '.$description_holder.' <br> Fecha de publicación: '.$date_holder.'</p>
                    </div>';
                    }
                }
                
                ?>
               <!-- <div>
                    <img class="horizontal-img" src="../imgs/sky1.jpg" alt="sky img">
                    <p class="inner-text">Titulo <br> Descripcion <br> Fecha de publicación</p>
                </div>
            </section>
            <section class="inner-col ml-5 mt-3">
                <div>
                    <img class="vertical-img" src="../imgs/street1.jpg" alt="street photo">
                    <p class="inner-text">Titulo <br> Descripcion <br> Fecha de publicación</p>
                </div>
                <div>
                    <img class="horizontal-img" src="../imgs/sunset1.jpg" alt="sunset photo">
                    <p class="inner-text">Titulo <br> Descripcion <br> Fecha de publicación</p>
                </div>-->
            </section>
        </section>
        <!--PROFILE INFO-->

        <!--FOOTER-->
        <footer>
            <div class="mt-3">
                <img class="footer-logo" src="../imgs/logo.png" alt="logo">
            </div>
        </footer>
        <!--FOOTER-->
    </section>
</body>
<!--BODY-->

</html>