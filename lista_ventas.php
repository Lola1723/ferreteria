<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("location:vista/login.html");
    exit();
}
require_once 'config/bd.php';
//saber cuantas ventas tengo realizadas
$stmt = $pdo->query("SELECT COUNT(*) AS total_ventas FROM ventas WHERE estado = '0'");
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$totalVentas = $result['total_ventas'];

// Aquí puedes usar la conexión PDO para realizar consultas
$stmt1 = $pdo->query("SELECT * FROM ventas where estado ='0'");
$rs = $stmt1->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Lista de Ventas</title>
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
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center g-2">
                <br><br>
                <div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="mb-3">
                                Listado de Ventas : <?php echo $totalVentas; ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Buscar por fecha</label>
                                <input type="text" id="buscarNombre" class="form-control" placeholder="dd-mm-aaaa"
                                    onkeyup="buscarProducto()">
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover col-4 col-md-4">
                        <thead>
                            <tr class=" table-secondary">
                                <th scope="col"># Nota de Venta</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Total</th>
                                <th scope="col">Verificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rs)): ?>
                                <?php foreach ($rs as $row): ?>
                                    <tr>
                                        <td class="col-6 col-md-1"><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td class="col-6 col-md-2"><?php echo date("d-m-Y", strtotime($row['fecha'])); ?></td>
                                        <td class="col-6 col-md-2">$ <?php echo htmlspecialchars($row['total']); ?></td>
                                        <td class="col-6 col-md-2">
                                            <!-- Botón para redirigir a detalle_venta.php -->
                                            <a href="detalle_ventas.php?id=<?php echo urlencode($row['id']); ?>&fecha=<?php echo urlencode(date('d-m-Y', strtotime($row['fecha']))); ?>"
                                                class="btn btn-warning">
                                                Detalle de Venta
                                            </a>
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
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>


</body>

</html>