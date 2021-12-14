<?php

namespace Medoo;

require 'Medoo.php';

//Base de datos Carlos
$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''    
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
    <link rel="stylesheet" href="../css/passRecovery.css">
    <title>Password Recovery</title>
</head>

<body class="background-img">
    <section class="container ">
        <!--HEADER-->
        <header>
            <a href="index.php">
                <img src="../imgs/social/logo.png" alt="FOTOTOP" class="ml-3-1 mt-1-8">
            </a>
        </header>
        <!--HEADER-->

        <!--Password recovery square-->
        <section class="inner-grid form-square inner-col" role="main">
            <h1 class="title">
                Recuperar contraseña
            </h1>
            <form action="PassRecovery.php" method="post">
                <div class="inner-grid ">
                    <label for="username" class="label-text">Ingrese su nombre de usuario</label>
                    <input class="form-item" type="text" id=username name="username">
                </div>
                <div class="inner-grid ">
                    <label for="password" class="label-text">Ingrese su nueva contraseña</label>
                    <input class="form-item" type="password" id=password name="password">
                </div>
            
                <div class="centered ">
                    <input class="recovery-button" type="submit" value="Recuperar contraseña">
                </div>
            </form>

        </section>
        <!--Password recovery square-->
        <div class="inner-grid mt-2 txt-r inner-col">
            <a class="back-btn" href="login.php">Volver</a>
        </div>
    </section>
</body>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
     <script>
         function alert(id){
            if(id ==1){
                let timerInterval
        Swal.fire({
            title: 'cambio de contraseña exitoso!',
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

            }else if(id == 2){
                Swal.fire({
                title: 'Error',
                text: 'No se pudo cambiar la contraseña, el usuario digitado no se encuentra registrado en el sistema',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
            }else if(id == 3){
                Swal.fire({
                title: 'Error',
                text: 'Por favor llene todos los campos',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            })
            }
        }

     </script>


</html>

<?php

$data=$database->select("users","*");
$password = "";
$username = "";
$user_exist = false;
$err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    for($i = 0; $i < count($data); $i++){
        if($data[$i]["username"] == $_POST['username']){
            $user_exist = true;
            $username = $_POST['username'];
        }
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
        if($user_exist){
            $password = $_POST ['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $database->update("users", 
            ['password' => $password
            ], ['username' => $_POST['username']
            ]);
            echo "<script>alert(1)</script>";
        }else{
            echo "<script>alert(2);</script>";
        }
    }else{
      echo '<script>alert(3);</script>';
    }
}



?>