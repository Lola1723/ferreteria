<?php 

define("SERVIDOR", "localhost");
define("USUARIO", "root");
define("PASSWORD","");
define("BD","ferreteria");

$servidor="mysql:dbname=".BD.";host=".SERVIDOR;
    try{
        $pdo= new PDO($servidor, USUARIO, PASSWORD,
        //Esta codificacion elimina caracteres extraños//>
        array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
       // echo "<script>alert('Conectado...')</script>";
    }
    catch(PDOException $e){
        //echo "<script>alert('Error de conexion...'.$e)</script>";
    }

