<?php
    namespace Medoo;
    require 'Medoo.php';

  $database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''    
]);


//coger todas las imagenes donde el status sea 1
    $images = $database->select("images", "*", [
        "status" => 1
    ]);



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
           <?php
                    foreach ($images as $image) {
                        $date = date_create($image['pub_date']);
                        $date = date_format($date, 'd-m-Y');


                        echo '<section data-aos="fade-up" class="inner-col card">
                                <div class="media">
                                <img src="../imgs/uploads/'.$image['main_image'].'" alt="'.$image['title'].'" class="image">
                                </div>
                                <div class="inner-content">
                                    <h2 class="inner-title">'.$image['title'].'</h2>
                                    <p class="inner-p"> Fecha de publicacion: '.$date.'</p>
                                     <p class="inner-p"> Autor: '.$image['autor'].' </p>
                                        <form action="galleryDetails.php" method="post">
                    
                                            <button type="submit" name="ver"
                                            class="btn" value='.$image['id'].'>Ver mas </button>
                                        </form>
                                        <form action="votar.php" method="post">
                                            <button type="submit" name="votar"
                                            class="btn-vote " value='.$image['id'].'>Votar </button>
                                        </form>
                    
                                            
                                </div>
                            </section>';
                    }
            ?>   






           
        </section>
        

  </section>
   <footer class="footer">
       <img src="../imgs/social/logo.png"  class="logo-footer" alt="logo">
   </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
      AOS.init();
  </script>

</body>

</html>