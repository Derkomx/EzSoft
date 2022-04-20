// Función al pulsar el botón "Iniciar sesión" para ingresar a una cuenta
function InicioSesion() {
    // Se obtienen el user y la clave
    var user = document.getElementById("user").value;
    var clave = document.getElementById("clave").value;

    // Si no se escribió un user, se notifica
    if (user.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar un usuario!");
        return;
    }

    // Si no escribió una clave, se notifica
    if (clave.length == 0) {
        Notiflix.Notify.Failure("Debes ingresar tu clave!");
        return;
    }

    // Activa la pantalla de carga
    Notiflix.Loading.Circle('Cargando...');

    $.ajax({
        type: 'POST',
        url: './Inyector.php',
        data: { Archivo: 'Ingreso.php', user: user, clave: clave },
        dataType: 'html',
        success: function(data) {
            var Resultado = JSON.parse(data);
            Notiflix.Loading.Remove();

            if (Resultado.error) {
                Notiflix.Notify.Failure(Resultado.error);
                return;
            }

            if (Resultado.location) {
                // Se borran los datos almacenados si existen
                localStorage.setItem("Recordar", 0);
                localStorage.setItem("user", false);

                // Recordar datos
                if (document.getElementById("Recordar").checked) {
                    // Si está seleccionado "Recordar user", se almacena para usarlo la próxima vez
                    localStorage.setItem("Recordar", 1);
                    localStorage.setItem("user", user);
                }

                location.reload();
                return;
            }

            Notiflix.Notify.Failure("Acaba de ocurrir un error muy raro...");
            return;
        },
        error: function(data) {
            Notiflix.Loading.Remove();

            Notiflix.Notify.Failure("¡No se pudo recibir una respuesta del servidor!");

            console.log(data);
            return;
        }
    });
}



$(document).ready(function() {
    /*Obtener datos almacenados*/
    var Recordar = localStorage.getItem("Recordar");
    var suser = localStorage.getItem("user");

    if (Recordar == 1) {
        document.getElementById("user").value = suser;
        document.getElementById("Recordar").checked = true;
    }

});

function enterKeyPressed(event) {
    if (event.keyCode == 13) {
        InicioSesion();
        return false;
    }
}