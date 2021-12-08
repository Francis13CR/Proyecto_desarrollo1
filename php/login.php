<?php

namespace Medoo;

require './php/Medoo.php';

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '1609'    
]);

if($_POST){
    if(isset($_POST['username']) and isset($_POST['password'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $userExist=$database->has('usuarios',[
            "username"=>$username]);

            if($userExist){
                $user=$database->get()
            }

    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>

<section class="container  ">
    <!--HEADER-->
        <header class="logo">
            <a href="index.html">
                <img src="../imgs/social/logo.png" alt="FotoTop">
            </a>
        </header>
    <!--HEADER-->

    <!--FORM-->
        <div class="">
            <section class="form-container">
                <h1 class="title">Inicio de sesión</h1>
                <p id="alerta-login" class="alert">lorem</p>

                <FORM id="login.php" method="post">

                    <div class="form-group">
                        <label class="form-label" for="username"></label>
                        <input class="form-input" type="text" id="username" name="username"
                            placeholder="Ingrese el nombre de usuario" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password"></label>
                        <input class="form-input" type="password" placeholder="Ingrese la contraseña" id="password-login"
                            name="titulo" required>
                    </div>
                      <button type="submit" onclick="singIn();" class="btn cursor centered">Iniciar sesión</button>
                </FORM>
                <section class="btn-section">
                    <div class="btn-div">
                    
                            <button href="./singup.html" class="btn cursor">Registrarse</button>

                            <button href="./PassRecovery.html" class="side-margin-auto btn cursor ">Restablecer la contraseña</button>
                    </div>
                    
                </section>

            </section>
        </div>
    <!--FORM-->
    </section>

 <script src="./js/App.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/MotionPathPlugin.min.js"></script>
    
</body>

</html>