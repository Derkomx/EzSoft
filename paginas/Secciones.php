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
		///////////////////////////////////////////////////
		"carrito" => "shop/selcliente.php",
		"carrito2" => "shop/productos2.php",
		"productoscatalogo" => "shop/productos.php",
		"productostabla" => "shop/productos3.php",
		"remito" => "shop/remito.php",
		"remitofinal" => "shop/rremitofinal.php",
		///////////////////////////////////////////////////
		"nuevocliente" => "administracion/clientenuevo.php",
		"ventas" => "administracion/ventas.php",
		"vercliente" => "administracion/vercliente.php",
		"ctascliente" => "administracion/ctascliente.php",
		"verctacliente" => "administracion/ctacliente.php",
		"nuevoproducto" => "administracion/cargarproducto.php",
		"eliminarproducto" => "administracion/eliminarproducto.php",
		"estadisticas" => "administracion/estadisticas.php",
		"pago"=>"administracion/pago.php",
		"pagofinal"=>"administracion/pagofinal.php",
		"admclientes"=>"administracion/admcliente.php",
		"pagocliente"=>"administracion/pagocliente.php",
		//datos.php de seccion DATOS no esta agregado ya que se redirije una sola vez en el sistema//
		///////////////////////////////////////////////
	];
	$Secciones[9] = [
		"Inicio" => "404.php",
		///////////////////////////////////////////////////
		"carrito" => "shop/selcliente.php",
		"carrito2" => "shop/productos2.php",
		"productoscatalogo" => "shop/productos.php",
		"productostabla" => "shop/productos3.php",
		"remito" => "shop/remito.php",
		"remitofinal" => "shop/rremitofinal.php",
		///////////////////////////////////////////////////
		"nuevocliente" => "administracion/clientenuevo.php",
		"ventas" => "administracion/ventas.php",
		"vercliente" => "administracion/vercliente.php",
		"ctascliente" => "administracion/ctascliente.php",
		"verctacliente" => "administracion/ctacliente.php",
		"nuevoproducto" => "administracion/cargarproducto.php",
		"eliminarproducto" => "administracion/eliminarproducto.php",
		"estadisticas" => "administracion/estadisticas.php",
		"pago"=>"administracion/pago.php",
		"pagofinal"=>"administracion/pagofinal.php",
		"admclientes"=>"administracion/admcliente.php",
		"pagocliente"=>"administracion/pagocliente.php",
		//datos.php de seccion DATOS no esta agregado ya que se redirije una sola vez en el sistema//
		///////////////////////////////////////////////
		"listausuarios"=>"ROOT/usuarios.php",
		"emailsactivos"=>"ROOT/emailactivo.php",
		"emailsinactivos"=>"ROOT/emailinactivo.php",
		"condatos"=>"ROOT/condatos.php",
		"sindatos"=>"ROOT/sindatos.php",
		"usuariosactivos"=>"ROOT/activo.php",
		"usuariosinactivos"=>"ROOT/inactivo.php",
		"estadisticasroot"=>"ROOT/estadisticas.php"
	];


?>