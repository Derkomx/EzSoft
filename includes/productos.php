<?php
include_once 'MySQL.php';
$usuario = 1;

        //fetch table rows from mysql db
        //$sql = "SELECT id_prod, id_user, nomprod, fileprod, prevent, codigo  FROM products WHERE id_user = '$usuario'";
        //$result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($mysqli));

        //create an array
        //$emparray = array();
        //while($row =mysqli_fetch_assoc($result))
        //{
        //    $emparray[] = $row;
        //}
        //echo json_encode($emparray);

        //close the db connection
        //mysqli_close($mysqli);


        if ($stmt5 = $mysqli->prepare("SELECT id_prod, id_user, nomprod, fileprod, prevent, codigo  FROM products WHERE id_user = ? ")) {
            $resultados = [];
            $stmt5->bind_param('i', $usuario);
            $stmt5->execute();
            $stmt5->store_result();
            $stmt5->bind_result($id_prod, $id_user, $nomprod, $fileprod, $prevent, $codigo);
            while ($stmt5->fetch()) {
                $resultados[] = array($id_prod, $id_user, $nomprod, $fileprod, $prevent, $codigo);
            }
            echo json_encode($resultados);
        }
            
?>