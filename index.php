<?php
    $mysql = new mysqli("localhost", "janpo", "12345", "Hardware_Store", 3306);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if ($mysql->connect_error){
        die("Fallo de Conexion: " . $mysql->connect_error);
    }

    class Server{  
        public function __construct(){
            $this -> init();
        }
        public function init(){
            global $mysql;
            require('database/database.php');
            $db = new database();
            $productos_Oferta = $db->ofertas();
            $productos_mas_vendidos = $db->mas_vendidos();
            include 'templates/inicio.php';
        }   
    }
    new Server();
?>