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
                    Elegi la fecha de cierre.
                </div>
            </div>
        </div>
    </div>

</section>
<div class="login-page">
    <div class="form">
        <h2 aligncenter>Fecha</h2>
        <div class="col-md-8 mx-auto text-center">
            <div class="form-group">
                <input type="datetime" class="form-control" placeholder="Ingrese fecha" id="datetime-picker">
            </div>
        </div>
        <button type="submit" onclick="aceptar()">Aceptar</button>
    </div>
</div>
<script>
// Inicia el flatpickr
flatpickr('#datetime-picker', {
    enableTime: true,
    dateFormat: "m-d-Y",
});

function aceptar() {
    var fecha = document.getElementById("datetime-picker").value;
    var fecha2 = document.getElementById("datetime-picker").value;
    var date = new Date(fecha);
    var date2 = new Date(fecha2);
    var dias = 1; // Número de días a agregar
    date2.setDate(date2.getDate() + dias);
    const unixTimestamp = Math.floor(date.getTime() / 1000);
    const unixTimestamp2 = Math.floor(date2.getTime() / 1000);

    Notiflix.Confirm.ask(
        'Cierre Diario',
        'Introduzca la clave',
        'izipizilemonsqueezi',
        'Aceptar',
        'Cancel',
        function okCb() {
            cerrardia(unixTimestamp, unixTimestamp2);
        },
        function cancelCb() {
            Location.href = ('?Seccion=Inicio');
        }, {},
    );
}

function cerrardia(unixTimestamp, unixTimestamp2) {
    Notiflix.Loading.Circle('Cargando...');
    $.ajax({
        type: 'POST',
        url: 'Inyector.php',
        data: {
            Archivo: 'ajaxROOT.php',
            Tipo: 'cierrecajas',
            fecha: unixTimestamp,
            fecha2: unixTimestamp2
        },
        dataType: 'html',
        success: function(data) {
            var Resultado = JSON.parse(data);
            Notiflix.Loading.Remove();

            if (Resultado.error) {
                Notiflix.Notify.Failure(Resultado.error);
                return;

            }
            if (Resultado.success) {
                /////////////////////////////////////////////
                location.href = ('?Seccion=Inicio');
            }
        }
    })
}
</script>