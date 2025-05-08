<?php
include("config/bd.php");
//$accion=isset($_POST["accion"])? $_POST['accion'] : 'null';
//print $_POST['id'];
$id = isset($_POST['id']) ? $_POST['id'] : 'null';
$id_categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : null;
$id_proveedor = isset($_POST["id_proveedor"]) ? $_POST["id_proveedor"] : null;
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
$precio = isset($_POST["precio"]) ? $_POST["precio"] : null;
$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : null;
$stock = isset($_POST["stock"]) ? $_POST["stock"] : null;

$sql = $pdo->prepare("UPDATE productos set id_categoria=?, id_proveedor=?, nombre=?, precio=?, descripcion=?, stock=? WHERE id=?");
$rs = $sql->execute(array($id_categoria, $id_proveedor, $nombre, $precio, $descripcion, $stock, $id));
header("Location:exito.php?v=5");