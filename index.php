<?php
    if ($mysql->connect_error){
        die("Fallo de Conexion: " . $mysql->connect_error);
    }

    class Server{  
        public function __construct(){
            $this -> init();
        }
        public function init(){
            /*Session json*/
            $_SESSION['email_user'] = null;
            if (!isset($_SESSION['email_user'])){
                $jsonList = 'static/json/lista.json';
                $file = file_get_contents($jsonList);
                $data = json_decode($file,true);
                $llaves = array_keys($data);
                $llaves_Numericas = array_filter($llaves,'is_numeric');
                $num_session = (empty($llaves_Numericas)) ? 1 : end($llaves_Numericas) + 1;

                session_start();
                $_SESSION['email_user'] = $num_session;
                $data[$num_session]["productos"] =[];
                file_put_contents($jsonList, json_encode($data,  JSON_PRETTY_PRINT));     
                header('Location: templates/inicio.php');
                exit();
            }       
        }   
    }
    new Server();
?>