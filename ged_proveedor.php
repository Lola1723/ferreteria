<?php
include("config/bd.php");

$id = isset($_POST['id']) ? $_POST['id'] : 'null';
    $empresa = isset($_POST["empresa"]) ? $_POST["empresa"] : null;
    $rfc = isset($_POST["rfc"]) ? $_POST["rfc"] : null;
    $representante = isset($_POST["representante"]) ? $_POST["representante"] : null;
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : null;

    $sql = $pdo->prepare("UPDATE proveedor set empresa=?, rfc=?, representante=?, telefono=? WHERE id=?");
    $rs = $sql->execute(array($empresa, $rfc, $representante, $telefono, $id));
    header("Location:exito.php?v=2");

