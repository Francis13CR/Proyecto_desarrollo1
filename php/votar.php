<?php
namespace Medoo;
require 'Medoo.php';

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'fototop',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '1609',
    'charset' => 'utf8'
]);
session_start();

 //recibir los datos del fetch
 if(isset($_SESSION["id"])){
     $id_user = $_SESSION['id'];

        if(isset($_SERVER["CONTENT_TYPE"])){
           
        $contentType = $_SERVER["CONTENT_TYPE"];
            if($contentType === "application/json"){
                 $content = trim(file_get_contents("php://input"));
                $id_image = json_decode($content,true);
                //verificar si el usuario ya voto
                $voto = $database->select("images_likes", "*", ["id_user" => $id_user, "id_place" => $id_image]);
                //si voto existe entonces quitarlos
                if($voto){
                    $database->delete("images_likes", ["id_user" => $id_user, "id_place" => $id_image]);
                }else{
                    //si no existe entonces insertarlo
                    $date = date("Y-m-d H:i:s");
                    $database->insert("images_likes", ["id_user" => $id_user, "id_place" => $id_image, "date_accepted" => $date]);
                    
                }                   

                
                
                echo json_encode(200);
            }
          }
    }else{
        echo json_encode(401);
 
    }







?>