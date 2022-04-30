<link rel="stylesheet" href="./CSS/solid.min.css" />
<link rel="stylesheet" href="./CSS/style.css">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="media/logo.png" alt="Ez - Soft" height="60" width="60">
  </div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="callout callout-info">
                    <h5><i class="fas fa-info"></i> Nota:</h5>
                    Completa todos los datos de tu cliente asi podras emitir un remito acorde a el mismo.
                </div>
            </div>
        </div>
    </div>

</section>
<div class="login-page">
    <div class="form">
        <h2 aligncenter>Actualizar Cliente</h2>

        <?php
        include "includes/funciones.php";
        $hash = $_GET['hash'];
        $datos = [];
        $datos = dtoscliente($hash, $mysqli);
        //echo $datos;
        ?>

        <div class="input-group mb-0">
            <input id="nombre" name="nombre" type="text" placeholder="Nombre" autocomplete="off" class="form-control" value = "<?php echo $datos[0];?>"/>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="direccion" name="direccion" type="text" placeholder="Direccion" autocomplete="off"
                class="form-control" value = "<?php echo $datos[1];?>" />
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="provincia" name="provincia" type="text" placeholder="Provincia" autocomplete="off"
                class="form-control" value = "<?php echo $datos[2];?>"/>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="codpos" name="codpos" type="text" placeholder="Codigo Postal" autocomplete="off"
                class="form-control" value = "<?php echo $datos[3];?>"/>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-map-marker-alt"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="telefono" name="telefono" type="text" placeholder="Telefono de contacto" autocomplete="off"
                class="form-control" value = "<?php echo $datos[4];?>"/>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-0">
            <input id="correo" name="Correo" type="email" placeholder="Email" autocomplete="off" class="form-control" value = "<?php echo $datos[5];?>"/>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-at"></span>
                </div>
            </div>
        </div>

        <button type="submit" onclick="cliente()">Aceptar</button>
    </div>
</div>
<script>
function cliente() {
    // Se obtienen los datos
    var nombre = document.getElementById("nombre").value;
    var direccion = document.getElementById("direccion").value;
    var provincia = document.getElementById("provincia").value;
    var codpos = document.getElementById("codpos").value;
    var telefono = document.getElementById("telefono").value;
    var email = document.getElementById("correo").value;
    var idcl = <?php echo $hash;?>;

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
        Notiflix.Notify.Failure("Debes ingresar un Telefono de contacto!");
        return;
    }
    // Si no escribió se notifica
    if (email.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un correo de contacto!");
        return;
    }

    // Activa la pantalla de carga
    Notiflix.Loading.Circle('Cargando...');

    $.ajax({
        type: 'POST',
        url: 'Inyector.php',
        data: {
            Archivo: 'ajax.php',
            nombre: nombre,
            direccion: direccion,
            provincia: provincia,
            codpos: codpos,
            telefono: telefono,
            email: email,
            Tipo: 'actualizar',
            id: idcl
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
                    'Su cliente fue actualizado correctamente, precione aceptar para concluir."',
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