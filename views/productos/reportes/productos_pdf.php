<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #4F81BD; color: white; }
    </style>
</head>
<body>

    <h1>Reporte General de Productos</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
        <?php foreach($productos as $producto): ?>
        <tr>
            <td><?= $producto['id']; ?></td>
            <td><?= $producto['nombre']; ?></td>
            <td><?= $producto['descripcion']; ?></td>
            <td><?= $producto['precio']; ?></td>
            <td><?= $producto['stock']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>