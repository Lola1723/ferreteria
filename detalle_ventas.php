<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("location:vista/login.html");
    exit();
}
require_once 'config/bd.php';

// Obtener el parámetro 'id' de la solicitud
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : ''; 

$sql = "SELECT id, id_venta, id_producto, cantidad, precio, total FROM detalleventa
        WHERE estado = '0' AND id_venta = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
// Obtener todos los detalles
$detalles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//////////////////////////////////////////////////////
$sqlV="SELECT id_venta FROM detalleventa WHERE estado='0' and id_venta=:id";
$stmtV = $pdo->prepare($sqlV);
$stmtV->bindValue(":id", $id, PDO::PARAM_INT);
$stmtV->execute();
$notaVta = $stmtV->fetch(PDO::FETCH_ASSOC);
// Verifica si se obtuvo algún valor
if ($notaVta) {
    $id_venta = $notaVta['id_venta']; // Accede directamente al valor de 'id_venta'
    //echo "ID Venta: " . $id_venta;
} else {
    echo "No se encontró ninguna venta con el estado '0' para el ID proporcionado.";
}

$totalGrl = 0; // Inicializar total general

if (count($detalles) > 0) {



    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Detalle de venta</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <?php include("cabecera.php") ?>
        <main>
            <div class="container mt-5">
                <div class="row justify-content-center align-items-center g-2">
                    <br><br>
                    <div class="col">
                        <div class="row mb-3">
                            <div class="col">
                                <div class="mb-3">
                                    <strong>Nota de venta: <?php echo $id_venta; ?> - Fecha <?php echo $fecha; ?></strong>
                                    
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="" class="form-label">Buscar por fecha</label>
                                    <input type="text" id="buscarNombre" class="form-control" placeholder="dd-mm-aaaa">
                                </div>
                            </div>
                            <div>
                                <form id="updateForm" action="gdetalle_venta.php" method="post">
                                        <div class="d-flex align-items-center">
                                            <input type="hidden" name="id_venta" value="<?php echo $id_venta;?>">
                                            <div class="form-check me-2">
                                                <input class="form-check-input" type="checkbox" value="1"
                                                    id="flexCheckDefault" onclick="toggleMotivoAnulacion()">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Anular Venta
                                                </label>
                                            </div>
                                            <button name="guardar" id="guardar" type="submit" class="btn btn-warning"
                                                style="display:none; margin-left: 10px;">
                                                Guardar
                                            </button>
                                        </div>
                                        <!-- Aquí se mostrará el motivo de anulación cuando el checkbox esté marcado -->
                                        <div id="motivoAnulacion" style="display:none; margin-top: 10px;">
                                            <label for="motivo" class="form-label">Motivo de Anulación:</label>
                                            <textarea class="form-control" name="motivo" id="motivo" rows="3"
                                                placeholder="Escriba el motivo de la anulación"></textarea>
                                        </div>
                                        </form>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Total</th>
                                            </tr>
                                            <?php
                                            foreach ($detalles as $detalle) {
                                                $cantidad = $detalle['cantidad'];
                                                $precio = $detalle['precio'];
                                                $totalind = $cantidad * $precio;
                                                $totalGrl += $totalind; // Sumar al total general
                                        
                                                echo '<tr>
                <td>' . htmlspecialchars($detalle['id_producto']) . '</td>
                <td>' . htmlspecialchars($detalle['cantidad']) . '</td>
                <td>' . htmlspecialchars($detalle['precio']) . '</td>
                <td align="right">' . htmlspecialchars(number_format($totalind, 2)) . '</td>
              </tr>';
                                            }

                                            echo '<tr>
            <td></td>
            <td></td>
            <td align="right"><strong>Total </strong></td>
            <td align="right"><strong>$' . htmlspecialchars(number_format($totalGrl, 2)) . '</strong></td>
          </tr>';
                                            echo '</table>';
                                            echo '</form>';
} else {
    echo 'No se encontraron detalles para esta venta.';
}
?>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script>
        // Función para mostrar/ocultar el textarea del motivo de anulación
        function toggleMotivoAnulacion() {
            var checkbox = document.getElementById('flexCheckDefault');
            var motivoAnulacion = document.getElementById('motivoAnulacion');
            var botonGuardar = document.getElementById('guardar');

            if (checkbox.checked) {
                motivoAnulacion.style.display = 'block';
                botonGuardar.style.display = 'block';
                console.log("Checkbox marcado: mostrando textarea");
            } else {
                motivoAnulacion.style.display = 'none';
                botonGuardar.style.display = 'none';
                console.log("Checkbox desmarcado: ocultando textarea");
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            console.log("Documento cargado");
            var checkbox = document.getElementById('flexCheckDefault');

            if (checkbox) {
                console.log("Checkbox encontrado");
                checkbox.addEventListener('change', toggleMotivoAnulacion);
            } else {
                console.log("Checkbox no encontrado");
            }
        });

        // Validar el formulario antes de enviarlo
        document.getElementById('updateForm').onsubmit = function (e) {
            var checkbox = document.getElementById('flexCheckDefault');
            var motivo = document.getElementById('motivo').value.trim();

            if (checkbox.checked && motivo === '') {
                alert('Debe escribir un motivo de anulación si selecciona "Anular Venta".');
                e.preventDefault(); // Evita que se envíe el formulario si no hay motivo
            }
        };
    </script>
</body>

</html>