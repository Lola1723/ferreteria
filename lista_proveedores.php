<?php
/*session_start();
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
if (!isset($_SESSION['usuario_id'])) {
    header("location:login.html");
    exit();
}*/
require_once 'config/bd.php';

$sql = $pdo->prepare("SELECT id, empresa, rfc, representante, telefono FROM proveedor ORDER BY empresa");
$sql->execute();
$proveedores = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Lista de Proveedores</title>
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

    </header>
    <?php include("cabecera.php") ?>
    <main>
        <?php if ($mensaje): ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $mensaje; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center g-2">
                <br><br>
                <div>
                    <p>
                    <h2>Lista de proveedores</h2>
                    </p>
                    <table class="table table-hover col-4 col-md-4">
                        <thead>
                            <tr class=" table-secondary">
                                <th scope="col">#</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">RFC</th>
                                <th scope="col">Representante</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proveedores)): ?>
                                <?php foreach ($proveedores as $proveedor): ?>
                                    <tr>
                                        <td class="col-6 col-md-1"><?php echo htmlspecialchars($proveedor['id']); ?></td>
                                        <td class="col-6 col-md-2"><?php echo htmlspecialchars($proveedor['empresa']); ?></td>
                                        <td class="col-6 col-md-2"><?php echo htmlspecialchars($proveedor['rfc']); ?></td>
                                        <td class="col-6 col-md-2"><?php echo htmlspecialchars($proveedor['representante']); ?>
                                        </td>
                                        <td class="col-6 col-md-2"><?php echo htmlspecialchars($proveedor['telefono']); ?></td>
                                        <td class="col-6 col-md-2">
                                            <!-- Button trigger modal -->
                                            <!-- Botón para abrir el modal -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-id="<?php echo $proveedor['id']; ?>">
                                                Editar
                                            </button>
                                        </td>
                                        <td class="col-6 col-md-2">
                                            <form action="eliminar_proveedor.php" method="post"><button name="accion" value="2"
                                                    class="btn btn-danger">Eliminar</button>
                                                <input type="hidden" name="id" value="<?php echo $proveedor['id']; ?>">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">No se encontraron registros</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </main>
    <footer>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se mostrarán los datos obtenidos -->
                    <div id="modalContent">Cargando...</div>
                </div>
                
            </div>
        </div>
    </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <!-- Modal -->
     <!-- Bootstrap JS -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var exampleModal = document.getElementById('exampleModal');
            exampleModal.addEventListener('show.bs.modal', function (event) {
                // Obtener el botón que abrió el modal
                var button = event.relatedTarget;
                // Extraer la variable del atributo data-id
                var id = button.getAttribute('data-id');

                // Realizar una solicitud AJAX para obtener datos
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'ed_proveedor.php?id=' + encodeURIComponent(id), true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Actualizar el contenido del modal con los datos obtenidos
                        var modalContent = document.getElementById('modalContent');
                        modalContent.innerHTML = xhr.responseText;
                    } else {
                        console.error('Error al obtener los datos:', xhr.statusText);
                    }
                };
                xhr.send();
            });
        });
    </script>
</body>

</html>