<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <title>-Ez Soft-</title>
    <link rel="shortcut icon" href="media/logo.png" type="image/x-icon">
    <link rel="icon" href="media/logo.png" type="image/x-icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Librería jQuery -->
    <script src="librerias/jQuery.js"></script>
    <!-- Librería jQuery - maskedinput -->
    <script src="librerias/jquery.maskedinput.js"></script>
    <!-- Librería Notiflix -->
    <link rel="stylesheet" href="librerias/Notiflix/notiflix-2.6.0.min.css" />
    <script src="librerias/Notiflix/notiflix-2.6.0.min.js"></script>
    <!-- Bootstrap -->
    <link href="librerias/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <!-- Modernizr JS -->
    <script src="librerias/modernizr-3.5.0.min.js"></script>
    <!-- SweetAlert 2 -->
    <script src="librerias/sweetalert2.all.min.js"></script>
    <!-- notiflix nuevo -->
    <script src="librerias/notiflix3.2.5/dist/notiflix-confirm-aio-3.2.5.min.js"></script>
    <link rel="stylesheet" href="CSS/solid.min.css" />
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/stilo.css">

</head>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Nota:</h5>
                    Completa todos los datos para poder utilizar el sistema.
                </div>
            </div>
        </div>
    </div>

</section>
<div class="login-page">
    <div class="form">
        <h2 aligncenter>Usuario</h2>

        <div class="input-group mb-0">
            <input id="nombre" name="nombre" type="text" placeholder="Nombre" autocomplete="off" class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="direccion" name="direccion" type="text" placeholder="Direccion" autocomplete="off"
                class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="provincia" name="provincia" type="text" placeholder="Provincia" autocomplete="off"
                class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="codpos" name="codpos" type="text" placeholder="Codigo Postal" autocomplete="off"
                class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="telefono" name="telefono" type="text" placeholder="Telefono de contacto" autocomplete="off"
                class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="correo" name="Correo" type="email" placeholder="Email" autocomplete="off" class="form-control" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-at"></span>
                </div>
            </div>
        </div>

        <button type="submit" onclick="cliente()">Aceptar</button>
    </div>
</div>

<script src="librerias/Bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
function cliente() {
    // Se obtienen los datos
    var nombre = document.getElementById("nombre").value;
    var direccion = document.getElementById("direccion").value;
    var provincia = document.getElementById("provincia").value;
    var codpos = document.getElementById("codpos").value;
    var telefono = document.getElementById("telefono").value;
    var email = document.getElementById("correo").value;

    // Si no escribió se notifica
    if (nombre.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un Nombre!");
        return;
    }
    // Si no escribió se notifica
    if (direccion.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar una Direccion!");
        return;
    }
    // Si no escribió se notifica
    if (provincia.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar una Provincia!");
        return;
    }
    // Si no escribió se notifica
    if (codpos.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un Codigo Postal!");
        return;
    }
    // Si no escribió se notifica
    if (telefono.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un Telefono!");
        return;
    }
    // Si no escribió se notifica
    if (email.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un Email!");
        return;
    }


    // Activa la pantalla de carga
    Notiflix.Loading.Circle('Cargando...');

    $.ajax({
        type: 'POST',
        url: 'Inyector.php',
        data: {
            Archivo: 'datos.php',
            nombre: nombre,
            direccion: direccion,
            provincia: provincia,
            codpos: codpos,
            telefono: telefono,
            email: email,
            tipo: 'nuevo'
        },
        dataType: 'html',
        success: function(data) {
            var Resultado = JSON.parse(data);
            Notiflix.Loading.Remove();

            if (Resultado.error) {
                Notiflix.Notify.Failure(Resultado.error);
                return;
            }

            if (Resultado.location) {

                Notiflix.Report.Success(
                    'Exito',
                    'Sus datos fueron cargados correctamente, precione aceptar para concluir el registro."',
                    'aceptar',
                    () => {
                        document.location = '/ezSoft/';
                    },
                )
            };
        },
    });
}
</script>

</html>