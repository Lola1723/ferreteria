<?php
require_once 'config/bd.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $empresa= $_POST['empresa'];
        $rfc= $_POST['rfc'];
        $representante= $_POST['representante'];
        $telefono= $_POST['telefono'];
        //insertar los campos
        $sql=$pdo->prepare("INSERT INTO proveedor (id, empresa, rfc, representante, telefono) values (null, :empresa, :rfc,
        :representante, :telefono)");
        $sql->execute(array(":empresa"=>$empresa,":rfc"=>$rfc,":representante"=>$representante,":telefono"=>$telefono));
        header("Location:exito.php?v=1");

    }else{
        echo 'Debes Rellenar los campos faltantes';
    }
   


