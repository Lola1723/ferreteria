<?php
require_once 'config/bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria= $_POST['categoria'];
    $sql=$pdo->prepare("INSERT INTO categoria (id, categoria) values (null, :categoria)");
        $sql->execute(array(":categoria"=>$categoria));
        header("Location:agregar_producto.php");
}else{
    
}