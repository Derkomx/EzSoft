<?php
$fecha = $_GET['fecha'];
include "includes/funciones.php";
$movimientosdia = movimientosdia($fecha, $mysqli);

?>