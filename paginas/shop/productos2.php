<?php 
$cliente = $_GET['hash'];
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Librería jQuery -->
    <script src="librerias/jQuery.js"></script>
    <!-- Librería jQuery - maskedinput -->
    <script src="librerias/jquery.maskedinput.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
</head>
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="media/logo.png" alt="Ez - Soft" height="60" width="60">
</div>
<div class="container">
    <h4>Productos</h4>
            <div class="row" id="cards"></div>
</div>



<template id="template-card">
    <div class="col-12 mb-2 col-md-4">
        <div class="card">
            <img src="" alt="" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">Titulo</h5>
                <p class="card-text">precio</p>
            </div>
        </div>
    </div>
</template>
<script src="scripts/productos2.js"></script>
<script>
function comprar() {
    //toma los datos almacenados en el cache
    var x = JSON.parse(localStorage.getItem('carrito'));
    const cCantidad = Object.values(carrito).reduce((acc, {
        cantidad
    }) => acc + cantidad, 0)
    const cPrecio = Object.values(carrito).reduce((acc, {
        cantidad,
        precio
    }) => acc + cantidad * precio, 0)
    var subtotal = cPrecio;
    var cliente2 = <?php echo $cliente?>;
    Notiflix.Loading.Circle('Cargando...');
    //crea un registro en tabla remitos y devuelve el id del registro
    $.ajax({
        type: 'POST',
        url: 'Inyector.php',
        data: {
            Archivo: 'ajax.php',
            Tipo: 'remito',
            subtotal: subtotal,
            cliente: cliente2
        },
        dataType: 'html',
        success: function(data) {
            var Resultad = JSON.parse(data);
            //console.log(Resultado.success)
            if (Resultad.error) {
                Notiflix.Notify.Failure(Resultad.error);
                return;
            }
            ////////////////////////////////////////////////////
            if (Resultad.success) {
                Object.values(carrito).forEach(producto => {
                    var prodc = producto.cantidad;
                    var prodv = producto.id;
                    var preciou = producto.precio;
                    var precio = producto.precio * producto.cantidad;
                    var titulo = producto.title;
                    console.log(titulo);
                    //console.log(y)

                    ////////////////////////////////////////////////////        
                    $.ajax({
                        type: 'POST',
                        url: 'Inyector.php',
                        data: {
                            Archivo: 'ajax.php',
                            datos: prodv,
                            Tipo: 'prodvend',
                            remito: Resultad.success,
                            cant: prodc,
                            preciou: preciou,
                            precio: precio,
                            titulo: titulo
                        },
                        dataType: 'html',
                        success: function(data) {
                            var Resultado = JSON.parse(data);
                            Notiflix.Loading.Remove();

                            if (Resultado.error) {
                                Notiflix.Notify.Failure(Resultado.error);
                                return;
                                console.log(Resultado.error)

                            }
                            if (Resultado.success) {
                                carrito = {}
                                hash = <?php echo $cliente?>;
                                pintarCarrito()
                                /////////////////////////////////////////////
                                location.href = ('?Seccion=remito&remito=' + Resultad
                                    .success + '&hash=' + hash)
                                //window.open('/ezSoft/?Seccion=remito&remito='+Resultad.success+'&hash='+hash)
                                /////////////////////////////////////////////
                            }
                            /////////////////////////////////////////////  
                        }
                    });
                })
                ///////////////////////////////////////////////////// 
            }
        }
    });
}
</script>