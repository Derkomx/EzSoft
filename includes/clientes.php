<?php
include_once 'MySQL.php';
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$provincia = $_POST['provincia'];
$codpos = $_POST['codpos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
//cambiar despues por el usuario en sesion
$usuario = 1;

$sql = "INSERT INTO clientes (id_cliente, nombre, direccion, provincia, codpos, telefono, email, id_usuario) VALUES ('', '$nombre', '$direccion', '$provincia', '$codpos', '$telefono', '$email', $usuario)";
$result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($mysqli));
echo json_encode(array("location" => 'nais'));
?>