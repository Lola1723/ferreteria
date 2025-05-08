<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("location:vista/login.html");
    exit();
}
require_once 'config/bd.php';

// Aquí puedes usar la conexión PDO para realizar consultas
$stmt = $pdo->query("SELECT * FROM usuario"); 
$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Lista de Usuarios</title>
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
                    <p>
                    <h2>Lista de usuarios</h2>
                    </p>
                    <table class="table table-hover col-4 col-md-4">
                        <thead>
                            <tr class=" table-secondary">
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rs)): ?>
                                <?php foreach ($rs as $row): ?>
                                    <tr>
                                        <td class="col-6 col-md-1"><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td class="col-6 col-md-2"><?php echo htmlspecialchars($row['nombre']); ?></td>
                                        <td class="col-6 col-md-2"><?php echo htmlspecialchars($row['apellido']); ?></td>
                                        <td class="col-6 col-md-2"><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td class="col-6 col-md-2">
                                            <a href="editar_usuario.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"
                                                value="editar" name=accion">Editar</a>
                                        </td>
                                        <td class="col-6 col-md-2">
                                            <form action="ged_usuario.php" method="post"><button name="accion" value="2"
                                                    class="btn btn-danger">Eliminar</button>
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
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
        <!-- place footer here -->
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