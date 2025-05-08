<?php
require_once 'config/bd.php';

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    
    $sql = "SELECT id, nombre, precio, descripcion, stock FROM productos WHERE nombre LIKE :nombre";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre', '%' . $nombre . '%', PDO::PARAM_STR);
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($productos) > 0) {
        echo '<table class="table table-bordered">';
        echo '<tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acción</th></tr>';
        

        foreach ($productos as $producto) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($producto['id']) . '</td>';
            echo '<td>' . htmlspecialchars($producto['nombre']) . '</td>';
            echo '<td>' . htmlspecialchars($producto['precio']) . '</td>';
            echo '<td>' . htmlspecialchars($producto['stock']) . '</td>';
            echo '<td><button type="button" onclick="agregarProducto(' 
                . $producto['id'] . ', \'' 
                . addslashes($producto['nombre']) . '\', ' 
                . $producto['precio'] . ')">Agregar</button></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No se encontraron productos';
    }
}