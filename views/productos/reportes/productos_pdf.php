<h1>Reporte General de Productos</h1> 

<table border="1" width="100%" cellspacing="0"> 

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