<?php
require_once 'config/bd.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //$accion=$_POST['accion'];
        $id_categoria=isset( $_POST['id_categoria'] ) ? $_POST['id_categoria'] :'null';
        $id_proveedor=isset( $_POST['id_proveedor'] ) ? $_POST['id_proveedor'] :'null';
        $nombre=isset( $_POST['nombre'] ) ? $_POST['nombre'] :'null';
        $precio=isset( $_POST['precio'] ) ? $_POST['precio'] :'null';
        $descripcion=isset( $_POST['descripcion'] ) ? $_POST['descripcion'] :'null';
        $stock=isset( $_POST['stock'] ) ? $_POST['stock'] :'null';
        
        //insertar los campos header("Location:exito.php?v=4");
        $sql=$pdo->prepare("INSERT INTO productos (id, id_categoria, id_proveedor, nombre, precio, descripcion, stock)
         values (null, :id_categoria, :id_proveedor, :nombre, :precio, :descripcion, :stock)");
        $sql->execute(array(":id_categoria"=>$id_categoria,":id_proveedor"=>$id_proveedor,
        ":nombre"=>$nombre,":precio"=>$precio,":descripcion"=>$descripcion,":stock"=>$stock));
        header("Location:exito.php?v=4");

    }

    //Seleccionar todos los productos
    $sql=$pdo->prepare("SELECT id, id_categoria, id_proveedor, nombre, precio, descripcion, stock from productos
    order by nombre");
    $sql->execute();
    $productos=$sql->fetchAll(PDO::FETCH_ASSOC);

    //////////////////////////////////////////////////////////////////////////////

