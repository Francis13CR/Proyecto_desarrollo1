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

$categories = $database->select("places_category", "*");
//var_dump($categories);



?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/placeForm.css">
    <title>Formulario de envio de lugar </title>
</head>

<body>
    <section class="container  ">
        <header class="logo">
            <a href="index.html">
                <img src="/imgs/social/logo.png" alt="FotoTop">
            </a>
        </header>
        <div >


            <section class="form-container">
                <h1 class="title">Formulario de Envio</h1>
                <p id="alerta-place" class="alert">lorem</p>
                <FORM id="placeForm" method="post">
                    <div class="form-group">
                        <label class="form-label" for="autor">Datos de autor</label>
                        <input class="form-input ml-5" type="text" id="autor" name="autor" placeholder="Ingrese los datos del autor" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="titulo">Titulo</label>
                        <input class="form-input ml-12 ml-titulo" type="text" placeholder="Ingrese el titulo para la imagen" id="titulo"
                            name="titulo" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="descripcion">Descripcion</label>
                        <input class="form-input ml-des"  type="text" id="description"
                            placeholder="Ingrese la descripcion para la imagen"
                            name="description" required>
                    </div>
                     <div class="form-group">
                         <label class="form-label" for="categoria">Categoria</label>
                         <select class="form-input ml-8 ml-cat" id="categorias" name="categoria" required>
                           <?php
                           for($index=0; $index<count($categories); $index++){
                            echo "<option value='".$categories[$index]
                            ["id_category"]."'>".$categories[$index]
                            ["name_category"]."</option>";
                           }
                           ?>
                         </select>
                     </div>
                    <div class="form-group">
                        <label class="form-label" for="Images">Imagenes</label>
                        <input class="form-input ml-img" type="file" id="Images" name="Images" accept="image/*" multiple required>
                    </div>
                    <button type="submit" onclick="formplace();" class="btn cursor"> Enviar</button>


                </FORM>
                
                    <button href="index.html" class="btn cursor">Volver</button>

            </section>
        </div>

    </section>

  <script src="./js/App.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/MotionPathPlugin.min.js"></script>
</body>

</html>