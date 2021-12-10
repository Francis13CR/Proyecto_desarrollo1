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

                <FORM id="placeForm.php" method="post" enctype="multipart/form-data">

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
                        <input class="form-input ml-des"  type="text" id="descripcion"
                            placeholder="Ingrese la descripcion para la imagen"
                            name="descripcion" required>
                    </div>
                     <div class="form-group">
                         <label class="form-label" for="categoria">Categoria</label>
                         <select class="form-input ml-8 ml-cat" id="categorias" name="categorias" required>
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
                        <input class="form-input ml-img" type="file" id="images" name="images" accept="image/*" multiple required>
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

<?php

function generateRandomString($len=15){
return substr(str_shuffle(str_repeat
($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
ceil($len/strlen($x)))),1,$len);
}

//echo "random string =" .generateRandomString();

if(isset($_FILES["images"])){
    $error = array();
    $file_name = $_FILES['images']["name"];
    $file_size = $_FILES['images']["size"];
    $file_tmp = $_FILES['images']["tmp_name"];
    $file_type = $_FILES['images']["type"];
    $file_ext_arr = explode(".", $_FILES["images"]["name"]);

    $file_ext = end ($file_ext_arr);
    $img_ext = array("jpeg","jpg","png");

    if(in_array($file_ext, $img_ext) == false){
        $errors[] = "Solamente JPEG, JPG o PNG como formato para las imágenes";

        //alerta de que no se acepta ese tipo de archivo
        //echo"<h3>".$errors[0]."</h3>";
    }

    if(empty($errors)){
        $img="places-img-".generateRandomString().".".$file_ext;
        move_uploaded_file($file_tmp,"uploads/".$img);

         //variable con la fecha y hora actual
         date_default_timezone_set("America/Costa_Rica");
         $date = date('Y-m-d H:i:s');
 

        $database->insert('images',[
            'autor'=>$_POST['autor'],
            'title'=>$_POST['titulo'],
            'description'=>$_POST['descripcion'],
            'id_category'=>$_POST['categorias'],
            'main_image'=>$img,
            'pub_date'=>$date
        ]);
    
        header("Location: ./index.html");
         
    }

}


?>