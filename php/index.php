<?php

namespace Medoo;

require_once 'Medoo.php';

//base de francis
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '1609'    
]);

$login = false;
session_start();
if(isset($_SESSION['login'])){
      $login = $_SESSION['login'];
    if(isset($_SESSION['user'])){
        $usuario = $_SESSION['user'];
      
    }elseif(isset($_SESSION['user_admin'])){
        $usuarioAdmin=$_SESSION['user_admin'];
    }
}
//insertar las categorias en la tabla si aun no estan creadas
$ciudad = $database->get("places_category", "*", ["name_category[~]" => 'Ciudad']);
if(empty($ciudad)){
    
    $database->insert("places_category", [
        "name_category" => 'Ciudad'
    ]);
}
$playa = $database->get("places_category", "*", ["name_category[~]" => 'Playa']);
if(empty($playa)){
    
    $database->insert("places_category", [
        "name_category" => 'Playa'
    ]);
}
$Animales = $database->get("places_category", "*", ["name_category[~]" => 'Animales']);
if(empty($Animales)){
    
    $database->insert("places_category", [
        "name_category" => 'Animales'
    ]);
}
$Cultura = $database->get("places_category", "*", ["name_category[~]" => 'Cultura']);
if(empty($Cultura)){
    
    $database->insert("places_category", [
        "name_category" => 'Cultura'
    ]);
}
$Deporte = $database->get("places_category", "*", ["name_category[~]" => 'Deporte']);
if(empty($Deporte)){
    
    $database->insert("places_category", [
        "name_category" => 'Deporte'
    ]);
}
$naturaleza = $database->get("places_category", "*", ["name_category[~]" => 'Naturaleza']);
if(empty($naturaleza)){
    
    $database->insert("places_category", [
        "name_category" => 'Naturaleza'
    ]);
}
$Otros = $database->get("places_category", "*", ["name_category[~]" => 'Otros']);
if(empty($Otros)){
    
    $database->insert("places_category", [
        "name_category" => 'Otros'
    ]);
}



?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/brands.min.css">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link href="https://allfont.es/allfont.css?fonts=agency-fb" rel="stylesheet" type="text/css" />
    <link href="https://allfont.es/allfont.css?fonts=book-antiqua" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/index.css">
    <title>FotoTop</title>
</head>

<body onload="validateLogin();">
    <section class="container">
        <!--HEADER-->
        <header class="background-img">
            <section class="inner-grid">
                <nav class="top-menu">
                    <!--Menu de navegacion-->
                    <input id="menu" type="checkbox">
                    <label class="bars" for="menu">
                        <img src="../imgs/index-imgs/svg/bars.svg" alt="menu bar">
                    </label>
                    <a href="index.php">
                        <img src="../imgs/social/logo.png" alt="FotoTop" class="logo">
                    </a>
            <label>

            </label>
                    <ul class="top-menu-items">
                        <li class="top-menu-item">
                            <a class="top-menu-social w3-xxlarge" href="https://facebook.com"
                                aria-label="link a facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="top-menu-item">
                            <a class="top-menu-social w3-xxlarge" href="https://twitter.com"
                                aria-label="link a twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="top-menu-item">
                            <a class="top-menu-social w3-xxlarge" href="https://instagram.com"
                                aria-label="link a instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

                <h1 class="slogan"> Comparte tus aventuras<br>con el mundo</h1>
                <?php if(!$login){?> 
                <a id="log" class="log-btn mt-9" href="login.php">Iniciar sesión</a>
                <a id="regis" class="log-btn mt-1" href="singup.php">Registrarse</a>
                <?php }else{     
                    if(isset($_SESSION['user'])){?>
                        <p class="log-btn mt-9" > Bienvenido <a href = ./profile.php> <?php echo $usuario?> </a> </p>  
                        <?php }else{?>
                        <p class="log-btn mt-9" > Bienvenido Admin <?php echo $usuarioAdmin?> </p>
                        <?php }?>  
                        <a id="log" class="log-btn mt-1" href="logout.php">Cerrar sesión</a>
                <?php }?>
            </section>
        </header>
        <!--HEADER-->

        <!--GALERIA-->
        <section class="inner-grid inner-bg mt-3">
            <section class="inner-col">
                <div>
                    <img class="inner-img" src="../imgs/index-imgs/night_sky.jpeg" alt="night sky">
                </div>
                <div class = "center-right">
                    <h3 class="inner-title">Galeria</h3>
                    <p class="inner-content">Aquí veras todos los<br>bellos lugares que<br>nos han compartido</p>
                <a class="inner-btn" href="gallery.php">
                    Ver mas
                </a>
                </div>
            </section>
        </section>
        <!--GALERIA-->
        
        <?php if(!isset($_SESSION['user_admin'])){?>
        <!--FORMULARIO-->
        <section class="inner-grid inner-bg mt-3">
            <section class="inner-col mt-3">
                <div class="center-left">
                    <h3 class="inner-title">Formulario</h3>
                    <p id="forms" class="inner-content">Aquí podras subir<br>tus lugares favoritos<br>a nuestra pagina</p>
                    <a class="inner-btn" href="placeForm.php">Enviar formulario</a>
                    
                </div>
                <div>
                    <img class="inner-img fr inner-img-left" src="../imgs/index-imgs/quiet_bird.jpg" alt="quiet bird">
                </div>
            </section>
        </section>
        <!--FORMULARIO-->
        <?php }else{?>
               <section class="inner-grid inner-bg mt-3">
            <section class="inner-col mt-3">
                <div class="center-left">
                    <h3 class="inner-title">Modulo administrativo</h3>
                    <p id="forms" class="inner-content">Aquí podras revisar los<br>lugares enviados<br> y consultar los usuarios registrados.</p>
                    <a class="inner-btn" href="adminHome.php">ir a administracion</a>
                    
                </div>
                <div>
                    <img class="inner-img fr inner-img-left" src="../imgs/ussers.JPEG" alt="admin users">
                </div>
            </section>
        </section>
        <?php }?>


        <!--TOP 10-->
        <section class="inner-grid inner-bg mt-3">
            <section class="inner-col mt-3">
                <div>
                    <img class="inner-img" src="../imgs/index-imgs/cocodrile.jpg" alt="cocodrilito">
                </div>
                <div class="center-right">
                    <h3 class="inner-title">Top 10</h3>
                    <p class="inner-content">Aquí podras mirar<br>los lugares mas votados<br>de nuestra pagina</p>
                <a class="inner-btn" href="topTen.php">
                    Ver mas
                </a>
                </div>
                
            </section>
        </section>
        <!--FORMULARIO-->

        <!--FOOTER-->
        <footer class="footer mt-3">
            <img src="../imgs/social/logo.png"  class="logo-footer" alt="logo">
        </footer>
        <!--FOOTER-->
    </section>
    <script src="./js/App.js"></script>
</body>

</html>