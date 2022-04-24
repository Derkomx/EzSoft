<?php
include_once 'MySQL.php';

$Tipo = $JSONContent['Tipo'];
    $Titulo = $JSONContent['titulo'];
    $Imagen = $JSONContent['imagen'];
    $precio = $JSONContent['precio'];
    $codigo = $JSONContent['codigo'];
     if ($Tipo == 'nuevo'){
        $id_usuario = 1;
        if ($stmt = $mysqli->prepare("INSERT INTO products (id_user, nomprod, prevent, codigo) VALUES (?, ?, ?, ?)")) {
            $stmt->bind_param('isds', $id_usuario, $Titulo, $precio, $codigo);
            $stmt->execute();
            if($stmt2 = $mysqli->prepare("SELECT id_prod FROM products WHERE id_user = ? and nomprod = ? ORDER BY id_prod DESC LIMIT 1")){
                $stmt2->bind_param('is', $id_usuario, $Titulo);
                $stmt2->execute();
                $stmt2->store_result();
                $stmt2->bind_result($newID);
                $stmt2->fetch();	
                if ($stmt2 = $mysqli->prepare("UPDATE products SET fileprod = '$newID' WHERE id_user = '$id_usuario' AND id_prod = '$newID'")) {
                    $stmt2 ->execute();

                                // Chequea si existe la carpeta donde guardar las imagenes de las productos
                                if (!is_dir('productos/Preview/'.$id_usuario.'')) {
                                    // Si no existe, crea la carpeta
                                    mkdir('productos/Preview/'.$id_usuario.'', 0777, true);
                                }
                                // Se chequea si por alguna razón ya existe la imagen de la publicación archivada
                                if (file_exists("productos/Preview/".$id_usuario."/".$newID.".jpeg")) {
                                    // En ese caso, se borra el archivo de la publicación
                                    unlink("productos/Preview/".$id_usuario."/".$newID.".jpeg");
                                }
                                // Se crea la imagen de presentación de la imagen
                                $Image_Decode = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $Imagen));
                                $Image_Path = "productos/Preview/".$id_usuario."/".$newID.".jpeg";
                                file_put_contents($Image_Path, $Image_Decode);
                                echo json_encode(array("success" => "funciona"));
                }
            }

        } else {
            // Si da error en la base de datos, se da aviso.
            echo json_encode(array("error" => "¡Ocurrió un error interno!"));
            exit();
        }
    }
?>