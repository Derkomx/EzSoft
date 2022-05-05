<?php
	session_start();
	include_once 'MySQL.php';
	include 'functions.php';
    $usuario = $_SESSION['id_usuario'];
    $tipo = $_POST['Tipo'];

        if ($tipo == 'cierrecajas'){
            $hoydate = $_POST['fecha'];
            $mañanadate = $_POST['fecha2'];     
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $hoydate = date('d-m-Y h:i:s', $hoydate);
                    $mañanadate = date('d-m-Y h:i:s', $mañanadate);
                    //$hoydate = date('d-m-Y');
                    //$finhoydate = date("d-m-Y",strtotime($hoydate."+1 day"));
                    $hoy = strtotime($hoydate);
                    $mañana = strtotime($mañanadate);
                    //$mañana = strtotime($finhoydate);
                    if($stmt1 = $mysqli->prepare("SELECT id_usu, SUM(total) AS total FROM  remitos WHERE fecha > $hoy and fecha < $mañana and total > 0 GROUP BY id_usu ORDER BY total DESC")){
                        $stmt1->execute();
                        $stmt1->store_result();
                        $stmt1->bind_result($id_usuario, $totalvendido);
                        while($stmt1->fetch()){
                            if($stmt2 = $mysqli->prepare("SELECT SUM(valor) FROM movcuentaclientes WHERE id_usuario = $id_usuario and fecha > $hoy and fecha < $mañana and tmovimiento = 'PAGO'")){
                                $stmt2->execute();
                                $stmt2->store_result();
                                $stmt2->bind_result($totalpagos);
                                $stmt2->fetch();
                                $TOTAL = ($totalvendido - $totalpagos);
                                if ($stmt3 = $mysqli->prepare("INSERT INTO cierredia (id_usuario, id_root, fecha, total, caja) VALUES ($id_usuario, $usuario, $hoy, $totalvendido, $TOTAL)")){
                                    $stmt3->execute();                                 
                                }                  
                            }
                        }
                        echo json_encode(array("success" => "izi pizi lemon squeezi"));
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }else if ($tipo == 'actualizardatos'){
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $provincia = $_POST['provincia'];
            $codpos = $_POST['codpos'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $usuario2 = $_POST['usuario'];
            if ($stmt2 = $mysqli->prepare("UPDATE usuarios SET nombre = '$nombre' , direccion = '$direccion' , provincia = '$provincia' , codpos = $codpos , telefono = '$telefono' , email = '$email' WHERE id_usuario = $usuario2")){
                $stmt2->execute();
                echo json_encode(array("location" => "(づ｡◕‿‿◕｡)づ"));
                }
        }else if ($tipo == 'actualizarnivel'){
            $lvl = $_POST['lvl'];
            $usuario2 = $_POST['usuario'];
            if ($stmt2 = $mysqli->prepare("UPDATE usuarios2 SET nivel = $lvl WHERE id_usuario = $usuario2")){
                $stmt2->execute();
                echo json_encode(array("location" => "(づ｡◕‿‿◕｡)づ"));
                }
        }
?>