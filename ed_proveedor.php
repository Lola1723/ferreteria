<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ferreteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el parámetro 'id' de la solicitud
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if($id>0){
       // Consultar los datos de la base de datos
    $sql = "SELECT id, empresa, rfc, representante, telefono FROM proveedor WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos y devolverlos en formato HTML   
        $row = $result->fetch_assoc();
        echo ' <form id="updateForm" action="ged_proveedor.php" method="post">
          <div class="mb-3">
            <label for="id" class="form-control">Id:</label>
            <input type="text" class="form-control" name="id" id="id" value='. htmlspecialchars($row['id']).'>
            <input type="hidden" name="var" id="var" value="t">
         </div>';
        echo '<div class="mb-3">
              <label for="empresa" class="form-control">Empresa:</label>
              <input type="text" class="form-control" name="empresa" id="empresa" value="'. htmlspecialchars($row['empresa']).'">
              </div>';
        echo '<div class="mb-3">
              <label for="rfc" class="form-control">RFC:</label> 
              <input type="text" class="form-control" name="rfc" id="rfc" value='. htmlspecialchars($row['rfc']).'>
              </div>';
        echo '<div class="mb-3">
              <label for="representante" class="form-control">Representante:</label> 
              <input type="text" class="form-control" name="representante" id="representante" value="'. htmlspecialchars($row['representante']).'">
              </div>';
        echo '<div class="mb-3">
              <label for="telefono" class="form-control">Telefono:</label> 
              <input type="text" class="form-control" name="telefono" id="telefono" value='. htmlspecialchars($row['telefono']).'>
              </div>
              <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div></form>';
    }

    $stmt->close();
} else{ echo "no se encontraron datos";}
$conn->close();

 


