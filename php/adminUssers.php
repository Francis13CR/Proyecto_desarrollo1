<?php

namespace Medoo;

require './php/Medoo.php';

$database = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'fototop',
    'username' => 'root',
    'password' => '',
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
    <link rel="stylesheet" href="./css/index.css">
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
                        <img src="./imgs/index-imgs/svg/bars.svg" alt="menu bar">
                    </label>
                    <a href="index.html">
                        <img src="./imgs/logo.png" alt="FotoTop" class="logo">
                    </a>
                    <!--<label>

            </label> -->

                </nav>

                <h1 class="header-txt"> Usuarios Registrados</h1>


            </section>
        </header>
        <!--HEADER-->

        <!-- <section class="inner-grid inner-bg mt-3">
            <section class="inner-col">
                <div>
                    <img class="inner-img" src="./imgs/usser.JPG" alt="usser">
                </div>
                <div >
                    <p class="inner-check-content mt-3 mr-3">Nombre: Andres Alpizar<br><br>Usuario: Alpzar<br><br>Correo: correo@ejemplo.es<br><br>Contraseña:1234
                    </p>
                </div>
            </section>
        </section> -->

        <section class="inner-grid inner-bg mt-3">
            <section class="inner-col">
              

                <table class="inner-check-content mt-3 mr-3 mb-3 ml-3">
                    <tr>    
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Fecha de creacion </th>
                        <th>Ultimo Login </th>
                    </tr>
                    <?php

            $data = $database->select("users", "*");
           

            for($i=0; $i<count($data); $i++){

                //contar numero de USUARIOS
                $num_users = $database->count("users");
                //mostrar el numero de usuario en cada usuario


                echo "<tr class='mb-3'>";
                echo "<td>".$data[$i]["ID"]."</td>";
                    echo "<td>".$data[$i]["Full_name"]."</td>";
                    
                    echo "<td>".$data[$i]["username"]."</td>";
                    echo "<td>".$data[$i]["email"]."</td>";
                    
                    echo "<td>".$data[$i]["Date_created"]."</td>";
                    echo "<td>".$data[$i]["last_login"]."</td>";
                    
                    // //imprimir numero de usuarios
                    // echo "<td>".$num_users."</td>";
                 echo "</tr>";
                
            }

        ?>
                </table>
              

            </section>
        </section>

        <!--FOOTER-->
        <footer class="admin-footer mt-3">
            <img src="./imgs/logo.png" class="logo-footer" alt="logo">
        </footer>
        <!--FOOTER-->
    </section>

</body>

</html>