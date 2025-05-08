<?php
session_start();
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
if (!isset($_SESSION['usuario_id'])) {
    header("location:login.html");
    exit();
}
require_once 'config/bd.php';
?>

<!doctype html>
<html lang="en">

<head>
    <title>Inventario</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function cargarProductos() {
            var categoria = document.getElementById("categoria").value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "obtener_productos.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("productos").innerHTML = xhr.responseText;
                }
            };
            xhr.send("categoria=" + categoria);
        }

        function buscarProducto() {
            var nombre = document.getElementById("buscarNombre").value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "obtener_productos.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("productos").innerHTML = xhr.responseText;
                }
            };
            xhr.send("nombre=" + nombre);
        }
    </script>
</head>

<body>
    <header>


    </header>
    <?php include("cabecera.php") ?>
    <main>
    <?php if ($mensaje): ?>
            <div class="alert alert-primary" role="alert">
                <?php echo $mensaje; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center g-2">
                <div class="row mb-3">
                    <div class="col">
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Filtra por Categoria</label>
                            <select id="categoria" name="categoria" class="form-select" onchange="cargarProductos()">
                                <option value="0">Selecciona una categoria</option>
                                <?php include 'categorias.php';
                                if ($categorias > 0) {
                                    foreach ($categorias as $categoria) {
                                        echo '<option value="' . htmlspecialchars($categoria['id']) . '">' . htmlspecialchars($categoria['categoria']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="0">Agregue una categoria</option>';
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-3">
                            <label for="" class="form-label">Filtra por Nombre del Producto</label>
                            <input type="text" id="buscarNombre" class="form-control" placeholder="Buscar por nombre"
                                onkeyup="buscarProducto()">
                        </div>
                    </div>

                </div>

                <div col="12">
                    <div id="productos">


                        <table class="table table-hover table-bordered table-borderless table-sm">
                            <thead>
                                <tr class="table table-secondary">
                                    <th scope="col">ID</th>
                                    <th scope="col">CATEGORIA</th>
                                    <th scope="col">PROVEEDOR</th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">PRECIO</th>
                                    <th scope="col">DESCRIPCION</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col">EDITAR</th>
                                    <th scope="col">ELIMINAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php include 'producto.php'; ?>
                                <?php if (!empty($productos)): ?>
                                    <?php $c = 0; ?>
                                    <?php foreach ($productos as $producto): ?>
                                        <?php $c++;
                                        $idCat = $producto['id_categoria'];
                                        $idProv = $producto['id_proveedor'];
                                        //BUSCAR EL NOMBRE DE LA CATEGORIA
                                        $sql = "SELECT categoria FROM categoria WHERE id = :idCat";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->bindValue(":idCat", $idCat, PDO::PARAM_INT);
                                        $stmt->execute();
                                        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
                                        //BUSCAR EL NOMBRE DEL PROVEEDOR
                                        $sql = "SELECT representante FROM proveedor WHERE id = :idProv";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->bindValue(":idProv", $idProv, PDO::PARAM_INT);
                                        $stmt->execute();
                                        $proveedor = $stmt->fetch(PDO::FETCH_ASSOC); ?>
                                        <tr>
                                            <td class="col-6 col-md-1"><?php echo ($producto['id']); ?></td>
                                            <td class="col-6 col-md-1"><?php echo ($categoria['categoria']); ?></td>
                                            <td class="col-6 col-md-1"><?php echo ($proveedor['representante']); ?></td>
                                            <td class="col-6 col-md-1"><?php echo ($producto['nombre']); ?></td>
                                            <td class="col-6 col-md-1"><?php echo ($producto['precio']); ?></td>
                                            <td class="col-6 col-md-1"><?php echo ($producto['descripcion']); ?></td>
                                            <td class="col-6 col-md-1"><?php echo ($producto['stock']); ?></td>
                                            <td class="col-6 col-md-1">
                                                <!-- Button trigger modal -->
                                            <!-- Botón para abrir el modal -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-id="<?php echo $producto['id']; ?>">
                                                Editar
                                            </button></td>
                                            <td class="col-6 col-md-1">
                                                <form action="eliminar_producto.php" method="post"><button name="accion"
                                                    class="btn btn-danger">Eliminar</button>
                                                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                            </form></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3">No se encontraron registros</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div>Total de productos <?php echo $c; ?></div>
                    </div>
                </div>


                <!-- Apartir de aqui se cierra la div ppal-->
            </div>

        </div>i
    </main>
    <footer>
         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles del Producto</h5>
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
                xhr.open('GET', 'ed_producto.php?id=' + encodeURIComponent(id), true);
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