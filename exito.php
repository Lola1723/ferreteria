<?php
session_start(); // Asegúrate de llamar esto al inicio

// Asumimos que $v se define en algún lugar antes de este código
//$v = 1;  Ejemplo de valor de $v
$v=$_GET['v'];
switch($v) {
    case '1':
        $_SESSION['mensaje'] = "Proveedor registrado con éxito";
        header("Location: lista_proveedores.php");
        break;
        case '2':
            $_SESSION['mensaje'] = "Proveedor actualizado con éxito";
            header("Location: lista_proveedores.php");
            break;
            case '3':
                $_SESSION['mensaje'] = "Proveedor eliminado con éxito";
                header("Location: lista_proveedores.php");
                break;
                case '4':
                    $_SESSION['mensaje'] = "Producto registrado con éxito";
                    header("Location: agregar_producto.php");
                    break;
                    case '5':
                        $_SESSION['mensaje'] = "Producto actualizado con éxito";
                        header("Location: inventario.php");
                        break;
                        case '6':
                            $_SESSION['mensaje'] = "Producto eliminado con éxito";
                            header("Location: inventario.php");
                            break;
                            case '7':
                                $totalGrl=$_GET['totalGrl'];
                                $_SESSION['mensaje'] = "Venta registrada correctamente con un total de ".$totalGrl;
                                header("Location: venta.php");
                                break;
    default:
        $_SESSION['mensaje'] = "Ocurrió un error.";
        header("Location: lista_proveedores.php");
        exit();
}

