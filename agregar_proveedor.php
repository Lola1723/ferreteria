<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("location:login.html");
    exit();
} ?>

<!doctype html>
<html lang="en">

<head>
    <title>Agregar proveedor</title>
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
  <div class="row justify-content-center">
  <div class="col-md-8 col-lg-8">
  <div class="card">
            <div class="card-header">Agregar Proveedor</div>
            <form action="proveedor.php" method="POST" name="frmprov">
                <div class="card-body">
                <div class="row mb-3">    
                    <div class="col">
                        <div class="mb-3">
                        <label for="" class="form-label">Empresa</label>
                        <input
                            type="text"
                            class="form-control"
                            name="empresa"
                            id="empresa"
                            aria-describedby="helpId"
                            placeholder="" required/>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="mb-3">
                        <label for="" class="form-label">RFC</label>
                        <input
                            type="text"
                            class="form-control"
                            name="rfc"
                            id="rfc"
                            aria-describedby="helpId"
                            placeholder="" required/>
                        </div>
                    </div>
                    </div>

                    <div class="row mb-3">    
                    <div class="col">
                        <div class="mb-3">
                        <label for="" class="form-label">Representante</label>
                        <input
                            type="text"
                            class="form-control"
                            name="representante"
                            id="representante"
                            aria-describedby="helpId"
                            placeholder="" required/>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="mb-3">
                        <label for="" class="form-label">Telefono</label>
                        <input
                            type="text"
                            class="form-control"
                            name="telefono"
                            id="telefono"
                            aria-describedby="helpId"
                            placeholder="" required/>
                        </div>
                    </div>
                    </div><button class="btn btn-secondary" type="submit">Guardar</button>
                        <button class="btn btn-secondary">Borrar</button>
                    </div>
                    </form>
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

</body>

</html>