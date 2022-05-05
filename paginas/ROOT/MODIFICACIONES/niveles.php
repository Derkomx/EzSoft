<?php
include "includes/funcionesroot.php";
$usuario = $_GET['hash'];
?>
<div class="login-page">
    <div class="form">
        <h2 aligncenter>Tablas</h2>

        <div class="input-group mb-0">
            <select name="select" onchange="aceptar()" id="tabla">
                <option value="" selected>SELECCIONE</option>
                <option value="3">Usuario</option>
                <option value="9">ROOT</option>
            </select>
        </div>
    </div>
</div>
<script>
function aceptar() {
    var select = document.getElementById('tabla');
    var usuario = <?php echo $usuario;?>;
    var value = select.options[select.selectedIndex].value;
    Notiflix.Confirm.ask(
        'Actualizar nivel de id ' + usuario,
        'Introduzca la clave',
        'lvlup',
        'Aceptar',
        'Cancel',
        function okCb() {
            // Activa la pantalla de carga
            Notiflix.Loading.Circle('Cargando...');

            $.ajax({
                type: 'POST',
                url: 'Inyector.php',
                data: {
                    Archivo: 'ajaxROOT.php',
                    lvl: value,
                    usuario: usuario,
                    Tipo: 'actualizarnivel'
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
                            'Sus datos fueron actualizados correctamente, precione aceptar para concluir."',
                            'aceptar',
                            () => {
                                document.location = '/ezSoft/';
                            },
                        )
                    };
                },
            });
        },
        function cancelCb() {
            return
        }, {},
    );
}
</script>