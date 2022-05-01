const signInBtn = document.getElementById("signIn");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const container = document.querySelector(".container");

signInBtn.addEventListener("click", () => {
    container.classList.remove("right-panel-active");
});

signUpBtn.addEventListener("click", () => {
    container.classList.add("right-panel-active");
});

fistForm.addEventListener("click", e => {
    Registrarme(e);
});
secondForm.addEventListener("click", e => {
    InicioSesion(e);
});



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

// Función al pulsar el botón "Iniciar sesión" para ingresar a una cuenta
function InicioSesion(e) {
    if (e.target.classList.contains('btn')) {
        // Se obtienen el user y la clave
        var user = secondForm.querySelectorAll('input')[0].value;
        var clave = secondForm.querySelectorAll('input')[1].value;
        //var user = document.getElementById("user").value;
        //var clave = document.getElementById("clave").value;
        console.log(hex_sha512(clave));
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
            data: { Archivo: 'Ingreso.php', user: user, clave: hex_sha512(clave) },
            dataType: 'html',
            success: function(data) {
                var Resultado = JSON.parse(data);
                Notiflix.Loading.Remove();

                if (Resultado.error) {
                    Notiflix.Notify.Failure(Resultado.error);
                    return;
                }

                if (Resultado.location) {


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
}

function Registrarme(e) {

    if (e.target.classList.contains('btn')) {
        // Se obtienen los datos ingresados

        var usuario = fistForm.querySelectorAll('input')[0].value;
        var Correo = fistForm.querySelectorAll('input')[1].value;
        var Clave = fistForm.querySelectorAll('input')[2].value;

        // Variable para verificar si completó todos los campos
        var Incompleto = false;

        // Si no se escribió un CUIL, se notifica
        if (usuario.length == 0) {
            Incompleto = true;
        }

        if (Correo.length == 0) {
            Incompleto = true;
        }

        // Si no escribió una clave, se notifica
        if (Clave.length == 0) {
            Incompleto = true;
        }

        if (Incompleto) {
            Notiflix.Notify.Failure("¡Debes completar todos los campos!");
            return;
        }

        // Activa la pantalla de carga
        Notiflix.Loading.Circle('Cargando...');
        $.ajax({
            type: 'POST',
            url: './Inyector.php',
            data: { Archivo: 'Registro.php', CUIL: usuario, Clave: hex_sha512(Clave), Correo: Correo },
            dataType: 'html',
            success: function(data) {
                console.log(data);
                var Resultado = JSON.parse(data);
                Notiflix.Loading.Remove();

                if (Resultado.error) {
                    Notiflix.Notify.Failure(Resultado.error);
                    return;
                }

                if (Resultado.success) {
                    Notiflix.Report.Success(
                        '¡Registrado con éxito!',
                        'Tu usuario fue registrado correctamente. Recibirás un correo electrónico en la dirección de correo que ingresaste, donde deberás confirmar tu cuenta para poder acceder a la página.',
                        'Aceptar',
                        function() {
                            location.reload();
                        }
                    );
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
}