<?php
require_once 'config/bd.php';

$sql = "SELECT id, empresa FROM proveedor";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$traer_proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);