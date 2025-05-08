<?php
include("config/bd.php");
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//para que el PDO  maneje los errores de forma automatica
// Consulta SQL
$sql = 'SELECT id, nombre, apellido, email, password FROM usuario';

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error al consultar los datos: ' . $e->getMessage();
    exit;
}
