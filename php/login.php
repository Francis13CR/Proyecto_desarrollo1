<?php

namespace Medoo;

require 'Medoo.php';

// base de datos francis

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '1609'    
]);

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
            <a href="index.php">
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
                        <input class="form-input mt-1" id="password" type="password" placeholder="Ingrese la contraseña" id="password"
                            name="password" required>
                    </div>
                      <button type="submit" class="btn cursor centered mt-3">Iniciar sesión</button>
                </FORM>
                <section class="btn-section">
                    <div class="btn-div">
                    
                            <a href="singup.php" class="btn cursor">Registrarse</a>

                            <a href="PassRecovery.php" class="side-margin-auto btn cursor ">Restablecer la contraseña</a>
                    </div>
                    
                </section>

            </section>
        </div>
    <!--FORM-->
    </section>

 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/MotionPathPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    function alert(id){
        if(id == 1){
            Swal.fire({
                title: 'Error',
                text: 'Usuario  incorrecto o no se encuentra registrado',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
        }else if(id == 2){
            Swal.fire({
                title: 'Acceso denegado',
                text: 'Contraseña incorrecta',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
        }


    }
    </script>


    
</body>

</html>




<?php
  session_start();
$_SESSION['login'] = false;

if($_POST){
      
        $username=$_POST['username'];
        $password=$_POST['password'];


         //verificar si el usuario pertenece aun administrador
         $userAdmin=$database->get('user_admin','*', [
            "user_admin"=>$username
        ]);

        //verificar si el usuario se escuentra en la base de datos
        $userExist=$database->get('users', '*',[
            "username"=>$username
        ]);

        var_dump($password);


    if($userAdmin){
            if($password == $userAdmin['password']){
                
                $_SESSION["id"]=$userAdmin["id"];
                $_SESSION["user_admin"]=$username;
                $_SESSION["login"]=true;
                 //actualizar el ultimo de login
            $database->update('user_admin',[
                "last_login"=>date("Y-m-d H:i:s")
            ],[
                "user_admin"=>$username
            ]);
                header("Location: adminUssers.php");

        }elseif(password_verify($password, $userAdmin['password']) ){
                
                $_SESSION["id"]=$userExist["id"];
                $_SESSION["user_admin"]=$username;
                $_SESSION["login"]=true;
                header("Location: adminUssers.php");
           
            
        }else{
            echo '<script>alert(2)</script>';
        }
    
    }else if($userExist){
        if(password_verify($password, $userExist['password'])){
            
            $_SESSION["id"]=$userExist["id"];
            $_SESSION["user"]=$username;
            $_SESSION["login"]=true;

            //actualizar el ultimo de login
            $database->update('users',[
                "last_login"=>date("Y-m-d H:i:s")
            ],[
                "username"=>$username
            ]);



            header("Location: index.php");
        }else{
            echo '<script>alert(2)</script>';
        }
    }else{
        echo '<script>alert(1)</script>';
    }
}         
?>