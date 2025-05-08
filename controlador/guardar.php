<?php

include("../config/bd.php");
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $errores = array();

    $nombre=isset($_POST["nombre"]) ? $_POST["nombre"] :null;
    $apellido=isset($_POST["apellido"]) ? $_POST["apellido"] :null;
    $email=isset($_POST["email"]) ? $_POST["email"] :null;
    $password=isset($_POST["password"]) ? $_POST["password"] :null;
    $confirmarPassword=isset($_POST["confirmarPassword"]) ? $_POST["confirmarPassword"] :null;

    if(empty($nombre)){
        $errores['nombre'] = "Debe ingresar el nombre";
    }
    if(empty($apellido)){
        $errores['apellido'] = "Debe ingresar el apellido";
    }
    if(empty($email)){
        $errores['email'] = "Debe ingresar el email";
    }//verificamos que sea un correo electronico valido
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores["email"] = "El formato del email es incorrecto";
    }
    //validacion de password
   /* if(strlen($password) < 6 || strlen($password) > 0){
        $error['password'] = "La contraseña debe ser mayor a 5 caracteres";
    }*/
    if(empty($password)){
        $errores["password"] = "La contraseña es obligatoria";
    }
    if(empty($confirmarPassword)){
        $errores["confirmarPassword"] = "Debes confirmar la contraseña";
    }elseif($confirmarPassword!=$password){
           $errores["confirmarPassword"] = "Las contraseñas no coinciden";
    }
}
    

      if((empty($errores))){
        //inserto en la base de datos
        try{
            
            //encriptando el password
            $nvoPassword=password_hash($password, PASSWORD_DEFAULT);
            $sql= $pdo->prepare("INSERT INTO usuario (id, email, password, nombre, apellido)
             VALUES (NULL, :email, :password, :nombre, :apellido)");
            $rs=$sql->execute(array('email'=>$email, 'password'=>$nvoPassword, 'nombre'=>$nombre,
             'apellido'=>$apellido));
              header("Location:../login.html");
        }
         catch(PDOException $e){
            // Mensaje de error
        echo "<p>Error al insertar el registro: " . $e->getMessage() . "</p>";
         }
    
    }else{
        foreach($errores as $error){
            echo "<br/>".$error."<br/>";
        }
    
        echo "<br/><a href='../registro.php'>Volver a Registro</a>";
    }

    
