<?php
require_once 'config/bd.php';

$sql = "SELECT id, categoria FROM categoria";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);