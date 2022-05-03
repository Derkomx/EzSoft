<?php 
include "includes/funciones.php";
?>
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="media/logo.png" alt="Ez - Soft" height="60" width="60">
</div>
<div class="container">
    <h4>Productos</h4>
    <div class="row" id="cards">
        <?php
            $user = $_SESSION['id_usuario'];
            $productos = [];
            $productos = todoslosproductos($mysqli);
            foreach($productos as $name){
            echo
            '<div class="col-12 mb-2 col-md-4">'.
            '<div class="card">';
                if ($name[1] == null){
                echo '<img src="./productos/Preview/nulo.jpg" alt="" class="card-img-top">';
                }else{
                echo '<img src="./productos/Preview/'.$user.'/'.$name[2].'.jpeg" alt="" class="card-img-top">';
                }
                echo 
                '<div class="card-body">
                    <h5 class="card-title">'.$name[1].'</h5>
                    <p class="card-text">$'.$name[3].'</p>
                    <p class="card-text">Cantidad: '.$name[4].'</p>
                </div>
                <button class="btn btn-info" onclick="elegir('.$name[0].')">Elegir</button>
                </div>
            </div>';
            }
            ?>
    </div>
</div>
<script>
function elegir(producto) {
    Notiflix.Confirm.prompt(
        'Aviso',
        'Indique en numeros cuantos productos se sumaran o restaran del stock o el nuevo precio',
        '',
        'Stock',
        'Precio',
        function Stock(dato) {
            if (dato.length == 0) {
                return
            }
            Notiflix.Loading.Circle('Cargando...');
            const tipo = 'stock';
            enviar(dato, producto, tipo);
        },
        function Precio(dato) {
            if (dato.length == 0) {
                return
            }
            Notiflix.Loading.Circle('Cargando...');
            const tipo = 'precio';
            enviar(dato, producto, tipo);
        },
    )
}

function enviar(dato, producto, tipo) {

    console.log(dato, producto, tipo);
    $.ajax({
        type: 'POST',
        url: 'Inyector.php',
        data: {
            Archivo: 'ajax.php',
            Tipo: tipo,
            data: dato,
            prod: producto,
        },
        dataType: 'html',
        success: function(data) {
            console.log(data)
            var Resultado = JSON.parse(data);
            console.log(Resultado);
            Notiflix.Loading.Remove();

            if (Resultado.error) {
                console.log(Resultado.error);
                Notiflix.Notify.Failure(Resultado.error);
                return;

            }
            if (Resultado.success) {
                /////////////////////////////////////////////
                location.href = ('?Seccion=carrito2');
            }
        }
    })
}
</script>