<?php
$user = 1;
include "../../includes/productos.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Ez Soft</title>
    <link href="../../librerias/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    	<!-- Librería jQuery -->
	<script src="../../librerias/jQuery.js"></script>
	<!-- Librería jQuery - maskedinput -->
	<script src="../../librerias/jquery.maskedinput.js"></script>
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
                    <th scope="row" colspan="5">Carrito vacío - comience a comprar!</th>
                </tr>
            </tfoot>
        </table>
        <h4>Cards</h4>
        <div class="row" id="cards"></div>
    </div>

    <template id="template-footer">
        <th scope="row" colspan="2">Total productos</th>
        <td>10</td>
        <td>
            <button class="btn btn-danger btn-sm" id="vaciar-carrito">
                vaciar todo
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
                <button class="btn btn-info btn-sm">
                    +
                </button>
                <button class="btn btn-danger btn-sm">
                    -
                </button>
            </td>
            <td>$ <span>500</span></td>
        </tr>
    </template>

    <template id="template-card">
        <div class="col-12 mb-2">
            <div class="card">
                <div class="card-body">
                    <h5>Titulo</h5>
                    <p>precio</p>
                    <button class="btn btn-dark">Comprar</button>
                </div>
            </div>
        </div>
    </template>

    <!------------------------------------------------------------------------------------------------>

    <script>
    const cards = document.getElementById('cards')
    const items = document.getElementById('items')
    const footer = document.getElementById('footer')
    const templateCard = document.getElementById('template-card').content
    const templateFooter = document.getElementById('template-footer').content
    const templateCarrito = document.getElementById('template-carrito').content
    const fragment = document.createDocumentFragment()
    let carrito = {}

    // Eventos
    // El evento DOMContentLoaded es disparado cuando el documento HTML ha sido completamente cargado y parseado
    document.addEventListener('DOMContentLoaded', e => {
        fetchData()
        if (localStorage.getItem('carrito')) {
            carrito = JSON.parse(localStorage.getItem('carrito'))
            pintarCarrito()
        }
    });
    cards.addEventListener('click', e => {
        addCarrito(e)
    });
    items.addEventListener('click', e => {
        btnAumentarDisminuir(e)
    })

    function getjson(data) {
        var usu = <?php echo $user?>;
     
        $.ajax({
            type: 'POST',
            url: '../../Inyector.php',
            data: {Archivo: 'productos.php', usu: usu},
            dataType: 'html',
            success: function(data) {
              var Resultado = JSON.parse(data);
              console.log(Resultado);
            },
            error: function(MLHttpRequest, textStatus, errorThrown) {
                console.log("ERROR", errorThrown);
            }
        });
    }

    // Traer productos
    const fetchData = async () => {
        const res = await getjson();
        //const res = await fetch(getjson());
        const data = await res.json()
        // console.log(data)
        pintarCards(data)
    }

    // Pintar productos
    const pintarCards = data => {
        data.forEach(item => {
            templateCard.querySelector('h5').textContent = item.nomprod
            templateCard.querySelector('p').textContent = item.prevent
            templateCard.querySelector('button').dataset.id = item.id
            const clone = templateCard.cloneNode(true)
            fragment.appendChild(clone)
        })
        cards.appendChild(fragment)
    }
   

    // Agregar al carrito
    const addCarrito = e => {
        if (e.target.classList.contains('btn-dark')) {
            // console.log(e.target.dataset.id)
            // console.log(e.target.parentElement)
            setCarrito(e.target.parentElement)
        }
        e.stopPropagation()
    }

    const setCarrito = item => {
        // console.log(item)
        const producto = {
            title: item.querySelector('h5').textContent,
            precio: item.querySelector('p').textContent,
            id: item.querySelector('button').dataset.id,
            cantidad: 1
        }
        // console.log(producto)
        if (carrito.hasOwnProperty(producto.id)) {
            producto.cantidad = carrito[producto.id].cantidad + 1
        }

        carrito[producto.id] = {
            ...producto
        }

        pintarCarrito()
    }

    const pintarCarrito = () => {
        items.innerHTML = ''

        Object.values(carrito).forEach(producto => {
            templateCarrito.querySelector('th').textContent = producto.id
            templateCarrito.querySelectorAll('td')[0].textContent = producto.title
            templateCarrito.querySelectorAll('td')[1].textContent = producto.cantidad
            templateCarrito.querySelector('span').textContent = producto.precio * producto.cantidad

            //botones
            templateCarrito.querySelector('.btn-info').dataset.id = producto.id
            templateCarrito.querySelector('.btn-danger').dataset.id = producto.id

            const clone = templateCarrito.cloneNode(true)
            fragment.appendChild(clone)
        })
        items.appendChild(fragment)

        pintarFooter()
        localStorage.setItem('carrito', JSON.stringify(carrito))
    }


    const pintarFooter = () => {
        footer.innerHTML = ''

        if (Object.keys(carrito).length === 0) {
            footer.innerHTML = `
        <th scope="row" colspan="5">Carrito vacío con innerHTML</th>
        `
            return
        }

        // sumar cantidad y sumar totales
        const nCantidad = Object.values(carrito).reduce((acc, {
            cantidad
        }) => acc + cantidad, 0)
        const nPrecio = Object.values(carrito).reduce((acc, {
            cantidad,
            precio
        }) => acc + cantidad * precio, 0)
        // console.log(nPrecio)

        templateFooter.querySelectorAll('td')[0].textContent = nCantidad
        templateFooter.querySelector('span').textContent = nPrecio

        const clone = templateFooter.cloneNode(true)
        fragment.appendChild(clone)

        footer.appendChild(fragment)

        const boton = document.querySelector('#vaciar-carrito')
        boton.addEventListener('click', () => {
            carrito = {}
            pintarCarrito()
        })

    }

    const btnAumentarDisminuir = e => {
        // console.log(e.target.classList.contains('btn-info'))
        if (e.target.classList.contains('btn-info')) {
            const producto = carrito[e.target.dataset.id]
            producto.cantidad++
            carrito[e.target.dataset.id] = {
                ...producto
            }
            pintarCarrito()
        }

        if (e.target.classList.contains('btn-danger')) {
            const producto = carrito[e.target.dataset.id]
            producto.cantidad--
            if (producto.cantidad === 0) {
                delete carrito[e.target.dataset.id]
            } else {
                carrito[e.target.dataset.id] = {
                    ...producto
                }
            }
            pintarCarrito()
        }
        e.stopPropagation()
    }
    </script>
    <!---------------------------------------------------------------------------------------------------------------------->
</body>

</html>