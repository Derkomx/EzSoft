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
$saldo = 0;
if ($tipo == 'nuevo'){
    if ($stmt = $mysqli->prepare("INSERT INTO clientes (id_cliente, nombre, direccion, provincia, codpos, telefono, email, id_usuario) VALUES ('', '$nombre', '$direccion', '$provincia', '$codpos', '$telefono', '$email', $usuario)")) {
        $stmt->execute();
        if ($stmt2 = $mysqli->prepare("SELECT id_cliente FROM clientes WHERE id_usuario = ? ORDER BY id_cliente DESC LIMIT 1")) {
            $stmt2 ->bind_param('s', $usuario);
            $stmt2 ->execute();
            $stmt2 ->store_result();
            $stmt2 ->bind_result($id_cliente);
            $stmt2 ->fetch();
            if ($stmt3 = $mysqli->prepare("INSERT INTO cuentaclientes (id, id_cliente, id_usuario, saldo) VALUES ('', '$id_cliente', '$usuario', '$saldo')")) {
                $stmt3 ->execute();
                echo json_encode(array("location" => 'nais'));
            }
        }   
    }
}
if ($tipo == 'actualizar'){
    $idcliente = $_POST['id'];
    if ($stmt = $mysqli->prepare("UPDATE clientes SET nombre = '$nombre', direccion = '$direccion', provincia = '$provincia', codpos = '$codpos', telefono = '$telefono', email = '$email' WHERE id_cliente = $idcliente")) {
        $stmt->execute();
        echo json_encode(array("location" => 'nais'));
    }
}
?>