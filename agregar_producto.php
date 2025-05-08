<?php
session_start();
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
if (!isset($_SESSION['usuario_id'])) {
    header("location:login.html");
    exit();
} ?>

<!doctype html>
<html lang="en">

<head>
    <title>Agregar Producto</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
    function redirectToInventario() {
        window.location.href = 'inventario.php';
    }
    </script>
</head>

<body>
    <header>
    </header>
    <?php include("cabecera.php") ?>
    <main>
        <div class="container mt-2">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8">
                    <div class="card">
                        <div class="card-header">Agregar Producto</div>
                        <form action="producto.php" method="POST">
                            <input type="hidden" name="accion" value="1">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Categoria</label>
                                            <select id="id_categoria" name="id_categoria" class="form-select">
                                                <?php include 'categorias.php';
                                                if ($categorias > 0) {
                                                    foreach ($categorias as $categoria) {
                                                        echo '<option value="' . htmlspecialchars($categoria['id']) . '">' . htmlspecialchars($categoria['categoria']) . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0">Agregue una categoria</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="" class="form-label"></label><br>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                Agregar Categoria
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Proveedor</label>
                                            <select id="id_proveedor" name="id_proveedor" class="form-select">
                                                <?php include 'traer_proveedores.php';
                                                if ($traer_proveedores > 0) {
                                                    foreach ($traer_proveedores as $traer_proveedor) {
                                                        echo '<option value="' . htmlspecialchars($traer_proveedor['id']) . '">' . htmlspecialchars($traer_proveedor['empresa']) . '</option>';
                                                    }
                                                } else {
                                                    echo '<option value="0"><a href="agregar_proveedor.php">Agregue un proveedor </a></option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nombre</label>
                                            <input type="text" id="nombre" name="nombre" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Precio</label><br>
                                            <input type="text" id="precio" name="precio" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripcion</label>
                                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                                <label for="stock" class="form-label">Stock</label>
                                                <input type="text" id="stock" name="stock" class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <a href="#" onclick="redirectToInventario()" class="btn btn-secondary">Inventario</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <footer>
        <!-- Modal -->
        <form action="guardar_categoria.php" method="POST">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Categoria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="" class="form-label">Categoria</label>
                            <input type="text" class="form-control" name="categoria" id="categoria"
                                aria-describedby="helpId" placeholder="Categoria" required />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>