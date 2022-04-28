<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link rel="stylesheet" href="CSS/style-inicio.css">
 <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
 <script src="librerias/jQuery.js"></script>
 <script src="librerias/jquery.maskedinput.js"></script>
 <script src="librerias/sha512.js"></script>
 <link rel="stylesheet" href="./librerias/notiflix-2.4.0.min.css" />
 <script src="librerias/notiflix-2.4.0.min.js"></script>

 <title>-Ez Soft-</title>
</head>
<body>
<div class="container right-panel-active">
	<!-- Sign Up -->
	<div class="container__form container--signup">
		<form action="#" class="form" id="form1">
			<h2 class="form__title">Registrarme</h2>
			<input type="text" placeholder="Usuario" class="input" />
			<input type="email" placeholder="Email" class="input" />
			<input type="password" placeholder="Contraseña" class="input" />
			<button class="btn">Registrarme</button>
		</form>
	</div>

	<!-- Sign In -->
	<div class="container__form container--signin">
		<form action="#" class="form" id="form2">
			<h2 class="form__title">Iniciar Sesion</h2>
			<input type="text" placeholder="Usuario" class="input" />
			<input type="password" placeholder="Contraseña" class="input" />
			<a href="#" class="link">Olvidaste tu Contraseña?</a>
			<button class="btn">Iniciar</button>
		</form>
	</div>

	<!-- Overlay -->
	<div class="container__overlay">
		<div class="overlay">
			<div class="overlay__panel overlay--left">
				<button class="btn" id="signIn">Iniciar Sesion</button>
			</div>
			<div class="overlay__panel overlay--right">
				<button class="btn" id="signUp">Registrarme</button>
			</div>
		</div>
	</div>
</body>
<script src="scripts/Ingreso2.js"></script>
</html>