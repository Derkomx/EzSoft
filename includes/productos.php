<?php
	session_start();
	include_once 'MySQL.php';
	include 'functions.php';
$id_usuario = $_SESSION['id_usuario'];

        //fetch table rows from mysql db
        $sql = "SELECT id_prod, id_user, nomprod, fileprod, prevent, codigo  FROM products WHERE id_user = '$id_usuario'";
        $result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($mysqli));

        //create an array
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }
        echo json_encode($emparray);

        //close the db connection
        mysqli_close($mysqli);

            
?>