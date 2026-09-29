<?php
header("Content-Type: application/json");
require_once '../config/database.php';
require_once '../models/Producto.php';

$database = new Database();
$db = $database->conectar();
$producto = new Producto($db);

// Obtener el método HTTP de la petición (si se ejecuta por consola, por defecto toma GET)
$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

switch($metodo) {
    case "GET":
        $stmt = $producto->listar();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos, JSON_UNESCAPED_UNICODE);
        break;

    case "POST":
        // Recibir los datos en formato JSON enviados desde Postman
        $datos = json_decode(file_get_contents("php://input"));
        
        // Asignar los valores a las propiedades del modelo
        $producto->nombre = $datos->nombre;
        $producto->descripcion = $datos->descripcion;
        $producto->precio = $datos->precio;
        $producto->stock = $datos->stock;
        
        // Ejecutar el método crear y retornar el JSON que pide la guía
        if($producto->crear()){
            echo json_encode([
                "mensaje" => "Producto creado"
            ], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([
                "mensaje" => "Error al crear el producto"
            ], JSON_UNESCAPED_UNICODE);
        }
        break;

        case "PUT": 

    $datos=json_decode( 

        file_get_contents("php://input") 

    ); 

    $producto->id=$datos->id; 

    $producto->nombre=$datos->nombre; 

    $producto->descripcion=$datos->descripcion; 

    $producto->precio=$datos->precio; 

    $producto->stock=$datos->stock; 

    if($producto->actualizarAPI()){ 

        echo json_encode([ 

          "mensaje"=>"Producto actualizado" 

        ]); 

    } 

break; 
case "DELETE": 

    $datos=json_decode( 

        file_get_contents("php://input") 

    ); 

    $producto->id=$datos->id; 

    if($producto->eliminarAPI()){ 

        echo json_encode([ 

            "mensaje"=>"Producto eliminado" 

        ]); 

    } 

break; 
}
?>