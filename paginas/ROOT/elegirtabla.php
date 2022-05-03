<div class="login-page">
    <div class="form">
        <h2 aligncenter>Tablas</h2>

        <div class="input-group mb-0">
            <select name="select" onchange="aceptar()" id="tabla">
                <option value="">SELECCIONE</option>
                <option value="cierredia">cierredia</option>
                <option value="clientes">clientes</option>
                <option value="cuentaclientes">cuentaclientes</option>
                <option value="intentos_logueo">intentos_logueo</option>
                <option value="menu">menu</option>
                <option value="movcuentaclientes">movcuentaclientes</option>
                <option value="products">products</option>
                <option value="prodvend">prodvend</option>
                <option value="recibo">recibo</option>
                <option value="remitos">remitos</option>
                <option value="usuarios">usuarios</option>
                <option value="usuarios2">usuarios2</option>
            </select>
        </div>
    </div>
</div>
<script>
function aceptar() {
    var select = document.getElementById('tabla');
    var value = select.options[select.selectedIndex].value;
    Notiflix.Confirm.ask(
        'ACCEDER A TABLA '+value,
        'Introduzca la clave',
        'tablasroot',
        'Aceptar',
        'Cancel',
        function okCb() {
            location.href = ('?Seccion=tabla&id='+value);
        },
        function cancelCb() {
            return
        }, {},
    );
}
</script>