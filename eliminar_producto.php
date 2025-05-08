<?php
include("config/bd.php");

$id = $_POST['id'];
$sql = $pdo->prepare("DELETE FROM productos WHERE id=:id");
$rs = $sql->execute(array('id' => $id));
header("Location:exito.php?v=6");