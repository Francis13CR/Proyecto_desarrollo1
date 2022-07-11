<?php
namespace Medoo;

require 'Medoo.php';

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '1609',
]);

if ($_POST) {
    if ($_POST['categoria'] == 0) {
        $images = $database->select("images", "*", [
            "status" => 1,
        ]);
    } else {

        //coger las imagenes donde el status sea 1 y la categoria ingresada en el formulario
        $images = $database->select("images", "*", ["AND" => ["status" => 1, "id_category" => $_POST["categoria"]]]);
    }

} else {

//coger todas las imagenes donde el status sea 1
    $images = $database->select("images", "*", [
        "status" => 1,
    ]);
}

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <link rel="stylesheet" href="../css/gallery.css">
    <title>Galeria</title>
</head>

<body>
    <section class="container">
        <header class="top-section">
            <a href="index.php">
                <img src="../imgs/social/logo.png" class="logo" alt="logo">
            </a>
            <h1 class="top-title">Galeria</h1>
            <p class="top-p"> lugares</p>
        </header>

        </div>



        <section class="inner-grid">
            <table class="">
                <tbody>
                    <?php cat();?>
                </tbody>
                <?php
                    function llenarSelect()
                    {
                        global $database;
                        $categorias = $database->select("places_category", "*");
                        foreach ($categorias as $categoria) {
                        $name = utf8_encode($categoria["name_category"]);
                        echo "<option value='" . $categoria["id_category"] . "'>" . $name . "</option>";
                        }
                    }
                        //contar el total de imagenes por categoria
                    function imagenes()
                    {
                        global $database;
                        $categorias = $database->select("places_category", "*");
                        foreach ($categorias as $categoria) {
                        $name = utf8_encode($categoria["name_category"]);
                        $total = $database->count("images", ["AND" => ["status" => 1, "id_category" => $categoria["id_category"]]]);
                        echo "<option value='" . $categoria["id_category"] . "'>" . $name . " (" . $total . ")</option>";
                        }
                    }
                    function cat()
                    {
                        global $database;
                        $categorias = $database->select("places_category", "*");
                        foreach ($categorias as $categoria) {
                            $name = utf8_encode($categoria["name_category"]);
                            $total = $database->count("images", ["AND" => ["status" => 1, "id_category" => $categoria["id_category"]]]);

                        }
                    }
                    //total de imagenes

                    //total de imagenes por categoria

                    if ($_POST && $_POST['categoria'] != 0) {
                         $total_categoria = $database->count("images", ["AND" => ["status" => 1, "id_category" => $_POST["categoria"]]]);
                            echo "<p class=' form-title'>Total de imagenes en la categoria buscada: " . $total_categoria . "</p>";
                        } else {
                            $total = $database->count("images", ["status" => 1]);
                            echo "<p class='form-title'>Total de imagenes en la galeria: " . $total . "</p>";
                        }

                ?>

                <form action="gallery.php" method="post">
                    <select class="form-item" name="categoria" id="categoria">
                        <option value="0">Todas</option>
                        <?php imagenes();?>
                    </select>
                    <input class="btn buscar" type="submit" value="Buscar">
                </form>





                <?php
                session_start();
                    foreach ($images as $image) {
                        $date = date_create($image['pub_date']);
                        $date = date_format($date, 'd-m-Y');
                        //comprobar si el usuario ha votado la imagen
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
                       

                        echo '<section data-aos="fade-up" class="inner-col card">
                                                    <div class="media">
                                                    <img src="../imgs/uploads/' . $image['main_image'] . '" alt="' . $image['title'] . '" class="image">
                                                    </div>
                                                    <div class="inner-content">
                                                        <h2 class="inner-title">' . $image['title'] . '</h2>
                                                        <p class="inner-p"> Fecha de publicacion: ' . $date . '</p>
                                                        <p class="inner-p"> Autor: ' . $image['autor'] . ' </p>
                                                            <form action="galleryDetails.php" method="post">

                                                                <button type="submit" name="ver"
                                                                class="btn" value=' . $image['id'] . '>Ver mas </button>
                                                            </form>
                                                            
                                                                <button id="vote'.$image['id'].'" type="submit" name="votar"
                                                                class="btn-vote  " onclick="vote('.$image['id'].')"   value=' . $image['id'] . '>'.$icon.'</button>
                                                         


                                                    </div>
                                                </section>';
                    }
                    ?>
            </section>


    </section>
    <footer class="footer">
        <img src="../imgs/social/logo.png" class="logo-footer" alt="logo">
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    AOS.init();
     //funcion para los votos de las imagenes
        function vote(id) {

       
        
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
                    } else {
                        btn.innerHTML = '<i class="material-icons">thumb_up_off_alt</i>';
                    }


                
                    
                }
            })


    }

    </script>

</body>

</html>