<?php
//session_start();
//include_once '../../includes/MySQL.php';

//include_once '../../includes/MySQL.php';
//include '../../includes/functions.php';

function prodenremito($nremito, $mysqli){
    $usuario = $_SESSION['id_usuario'];
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT id_prod, cant, preciou, precio, nomprod FROM prodvend where id_remito = $nremito AND id_usuario = $usuario")) {
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
    $id_usuario = $_SESSION['id_usuario'];
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT subtotal, descuento, total FROM remitos where id_remito = $nremito AND id_usu = $id_usuario")) {
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
    $usuario = $_SESSION['id_usuario'];
    $resultados = '';
    if ($stmt = $mysqli->prepare("SELECT fecha FROM remitos where id_remito = $nremito and id_usu = $usuario")) {
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
function ctacliente($id_cliente, $nremito, $mysqli){
    $resultados = [];
    $id_usuario = $_SESSION['id_usuario'];
if($stmt3 = $mysqli->prepare("SELECT id FROM remitos WHERE id_remito = '$nremito' AND id_usu = '$id_usuario' ")){
    $stmt3->execute();
    $stmt3->store_result();
    $stmt3->bind_result($id);
    $stmt3->fetch();
    if($stmt = $mysqli->prepare("SELECT valor, modpago FROM movcuentaclientes WHERE id_cliente = '$id_cliente' AND id_remito = '$id' AND tmovimiento = 'PAGO'")){
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($valor, $modpago);
        $stmt->fetch();
        if ($stmt = $mysqli->prepare("SELECT saldo FROM cuentaclientes WHERE id_cliente = '$id_cliente'")){
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($saldo);
            $stmt->fetch();
            $resultados = array($valor, $modpago, $saldo);
            return($resultados);
        }
    }
}
}
function prodmasvend($id_usuario, $mysqli){
    $Resultado = [];
    if($stmt = $mysqli->prepare("SELECT id_prod, COUNT( id_prod ) AS total FROM  prodvend WHERE id_usuario = '$id_usuario' GROUP BY id_prod ORDER BY total DESC")){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id_prod, $total);
        while($stmt->fetch()){
            if($stmt1 = $mysqli->prepare("SELECT nomprod, prevent FROM products WHERE id_prod = '$id_prod'")){
                $stmt1->execute();
                $stmt1->store_result();
                $stmt1->bind_result($nombre, $precio);
                $stmt1->fetch();
                if($stmt2 = $mysqli->prepare("SELECT SUM(cant) FROM prodvend WHERE id_prod = '$id_prod'")){
                    $stmt2->execute();
                    $stmt2->store_result();
                    $stmt2->bind_result($cantvend);
                    $stmt2->fetch();
                    $Resultado[] = array($id_prod, $nombre, $precio, $cantvend);
                }
            }
        }
        return($Resultado);

    }
}
function cantprod($id_usuario, $mysqli){
    if($stmt2 = $mysqli->prepare("SELECT COUNT(nomprod) FROM products WHERE id_user = '$id_usuario'")){
        $stmt2->execute();
        $stmt2->store_result();
        $stmt2->bind_result($cant);
        $stmt2->fetch();
        $Resultado = $cant;
        return ($Resultado);
    }
}
function cantventas($id_usuario, $mysqli){
    $Resultad = 0;
    if($stmt = $mysqli->prepare("SELECT COUNT(id_remito) FROM remitos WHERE id_usu = $id_usuario AND total > '0' ")){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($cant1);
        $stmt->fetch();
        $Resultad = $cant1;
        return ($Resultad);
    }
}
function cantclientes($id_usuario, $mysqli){
    if($stmt = $mysqli->prepare("SELECT COUNT(id_cliente) FROM clientes WHERE id_usuario = $id_usuario ")){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($cant);
        $stmt->fetch();
        $Resultad = $cant;
        return ($Resultad);
    }
}
function balancecuentas($id_usuario, $mysqli){
    if($stmt = $mysqli->prepare("SELECT SUM(saldo) FROM cuentaclientes WHERE id_usuario = $id_usuario ")){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($cant);
        $stmt->fetch();
        $Resultad = $cant;
        return ($Resultad);
    }
}
function clientesmascompras($id_usuario, $mysqli){
    $Resultado = [];
    if($stmt = $mysqli->prepare("SELECT id_cli, COUNT( id_cli ) AS total FROM  remitos WHERE id_usu = '$id_usuario' AND total > 0 GROUP BY id_cli ORDER BY total DESC")){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id_cliente, $total);
        while($stmt->fetch()){
            if($stmt1 = $mysqli->prepare("SELECT nombre FROM clientes WHERE id_cliente = $id_cliente AND id_usuario = $id_usuario")){
                $stmt1->execute();
                $stmt1->store_result();
                $stmt1->bind_result($nombre);
                $stmt1->fetch();
                $Resultado[] = array($total, $nombre);
            }
        }
        return($Resultado);
    }
}
function cuentacte($client, $mysqli){
    if ($stmt = $mysqli->prepare("SELECT saldo FROM cuentaclientes WHERE id_cliente = '$client'")){
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($saldo);
        $stmt->fetch();
        $resultados = $saldo;
        return($resultados);
    }
}
function fecharecibo($nremito, $mysqli){
    $usuario = $_SESSION['id_usuario'];
    $resultados = '';
    if ($stmt = $mysqli->prepare("SELECT fecha FROM recibo where id_recibo = $nremito AND id_usuario = $usuario")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($fecha);
		$stmt ->fetch();
        $resultados = date('d-m-Y',$fecha);
		return ($resultados);
		
	}
}
function ctacliente2($id_cliente, $nremito, $mysqli){
    $resultados = [];
    $id_usuario = $_SESSION['id_usuario'];
if($stmt3 = $mysqli->prepare("SELECT id FROM recibo WHERE id_recibo = '$nremito' AND id_usuario = '$id_usuario' ")){
    $stmt3->execute();
    $stmt3->store_result();
    $stmt3->bind_result($id);
    $stmt3->fetch();
    if($stmt = $mysqli->prepare("SELECT valor, modpago FROM movcuentaclientes WHERE id_cliente = '$id_cliente' AND id_recibo = '$id' AND tmovimiento = 'PAGO'")){
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($valor, $modpago);
        $stmt->fetch();
        if ($stmt = $mysqli->prepare("SELECT saldo FROM cuentaclientes WHERE id_cliente = '$id_cliente'")){
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($saldo);
            $stmt->fetch();
            $resultados = array($valor, $modpago, $saldo);
            return($resultados);
        }
    }
}
}
function movimientos_hoy($mysqli){
    $usuario = $_SESSION['id_usuario'];
    $hoydate = date('d-m-Y');
    $finhoydate = date("d-m-Y",strtotime($hoydate."+ 1 days"));
    $hoy = strtotime($hoydate);
    $mañana = strtotime($finhoydate);
    $resultados = '';
    if ($stmt = $mysqli->prepare("SELECT SUM(total) FROM remitos where id_usu = $usuario AND fecha < $mañana AND fecha > $hoy ")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($total);
		$stmt ->fetch();
        $resultados = $total;
		return ($resultados);
		
	}
}
function movimientos_mes($mysqli){
    $usuario = $_SESSION['id_usuario'];
    $mes1 = date('01-m-Y');
    $mes2 = date("t-m-Y");
    $principiomes = strtotime($mes1);
    $findemes = strtotime($mes2);
    $resultados = '';
    if ($stmt = $mysqli->prepare("SELECT SUM(total) FROM remitos where id_usu = $usuario AND fecha < $findemes AND fecha > $principiomes ")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($total);
		$stmt ->fetch();
        $resultados = $total;
		return ($resultados);
		
	}
}
?>