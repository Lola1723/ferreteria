<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Registro de usuario</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <header>
    </header>
    <main>
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-8">
            <?php 
            if(isset($success)){?>
                <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
            
                <strong>Registro logrado con éxito!</strong>Puede loguearse ahora. 
                En el siguiente enlace: <a href="login.html" class="btn btn-success">Login</a>
            </div>
            <?php } ?>
            
            <div class="card">
              <div class="card-header">Formulario de Registro</div>
              <div class="card-body">
                <form
                  action="controlador/guardar.php"
                  method="post"
                  id="formulariodeRegistro"
                >
                  <div class="row mb-3">
                    <div class="col">
                      <div class="mb-3">
                        <label for="" class="form-label">Nombre</label>
                        <input
                          type="text"
                          class="form-control"
                          name="nombre"
                          id="nombre"
                          aria-describedby="helpId"
                          placeholder=""
                          required
                        />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="" class="form-label">Apellido</label>
                        <input
                          type="text"
                          class="form-control"
                          name="apellido"
                          id="apellido"
                          aria-describedby="helpId"
                          placeholder=""
                          required
                        />
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      name="email"
                      id="email"
                      aria-describedby="helpId"
                      placeholder=""
                      required
                    />
                  </div>

                  <div class="row mb-3">
                    <div class="col">
                      <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input
                          type="password"
                          class="form-control"
                          name="password"
                          id="password"
                          aria-describedby="helpId"
                          placeholder=""
                          required
                        />
                      </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                        <label for="" class="form-label"
                          >Confirmar Password</label
                        >
                        <input
                          type="password"
                          class="form-control"
                          name="confirmarPassword"
                          id="confirmarPassword"
                          aria-describedby="helpId"
                          placeholder=""
                          required
                        />
                        <div class="invalid-feedback">Las contraseñas no coinciden</div>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success">
                    Registrarme
                  </button>
                  <a href="login.html" class="btn btn-secondary">Login</a>
                </form>
              </div>
              <div class="card-footer text-muted"></div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer>
      <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        document
          .getElementById("formulariodeRegistro")
          .addEventListener("submit", function (event) {
            var pass = document.getElementById("password").value;
            var confPassword = document.getElementById("confirmarPassword").value;
            //verificar contraeñas
            if (pass !== confPassword) {
              document
                .getElementById("confirmarPassword")
                .classList.add("is-invalid");
                event.preventDefault();//previene el envio del formulario
            } else {
              document
                .getElementById("confirmarPassword")
                .classList.remove("is-invalid");
            }
          });
      });
    </script>
  </body>
</html>
