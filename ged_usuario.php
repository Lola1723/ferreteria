<?php
include("config/bd.php");


if ($_POST['accion'] == '1') {

    $id = isset($_POST['id']) ? $_POST['id'] : 'null';
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
    $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : null;
    $email = isset($_POST["email"]) ? $_POST["email"] : null;
    $password = isset($_POST["password"]) ? $_POST["password"] : null;
    $confirmarPassword = isset($_POST["confirmarPassword"]) ? $_POST["confirmarPassword"] : null;
    //encriptando el password
    $nvoPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = $pdo->prepare("UPDATE usuario set nombre=?, apellido=?, email=?, password=? WHERE id=?");
    $rs = $sql->execute(array($nombre, $apellido, $email, $nvoPassword, $id));
    header("Location:lista_usuarios.php");
} else if ($_POST['accion'] == '2') {
    $id = $_POST['id'];
    $sql = $pdo->prepare("DELETE FROM usuario WHERE id=:id");
    $rs = $sql->execute(array('id' => $id));
    header("Location:lista_usuarios.php");

}

