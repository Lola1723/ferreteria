<?php
require_once 'config/bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productos = $_POST['cantidad']; // Array con las cantidades por producto
    $totalGeneral = 0;
    
    // Registrar la venta
    $sql = "INSERT INTO ventas (fecha, total) VALUES (NOW(), 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Obtener el ID de la venta recién creada
    $ventaId = $pdo->lastInsertId();
    
    foreach ($productos as $idProducto => $cantidad) {
        // Obtener el precio del producto
        $sql = "SELECT precio FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $idProducto, PDO::PARAM_INT);
        $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verificar que se obtuvo el producto
        if ($producto && isset($producto['precio'])) {
            $precio = $producto['precio'];
            $cantidad = floatval($cantidad); // Convertir a número en caso de que venga como string
            $precio = floatval($precio); // Convertir a número el precio
            
            // Calcular el total por producto
            $totalProducto = $precio * $cantidad;
            $totalProducto = $precio * $cantidad;
            $totalGeneral += $totalProducto;
            // Verificar los valores calculados antes de insertar
            echo "ID Producto: $idProducto, Precio: $precio, Cantidad: $cantidad, Total Producto: $totalProducto <br>";
    
            // Inserción de detalle de la venta
            $sqlDetalle = "INSERT INTO detalleventa (id_venta, id_producto, cantidad, precio, total) 
                           VALUES (:id_venta, :id_producto, :cantidad, :precio, :total)";
            $stmtDetalle = $pdo->prepare($sqlDetalle);
            $stmtDetalle->bindValue(':id_venta', $ventaId, PDO::PARAM_INT);
            $stmtDetalle->bindValue(':id_producto', $idProducto, PDO::PARAM_INT);
            $stmtDetalle->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
            $stmtDetalle->bindValue(':precio', $precio, PDO::PARAM_STR);
            $stmtDetalle->bindValue(':total', $totalProducto, PDO::PARAM_STR);
            $stmtDetalle->execute();
        } else {
            echo "No se encontró el producto o su precio con ID $idProducto.";
        }

        // Obtener el stock del producto
        $sql = "SELECT stock FROM productos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $idProducto, PDO::PARAM_INT);
        $stmt->execute();
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        $stock=$producto['stock'];
        $nvoInventario= $stock - $cantidad;

        // Actualizar el stock del inventario
         $sql = "UPDATE productos SET stock = :stock WHERE id = :id";
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue(':stock', $nvoInventario, PDO::PARAM_STR);
         $stmt->bindValue(':id', $idProducto, PDO::PARAM_INT);
         $stmt->execute();



    }
    
    // Actualizar el total general de la venta
    $sql = "UPDATE ventas SET total = :total WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':total', $totalGeneral, PDO::PARAM_STR);
    $stmt->bindValue(':id', $ventaId, PDO::PARAM_INT);
    $stmt->execute();
    
    // Redirigir o mostrar mensaje de éxito
    //echo "Venta registrada correctamente con un total de $totalGeneral.";
    header("Location:exito.php?v=7&totalGrl=".$totalGeneral);
}