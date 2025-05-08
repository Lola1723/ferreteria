<?php
require_once 'config/bd.php';

if (isset($_POST['categoria']) || isset($_POST['nombre'])) {
    // Preparar la consulta según el filtro
    if (isset($_POST['categoria'])) {
        $categoria = $_POST['categoria'];
        $sql = "SELECT id, id_categoria, id_proveedor, nombre, precio, descripcion, stock 
                FROM productos 
                WHERE id_categoria = :id_categoria";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_categoria', $categoria, PDO::PARAM_INT);
    } elseif (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
        $sql = "SELECT id, id_categoria, id_proveedor, nombre, precio, descripcion, stock 
                FROM productos 
                WHERE nombre LIKE :nombre";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nombre', '%' . $nombre . '%', PDO::PARAM_STR);
    }

    // Ejecutar la consulta
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generar la tabla correctamente estructurada
    echo '<table class="table table-hover table-bordered table-borderless table-sm">';
    echo '<thead><tr class="table table-secondary"><th>ID</th><th>Categoría</th><th>Proveedor</th><th>Nombre</th><th>Precio</th><th>Descripción</th><th>Stock</th></tr></thead>';
    echo '<tbody>';
    
    // Imprimir los productos
    if (count($productos) > 0) {
        foreach ($productos as $row) {
            $idCat=$row['id_categoria'];
            $idProv=$row['id_proveedor'];
            //BUSCAR EL NOMBRE DE LA CATEGORIA
            $sql="SELECT categoria FROM categoria WHERE id = :idCat";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":idCat", $idCat, PDO::PARAM_INT);
                $stmt->execute();
                $categoria= $stmt->fetch(PDO::FETCH_ASSOC);
             //BUSCAR EL NOMBRE DEL PROVEEDOR
             $sql="SELECT representante FROM proveedor WHERE id = :idProv";
             $stmt = $pdo->prepare($sql);
             $stmt->bindValue(":idProv", $idProv, PDO::PARAM_INT);
             $stmt->execute();
             $proveedor= $stmt->fetch(PDO::FETCH_ASSOC);

            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' .  htmlspecialchars($categoria['categoria']). '</td>';
            echo '<td>' . htmlspecialchars($proveedor['representante']) . '</td>';
            echo '<td>' . htmlspecialchars($row['nombre']) . '</td>';
            echo '<td>' . htmlspecialchars($row['precio']) . '</td>';
            echo '<td>' . htmlspecialchars($row['descripcion']) . '</td>';
            echo '<td>' . htmlspecialchars($row['stock']) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="7">No se encontraron productos</td></tr>';
    }
    
    echo '</tbody></table>';
}