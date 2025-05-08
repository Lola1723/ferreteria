 <nav
            class="navbar navbar-expand-lg navbar-light bg-light"
        >
            <div class="container">
                <a class="navbar-brand" href="index.php">Panel administrador</a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php" aria-current="page"
                                >Inicio
                                <span class="visually-hidden">(current)</span></a
                            >
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="dropdownId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                >Ventas</a
                            >
                            <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownId"
                            >
                                <a class="dropdown-item" href="venta.php"
                                    >Realizar Venta</a
                                >
                                <a class="dropdown-item" href="lista_ventas.php"
                                    >Listado de Ventas</a
                                >
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="dropdownId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                >Usuarios</a
                            >
                            <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownId"
                            >
                                <a class="dropdown-item" href="registro.php"
                                    >Agregar</a
                                >
                                <a class="dropdown-item" href="lista_usuarios.php"
                                    >Lista</a
                                >
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="dropdownId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                >Productos</a>
                            <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownId"
                            >
                                <a class="dropdown-item" href="agregar_proveedor.php"
                                    >Agregar Proveedor</a>
                                <a class="dropdown-item" href="lista_proveedores.php">
                                    Lista de Proveedores</a>
                                <a class="dropdown-item" href="agregar_producto.php"
                                    >Agregar Producto</a
                                >
                                <a class="dropdown-item" href="inventario.php"
                                    >Inventario</a
                                >
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="dropdownId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                >Contabilidad</a>
                            <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownId"
                            >
                                <a class="dropdown-item" href="#"
                                    >Ingresos</a
                                >
                                <a class="dropdown-item" href="#"
                                    >Egresos</a
                                >
                                <a class="dropdown-item" href="#"
                                    >Balance</a
                                >
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cerrar.php">Cerrar</a>
                        </li>
                    </ul>
                    <a href="login.html">Login</a>
                </div>
                &nbsp;&nbsp;&nbsp;Bienvenido <?php echo ucfirst($_SESSION['usuario_nombre']).'&nbsp'.ucfirst($_SESSION['usuario_apellido']);?>
            </div>
           
        </nav>