<?php

function prodenremito($nremito){
    if ($stmt = $mysqli->prepare("SELECT id_prod, cant, precio FROM prodvend where id_remito = $nremito")) {
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result($id_prod, $cant, $precio);
		while ($stmt->fetch()) {
			$resultados[] = array($id_prod, $cant, $precio);
		}
		return ($resultados);
		
	}
}

?>