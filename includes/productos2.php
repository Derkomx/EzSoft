<?php
include_once 'MySQL.php';
$usuario = 1;
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
        $sql = "INSERT INTO prodvend (id, id_remito, id_prod, cant, preciou, precio, nomprod) VALUES ('', $remito, $datos, $cant, $preciou, $precio, '$titulo')";
        $result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($mysqli));

        echo json_encode(array("success" => "aber"));

    }else if($tipo == 'remito'){
        $usu = $usuario;
        $cli = $_POST['cliente'];
        $now = time();
        $subtotal = $_POST['subtotal'];
        $sql = "INSERT INTO remitos (id_remito, id_usu, id_cli, fecha, subtotal) VALUES ('', $usu, $cli, $now, $subtotal)";
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
    }else if ($tipo == 'remito2'){
        $total = $_POST['total'];
        $remito = $_POST['remito'];
        $idcliente = $_POST['hash'];
        $descuento = $_POST['descuento'];
        $pago = $_POST['pago'];
        $fecha = time();
        $id_usuario = 1;
        if ($stmt = $mysqli->prepare("UPDATE remitos SET descuento = '$descuento', total = '$total' WHERE id_remito = '$remito' AND id_cli = '$idcliente'")) {
            $stmt->execute();
            if ($stmt2 = $mysqli->prepare("UPDATE cuentaclientes SET saldo = '$total' WHERE id_cliente = '$idcliente' AND id_usuario = '$id_usuario'")) {
                $stmt2 ->execute();
                if ($stmt3 = $mysqli->prepare("INSERT INTO movcuentaclientes (id, id_cliente, id_usuario, tmovimiento, valor, fecha) VALUES ('', '$idcliente', '$id_usuario', 'COMPRA', '$total', '$fecha')")) {
                    $stmt3 ->execute();
                    if ($stmt4 = $mysqli->prepare("INSERT INTO movcuentaclientes (id, id_cliente, id_usuario, tmovimiento, valor, fecha) VALUES ('', '$idcliente', '$id_usuario', 'PAGO', '$pago', '$fecha')")) {
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
    }else if ($tipo == 'cancelaremito'){
        $remito = $_POST['remito'];
        $cliente = $_POST['hash'];
        $id_usuario = 1;
        if ($stmt = $mysqli->prepare("DELETE FROM remitos WHERE id_remito = $remito AND id_cli = $cliente AND id_usu = $id_usuario")) {
            $stmt->execute();
            echo json_encode(array("success" => "atr" ));
        }
    }else if ($tipo == 'eliminar'){
        $id_producto = $_POST['id'];
        $id_usuario = 1;
        if ($stmt = $mysqli->prepare("DELETE FROM products WHERE id_prod = $id_producto AND id_user = $id_usuario")) {
            $stmt->execute();
            echo json_encode(array("success" => "Bien!" ));
        }else{
            echo json_encode(array("error" => "Error en producto, contacte con el desarrollador" ));
        }
    }
?>