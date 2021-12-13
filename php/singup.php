<?php

namespace Medoo;

require 'Medoo.php';


//base de francis

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '1609'    
]);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/singup.css">
    <title>Sing up</title>
</head>

<body class="background-img">
    <section class="container">
        <!--HEADER-->
        <header>
            <section class="inner-grid centered-flex">
                <a href="./index.html">
                    <img src="../imgs/social/logo.png" alt="Logo">
                </a>
            </section>
        </header>
        <!--HEADER-->

        <!--FORMULARIO-->
        <section class="form-container">
            <h1 class="title">Formulario de Registro</h1>
            <p id="alerta-singup" class="alert">lorem</p>

            <form action="singup.php" method="post">

                <div class="form-group dif">
                    <label class="form-label" for="">Nombre completo</label>
                    <input class="form-input" type="text" id="full_name" name="full_name" required>
                </div>
                <div class="form-group dif">
                    <label class="form-label" for="email">Correo electronico</label>
                    <input class="form-input" type="email" id="email" name="email" required>
                </div>

                <div class="form-group dif">
                    <label class="form-label" for="username">Usuario</label>
                    <input class="form-input" type="text" id="username" name="username" required>
                </div>
                <div class="form-group dif">
                    <label class="form-label" for="password">Contraseña</label>
                    <input class="form-input" type="password" id="password" name="password" required>
                </div>
                <div class="form-group dif">
                    <label class="form-label" for="password-validation">Repita la contraseña</label>
                    <input class="form-input" type="password" id="password-validation" name="password-validation"
                        required>
                </div>
                <div class="df">
                    <button type="submit" class="btn cursor centered-flex">Registrarse</button>
                </div>
                <button href="index.html" class="btn cursor centered-flex mb-1">Volver
                </button>






            </form>

        </section>
        <!--FORMULARIO-->


    </section>
    <!-- <script src="./js/App.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/MotionPathPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
    function errorEmail() {


        Swal.fire({
            icon: 'error',
            title: 'Este correo electrónico ya se encuentra registrado...',
            text: 'Intente con otro correo electrónico'
        })
    }

    function errorUser() {
        Swal.fire({
            icon: 'error',
            title: 'Este nombre de  usuario ya se encuentra registrado...',
            text: 'Intente con otro nombre de usuario',

        })
    }

    function login() {
        let timerInterval
        Swal.fire({
            title: 'Registro exitoso!',
            html: 'Redireccionando al inicio de sesion...',
            imageUrl: '../imgs/index-imgs/cocodrile.jpg',
            imageWidth: 400,
            imageHeight: 200,
            timer: 4000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
           
            if (result.dismiss === Swal.DismissReason.timer) {
                window.location.href = "login.php";
            }
        })

    }
    </script>

</body>

</html>




<?php

// $message = '';
// $registro = false;
if ($_POST) {

    //consulta para verificar
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordValidation = $_POST['password-validation'];

    if($passwordValidation == $password){
        



    $user_rep = '';
    //consulta
    $user_rep = $database->select('users', 'username', [
        'username' => $username,
    ]);
    //seleccionar si el email ya existe
    $email_exist = $database->select('users', 'email', [
        'email' => $email,
    ]);

    //ssi ya existe en el sistema entonces devolver el mensaje
    if ($user_rep) {
        echo '<script>errorUser();</script>';
        
    } else if ($email_exist) {

        echo '<script type="text/javascript">
       errorEmail();
      </script>';
    } else {
     
        //si no existe entonces insertar
        $password = $_POST['password'];
        //encripatando la contraseña
        $password = password_hash($password, PASSWORD_DEFAULT);

        //variable con la fecha y hora actual
        date_default_timezone_set("America/Costa_Rica");
        $date = date('Y-m-d H:i:s');

        $database->insert('users', [
            'username' => $_POST['username'],
            'password' => $password,
            "email" => $_POST["email"],
            "full_name" => $_POST["full_name"],
            "Date_created" => $date,

        ]);
        //llama a la funcion para mostrar la alerta
        echo '<script type="text/javascript">login();</script>';

    }
}else{
    echo '<script type="text/javascript">
    Swal.fire({
        icon: "error",
        title: "Las contraseñas no coinciden",
        text: "Intente de nuevo",
       
    })
    </script>';
}
}

?>