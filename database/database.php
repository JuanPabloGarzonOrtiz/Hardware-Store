<?php 
    $mysql = new mysqli("localhost", "janpo", "12345", "Hardware_Store", 3306);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if ($mysql->connect_error){
        die("Fallo de Conexion: " . $mysql->connect_error);
    }
    class database{
        public function consultas($lista_Contenedora, $consulta){
            global $mysql;
            $resultado = $mysql->query($consulta);
            if (!$resultado){
                die("Error de Conexion: " . $mysql->error);
            }
            while($fila = $resultado->fetch_assoc()){
                $lista_Contenedora[] = $fila;
            }
            return $lista_Contenedora;
        }
        public function ofertas(){
            $productos_Oferta = [];
            $sql_ofertas = "SELECT 
                                nombre,
                                precio,  
                                precio * 0.5 AS precio_Descuento, 
                                (SELECT nombre FROM Proveedores  WHERE id_Proveedor = p.id_Proveedor) AS Marca 
                            FROM Productos p WHERE cantidad_Stock <= 50;";
            $productos_Oferta = (new database())->consultas($productos_Oferta, $sql_ofertas);
            return $productos_Oferta;
        }
        public function mas_vendidos(){
            $productos_mas_vendidos = [];
            $sql_mas_vendidos = "SELECT 
                                    nombre, 
                                    precio,
                                    (SELECT nombre FROM Proveedores  WHERE id_Proveedor = p.id_Proveedor) AS Marca 
                                FROM Productos p WHERE cantidad_Stock <= 40;";
            $productos_Oferta = (new database())->consultas($productos_mas_vendidos, $sql_mas_vendidos);
            return $productos_mas_vendidos;
        }
        public function productos_sec($division){
            global $mysql;
            $productos = [];
            $sql_productos ="SELECT 
                                nombre,
                                precio,
                                (SELECT nombre FROM Proveedores WHERE id_Proveedor = p.id_Proveedor) AS Proveedor
                            FROM Productos  p 
                                WHERE clasificacion  = ?";
            $preparacion = $mysql->prepare($sql_productos);
            $preparacion->bind_param("s",$division);
            $preparacion->execute();
            $resultado = $preparacion->get_result();
            if (!$resultado){
                die("Error de Conexion: " . $mysql->error);
            }
            while ($fila = $resultado ->fetch_assoc()){
                $productos[] = $fila;
            }           
            return $productos;
        }
        public function logeo($correo, $contraseña){
            global $mysql;
            $datos =[];
            $sql_logeo = "SELECT 
                            nombre,
                            tipo_Cliente
                        FROM Clientes 	
                            WHERE  email = ? AND contraseña = ?;";
            $preparacion = $mysql->prepare($sql_logeo);
            $preparacion->bind_param("ss",$correo,$contraseña);
            $preparacion->execute();
            $resultado = $preparacion->get_result();
            if (!$resultado){
                die("Error de Conexion: " . $mysql->error);
            }
            while ($fila = $resultado ->fetch_assoc()){
                $datos[] = $fila;
            } 
            return $datos; 
        }
    }
?>