<?php
require_once 'config/bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_venta= $_POST['id_venta'];
    $motivo= $_POST['motivo'];
    //echo $motivo;
    
    $sql=$pdo->prepare('UPDATE ventas set estado=? where id=?');
    $rs=$sql->execute(array('1', $id_venta));

    $sqlDos=$pdo->prepare("UPDATE detalleventa set estado=?, motivo=?  WHERE id_venta=?");
    $rsDos = $sqlDos->execute(array('1', $motivo, $id_venta));
        header("Location:lista_ventas.php");
}else{
    
}