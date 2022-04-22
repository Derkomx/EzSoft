<?php
include_once '../../includes/MySQL.php';
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
    $resultados = '';
    if ($stmt = $mysqli->prepare("SELECT subtotal FROM remitos where id_remito = $nremito")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($subtotal);
		$stmt ->fetch();
        $resultados = $subtotal;
		return ($resultados);
		
	}
}
function datosvendedor($mysqli){
    $resultados = '';
    $idusuario=1;
    if ($stmt = $mysqli->prepare("SELECT nombre, direccion, provincia, codpos, telefono, email FROM usuarios where id_usuario = $idusuario")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($nombre, $direccion, $provincia, $codpos, $telefono, $email);
		$stmt ->fetch();
        $resultados = array($nombre, $direccion, $provincia, $codpos, $telefono, $email);
		return ($resultados);
		
	}
}
function datoscliente($mysqli){
    $resultados = '';
    $idcliente=1;
    if ($stmt = $mysqli->prepare("SELECT nombre, direccion, provincia, codpos, telefono, email FROM clientes where id_cliente = $idcliente")) {
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

?>