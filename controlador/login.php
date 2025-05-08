<?php
session_start();//aqui inicializo la sesion    
//validacion de datos del login
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("../config/bd.php");
    $errores = array();

    // para verificar que estamos recibiendo los datos -> print_r($_POST);
    //se validan con un if ternario
    $email = (isset($_POST["email"])) ? htmlspecialchars($_POST["email"]) : null;
    $password = (isset($_POST["password"])) ? $_POST["password"] : null;

    if (empty($email)) {
        $errores['email'] = "Debe ingresar el email";
    }//verificamos que sea un correo electronico valido
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores["email"] = "El formato del email es incorrecto";
    }
    if (empty($password)) {
        $errores["password"] = "La contraseña es obligatoria";
    }

    if ((empty($errores))) {
        //leo los registros en la base de datos
        try {
            $sql = "SELECT * FROM usuario WHERE email=:email";
            $rs = $pdo->prepare($sql);
            $rs->execute(['email' => $email]);

            $usuarios = $rs->fetchAll(PDO::FETCH_ASSOC);

            //print_r($usuarios);
            //verificando los datos
            $login = false;

            foreach ($usuarios as $user) {
                //if(password_verify($password, $user['password'])){
                // $_SESSION['loggedUser']=$user; x el momento se comenta esta variable ya q se tiene q inicializar
                if (password_verify($password, $user['password'])) {
                    $_SESSION['usuario_id'] = $user['id'];//aqui ya empieza la variable indentificada
                    $_SESSION['usuario_nombre'] = $user['nombre'];
                    $_SESSION['usuario_apellido'] = $user['apellido'];
                    $login = true;
                }
            }
            if ($login) {
                echo 'Existe en la BD';
                header('location:../index.php');
            } else {
                echo 'No existe en la BD';
            }



        } catch (Exception $e) {
            echo "<p>Error al insertar el registro: " . $e->getMessage() . "</p>";
        }
    } else {

        foreach ($errores as $error) {
            echo "<br/>" . $error . "<br/>";
        }
        echo "<br/><a href='../login.html'>Volver a Login</a>";
    }
}