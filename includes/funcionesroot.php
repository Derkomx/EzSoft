<?php
include_once 'functions.php';
include_once 'MySQL.php';

//include_once '../../includes/MySQL.php';


//$usuario = $_SESSION['id_usuario'];
    //if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
    //    $stmt->execute();
    //    $stmt->store_result();
    //    $stmt->bind_result($nivel);
    //    $stmt->fetch();
    //    if($nivel == 9){
            
    //    }else{
    //        header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
    //        exit();
    //    }
    //}
        function listausuarios($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivell);
                $stmt->fetch();
                if($nivell == 9){
                    $resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_usuario, cuil, nivel, email FROM usuarios2 ")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $nombre, $nivel, $email);
                        while ($stmt2->fetch()){
                            $resultado[]= array($id_usuario, $nombre, $nivel, $email);
                        }
                        return ($resultado);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
        function listausuariosemailactivo($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_usuario, cuil, email  FROM usuarios2 WHERE activo = 1")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $nombre, $email);
                        while ($stmt2->fetch()){
                            $resultado[]= array($id_usuario, $nombre, $email);
                        }
                        return ($resultado);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
            
        function listausuariosemailinactivo($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_usuario, cuil, email, activacion  FROM usuarios2 WHERE activo = 0")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $nombre, $email, $activacion);
                        while ($stmt2->fetch()){
                            $resultado[]= array($id_usuario, $nombre, $email, $activacion);
                        }
                        return ($resultado);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
            
        function listausuariossindatos($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_usuario, cuil, email  FROM usuarios2 WHERE verificado2 = 0")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $nombre, $email);
                        while ($stmt2->fetch()){
                            $resultado[]= array($id_usuario, $nombre, $email);
                        }
                        return ($resultado);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
            
        function listausuarioscondatos($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_usuario, cuil, email FROM usuarios2 WHERE verificado2 = 1")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $nombre, $email);
                        while ($stmt2->fetch()){
                            $resultado[]= array($id_usuario, $nombre, $email);
                        }
                        return ($resultado);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }            
        }
        function listausuariosactivos($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_usuario, cuil, email FROM usuarios2 WHERE denegado = 0")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $nombre, $email);
                        while ($stmt2->fetch()){
                            $resultado[]= array($id_usuario, $nombre, $email);
                        }
                        return ($resultado);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
        function listausuariosinactivos($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_usuario, cuil, email FROM usuarios2 WHERE denegado = 1")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $nombre, $email);
                        while ($stmt2->fetch()){
                            $resultado[]= array($id_usuario, $nombre, $email);
                        }
                        return ($resultado);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }            
        }
        function cantprod($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    if($stmt2 = $mysqli->prepare("SELECT COUNT(nomprod) FROM products")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($cant);
                        $stmt2->fetch();
                        $Resultado = $cant;
                        return ($Resultado);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }            
        }
        function cantventas($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $Resultad = 0;
                    if($stmt = $mysqli->prepare("SELECT COUNT(id_remito) FROM remitos WHERE total > '0' ")){
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($cant1);
                        $stmt->fetch();
                        $Resultad = $cant1;
                        return ($Resultad);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }            
        }
        function cantclientes($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    if($stmt = $mysqli->prepare("SELECT COUNT(id_cliente) FROM clientes ")){
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($cant);
                        $stmt->fetch();
                        $Resultad = $cant;
                        return ($Resultad);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }        
        }
        function movimientos_mes($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $mes1 = date('01-m-Y');
                    $mes2 = date("t-m-Y");
                    $principiomes = strtotime($mes1);
                    $findemes = strtotime($mes2);
                    $resultados = '';
                    if ($stmt = $mysqli->prepare("SELECT SUM(total) FROM remitos where fecha < $findemes AND fecha > $principiomes ")) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($total);
                        $stmt ->fetch();
                        $resultados = $total;
                        return ($resultados);       
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
        function movimientos_hoy($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $hoydate = date('d-m-Y');
                    $finhoydate = date("d-m-Y",strtotime($hoydate."+ 1 days"));
                    $hoy = strtotime($hoydate);
                    $mañana = strtotime($finhoydate);
                    $resultados = '';
                    if ($stmt = $mysqli->prepare("SELECT SUM(total) FROM remitos where fecha < $mañana AND fecha > $hoy ")) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($total);
                        $stmt ->fetch();
                        $resultados = $total;
                        return ($resultados);
                        
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }         
        }
        function cantusuarios($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    if($stmt = $mysqli->prepare("SELECT COUNT(cuil) FROM usuarios2 ")){
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($cant);
                        $stmt->fetch();
                        $Resultad = $cant;
                        return ($Resultad);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
        function cantusuariosactivos($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    if($stmt = $mysqli->prepare("SELECT COUNT(cuil) FROM usuarios2 WHERE denegado = 0 ")){
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($cant);
                        $stmt->fetch();
                        $Resultad = $cant;
                        return ($Resultad);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
        function balancecuentas($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    if($stmt = $mysqli->prepare("SELECT SUM(saldo) FROM cuentaclientes ")){
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($cant);
                        $stmt->fetch();
                        $Resultad = $cant;
                        return ($Resultad);
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
        function usermasventas($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $Resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_usu, COUNT( id_usu ), SUM(total) AS total FROM  remitos WHERE total > 0 GROUP BY id_usu ORDER BY total DESC")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $total, $sumtotal);
                        while($stmt2->fetch()){
                            if($stmt3 = $mysqli->prepare("SELECT nombre, email FROM usuarios WHERE id_usuario = $id_usuario ")){
                                $stmt3->execute();
                                $stmt3->store_result();
                                $stmt3->bind_result($nombre, $email);
                                $stmt3->fetch();
                                $Resultado[] = array($id_usuario, $nombre, $email, $total, $sumtotal);
                            }
                        }
                        return $Resultado;
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
        function usermasproductos($mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $Resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT id_user, COUNT( codigo ) AS total FROM  products GROUP BY id_user ORDER BY total DESC")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($id_usuario, $total);
                        while($stmt2->fetch()){
                            if($stmt3 = $mysqli->prepare("SELECT nombre, email FROM usuarios WHERE id_usuario = $id_usuario ")){
                                $stmt3->execute();
                                $stmt3->store_result();
                                $stmt3->bind_result($nombre, $email);
                                $stmt3->fetch();
                                $Resultado[] = array($id_usuario, $nombre, $email, $total);
                            }
                        }
                        return $Resultado;
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }
        }
        function columnastabla($tabla, $mysqli){
            $usuario = $_SESSION['id_usuario'];
            if($stmt = $mysqli->prepare("SELECT nivel FROM usuarios2 WHERE id_usuario = $usuario")){
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($nivel);
                $stmt->fetch();
                if($nivel == 9){
                    $Resultado = [];
                    if($stmt2 = $mysqli->prepare("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='ezsoft' AND `TABLE_NAME`='$tabla'")){
                        $stmt2->execute();
                        $stmt2->store_result();
                        $stmt2->bind_result($columna);
                        while($stmt2->fetch()){
                                $Resultado[] = array($columna);
                            }
                        }
                        return $Resultado;
                    }
                }else{
                    header("Location: ../(ง ͡❛ ͜ʖ ͡❛)_งQue_queres_hacer_pibe?.");
                    exit();
                }
            }      
            
            

?>