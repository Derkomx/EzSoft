<script>
Notiflix.Confirm.ask(
    'ACCEDER A TABLAS',
    'Introduzca la clave',
    'tablasroot',
    'Aceptar',
    'Cancel',
    function okCb() {
        location.href = ('?Seccion=elegirtabla');
    },
    function cancelCb() {
        location.href = ('?Seccion=Inicio');
    }, {},
);
</script>