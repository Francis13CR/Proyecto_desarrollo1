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
// cerrar sesion
session_start();
session_destroy();
 header("Location: login.php");



?>