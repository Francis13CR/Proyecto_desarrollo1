<?php

namespace  Medoo;

require './php/Medoo.php';

$database = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'fototop',
    'username' => 'root',
    'password' => ''
]);




$message = '';
if ($_POST) {


    //consulta para verificar
    $username = $_POST['username'];
    $email = $_POST['email'];
    $user_rep = '';
    //consulta
    $user_rep = $database->select('users', 'username', [
        'username' => $username
    ]);
    //seleccionar si el email ya existe
    $email_exist = $database->select('users', 'email', [
        'email' => $email
    ]);




    //ssi ya existe en el sistema entonces devolver el mensaje 
    if ($user_exist) {
        $message = 'Este nombre de usuario ya se encuentra registrado';
    } else if ($email_exist) {
        $message = 'este correo electrónico ya se encuentra registrado';
    } else {
        //si no existe entonces insertar
        $password = $_POST['password'];
        //encripatando la contraseña
        $password = password_hash($password, PASSWORD_DEFAULT);

        //variable con la fecha y hora actual
        $date = date('Y-m-d H:i:s');




        $database->insert('users', [
            'username' => $_POST['username'],
            'password' => $password,
            "email" => $_POST["email"],
            "Full_name" => $_POST["full_name"],
            "Date_created" => $date

        ]);

        echo '<script>alert("Usuario registrado")</script>';
        //despues de registrar redireccionar a login
        header('Location: login.php');
    }
}


?>











<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/singup.css">
    <title>Sing up</title>
</head>

<body class="background-img">
    <section class="container">
        <!--HEADER-->
        <header>
            <section class="inner-grid centered-flex">
                <a href="./index.html">
                    <img src="./imgs/social/logo.png" alt="Logo">
                </a>
            </section>
        </header>
        <!--HEADER-->

        <!--FORMULARIO-->
        <section class="form-container">
            <h1 class="title">Formulario de Registro</h1>
            <p id="alerta-singup" class="alert">lorem</p>

            <form id="singUp" action="singup.php" method="post">
                <div class="form-group dif">
                    <label class="form-label" for="">Nombre completo</label>
                    <input class="form-input" type="text" id="full_name" name="full_name" required>
                </div>
                <div class="form-group dif">
                    <label class="form-label" for="email">Correo electronico</label>
                    <input class="form-input" type="email" id="email" name="email" required>
                </div>

                <div class="form-group dif">
                    <label class="form-label" for="user">Usuario</label>
                    <input class="form-input" type="text" id="username" name="Usuario" required>
                </div>
                <div class="form-group dif">
                    <label class="form-label" for="password">Contraseña</label>
                    <input class="form-input" type="password" id="password" name="password" required>
                </div>
                <div class="form-group dif">
                    <label class="form-label" for="password-validation">Repita la contraseña</label>
                    <input class="form-input" type="password" id="passwordValidation" name="password-validation" required>
                </div>
                <div class="df">
                    <button type="submit" onclick="singUp();" class="btn cursor centered-flex">Registrarse</button>
                </div>
                <button href="index.html" class="btn cursor centered-flex">Volver
                </button>
            </form>

        </section>
        <!--FORMULARIO-->


    </section>
    <!-- <script src="./js/App.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/MotionPathPlugin.min.js"></script>
</body>

</html>