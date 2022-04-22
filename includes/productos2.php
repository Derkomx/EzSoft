<?php
include_once 'MySQL.php';
$usuario = 1;
$tipo = $_POST['Tipo'];
    
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
        $cli = 1;
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
    }else
?>