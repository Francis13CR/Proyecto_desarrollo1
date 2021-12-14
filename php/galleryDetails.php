<?php
    namespace Medoo;

    require 'Medoo.php';

    //base de francis
  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''    
]);

$data='';
if($_POST){
   $id = $_POST['ver'];
    $data = $database->select("images", "*", ["id" => $id]);

}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://allfont.es/allfont.css?fonts=agency-fb" rel="stylesheet" type="text/css" />
    <link href="https://allfont.es/allfont.css?fonts=book-antiqua" rel="stylesheet" type="text/css" />
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="../css/galeryDetails.css">
    <title>Galery Details</title>
</head>

<body>
    <section class = "container">
        <!--HEADER-->
        <header class="top-section">
            <section class = " inner-grid">
                <a href="index.php">
                    <img src="../imgs/social/logo.png" alt="FotoTop" class="logo">
                </a>
            </section>
        </header>
        <!--HEADER-->

        <!--ABOUT-->
        <?php
        session_start();
            foreach ($data as $image) {
                //pasar la fecha de creacion a una fecha legible
                $date = date_create($image['pub_date']);
                $date = date_format($date, 'd-m-Y');

                //contar los votos que tiene la imagen
                $votes = $database->count("images_likes", ["id_place" => $image['id']]);

                //mostrar la categoria a la que pertenece la imagen
                $category = $database->select("places_category", "*", ["id_category" => $image['id_category']]);
                 $id_user='';
                        if (isset($_SESSION['user'])) {
                               $id_user = $_SESSION['id'];
                        }
                    
                       $voted= $database->select("images_likes", "*", ["id_place" => $image['id'], "id_user" => $id_user]);
                        //si el usuario ha votado la imagen, mostrar el icono de votado
                        if ($voted) {
                            $icon = '<i class="material-icons">thumb_up</i>';
                        } else {
                            $icon = '<i class="material-icons">thumb_up_off_alt</i>';
                        }
               
                //mostrar el nombre de la categoria
                foreach ($category as $cat) {
                    $category = $cat['name_category'];
                    //pasar el nombre a utf8
                    $category = utf8_encode($category);
                }
                
              





                        echo ' <section class = "inner-grid">
                              <h1 class="title">'.$image['title'].'</h1>
                                 <h2 id ="votes" class="votes">Votos: '.$votes.' </h2>
                                       <button id="vote'.$image['id'].'" type="submit" name="votar"
                                     class="button btn-rigth " onclick="votacion('.$image['id'].')"   value=' . $image['id'] . '>'.$icon.'</button>
                                                         
                                                         
                                  <img src="../imgs/uploads/'.$image['main_image'].'" alt="'.$image['title'].'" class="img">
                                  <h3 class="subtitle mt-2 mb-1">
                                        Descripción: <br>
                                        <span class="text">'.$image['description'].'</span>
                                    </h3>
                                     <h4 class="subtitle">
                                            Autor: <br><span>'.$image['autor'].'</span>
                                        </h4>

                                        <h5 class="subtitle">
                                            Categoria: <br> <span>'.$category.'</span>
                                        </h5>

                                        <h6 class="subtitle mb-2">
                                            Fecha de publicación: '.$date.'
                                        </h6>

                                        <!--BUTTONS-->
                                        <div class= "mt-3">
                                            <a  href="'.$_SERVER["HTTP_REFERER"].'"class="button btn-left">Volver</a>
                                            <a href="index.php" class="button btn-rigth">Inicio</a>
                                        </div>

                                                        
                            </section>';
                    }
        ?>


        <!--ABOUT-->

        <!--FOOTER-->
        
        <footer class="bottom-section">
            <img src="../imgs/social/logo.png" alt="FotoTop" class="logo">
        </footer>
        <!--FOOTER-->
    </section>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    
     //funcion para los votos de las imagenes
        function votacion(id) {

       
        
        fetch("votar.php", {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(id)
            })
            .then(response => response.json())
            .then(data => {
                if (data === 401) {
                    swal.fire({
                        title: 'Debes iniciar sesion para poder votar',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Iniciar sesion'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "login.php";
                        }
                    })
                }
                if (data === 200) {
                    
                   //si ya vota entonces el icono cambia a votado
                
                    btn = document.getElementById("vote"+id);
                    //cambiar el icono a votado a la imagen
                    if (btn.innerHTML === '<i class="material-icons">thumb_up_off_alt</i>') {
                        btn.innerHTML = '<i class="material-icons">thumb_up</i>';
                        //sumar al contador de votos
                        vote = document.getElementById("votes");
                        vote.innerHTML = "Votos: " + (parseInt(vote.innerHTML.split(":")[1]) + 1);
                        
                    } else {
                        btn.innerHTML = '<i class="material-icons">thumb_up_off_alt</i>';
                        //restar al contador de votos
                        vote = document.getElementById("votes");
                        vote.innerHTML = "Votos: " + (parseInt(vote.innerHTML.split(":")[1]) - 1);
                    }


                
                    
                }
            })


    }

    </script>
</body>

</html>