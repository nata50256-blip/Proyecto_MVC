<h2>Crear Nuevo Producto</h2>
<form action="index.php?action=guardar" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br>

    <label>Descripción:</label>
    <textarea name="descripcion"></textarea><br>

    <label>Precio:</label>
    <input type="number" step="0.01" name="precio" required><br>

    <label>Stock:</label>
    <input type="number" name="stock" required><br>

    <button type="submit">Guardar</button>
</form>
<a href="index.php">Volver</a>