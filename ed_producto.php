<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ferreteria";
include 'categorias.php';
include 'traer_proveedores.php';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el parámetro 'id' de la solicitud
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Consultar los datos de la base de datos
    $sql = "SELECT id, id_categoria, id_proveedor, nombre, precio, descripcion, stock from productos 
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos y devolverlos en formato HTML   \
        $row = $result->fetch_assoc();
        echo ' <form id="" action="ged_producto.php" method="POST">
        <input type="hidden" name="id" value="'.$id.'">
                <label for="" class="form-label">Categoria</label>
                <select id="categoria" name="categoria" class="form-select">';
                // Mostrar las categorías
                foreach ($categorias as $categoria) {
                $selected = ($categoria['id'] == $row['id_categoria']) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($categoria['id']) . '" ' . $selected . '>' . htmlspecialchars($categoria['categoria']) . '</option>';
                }
                 echo ' </select>
                 <label for="" class="form-label">Proveedor</label>
                 <select id="id_proveedor" name="id_proveedor" class="form-select">';
                // Mostrar los proveedores
                foreach ($traer_proveedores as $traer_proveedor) {
                $selected = ($traer_proveedor['id'] == $row['id_proveedor']) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($traer_proveedor['id']) . '" ' . $selected . '>' . htmlspecialchars($traer_proveedor['empresa']) . '</option>';
                }
                echo ' </select>
                
                <label for="" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="' . $row['nombre'] . '"/>
                
                <label for="" class="form-label">Precio</label><br>
                <input type="text" id="precio" name="precio" class="form-control" value="' . $row['precio'] . '" />
                
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="3">' . $row['descripcion'] . '</textarea>
                 
                <label for="stock" class="form-label">Stock</label>
                <input type="text" id="stock" name="stock" class="form-control" value="' . $row['stock'] . '" />
                
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                 </div></form>';
    }

    $stmt->close();
} else {
    echo "no se encontraron datos";
}
$conn->close();