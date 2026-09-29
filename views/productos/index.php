<?php
// Aseguramos que la variable $productos exista para evitar errores si la vista se carga de forma directa
$productos = isset($productos) ? $productos : [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <!-- Estilo opcional de Bootstrap para que se vea ordenado -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Listado de Productos</h2>

        <table class="table table-bordered table-striped mt-3" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $row): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['precio']; ?></td>
                            <td><?php echo $row['stock']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No hay productos registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Botón para exportar a Excel -->
        <div style="margin-top: 20px;">
            <a href="../../reportes/excel.php" target="_blank" class="btn btn-success">Exportar Excel</a>
            <a href="../../reportes/pdf.php" target="_blank" class="btn btn-danger">Exportar PDF</a>
        </div>
    </div>
</body>
</html>