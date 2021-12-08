<?php

namespace Medoo;

require 'Medoo.php';

$database = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'fototop',
    'username' => 'root',
    'password' => '1609',
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
    <link rel="stylesheet" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- SweetAlert2 -->
    <script>
    function error() {
        Swal.fire({
            icon: 'error',
            title: 'El usuario no existe en el registro  o ha introducido mal el nombre de usuario...',
            text: 'Por favor, verifique los datos introducidos. También puede ver la lista de todos los usuarios al presionar el botón buscar sin introducir ningun nombre.',

        })
    }
    </script>
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

        <section class="inner-grid inner-bg mt-3">
            <section class="inner-col">

                <form class="inner-check-content" action="adminUssers.php" method="POST">
                    <input type="text" id="buscar" name="buscar" placeholder="Buscar nombre Usuario">
                    <input class="search-btn" type="submit" value="Buscar">
            </section>
        </section>

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

                    //buscar usuarios
                        
                        
                        if ($_POST && $_POST['buscar'] != "") {
                            $buscar = $_POST['buscar'];
                            $user = $database->select('users', '*', [
                            'username' => $buscar,

                            ]);     
                            if ($user) {
                                foreach ($user as $user) {
                                    echo "<tr>";
                                    echo "<td>" . $user['ID'] . "</td>";
                                    echo "<td>" . $user['Full_name'] . "</td>";
                                    echo "<td>" . $user['username'] . "</td>";
                                    echo "<td>" . $user['email'] . "</td>";
                                    echo "<td>" . $user['Date_created'] . "</td>";
                                    echo "<td>" . $user['last_login'] . "</td>";
                                    echo "</tr>";
                                }

                            } else {
                                echo '<script type="text/javascript">
                            error();
                            </script>';
                            }
                        } else if (!$_POST || $_POST['buscar'] == "" ) {

                            $data = $database->select("users", "*");

                            for ($i = 0; $i < count($data); $i++) {

                                //contar numero de USUARIOS
                                $num_users = $database->count("users");
                                //mostrar el numero de usuario en cada usuario

                                echo "<tr class='mb-3'>";
                                echo "<td>" . $data[$i]["ID"] . "</td>";
                                echo "<td>" . $data[$i]["Full_name"] . "</td>";

                                echo "<td>" . $data[$i]["username"] . "</td>";
                                echo "<td>" . $data[$i]["email"] . "</td>";

                                echo "<td>" . $data[$i]["Date_created"] . "</td>";
                                echo "<td>" . $data[$i]["last_login"] . "</td>";

                                // //imprimir numero de usuarios
                                // echo "<td>".$num_users."</td>";
                                echo "</tr>";

                            }
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