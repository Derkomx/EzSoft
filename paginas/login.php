<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link rel="stylesheet" href="CSS/style-login.css">
 <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;500;700&display=swap" rel="stylesheet">
 <script src="librerias/jQuery.js"></script>
 <script src="librerias/jquery.maskedinput.js"></script>
 <script src="librerias/sha512.js"></script>
 <link rel="stylesheet" href="./librerias/notiflix-2.4.0.min.css" />
 <script src="./librerias/notiflix-2.4.0.min.js"></script>
 <title>-Ez Soft-</title>
</head>
<body>
    <div class="login">
        <div class="form-container">
          <img src=""
           alt="logo" class="logo">
          <form class="form">
            <label for="user" 
            class="label">Usuario</label>
            <div>
            <input type="text" 
            id="user" 
            placeholder="Usuario" 
            class="input input-email">
            </div>
            <label for="clave" 
            class="label">Password</label>
            <div>
            <input type="password" 
            id="clave" 
            placeholder="*********" 
            class="input input-password">
            </div>
            <label class="">Recordar usuario
					  <div>
						<input type="checkbox" id="Recordar">
						<span class="checkmark"></span>
					  </div>
				    </label>
            <input 
            onclick="InicioSesion()" 
            class="primary-button 
            login-button">
          </form>
        </div>
      </div>
    
</body>
<script src="scripts/Ingreso.js"></script>
</html>