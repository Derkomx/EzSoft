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
    

?>