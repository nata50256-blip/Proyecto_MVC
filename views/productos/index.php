<?php
require_once '../../config/database.php';
require_once '../../controllers/ProductoController.php';

$database = new Database();
$db = $database->conectar();
$controlador = new ProductoController($db);
$productos = $controlador->index();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4F81BD; color: white; }
        .btn { padding: 10px 15px; text-decoration: none; color: white; border-radius: 5px; display: inline-block; margin-right: 10px; margin-bottom: 20px; }
        .btn-excel { background-color: #28a745; }
        .btn-pdf { background-color: #dc3545; }
    </style>
</head>
<body>

    <h2>Listado de Productos</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
        <?php 
        // Verificamos si la consulta devolvió resultados
        if ($productos) {
            $filasEncontradas = false;
            while($row = $productos->fetch(PDO::FETCH_ASSOC)) {
                $filasEncontradas = true;
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['precio'] . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "</tr>";
            }
            if (!$filasEncontradas) {
                echo '<tr><td colspan="5" style="text-align: center;">No hay productos registrados.</td></tr>';
            }
        } else {
            echo '<tr><td colspan="5" style="text-align: center;">No hay productos registrados.</td></tr>';
        }
        ?>
    </table>

    <br><br>
    <!-- Botones de Reportes -->
    <a href="../../reportes/excel.php" class="btn btn-excel" target="_blank">Exportar Excel</a>
    <a href="../../reportes/pdf.php" class="btn btn-pdf" target="_blank">Exportar PDF</a>

</body>
</html>