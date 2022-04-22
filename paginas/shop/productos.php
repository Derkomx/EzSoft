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

<body>
    <div class="container">
        <h4>Carrito de compras</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Acción</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody id="items"></tbody>
            <tfoot>
                <tr id="footer">
                    <th scope="row" colspan="5">Carrito vacio - comience a comprar!</th>
                </tr>
            </tfoot>
        </table>

        <h4>Productos</h4>
        <div class="row" id="cards"></div>
    </div>

    <template id="template-footer">
        <th scope="row" colspan="2">Total productos</th>
        <td>
            <button class="btn btn-success btn-sm" onclick="comprar()">
                Comprar
            </button>
        </td>
        <td>
            <button class="btn btn-danger btn-sm" id="vaciar-carrito">
                Vaciar Carro
            </button>
        </td>
        <td class="font-weight-bold">$ <span>5000</span></td>
    </template>

    <template id="template-carrito">
        <tr>
            <th scope="row">id</th>
            <td>Café</td>
            <td>1</td>
            <td>
                <button class="btn btn-info btn-sm">+</button>
                <button class="btn btn-danger btn-sm">-</button>
            </td>
            <td>$ <span>500</span></td>
        </tr>
    </template>

    <template id="template-card">
        <div class="col-12 mb-2 col-md-4">
            <div class="card">
                <img src="media/1.jfif" alt="Card image" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">Titulo</h5>
                    <p class="card-text">precio</p>
                    <button class="btn btn-dark">Comprar</button>
                </div>
            </div>
        </div>
    </template>
    <script src="scripts/productos.js"></script>
    <script>
    function comprar() {
        //toma los datos almacenados en el cache
        var x = JSON.parse(localStorage.getItem('carrito'));
        Notiflix.Loading.Circle('Cargando...');
        var tipo = 'remito';
        const cCantidad = Object.values(carrito).reduce((acc, {
        cantidad
        }) => acc + cantidad, 0)
        const cPrecio = Object.values(carrito).reduce((acc, {
        cantidad,
        precio
        }) => acc + cantidad * precio, 0)
        var subtotal = cPrecio;
        //crea un registro en tabla remitos y devuelve el id del registro
        $.ajax({
            type: 'POST',
            url: 'Inyector.php',
            data: {Archivo: 'productos2.php', Tipo: tipo, subtotal: subtotal},
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
                            data: {Archivo: 'productos2.php', datos: prodv, Tipo: 'prodvend',remito: Resultad.success, cant: prodc, preciou: preciou, precio: precio, titulo: titulo},
                            dataType: 'html',
                            success: function(data) {
                                var Resultado = JSON.parse(data);
                                Notiflix.Loading.Remove();

                                if (Resultado.error) {
                                    Notiflix.Notify.Failure(Resultado.error);
                                    return;
                                    console.log(Resultado.error)
                                
                                }
                                if (Resultado.success){
                                    carrito = {}
                                    hash = <?php echo $cliente?>;
                                    pintarCarrito()
                                    /////////////////////////////////////////////
                                    window.open('/ezSoft/paginas/shop/remito.php?remito='+Resultad.success+'&hash='+hash)
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

    
</body>
