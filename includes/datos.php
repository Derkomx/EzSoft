<?php
	session_start();
	include_once 'MySQL.php';
	include 'functions.php';
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$provincia = $_POST['provincia'];
$codpos = $_POST['codpos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$tipo = $_POST['tipo'];
//cambiar despues por el usuario en sesion
$usuario = $_SESSION['id_usuario'];

if ($tipo == 'nuevo'){
    if ($stmt = $mysqli->prepare("INSERT INTO usuarios (id_usuario, nombre, direccion, provincia, codpos, telefono, email) VALUES ( '$usuario' , '$nombre', '$direccion', '$provincia', '$codpos', '$telefono', '$email')")) {
        $stmt->execute();
        if ($stmt2 = $mysqli->prepare("UPDATE usuarios2 SET verificado2 = '1'"))
        $stmt2->execute();
        echo json_encode(array("location" => 'nais'));
    }

}
?>