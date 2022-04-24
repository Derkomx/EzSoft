const cards = document.getElementById('cards')
const items = document.getElementById('items')
const footer = document.getElementById('footer')
const templateCard = document.getElementById('template-card').content
const templateFooter = document.getElementById('template-footer').content
const templateCarrito = document.getElementById('template-carrito').content
const fragment = document.createDocumentFragment()
let fila = {}
let carrito = {}
let data = {}

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

async function myAjax(data) {
  let result
  try {
    
    result = await $.ajax({
      type: 'POST',
      url: 'Inyector.php',
      data: {Archivo: 'productos.php', Tipo: 'carga'},
      dataType: 'html',     
    })
    
    return JSON.parse(result)
  } catch (error) {
    console.error(error)
  }
} 

// Traer productos
const fetchData = async () => {
    data = await myAjax()
    pintarCards(data)
};

// Pintar productos
const pintarCards = (data) => {
    var i = -1;
    Object.values(data).forEach(item => {
        i++
        //data.forEach(item => {
        templateCard.querySelector('th').textContent = item[0]
        templateCard.querySelectorAll('td')[0].textContent = item[5]
        templateCard.querySelectorAll('td')[1].textContent = item[2]
        templateCard.querySelector('span').textContent = item[4]
        templateCard.querySelector('.btn-dark').dataset.id = i
        //////////////////////////////////////////////////////////////
        const clone = templateCard.cloneNode(true)
        fragment.appendChild(clone)
    })
    cards.appendChild(fragment)
    $(document).ready(function() {
        $('#example1').DataTable({
            responsive: true,
            language: {
                search: "Buscar:",
                info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                zeroRecords: "No se encontraron resultados",
                infoEmpty: "Mostrando 0 de 0 de 0 entradas",
                lengthMenu: "Mostrar _MENU_ entradas",
                infoFiltered: "(filtrado de _MAX_ total entradas)",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            }
        });
    });
}


// Agregar al carrito
const addCarrito = e => {

    if (e.target.classList.contains('btn-dark')) {
        //(data[e.target.dataset.id].id_prod) = (data[e.target.dataset.id].id_prod - 1)
        setCarrito(data[e.target.dataset.id])
    }
    e.stopPropagation()
}

const setCarrito = item => {
    const producto = {
        title: item[2],
        precio: item[4],
        id: item[0],
        cantidad: 1
    }

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
    <th scope="row" colspan="5">Carrito vacío - comience a comprar!</th>
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

    //templateFooter.querySelectorAll('td')[0].textContent = nCantidad
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
        //console.log(e.target.dataset.id)
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