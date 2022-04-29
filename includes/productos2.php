<?php
	session_start();
	include_once 'MySQL.php';
	include 'functions.php';
$usuario = $_SESSION['id_usuario'];
$tipo = $_POST['Tipo'];
    
//tipos de tipo: 
//prodvend(cuando se vende un producto), 
//remito(devuelve los datos de un remito), 
//remito2(carga los datos en el remito y crea los movimientos en la cuenta corriente del cliente)
//cancelaremito(cuando estas ya en la previsualizacion del remito, al presionar boton cancelar al ir a pagar, borra el remito, por mas que no se lo haga no puede ser visualizado, pero mantiene una cierta limpieza en la base de datos)
//nuevo(carga un producto nuevo al usuario)


    if($tipo == 'prodvend'){
        $datos = $_POST['datos'];
        $remito = $_POST['remito'];
        $cant = $_POST['cant'];
        $precio = $_POST['precio'];
        $preciou = $_POST['preciou'];
        $titulo = $_POST['titulo'];
        $usuario = $_SESSION['id_usuario'];
        $sql = "INSERT INTO prodvend (id, id_remito, id_prod, cant, preciou, precio, nomprod, id_usuario) VALUES ('', $remito, $datos, $cant, $preciou, $precio, '$titulo', '$usuario')";
        $result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($mysqli));

        echo json_encode(array("success" => "aber"));

    }else if($tipo == 'remito'){
        $usu = $usuario;
        $cli = $_POST['cliente'];
        $now = time();
        $subtotal = $_POST['subtotal'];
        if ($stmt1 = $mysqli->prepare("SELECT id_remito FROM remitos WHERE id_usu = ? ORDER BY id_remito DESC LIMIT 1")) {
            $stmt1->bind_param('s', $usu);
            $stmt1->execute();
            $stmt1->store_result();
            $stmt1->bind_result($idremito);
            $stmt1->fetch();
            $idres = $idremito+1;
        
            $sql = "INSERT INTO remitos (id_remito, id_usu, id_cli, fecha, subtotal) VALUES ($idres, $usu, $cli, $now, $subtotal)";
            $result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($mysqli));
        
                if ($stmt = $mysqli->prepare("SELECT id_remito FROM remitos WHERE id_usu = ? ORDER BY id_remito DESC LIMIT 1")) {
                    $stmt->bind_param('s', $usu);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($remito);
                    $stmt->fetch();
                    $res = $remito;
                    echo json_encode(array("success" => $res));
                    mysqli_close($mysqli);
                }
        }
        // remito2 Genera el remito, actualiza el saldo en la cuenta corriente, crea los movimientos en las cuentas
    }else if ($tipo == 'remito2'){
        $total = $_POST['total'];
        $remito = $_POST['remito'];
        $idcliente = $_POST['hash'];
        $descuento = $_POST['descuento'];
        $pago = $_POST['pago'];
        $metodo = $_POST['metodo'];
        $fecha = time();
        $id_usuario = $usuario;
        //actualiza el remito
        if ($stmt = $mysqli->prepare("UPDATE remitos SET descuento = '$descuento', total = '$total' WHERE id_remito = '$remito' AND id_cli = '$idcliente'")) {
            $stmt->execute();
            //consulta el saldo para despues utilizarlo
            if($stmt8 = $mysqli->prepare("SELECT saldo FROM cuentaclientes WHERE id_cliente = ? AND id_usuario = ?")) {
                $stmt8->bind_param('ii', $idcliente, $id_usuario);
                $stmt8->execute();
                $stmt8->store_result();
                $stmt8->bind_result($usaldo);
                $stmt8->fetch();
                $utotal = ($total + $usaldo);
                //actualiza el saldo si es que pago menos del total de la factura, teniendo en cuenta el saldo anterior
                if ($stmt2 = $mysqli->prepare("UPDATE cuentaclientes SET saldo = '$utotal' WHERE id_cliente = '$idcliente' AND id_usuario = '$id_usuario'")) {
                    $stmt2 ->execute();
                    if($stmt7 = $mysqli->prepare("SELECT id FROM remitos WHERE id_cli = $idcliente AND id_usu = $id_usuario AND id_remito = $remito")){
                        $stmt7->execute();
                        $stmt7->store_result();
                        $stmt7->bind_result($id);
                        $stmt7->fetch();
                        if ($stmt3 = $mysqli->prepare("INSERT INTO movcuentaclientes (id, id_cliente, id_usuario, tmovimiento, valor, fecha) VALUES ('', '$idcliente', '$id_usuario', 'COMPRA', '$total', '$fecha')")) {
                            $stmt3 ->execute();
                            if ($stmt4 = $mysqli->prepare("INSERT INTO movcuentaclientes (id, id_cliente, id_usuario, tmovimiento, valor, fecha, modpago, id_remito) VALUES ('', '$idcliente', '$id_usuario', 'PAGO', '$pago', '$fecha', '$metodo', '$id')")) {
                                $stmt4 ->execute();
                                if ($stmt5 = $mysqli->prepare("SELECT saldo FROM cuentaclientes WHERE id_cliente = ? AND id_usuario = ?")) {
                                    $stmt5->bind_param('ii', $idcliente, $id_usuario);
                                    $stmt5->execute();
                                    $stmt5->store_result();
                                    $stmt5->bind_result($saldo);
                                    $stmt5->fetch();
                                    $saldonvo = ($saldo-$pago);
                                    if ($stmt6 = $mysqli->prepare("UPDATE cuentaclientes SET saldo = '$saldonvo' WHERE id_cliente = '$idcliente' AND id_usuario = '$id_usuario'")) {
                                        $stmt6 ->execute();
                                        echo json_encode(array("success" => "$remito" ));
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }else if ($tipo == 'cancelaremito'){
        $remito = $_POST['remito'];
        $cliente = $_POST['hash'];
        $id_usuario = $usuario;
        if ($stmt = $mysqli->prepare("DELETE FROM remitos WHERE id_remito = $remito AND id_cli = $cliente AND id_usu = $id_usuario")) {
            $stmt->execute();
            echo json_encode(array("success" => "atr" ));
        }
    }else if ($tipo == 'eliminar'){
        $id_producto = $_POST['id'];
        $id_usuario = $usuario;
        if ($stmt = $mysqli->prepare("DELETE FROM products WHERE id_prod = $id_producto AND id_user = $id_usuario")) {
            $stmt->execute();
            echo json_encode(array("success" => "Bien!" ));
        }else{
            echo json_encode(array("error" => "Error en producto, contacte con el desarrollador" ));
        }
    }else if ($tipo == 'nuevopago'){
        $usu = $usuario;
        $cli = $_POST['hash'];
        $now = time();
        $pago = $_POST['pago'];
        $metodo = $_POST['metodo'];
        if ($stmt1 = $mysqli->prepare("SELECT id_recibo FROM recibo WHERE id_usuario = ? ORDER BY id_recibo DESC LIMIT 1")) {
            $stmt1->bind_param('s', $usu);
            $stmt1->execute();
            $stmt1->store_result();
            $stmt1->bind_result($idrecibo);
            $stmt1->fetch();
            $idrec = $idrecibo+1;      
            $sql = "INSERT INTO recibo (id_recibo, id_usuario, id_cliente, metodo, valor, fecha) VALUES ('$idrec', '$usu', '$cli', '$metodo', '$pago', '$now')";
            $result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($mysqli));
                if ($stmt = $mysqli->prepare("SELECT id FROM recibo WHERE id_usuario = ? AND id_recibo = '$idrec' ORDER BY id_recibo DESC LIMIT 1")) {
                    $stmt->bind_param('s', $usu);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($remito);
                    $stmt->fetch();
                    $res = $remito;
                    if($stmt2 = $mysqli->prepare("SELECT saldo FROM cuentaclientes WHERE id_cliente = ? AND id_usuario = ?")) {
                        $stmt2->bind_param('ii', $cli, $usu);
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($usaldo);
                        $stmt2->fetch();
                        $utotal = ($usaldo - $pago);
                        //actualiza el saldo si es que pago menos del total de la factura, teniendo en cuenta el saldo anterior
                        if ($stmt2 = $mysqli->prepare("UPDATE cuentaclientes SET saldo = '$utotal' WHERE id_cliente = '$cli' AND id_usuario = '$usu'")) {
                            $stmt2 ->execute();
                            if ($stmt3 = $mysqli->prepare("INSERT INTO movcuentaclientes (id, id_cliente, id_usuario, tmovimiento, valor, fecha, modpago, id_recibo) VALUES ('', '$cli', '$usu', 'PAGO', '$pago', '$now', '$metodo', '$res')")) {
                                $stmt3 ->execute();
                            echo json_encode(array("success" => $idrec));
                            mysqli_close($mysqli);
                            }
                        }
                    }
                }
    }
}
?>