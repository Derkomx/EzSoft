<?php
include_once '../../includes/MySQL.php';
function prodenremito($nremito, $mysqli){
    $resultados = [];
    if ($stmt = $mysqli->prepare("SELECT id_prod, cant, preciou, precio FROM prodvend where id_remito = $nremito")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($id_prod, $cant, $preciou,$precio);
		while ($stmt->fetch()) {
			$resultados[] = array($id_prod, $cant, $preciou,$precio);
		}
		return ($resultados);
		
	}
}

?>