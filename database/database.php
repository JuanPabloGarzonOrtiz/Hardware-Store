<?php 
    session_start();
    
    $mysql = new mysqli("localhost", "janpo", "12345", "Hardware_Store", 3306);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if ($mysql->connect_error){
        die("Fallo de Conexion: " . $mysql->connect_error);
    }

    class database{
        public function consultas_Cuenta($consulta, $lista = "", $email = "", $contraseña = "", $division_producto = ""){
            global $mysql;
            if (empty($email)){
                if (!empty($division_producto)){
                    $preparacion = $mysql->prepare($consulta);
                    $preparacion->bind_param("s",$division_producto);
                    $preparacion->execute();
                    $resultado = $preparacion->get_result();
                }else{
                    $resultado = $mysql->query($consulta);
                }
                if (!$resultado){
                    die("Error de Conexion: " . $mysql->error);
                }
                while ($fila = $resultado->fetch_assoc()){
                    $lista[]= $fila;
                }
                return $lista;
            }else{
                $preparacion = $mysql->prepare($consulta);
                (!empty($contraseña) ? $preparacion->bind_param("ss",$email,$contraseña):$preparacion->bind_param("s",$email));
                $preparacion->execute();
                $resultado = $preparacion->get_result();
                if (!$resultado){
                    die("Error de Conexion: " . $mysql->error);
                }
                if (is_array($lista)){
                    while ($fila = $resultado->fetch_assoc()){
                        $lista[]= $fila;
                    }
                    return $lista;
                }else{
                    return $resultado->fetch_assoc();
                }
            }
        }
        public function ofertas(){
            $sql_ofertas = "SELECT 
                                nombre,
                                precio,  
                                descuento, 
                                (SELECT nombre FROM Proveedores  WHERE id_Proveedor = p.id_Proveedor) AS marca
                            FROM Productos p WHERE cantidad_Stock <= 50;";
            return (new database())->consultas_Cuenta($sql_ofertas, $productos_Oferta = []);
        }
        public function mas_vendidos(){
            $sql_mas_vendidos = "SELECT 
                                    nombre, 
                                    precio,
                                    descuento,
                                    (SELECT nombre FROM Proveedores  WHERE id_Proveedor = p.id_Proveedor) AS marca 
                                FROM Productos p WHERE cantidad_Stock <= 40;";
            return (new database())->consultas_Cuenta($sql_mas_vendidos, $productos_mas_vendidos = []);
        }
        public function logeo($correo, $contraseña){
            $sql_logeo = "SELECT 
                            email,
                            contraseña
                        FROM Clientes 	
                            WHERE  email = ? AND contraseña = ?;";
            $datos =  (new database())->consultas_Cuenta($sql_logeo, null, $correo, $contraseña);
            $session_Anterior = $_SESSION['email_user'];
            $_SESSION['email_user'] =(!empty($datos) ? $correo : "");

            $jsonList = '../static/lista.json';
            $lista = file_get_contents($jsonList);
            $productos = json_decode($lista, true);
            foreach($productos as $producto => &$valor){
                if ($producto == $session_Anterior){
                    unset($productos[$session_Anterior]);
                    $productos[$_SESSION['email_user']] = $valor;
                    file_put_contents($jsonList, json_encode($productos, JSON_PRETTY_PRINT));
                }
            }
            return $datos;
        }
        public function cerrar_Secion(){
            session_destroy();
        }
        public function ultimos_Productos($correo){
            $sql_ultimos = "SELECT 
                                p.nombre,
                                p.precio,
                                p.descuento,
                                (SELECT nombre FROM Proveedores WHERE id_Proveedor = p.id_Proveedor) AS marca
                            FROM Productos p JOIN Historial_Productos hp  ON p.id_Producto = hp.id_Producto
                                WHERE id_Cliente  = (SELECT id_Cliente FROM Clientes WHERE email = ?);";
            return (new database()) ->consultas_Cuenta($sql_ultimos,$ultimos_Vistos = [], $correo );
        }
        public function descuento_Cliente($email){
            $sql_descuento_Cliente ="SELECT
                                        (SELECT nombre FROM Clientes WHERE id_Cliente = hp.id_Cliente ) AS Cliente,
                                        SUM(comprado) AS Cantidad_Compras
                                    FROM Historial_Productos hp 
                                        WHERE (SELECT email FROM Clientes WHERE id_Cliente = hp.id_Cliente) = ?
                                    GROUP BY id_Cliente;";
            return (new database()) ->consultas_Cuenta($sql_descuento_Cliente, null,$email,);
        }
        public function productos_sec($division){
            $sql_productos ="SELECT 
                                nombre,
                                precio,
                                descuento,
                                (SELECT nombre FROM Proveedores WHERE id_Proveedor = p.id_Proveedor) AS marca
                            FROM Productos  p 
                                WHERE clasificacion  = ?";      
            return (new database()) ->consultas_Cuenta($sql_productos, null,null,null,$division);   
        }
        public function buscar_Producto($nombre_producto){
            $sql_buscar_Producto = "SELECT 
                                        nombre,
                                        precio,
                                        precio,
                                        descuento
                                    FROM Productos WHERE nombre = ?";
            return(new database()) ->consultas_Cuenta($sql_buscar_Producto,null,null,null,$nombre_producto);
        }
        public function registro($nombre, $email, $password){
            global $mysql;
            $sql_corroboracion = "SELECT * FROM Clientes WHERE email =  ?";
            $resultado = (new database()) ->consultas_Cuenta($sql_corroboracion, null,$email,);
            if (empty($resultado)){
                $sql_registro = "INSERT INTO Clientes (nombre, email, contraseña)
                                    VALUES
                                        (?,?,?);";
                $preparacion = $mysql->prepare($sql_registro);
                $preparacion->bind_param("sss",$nombre, $email, $password);
                $preparacion->execute();
                $resultado = $preparacion->get_result();
                $_SESSION['email_user'] = $email;
            }else{
                return "Ya existe una cuenta con ese correo";
            }
        }
        public function borrar_Cuenta($correo){
            global $mysql;
            $sql_Max_ids = "SELECT MAX(id_Pedido) AS max_id FROM Pedidos
                    UNION ALL
                    SELECT MAX(id_Historial) FROM Historial_Productos
                    UNION ALL
                    SELECT MAX(id_Cotizacion) FROM Cotizaciones
                    UNION ALL
                    SELECT MAX(id_Cliente) FROM Clientes;";
            $resultado = $mysql->query($sql_Max_ids);
            $max_Id = [];
            while ($fila = $resultado->fetch_row()) {
                $max_Id[] = $fila[0]; 
            }
            $sql_id_Usuario = "SELECT id_Cliente FROM Clientes WHERE email = ?;";
            $preparacion = $mysql->prepare($sql_id_Usuario);
            $preparacion->bind_param("s",$correo);
            $preparacion->execute();
            $resultado = $preparacion->get_result();
            $id_Usuario = $resultado->fetch_row()[0];
            $cont = 0;
            foreach($max_Id as $id){
                if ($id != null){
                    if ($cont == 0){
                        $sql = "DELETE FROM Pedidos WHERE id_Cliente = ?;";
                    }elseif ($cont == 1){
                        $sql = "DELETE FROM Historial_Productos WHERE id_Cliente = ?;";
                    }elseif ($cont == 2){
                        $sql = "DELETE FROM Cotizaciones WHERE id_Cliente = ?;";
                    }elseif ($cont == 3){
                        $sql = "DELETE FROM Clientes WHERE id_Cliente = ?;";
                    }
                    $preparacion = $mysql->prepare($sql);
                    $preparacion->bind_param("s",$id_Usuario);
                    $preparacion->execute();
                }
                $cont++;
            }
        }
    }
?>