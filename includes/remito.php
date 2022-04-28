<?php
session_start();
include_once '../../includes/MySQL.php';

//include_once '../../includes/MySQL.php';
include '../../includes/functions.php';

function prodenremito($nremito, $mysqli){
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT id_prod, cant, preciou, precio, nomprod FROM prodvend where id_remito = $nremito")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($id_prod, $cant, $preciou,$precio,$nomprod);
		while ($stmt->fetch()) {
			$resultados[] = array($id_prod, $cant, $preciou,$precio,$nomprod);
		}
		return ($resultados);
		
	}
}
function subtotal($nremito, $mysqli){
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT subtotal, descuento, total FROM remitos where id_remito = $nremito")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($subtotal, $descuento, $total);
		$stmt ->fetch();
        $resultados = array($subtotal, $descuento, $total);
		return ($resultados);
		
	}
}
function datosvendedor($vend, $mysqli){
    $resultados = '';
    $idusuario= $_SESSION['id_usuario'];
    if ($stmt = $mysqli->prepare("SELECT nombre, direccion, provincia, codpos, telefono, email FROM usuarios where id_usuario = $idusuario")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($nombre, $direccion, $provincia, $codpos, $telefono, $email);
		$stmt ->fetch();
        $resultados = array($nombre, $direccion, $provincia, $codpos, $telefono, $email);
		return ($resultados);
		
	}
}
function datoscliente($client, $vend, $mysqli){
    $idusuario = $_SESSION['id_usuario'];
    $resultados = '';
    $idcliente=$client;
    if ($stmt = $mysqli->prepare("SELECT nombre, direccion, provincia, codpos, telefono, email FROM clientes where id_cliente = $idcliente AND id_usuario = $idusuario")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($nombre, $direccion, $provincia, $codpos, $telefono, $email);
		$stmt ->fetch();
        $resultados = array($nombre, $direccion, $provincia, $codpos, $telefono, $email);
		return ($resultados);
    }
}
function fecharemito($nremito , $mysqli){
    $resultados = '';
    if ($stmt = $mysqli->prepare("SELECT fecha FROM remitos where id_remito = $nremito")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($fecha);
		$stmt ->fetch();
        $resultados = date('d-m-Y',$fecha);
		return ($resultados);
		
	}
}
function todosclientes($id_usuario, $mysqli){
    $id_usuario = $_SESSION['id_usuario'];
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT id_cliente, nombre FROM clientes where id_usuario = $id_usuario")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($id_cliente, $nombre);
		while ($stmt->fetch()) {
			$resultados[] = array($id_cliente, $nombre);
		}
		return ($resultados);
		
	}
}
function ventastot($id_usuario, $mysqli){
    $id_usuario = $_SESSION['id_usuario'];

    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT id_remito, id_cli, fecha, total FROM remitos WHERE id_usu = $id_usuario AND total > 0 ORDER BY id_remito DESC")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($id_remito, $id_cli, $fecha, $subtotal);
		while ($stmt->fetch()) {
            if ($stmt2 = $mysqli->prepare("SELECT nombre FROM clientes where id_cliente = $id_cli ")) {
                $stmt2->execute();
                $stmt2->store_result();
                $stmt2->bind_result($nombre);
                $stmt2 ->fetch();
                $fecha2 = date('d-m-Y',$fecha);
                $resultados[] = array($id_remito, $id_cli, $nombre, $fecha2, $subtotal);
            }
            
		}
		return ($resultados);
		
	}
}
function verclientes($id_usuario, $mysqli){
    $id_usuario = $_SESSION['id_usuario'];
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT id_cliente, nombre, provincia, telefono, email FROM clientes where id_usuario = $id_usuario")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($id_cliente, $nombre, $provincia, $telefono, $email);
		while ($stmt->fetch()) {
			$resultados[] = array($id_cliente, $nombre, $provincia, $telefono, $email);
		}
		return ($resultados);
		
	}
}

function dtoscliente($hash, $mysqli){
    $resultados = "";
    if ($stmt = $mysqli->prepare("SELECT nombre, direccion, provincia, codpos, telefono, email FROM clientes where id_cliente = $hash")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($nombre,$direccion, $provincia, $codpos, $telefono, $email);
		$stmt->fetch();
		$resultados = array($nombre,$direccion, $provincia, $codpos, $telefono, $email);
		return ($resultados);

		
	}
}

function clisaldos($id_usuario, $mysqli){
    $id_usuario = $_SESSION['id_usuario'];
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT id_cliente, nombre FROM clientes where id_usuario = $id_usuario")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($id_cliente, $nombre);
		while ($stmt->fetch()) {
            if ($stmt2 = $mysqli->prepare("SELECT saldo FROM cuentaclientes where id_cliente = $id_cliente AND id_usuario = $id_usuario")) {
                $stmt2->execute();
                $stmt2->store_result();
                $stmt2->bind_result($saldo);
                while ($stmt2->fetch()) {
                $resultados[] = array($id_cliente, $nombre, $saldo);
                }
            }         
		}
		return ($resultados);
	}
}

function climovimientos($cliente, $mysqli){
    $id_usuario = $_SESSION['id_usuario'];
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT tmovimiento, valor, fecha FROM movcuentaclientes where id_cliente = $cliente and id_usuario = $id_usuario")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($movimiento, $valor, $fecha);
        $fecha2 = date('d-m-Y',$fecha);
		while ($stmt->fetch()) {
			$resultados[] = array($movimiento, $valor, $fecha2);
		}
		return ($resultados);
		
	}
}
function totalproductos($id_usuario, $mysqli){
    $id_usuario = $_SESSION['id_usuario'];
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT id_prod, nomprod, prevent, codigo  FROM products WHERE id_user = '$id_usuario'")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($id_prod, $nomprod, $precio, $codigo);
		while ($stmt->fetch()) {
			$resultados[] = array($id_prod, $nomprod, $precio, $codigo);
		}
		return ($resultados);
		
	}
}


?>