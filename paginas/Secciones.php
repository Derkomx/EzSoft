<?php
/*
	Archivo: Secciones.php
	Autor: Armas, Juan Manuel
	Proposito: Funcionamiento de las secciones aparte del menú
	Fecha: 07/01/2021
	Ultima edición: 08/01/2021
*/

	// Array limpio
	$Secciones = [];

	// Secciones de nivel 3 (Usuario)
	$Secciones[3] = [
		"Inicio" => "404.php",
		"carrito" => "shop/selcliente.php",
		"carrito2" => "shop/productos.php",
		"productos" => "shop/productos.php",
		"CrearCarpeta" => "crear/crearc.php",
		"nuevocliente" => "administracion/clientenuevo.php",
		"ventas" => "administracion/ventas.php",
		"vercliente" => "administracion/vercliente.php",
		"ctascliente" => "administracion/ctascliente.php",
		"verctacliente" => "administracion/ctacliente.php",
	];

?>