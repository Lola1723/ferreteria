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
        <title>Venta</title>
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
        <script>
             function buscarProducto() {
            var nombre = document.getElementById("buscarNombre").value;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "obtener_productos_venta.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("productos").innerHTML = xhr.responseText;
                }
            };
            xhr.send("nombre=" + nombre);
        }

        // Al agregar un producto a la tabla de ventas
function agregarProducto(id, nombre, precio) {
    var detalleVenta = document.getElementById("detalleVenta");
    
    // Crear una nueva fila en la tabla de ventas
    var fila = document.createElement("tr");
    fila.setAttribute("id", "producto-" + id);
    
    fila.innerHTML = `
        <td>${id}</td>
        <td>${nombre}</td>
        <td>${precio}</td>
        <td><input type="number" name="cantidad[${id}]" value="1" min="1" onchange="actualizarTotal(${id}, ${precio})"></td>
        <td id="total-${id}">${precio}</td>
        <td><button type="button" onclick="eliminarProducto(${id})">Eliminar</button></td>
    `;
    
    detalleVenta.appendChild(fila);
    
    actualizarTotal(id, precio);
}

// Actualizar el total por producto y el total general
function actualizarTotal(id, precio) {
    var cantidad = document.querySelector(`#producto-${id} input`).value;
    var totalProducto = precio * cantidad;
    
    document.getElementById("total-" + id).innerText = totalProducto.toFixed(2);
    
    // Actualizar el total general
    actualizarTotalGeneral();
}

function actualizarTotalGeneral() {
    var totalVenta = 0;
    
    document.querySelectorAll("[id^='total-']").forEach(function (total) {
        totalVenta += parseFloat(total.innerText);
    });
    
    document.getElementById("totalVenta").innerText = totalVenta.toFixed(2);
}

// Eliminar un producto de la tabla de ventas
function eliminarProducto(id) {
    var fila = document.getElementById("producto-" + id);
    fila.remove();
    
    actualizarTotalGeneral();
}
        </script>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
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
                <div col="12" class="col">
                <div class="col">
                        <div class="mb-3">
                            <form onsubmit="buscarProducto(); return false;">
                            <div class="col-6">
                                <input type="text" id="buscarNombre" class="form-control" placeholder="Escriba el nombre del producto"
                                onkeydown="if(event.keyCode==13) buscarProducto();">
                                
                                <input type="submit" value="Buscar">
                                </div>
                            </form>
                        </div>
                        <div id="productos"></div>
    <!--Tabla temporal donde se agregaran los productos para su venta-->
    <h3>Productos en la venta</h3>
    <form id="ventaForm" action="registrar_venta.php" method="POST">
    <table class="table table-bordered table-primary" id="tablaVenta">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody id="detalleVenta"></tbody>
    </table>
    <div>Total General: $<span id="totalVenta">0.00</span></div>
    <button type="submit">Registrar Venta</button>
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
    </body>
</html>
