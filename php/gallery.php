<?php
namespace Medoo;

require 'Medoo.php';

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '',
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
    <link rel="stylesheet" href="../css/gallery.css">
    <title>Galeria</title>
</head>

<body>
    <section class="container">
        <header class="top-section">
            <a href="index.html">
                <img src="../imgs/social/logo.png" class="logo" alt="logo">
            </a>
            <h1 class="top-title">Galeria</h1>
            <p class="top-p"> lugares</p>
        </header>

        </div>



        <section class="inner-grid">
            <table class="">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Imagenes</th>
                    </tr>
                </thead>
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
                            //hacer una tabla de las categorias con el total de imagenes
                            echo "<tr>";
                            echo "<td>" . $name . "</td>";
                            echo "<td>" . $total . "</td>";
                            echo "</tr>";

                        }
                    }
                    //total de imagenes

                    //total de imagenes por categoria

                    if ($_POST && $_POST['categoria'] != 0) {
                         $total_categoria = $database->count("images", ["AND" => ["status" => 1, "id_category" => $_POST["categoria"]]]);
                            echo "<p class=' '>Total de imagenes en la categoria buscada: " . $total_categoria . "</p>";
                        } else {
                            $total = $database->count("images", ["status" => 1]);
                            echo "<p class=' '>Total de imagenes en la galeria: " . $total . "</p>";
                        }

                ?>

                <form action="gallery.php" method="post">
                    <select class=" " name="categoria" id="categoria">
                        <option value="0">Todas</option>
                        <?php imagenes();?>
                    </select>
                    <input class="" type="submit" value="Buscar">
                </form>





                <?php
                    foreach ($images as $image) {
                        $date = date_create($image['pub_date']);
                        $date = date_format($date, 'd-m-Y');

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
                                                            <form action="votar.php" method="post">
                                                                <button type="submit" name="votar"
                                                                class="btn-vote " value=' . $image['id'] . '>Votar </button>
                                                            </form>


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
    <script>
    AOS.init();
    </script>

</body>

</html>