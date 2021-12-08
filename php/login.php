<?php

namespace Medoo;

require 'Medoo.php';

// base de datos francis
// $database = new Medoo([
//     'database_type' => 'mysql',
//     'database_name' => 'fototop',
//     'server' => 'localhost',
//     'username' => 'root',
//     'password' => ''    
// ]);
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '1609'    
]);

if($_POST){
    if(isset($_POST['username'])  && isset($_POST['password'])){
        $username=$_POST['username'];
        $password=$_POST['password'];




        $userExist=$database->get('users', '*',[
            "username"=>$username
        ]);

            if($userExist){
                
                if(password_verify($password, $userExist['Password'])){
                    session_start();
                    $_SESSION["id"]=$user["ID"];
                    $_SESSION["username"]=$user["username"];
                    header("Location: \index.html");
                }
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
                <h1 class="title">Inicio de sesión   </h1>
                <p id="alerta-login" class="alert">lorem</p>

                <FORM action="login.php" method="post">

                    <div class="form-group">
                        <label class="form-label" for="username"></label>
                        <input class="form-input" type="text" id="username" name="username"
                            placeholder="Ingrese el nombre de usuario" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password"></label>
                        <input class="form-input" id="password" type="password" placeholder="Ingrese la contraseña" id="password"
                            name="password" required>
                    </div>
                      <button type="submit" class="btn cursor centered">Iniciar sesión</button>
                </FORM>
                <section class="btn-section">
                    <div class="btn-div">
                    
                            <a href="singup.php" class="btn cursor">Registrarse</a>

                            <button href="./PassRecovery.html" class="side-margin-auto btn cursor ">Restablecer la contraseña</button>
                    </div>
                    
                </section>

            </section>
        </div>
    <!--FORM-->
    </section>

 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/MotionPathPlugin.min.js"></script>
    
</body>

</html>